<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Folder;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;

use App\Models\DocumentPermission;


class FolderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $folders = Folder::all();
        echo 'ngobao';
    }

    public function indexClient(string $id)
    {

            $folder = Folder::where('user_id', Auth::user()->id)
            ->where('id', $id)
            
            ->first();
            
            $folders = Folder::where('user_id', Auth::user()->id)
            ->where('parent_id', $id)
            ->get();

           
    
            $files = Document::where('user_id', Auth::user()->id)
            ->where('folder_id', $id)
            ->where('is_deleted', 0)
            ->get();


            foreach ($files as $file) {


                $documentPermission = DocumentPermission::where('document_id', $file->id)->first();

                if ($documentPermission) $file->iconRule = $this->getIconRuleFile($documentPermission->rule);
                else  $file->iconRule = $this->getIconRuleFile('0');



                $file->realSize = $this->convertBytes($file->size);
            }




        $breadcrumbs = $this->getBreadcrumb($id);

        return view('frontend.pages.folder', compact('folders', 'folder', 'breadcrumbs', 'files'));
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

        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:folders,id',     
        ]);

        $parentFolders = Folder::where('user_id', Auth::user()->id)
        ->where('parent_id', $request->parent_id)->get();

        foreach($parentFolders as $row) {
            if ($row->name == $request->name) {
                return response()->json(['status' => 'error', 'msg' => 'Thư mục đã tồn tại']);
            }
        }

        Folder::create([
            'user_id' => Auth::user()->id,
            'name'=> $request->name,
            'parent_id' => $request->parent_id,
        ]);

        return response()->json(['status' => 'success', 'msg' => 'Tải lên thư mục thành công']);

     

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $folder = Folder::where('user_id', Auth::user()->id)
        ->where('id', $id)
        ->first();
        
        $folders = Folder::where('user_id', Auth::user()->id)
        ->where('parent_id', $id)
        ->get();

        $breadcrumbs = $this->getBreadcrumb($id);

        return view('frontend.pages.folder', compact('folders', 'folder', 'breadcrumbs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getBreadcrumb($folderId)
    {
        while ($folderId != null) {
            $folder = Folder::find($folderId);
            $breadcrumbs[] = $folder;
            $folderId = $folder->parent_id;
        }
        return array_reverse($breadcrumbs);
    }

}