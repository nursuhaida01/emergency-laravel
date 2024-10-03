<?php
namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // ดึงข้อมูลข่าวสารจากฐานข้อมูล
        $latestNews = News::orderBy('created_at', 'desc')->limit(5)->get(); // ดึงข่าวสาร 5 รายการล่าสุด

        // ส่งข้อมูลไปยังมุมมอง Dashboards.blade.php
        return view('Dashboards', compact('latestNews'));
    }
}
