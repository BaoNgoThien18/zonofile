<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rows = Package::all();
         // send tele 

       

        return view('backend.pages.packages.index', compact('rows'));
    }
    public function indexClient()
    {
        $packages = Package::where('status', 1)->get();

        return view('frontend.pages.upgrade', compact('packages'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.packages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:0',
            'capacity' => 'required|integer|min:0',
            'status' => 'required|integer|min:0',
        ]);

        Package::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'duration' => $request->duration,
            'capacity' => $request->capacity,
            'status' => $request->status,
        ]);
        return redirect()->back()->with('success', 'Thêm gói thành công!');
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
        $row = Package::find($id);
        return view('backend.pages.packages.edit', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:0',
            'capacity' => 'required|integer|min:0',
            'status' => 'required|integer|min:0',
        ]);
        $row = Package::find($id);
        $row->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'duration' => $request->duration,
            'capacity' => $request->capacity,
            'status' => $request->status,
        ]);
        return redirect()->back()->with('success', 'Chỉnh sửa thông tin gói thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $row = Package::find($id);

        if (!$row) {
            return redirect()->back()->withErrors(['error' => 'Không tìm thấy gói nào!']);
        }

        $row->delete();

        return redirect()->back()->with('success', 'Xóa gói thành công!');
    }

}