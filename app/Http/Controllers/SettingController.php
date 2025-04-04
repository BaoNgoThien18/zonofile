<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.pages.settings.index');
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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id)
    {


    }

    public function updateAllSetting(Request $request)
    {
        $allData = $request->all(); // Đảm bảo $allData được khởi tạo
    
        foreach ($allData as $key => $value) {
            if ($request->hasFile($key)) {
                $file = $request->file($key);
                $originalName = $file->getClientOriginalName();
                $uniqueName = time() . '_' . $originalName; // Tạo tên file duy nhất
                $destinationPath = public_path('uploads'); // Đường dẫn thực tế tới thư mục uploads
    
                // Đảm bảo thư mục tồn tại
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }
    
                // Lưu file vào thư mục public/uploads
                $file->move($destinationPath, $uniqueName);
    
                // Gán đường dẫn file cho biến $path
                $path = 'uploads/' . $uniqueName;
    
                // Lưu thông tin vào bảng settings
                Setting::updateOrCreate(
                    ['name' => $key],
                    ['value' => $path]
                );
            } else {
                // Lưu thông tin thông thường vào bảng settings
                Setting::updateOrCreate(
                    ['name' => $key],
                    ['value' => $value ?? ''] // Xử lý giá trị NULL
                );
            }
        }
    
        // Flash message thành công
        session()->flash('success', 'Cập nhật thành công!');
    
        // Trả về trang trước
        return back();
    }
    



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
