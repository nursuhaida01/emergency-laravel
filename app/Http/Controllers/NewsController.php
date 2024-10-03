<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    // แสดงรายการข่าวทั้งหมด
    public function index(Request $request)
    {
        $query = News::query();

        // ตรวจสอบว่ามีการส่งค่าการค้นหามาหรือไม่
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'LIKE', "%{$search}%")
                ->orWhere('content', 'LIKE', "%{$search}%");
        }

        // กรองข่าวตามประเภทถ้ามีการเลือก
        if ($request->has('category')) {
            $category = $request->input('category');
            $query->where('category', $category);
        }

        // ดึงข้อมูลข่าวสารทั้งหมด โดยเรียงลำดับตามวันที่อัปเดตล่าสุด
        $news = $query->orderBy('updated_at', 'desc')->get();

        // ส่งตัวแปร $news ไปยัง view
        return view('news.index', compact('news'));
    }
   
    public function showDashboard()
    {
        // ดึงข้อมูลข่าวสารจากฐานข้อมูล
        $newsItems = News::all();

        // ตรวจสอบการดึงข้อมูลจากฐานข้อมูล
        dd($newsItems);  // ดูข้อมูลก่อนเพื่อยืนยันว่าได้ข้อมูลมาจากฐานข้อมูลหรือไม่

        // ส่งข้อมูลไปยัง View
        return view('Dashboards', compact('newsItems'));
    }
    public function showFrontend()
    {
        // ดึงข้อมูลข่าวทั้งหมด
        $newsItems = News::orderBy('created_at', 'desc')->paginate(10); // แสดงข่าวทีละ 10 รายการ
        
        return view('news.frontend', compact('newsItems'));
    }
    
    public function showNewsDetail($id)
    {
        // ดึงข้อมูลข่าวที่ต้องการแสดงรายละเอียด
        $newsItem = News::findOrFail($id);
        
        return view('news.detail', compact('newsItem'));
    }
    

    


    // แสดงหน้าแบบฟอร์มสร้างข่าว
    public function create()
    {
        return view('news.create');
    }

    // บันทึกข้อมูลข่าวสารใหม่
    public function store(Request $request)
    {
        // ตรวจสอบข้อมูลที่ส่งมา
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'username' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'time' => 'required|date_format:Y-m-d\TH:i',
            'category' => 'nullable|string|max:255',
        ]);

        // ประมวลผลการอัปโหลดรูปภาพ
        $fileNames = [];
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName);
                $fileNames[] = '/images/' . $imageName;
            }
        }

        // สร้างรายการข่าวใหม่และบันทึกลงในฐานข้อมูล
        News::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => json_encode($fileNames), // บันทึกรูปภาพในรูปแบบ JSON
            'username' => $request->username,
            'location' => $request->location,
            'time' => $request->time,
            'category' => $request->category,
        ]);

        // ตรวจสอบว่าเป็นการร้องขอแบบ JSON หรือไม่
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'บันทึกข้อมูลสำเร็จ'
            ]);
        }

        return redirect()->route('news.index')->with('success', 'News created successfully!');
    }

    // แสดงหน้าแบบฟอร์มแก้ไขข่าว
    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('news.edit', compact('news'));
    }

    // อัปเดตข้อมูลข่าวสาร
    public function update(Request $request, $id)
    {
        // ตรวจสอบข้อมูลที่ส่งมา
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'username' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'time' => 'required|date_format:Y-m-d\TH:i',
            'category' => 'nullable|string|max:255',
        ]);

        $news = News::findOrFail($id);

        // รับข้อมูลรูปภาพที่มีอยู่แล้ว
        $fileNames = json_decode($news->image, true) ?: [];

        // ประมวลผลการอัปโหลดรูปภาพใหม่
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName);
                $fileNames[] = '/images/' . $imageName;
            }
        }

        // อัปเดตข่าวสารด้วยข้อมูลใหม่
        
        $news->update([
            'title' => $request->title,
            'content' => $request->content,
            'image' => json_encode($fileNames), // อัปเดตรูปภาพในรูปแบบ JSON
            'username' => $request->username,
            'location' => $request->location,
            'time' => $request->time,
            'category' => $request->category,
        ]);

        return redirect()->route('news.index')->with('success', 'News updated successfully!');
    }

    // ลบข่าวสาร
    public function destroy($id)
    {
        $news = News::findOrFail($id);

        // ลบรูปภาพจากโฟลเดอร์ public/images
        $images = json_decode($news->image, true);
        if ($images) {
            foreach ($images as $image) {
                if (file_exists(public_path($image))) {
                    unlink(public_path($image));
                }
            }
        }

        // ลบรายการข่าว
        $news->delete();

        return redirect()->route('news.index')->with('success', 'News deleted successfully!');
    }

    // แสดงข่าวสารเฉพาะรายการหนึ่ง
    public function show($id)
    {
        $newsItem = News::findOrFail($id);
        // เพิ่มจำนวนครั้งที่ดู
        $newsItem->increment('view_count');
        $relatedNews = News::where('id', '!=', $id)->take(3)->get();
        return view('news.show', compact('newsItem', 'relatedNews'));
    }
}
