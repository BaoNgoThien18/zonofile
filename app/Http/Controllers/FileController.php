<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Events\RealtimeUploadPercentage;
use Carbon\Carbon;
use App\Models\Folder;
use App\Models\User;
use App\Models\Log;
use App\Models\Subscription;
use App\Models\DocumentPermission;

use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;


// s3
use Aws\S3\S3Client;
use Aws\S3\MultipartUploader;
use Aws\Exception\AwsException;




class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $folders = Folder::all();

        $files = Document::all();

        $totalFiles = Document::count();
        $totalFilesIsDeleted = Document::where('is_deleted', 1)->count();


        foreach ($files as $file) {
            $file->size = $this->convertBytes($file->size);
            $file->user = User::find($file->user_id);
        }

        return view('backend.pages.files.index', compact('files', 'folders', 'totalFiles', 'totalFilesIsDeleted'));
    }

    public function shared(Request $request)
    {


        $file = Document::where('shared_id', $request->id)->first();

        abort_if(!$file, 404);

        $fileRule = DocumentPermission::where('document_id', $file->id)->first();

        abort_if(!$fileRule, 404);

     

        if ($fileRule->rule == '0') {
            if ( !Auth::check())    return redirect('/');

            if ($fileRule->user_id != Auth::user()->id) {
                return redirect('/');
            } 
        }

        if ($fileRule->user_id == Auth::user()->id) {
            $fileRule->rule = 'me';
        }
           

        return view('frontend.pages.shared', compact('file', 'fileRule'));
    }


    public function indexClient()
    {
        $folders = Folder::where('user_id', Auth::user()->id)
            ->where('parent_id', null)
            ->inRandomOrder() // Sắp xếp ngẫu nhiên các bản ghi
            ->get();

        $files = Document::where('user_id', Auth::user()->id)
            ->where('type', 'file')
            ->where('is_deleted', 0)
            ->inRandomOrder() // Sắp xếp ngẫu nhiên các bản ghi
            ->get();

        $user = Auth::user();
        $subscription = Subscription::where('user_id', $user->id)->first();

        foreach ($folders as $folder) {
            $folder->fileCounts = Document::where('folder_id', $folder->id)->count();
            $folder->timeAgo = Carbon::parse($folder->updated_at)->diffForHumans(Carbon::now(), true);
        }

        // Lặp qua từng file để lấy icon
        foreach ($files as $file) {

            

            $file->realSize = $this->convertBytes($file->size);
            $file->icon = $this->getIconFile($file->path); // Lưu icon vào thuộc tính 'icon' của file
            $file->timeAgo = Carbon::parse($file->created_at)->diffForHumans(Carbon::now(), true);
        }

        return view('frontend.pages.file', compact('files', 'folders', 'subscription'));
    }

    public function recent()
    {
        $folders = Folder::where('user_id', Auth::user()->id)
            ->where('parent_id', null)
            ->orderBy('id', 'desc')
            ->get();


        $files = Document::where('user_id', Auth::user()->id)
            ->where('type', 'file')
            ->where('is_deleted', 0)
            ->orderBy('id', 'desc')
            ->get();

        $user = Auth::user();
        $subscription = Subscription::where('user_id', $user->id)->first();

        foreach ($folders as $folder) {
            $folder->fileCounts = Document::where('folder_id', $folder->id)->count();
            $folder->timeAgo = Carbon::parse($folder->updated_at)->diffForHumans(Carbon::now(), true);
        }

        // Lặp qua từng file để lấy icon
        foreach ($files as $file) {
            $file->icon = $this->getIconFile($file->path); // Lưu icon vào thuộc tính 'icon' của file
            $file->timeAgo = Carbon::parse($file->created_at)->diffForHumans(Carbon::now(), true);
        }

        return view('frontend.pages.recent', compact('files', 'folders', 'subscription'));
    }


    public function trash()
    {
        $folders = Folder::where('user_id', Auth::user()->id)
            ->where('parent_id', null)
            ->orderBy('id', 'desc')
            ->get();

        $files = Document::where('user_id', Auth::user()->id)
            ->where('type', 'file')
            ->where('is_deleted', 1)
            ->orderBy('id', 'desc')
            ->get();

        $user = Auth::user();
        $subscription = Subscription::where('user_id', $user->id)->first();

        foreach ($folders as $folder) {
            $folder->fileCounts = Document::where('folder_id', $folder->id)->count();
            $folder->timeAgo = Carbon::parse($folder->updated_at)->diffForHumans(Carbon::now(), true);
        }

        // Lặp qua từng file để lấy icon
        foreach ($files as $file) {
            $file->icon = $this->getIconFile($file->path); // Lưu icon vào thuộc tính 'icon' của file
            $file->timeAgo = Carbon::parse($file->created_at)->diffForHumans(Carbon::now(), true);
        }

        return view('frontend.pages.trash', compact('files', 'folders', 'subscription'));
    }



    public function myfolder()
    {
        $folders = Document::where('type', 'folder')->get();

        return view('frontend.pages.folder', compact('folders'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->checkLogin();

        // 
        $folder_id = $request->input('folder_id');

        $urls = [];
        $startTime = microtime(true);

        if ($request->hasFile('files')) {
            $files = $request->file('files');
            $totalFiles = count($files);
            $uploadedFiles = 0;

            $subscription = Subscription::where('user_id', Auth::id())
                ->where('status', 1)
                ->first();
            if (!$subscription) {
                return response()->json(['message' => 'Subscription not found.'], 404);
            }

            foreach ($files as $file) {



                $shared_id = Str::random(30);

                // 


                $fileTitle = $file->getClientOriginalName();
                $fileSize = $file->getSize();


                // 
                $pathRandom = 'uploads/user_' . Auth::id() . '/' . $shared_id . '.' . $file->getClientOriginalExtension();
                $filePath = $file->getPathname();

                // Tạo S3Client
                $s3Client = new S3Client([
                    'version' => 'latest',
                    'region' => env('AWS_DEFAULT_REGION'),
                    'credentials' => [
                        'key' => env('AWS_ACCESS_KEY_ID'),
                        'secret' => env('AWS_SECRET_ACCESS_KEY'),
                    ],
                ]);

                $uploadTotalSize = $fileSize;

                // Kiểm tra nếu kích thước file bằng 0
                if ($uploadTotalSize === 0) {
                    return response()->json(['message' => 'File size is 0, upload failed.']);
                }
                if (!$this->checkCapacity($subscription->id, $uploadTotalSize)) {
                    return response()->json(['status' => 'error', 'message' => 'Not enough capacity to upload the file. Remaining capacity:' . $subscription->total_capacity - $subscription->used_capacity]);

                }
                $s3Client->putObject([
                    'Bucket' => env('AWS_BUCKET'),
                    'Key' => $pathRandom,
                    'SourceFile' => $filePath,
                    'ContentType' => 'application/pdf',
                    '@http' => [
                        'progress' => function ($downloadTotalSize, $downloadSizeSoFar, $uploadTotalSize, $uploadSizeSoFar) use (&$totalSize, &$fileTitle, &$fileSize) {


                            // Tính toán phần trăm đã tải lên
                            if ($uploadTotalSize > 0) {
                                $percentage = ($uploadSizeSoFar / $uploadTotalSize) * 100;
                            } else {
                                $percentage = 0; // Tránh phép chia cho 0
                            }

                            $eventData = [
                                'fileTitle' => $fileTitle,
                                'fileSize' => $this->convertBytes($fileSize),
                                'uploaded' => $this->convertBytes($uploadSizeSoFar),
                                'total' => $this->convertBytes($uploadTotalSize),
                                'percentage' => round($percentage), // Làm tròn
                            ];

                            event(new RealtimeUploadPercentage($eventData));

                        },
                    ]
                ]);

                // Lưu URL file đã upload
                $urls[] = $s3Client->getObjectUrl(env('AWS_BUCKET'), $pathRandom);
                $uploadedFiles++;

                // Lưu thông tin vào database
                $create = Document::create([
                    'user_id' => Auth::id(),
                    'folder_id' => $request->folder_id,
                    'title' => $fileTitle,
                    'path' => $pathRandom,
                    'shared_id' => $shared_id,
                    'size' => $fileSize,
                    'type' => 'file',
                ]);
                $this->updateUsedCapacity($subscription->id, $uploadTotalSize);


                // Log
                Log::create([
                    'user_id' => Auth::id(),
                    'ip' => $request->ip(),
                    'device' => $request->header('User-Agent'),
                    'action' => 'Tải lên file ' . $fileTitle,
                ]);


            }

            // Tính toán thời gian tải lên và tốc độ
            $currentTime = microtime(true);
            $elapsedTime = $currentTime - $startTime;

            // Kiểm tra để tránh phép chia cho 0
            if ($elapsedTime > 0) {
                $transferRate = ($totalSize / $elapsedTime) / (1024 * 1024); // MB/s
            } else {
                $transferRate = 0; // Tránh phép chia cho 0
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Tải lên thành công!',
                'data' => [
                    'urls' => $urls,
                    'totalTime' => $elapsedTime,
                    'totalSize' => $totalSize / (1024 * 1024), // Convert to MB
                    'transferRate' => $transferRate, // MB/s
                ]
            ], 200);
        }

        return response()->json(['message' => 'No files uploaded'], 400);
    }

    public function downloadFile($id)
    {

        $file = Document::where('shared_id', $id)->first();

        abort_if(!$file, 404);

        $fileRule = DocumentPermission::where('document_id', $file->id)->first();

        abort_if(!$fileRule, 404);

        if ($fileRule->rule != 'download')
            return redirect('/');

        $filePath = $file->path;

        $s3Client = new S3Client([
            'version' => 'latest',
            'region'  => env('AWS_DEFAULT_REGION'),
            'credentials' => [
                'key'    => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);

        try {
            $result = $s3Client->getObject([
                'Bucket' => env('AWS_BUCKET'),
                'Key'    => $filePath,
            ]);

            $file->count_downloads += 1;
            $file->save();

            return response($result['Body'])
                ->header('Content-Type', $result['ContentType'])
                ->header('Content-Disposition', 'attachment; filename="' . $file->title . '"');

        } catch (AwsException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    public function storeFile(Request $request)
    {
        $this->checkLogin();

        $urls = [];
        $startTime = microtime(true);

        if ($request->hasFile('files')) {
            $files = $request->file('files');
            $totalFiles = count($files);
            $uploadedFiles = 0;

            $subscription = Subscription::where('user_id', Auth::id())
                ->where('status', 1)
                ->first();
            if (!$subscription) {
                return response()->json(['message' => 'Subscription not found.'], 404);
            }
            foreach ($files as $file) {



                // 


                $fileTitle = $file->getClientOriginalName();
                $fileSize = $file->getSize();


                // 
                $pathRandom = 'uploads/user_' . Auth::id() . '/' . Str::random(30) . '.' . $file->getClientOriginalExtension();
                $filePath = $file->getPathname();

                // Tạo S3Client
                $s3Client = new S3Client([
                    'version' => 'latest',
                    'region' => env('AWS_DEFAULT_REGION'),
                    'credentials' => [
                        'key' => env('AWS_ACCESS_KEY_ID'),
                        'secret' => env('AWS_SECRET_ACCESS_KEY'),
                    ],
                ]);

                $uploadTotalSize = $fileSize;
                $this->updateUsedCapacity($subscription->id, $uploadTotalSize);

                // Kiểm tra nếu kích thước file bằng 0
                if ($uploadTotalSize === 0) {
                    return response()->json(['message' => 'File size is 0, upload failed.'], 400);
                }

                $s3Client->putObject([
                    'Bucket' => env('AWS_BUCKET'),
                    'Key' => $pathRandom,
                    'SourceFile' => $filePath,
                    'ContentType' => 'application/pdf',
                    '@http' => [
                        'progress' => function ($downloadTotalSize, $downloadSizeSoFar, $uploadTotalSize, $uploadSizeSoFar) use (&$totalSize, &$fileTitle, &$fileSize) {


                            // Tính toán phần trăm đã tải lên
                            if ($uploadTotalSize > 0) {
                                $percentage = ($uploadSizeSoFar / $uploadTotalSize) * 100;
                            } else {
                                $percentage = 0; // Tránh phép chia cho 0
                            }

                            $eventData = [
                                'fileTitle' => $fileTitle,
                                'fileSize' => $this->convertBytes($fileSize),
                                'uploaded' => $this->convertBytes($uploadSizeSoFar),
                                'total' => $this->convertBytes($uploadTotalSize),
                                'percentage' => round($percentage), // Làm tròn
                            ];

                            event(new RealtimeUploadPercentage($eventData));

                        },
                    ]
                ]);

                // Lưu URL file đã upload
                $urls[] = $s3Client->getObjectUrl(env('AWS_BUCKET'), $pathRandom);
                $uploadedFiles++;

                // Lưu thông tin vào database
                Document::create([
                    'user_id' => Auth::id(),
                    'title' => $fileTitle,
                    'path' => $pathRandom,
                    'size' => $fileSize,
                    'type' => 'file',
                ]);
            }

            // Tính toán thời gian tải lên và tốc độ
            $currentTime = microtime(true);
            $elapsedTime = $currentTime - $startTime;

            // Kiểm tra để tránh phép chia cho 0
            if ($elapsedTime > 0) {
                $transferRate = ($totalSize / $elapsedTime) / (1024 * 1024); // MB/s
            } else {
                $transferRate = 0; // Tránh phép chia cho 0
            }

            return response()->json([
                'success' => true,
                'message' => 'Tải lên thành công!',
                'urls' => $urls,
                'totalTime' => $elapsedTime,
                'totalSize' => $totalSize / (1024 * 1024), // Convert to MB
                'transferRate' => $transferRate, // MB/s
            ], 200);
        }

        return response()->json(['success' => false, 'message' => 'No files uploaded'], 400);
    }




    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $file = Document::where('id', $id)->first();
        $file->size = $this->convertBytes($file->size);
        $file->user = User::find($file->user_id);

        return view('backend.pages.Files.EditFiles', compact('file'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $file = Document::findOrFail($id);

        $file->is_deleted = $request->input('is_deleted');

        $file->save();

        return redirect()->back()->with('success', 'Cập nhật file thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getFile(Request $request)
    {

        $fileId = $request->get('id');

        $file = Document::find($fileId);
        return response()->json([
            'status' => 'success',
            'data' => $file,
        ]);
    }

    public function getRuleFile(Request $request)
    {

        $fileId = $request->get('id');

        $ruleFile = DocumentPermission::where('document_id', $fileId)->first();
        if ($ruleFile) {
            return response()->json([
                'status' => 'success',
                'data' => $ruleFile,
            ]);
        }

        $ruleFile['rule'] = '0';

        return response()->json([
            'status' => 'success',
            'data' => $ruleFile,
        ]);
    }

    public function searchFile(Request $request)
    {
        $key = $request->get('key');

        $files = Document::where('user_id', Auth::user()->id)
            ->where('title', 'like', '%' . $key . '%')
            ->where('type', 'file')
            ->where('is_deleted', 0)
            ->orderBy('id', 'desc')
            ->get();

        $folders = Folder::where('user_id', Auth::user()->id)
            ->where('parent_id', null)
            ->orderBy('id', 'desc')
            ->where('name', 'like', '%' . $key . '%')->get();

        foreach ($folders as $folder) {
            $folder->fileCounts = Document::where('folder_id', $folder->id)->count();
            $folder->timeAgo = Carbon::parse($folder->updated_at)->diffForHumans(Carbon::now(), true);
        }

        // Lặp qua từng file để lấy icon
        foreach ($files as $file) {
            $file->icon = $this->getIconFile($file->path); // Lưu icon vào thuộc tính 'icon' của file
            $file->timeAgo = Carbon::parse($file->created_at)->diffForHumans(Carbon::now(), true);
        }


        return response()->json([
            'status' => 'success',
            'msg' => 'Tìm kiếm thành công từ khóa: ' . $key,
            'data' => [
                'files' => $files,
                'folders' => $folders,
            ],
        ]);
    }





    public function removeFile(Request $request)
    {
        $fileId = $request->get('id');

        $file = Document::find($fileId);


        if (!$file) {
            return response()->json(['status' => 'error', 'msg' => 'File not found'], 404);
        }

        if ($file && $file->is_deleted == 0) {
            $file->is_deleted = 1;
            $file->save();
            return response()->json([
                'status' => 'success',
                'updated_at' => $file->updated_at,
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'File not found',
            ], 404);
        }
    }

    public function removeAllFile(Request $request)
    {

        $fileIds = $request->get('id');

        $msg = [];

        foreach ($fileIds as $fileId) {

            $file = Document::find($fileId);

            if (!$file) {

                array_push($msg, 'Không tìm thấy file có id: ' . $fileId);

                continue;
            }

            if ($file && $file->is_deleted == 0) {
                $file->is_deleted = 1;
                $file->save();
                array_push($msg, 'Xóa thành công file id: ' . $fileId);

            }

        }

        return response()->json([
            'status' => 'success',
            'message' => $msg,
        ]);
    }


    public function restoreFile(Request $request)
    {

        $fileId = $request->get('id');

        $file = Document::find($fileId);


        if (!$file) {
            return response()->json(['status' => 'error', 'msg' => 'File not found'], 404);
        }

        if ($file && $file->is_deleted == 1) {
            $file->is_deleted = 0;
            $file->save();
            return response()->json([
                'status' => 'success',
                'updated_at' => $file->updated_at,
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'File not found',
            ], 404);
        }
    }

    public function updateUsedCapacity($subscription_id, $uploadTotalSize)
    {
        $uploadSizeInMB = $uploadTotalSize / (1024 * 1024); // Chuyển đổi sang MB
        $subscription = Subscription::find($subscription_id);

        // Cộng thêm dung lượng đã sử dụng
        $subscription->used_capacity += $uploadSizeInMB;
        $subscription->save();
    }

    public function checkCapacity($subscription_id, $uploadTotalSize)
    {
        $subscription = Subscription::find($subscription_id);

        if (!$subscription) {
            throw new \Exception("Subscription not found.");
        }

        // Tính dung lượng còn lại
        $remainingCapacity = $subscription->total_capacity - $subscription->used_capacity;

        // Kiểm tra dung lượng
        if (($uploadTotalSize / (1024 * 1024)) > $remainingCapacity) {
            return false; // Không đủ dung lượng
        }

        return true; // Đủ dung lượng
    }

    public function shareFileToMail(Request $request)
    {

        $fileId = $request->get('id');
        $email = $request->email;

        $file = Document::find($fileId);

        if (!$file) {
            return response()->json(['status' => 'error', 'msg' => 'File not found'], 404);
        }

        $data = [
            'user' => Auth::user(),
            'file' => $file
        ];

        try {

            Mail::to($email)->send(new SendMail($data));
            return response()->json([
                'status' => 'success',
                'msg' => '',
                'data' => [
                    'email' => $email
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'msg' => $e->getMessage()], 500);
        }


    }

    public function renameFile(Request $request)
    {

        $fileId = $request->get('id');
        $newFileName = $request->newFileName;

        $file = Document::find($fileId);

        if (!$file) {
            return response()->json(['status' => 'error', 'msg' => 'File not found'], 404);
        }

        $file->title = $newFileName;
        $file->save();

        return response()->json(['status' => 'success', 'msg' => 'Đổi tên file thành công!']);

    }

    public function updateRuleFile(Request $rq) {
        
        $fileId = $rq->get('id');
        $value = $rq->value;

        $file = Document::where('id', $fileId)->first();

        $documentPermissionRecord = DocumentPermission::where('document_id', $fileId)->first();

        if ($documentPermissionRecord) {

            $documentPermissionRecord->rule = $value;
            $documentPermissionRecord->save();


        } else {
            $documentPermissionRecord = new DocumentPermission();

            $documentPermissionRecord->document_id = $fileId;
            $documentPermissionRecord->user_id = $file->user_id;
            $documentPermissionRecord->rule = $value;
            $documentPermissionRecord->save();



        }

        return response()->json(['status' => 'success', 'msg' => 'Đổi tên file thành công!']);



    }


}