<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incident;
use Carbon\Carbon;
use DB;
class accidentController extends Controller
{
    public function index(Request $request)
    {
        // รับค่าช่วงเวลาที่ผู้ใช้เลือก
        $startDate = $request->query('startDate') ? Carbon::parse($request->query('startDate')) : null;
        $endDate = $request->query('endDate') ? Carbon::parse($request->query('endDate')) : null;

        // Query ข้อมูลตามช่วงเวลาที่เลือก
        $query = Incident::whereNotNull('created_at');
        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        // นับจำนวนการแจ้งเหตุทั้งหมด
        $totalIncidents = $query->count();

        // นับจำนวนเหตุการณ์เจ็บป่วย อุบัติเหตุ และอื่น ๆ
        $illnessCount = (clone $query)->where('help_needed', 'เจ็บป่วย')->count();
        $accidentCount = (clone $query)->where('help_needed', 'อุบัติเหตุ')->count();
        $otherCount = (clone $query)->whereNotIn('help_needed', ['เจ็บป่วย', 'อุบัติเหตุ'])->count();

        // ดึงข้อมูลเหตุการณ์ที่มีสถานะ 'แจ้งเหตุใหม่'
        $incidents = (clone $query)->where('status', 'แจ้งเหตุใหม่')->get();
        $newIncidentsCount = $incidents->count(); // กำหนดค่าให้ตัวแปรนี้

        $inProgress  = (clone $query)->where('status', 'กำลังดำเนินการ')->get();
        $inProgressCount = $inProgress->count(); // กำหนดค่าให้ตัวแปรนี้

        // ดึงข้อมูลเหตุการณ์ที่เสร็จสิ้นและยกเลิกตามช่วงเวลา
        $completedIncidents = (clone $query)->where('status', 'เสร็จสิ้น')->get();
        $completedCounts = $completedIncidents->count(); // นับจำนวนเหตุการณ์ที่เสร็จสิ้น

        $cancelIncidents = (clone $query)->where('status', 'ยกเลิก')->get();
        $cancelCount = $cancelIncidents->count(); // นับจำนวนเหตุการณ์ที่ยกเลิก

        // แสดงรายชื่อเดือน
        $months = [
            'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 
            'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 
            'พฤศจิกายน', 'ธันวาคม'
        ];
        $locations = Incident::select('latitude', 'longitude')->get();
    
     
        // ส่งข้อมูลไปยัง View
        return view('accident_report', compact(
            'startDate', 'endDate', 'totalIncidents',  'incidents', 'newIncidentsCount', 'inProgressCount', 'inProgress', 'locations',
            'illnessCount', 'accidentCount', 'otherCount',
            'completedCounts', 'cancelCount', 'cancelIncidents', 'months', 'completedIncidents'
        ));
    }
}
