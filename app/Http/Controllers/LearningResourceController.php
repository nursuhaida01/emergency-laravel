<?php

namespace App\Http\Controllers;

use App\Models\LearningResource;
use Illuminate\Http\Request;

class LearningResourceController extends Controller
{
    public function show($id)
{
    $resource = LearningResource::findOrFail($id);
    $resource ->increment('view_count');

    // Fetch related articles if necessary (optional)
    $relatedResources = LearningResource::where('id', '!=', $id)->take(3)->get();

    return view('learning-resources.show', compact('resource', 'relatedResources'));
}

public function index(Request $request)
{
    // เริ่มต้นการสร้าง query
    $query = LearningResource::query();
    // ตรวจสอบว่ามีการส่งค่าการค้นหาหรือไม่
    if ($request->has('search')) {
        $search = $request->input('search');
        // ค้นหาข้อมูลในฟิลด์ title และ description
        $query->where('title', 'LIKE', "%{$search}%")
              ->orWhere('description', 'LIKE', "%{$search}%");
    }

    // ตรวจสอบว่ามีการส่งค่าพารามิเตอร์ category มาหรือไม่
    if ($request->has('category')) {
        $category = $request->input('category');
        $query->where('category', $category);
    }

    // ดึงข้อมูลจากฐานข้อมูลตามเงื่อนไขที่กำหนด
    $learningResources = $query->get();

    // ส่งข้อมูลไปยัง View ที่ชื่อว่า 'learning-resources.index'
    return view('learning-resources.index', compact('learningResources'));
}





    public function create()
    {
        return view('learning-resources.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'nullable|string|max:255',
        ]);
        
        $fileNames = [];
        if ($request->hasFile('image')) { // เปลี่ยนจาก 'images' เป็น 'image'
            foreach ($request->file('image') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName);
                $fileNames[] = '/images/' . $imageName;
            }
        }
        
        LearningResource::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => json_encode($fileNames), // Store image paths as a JSON array in the database
            'category' => $request->category,
        ]);
        
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'บันทึกข้อมูลสำเร็จ'
            ]);
        }

        
        return redirect()->route('learning-resources.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
    }          
    
    public function edit($id)
    {
        $resource = LearningResource::findOrFail($id);
        return view('learning-resources.edit', compact('resource'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'nullable|string|max:255',
        
        ]);
        
        $fileNames = [];
        if ($request->hasFile('image')) { // เปลี่ยนจาก 'images' เป็น 'image'
            foreach ($request->file('image') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName);
                $fileNames[] = '/images/' . $imageName;
            }
        }
        
        LearningResource::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => json_encode($fileNames), // Store image paths as a JSON array in the database
            'category' => $request->category,
        ]);
        
        return redirect()->route('learning-resources.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
    }        

    public function destroy($id)
    {
        $resource = LearningResource::findOrFail($id);

        if ($resource->image && file_exists(public_path($resource->image))) {
            unlink(public_path($resource->image));
        }

        $resource->delete();

        return redirect()->route('learning-resources.index')->with('success', 'Learning resource deleted successfully!');
    }
}
