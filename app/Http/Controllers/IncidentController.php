<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Incident;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

class IncidentController extends Controller
{
    
    public function notifications()
    {
        // ดึงข้อมูล incident ที่เกี่ยวข้องกับผู้ใช้ที่ล็อกอิน
        $user = Auth::user();
        $incidents = Incident::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(10);

        return view('notifications.index', compact('incidents'));
    }
    public function markAsRead(Request $request)
    {
        $user = Auth::user();

        // อัปเดตสถานะการแจ้งเตือนเป็น "อ่านแล้ว"
        $user->unreadNotifications->markAsRead();

        return response()->json(['success' => true]);
    }
    

    public function process($id)
    {
        $incident = Incident::findOrFail($id);
        return view('incident.process', compact('incident'));
    }

    public function index(Request $request)
    {
        // ดึงข้อมูลเหตุการณ์ที่มีสถานะ 'แจ้งเหตุใหม่'
        $incidents = Incident::where('status', 'แจ้งเหตุใหม่')->get();

        // นับจำนวนเหตุการณ์ใหม่
        $newIncidentsCount = $incidents->count(); // กำหนดค่าให้ตัวแปรนี้

        // ส่งตัวแปร incidents และ newIncidentsCount ไปยังวิว
        return view('incident.index', [
            'incidents' => $incidents,
            'newIncidentsCount' => ($newIncidentsCount), // ตอนนี้ตัวแปรมีค่าแล้ว
        ]);
    }

    public function create()
    {
        return view('incident.create');
    }



    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'rate' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'help_needed' => 'required|string',
            'other_info' => 'nullable|string',
            'quantity' => 'nullable|integer',
            'description' => 'nullable|string|max:255',
            'contact_number' => 'required|string|max:15',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        $fileNames = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images'), $filename);
                $fileNames[] = $filename;
            }
        }

        $fileNamesJson = json_encode($fileNames);

        $incident = new Incident();

        $incident->rate = $request->rate;
        $incident->location = $request->location;
        $helpNeeded = $request->help_needed;
        if ($helpNeeded == 'อื่นๆ' && $request->filled('other_info')) {
            $helpNeeded = $request->other_info;
        }
        $incident->help_needed = $helpNeeded;
        $incident->quantity = $request->quantity;
        $incident->description = $request->description;
        $incident->contact_number = $request->contact_number;
        $incident->latitude = $request->input('latitude', null);
        $incident->longitude = $request->input('longitude', null);
        $incident->user_id = auth()->user()->id;

        $date = date('Ymd');
        $lastId = Incident::max('id');
        $lastId = $lastId ? $lastId + 1 : 1;
        $caseNumber = $date . '-' . str_pad($lastId, 4, '0', STR_PAD_LEFT);
        $incident->case_number = $caseNumber;
        $incident->images = $fileNamesJson;
        $incident->status = 'แจ้งเหตุใหม่';

        try {
            $incident->save();

            // แจ้งเตือนทาง Line
            $this->sendLineNotification($incident);

            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => 'บันทึกข้อมูลสำเร็จ']);
            } else {
                return redirect()->back()->with('success', 'บันทึกข้อมูลสำเร็จ');
            }
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'เกิดข้อผิดพลาดในการบันทึกข้อมูล: ' . $e->getMessage()]);
            } else {
                return redirect()->back()->with('error', 'เกิดข้อผิดพลาดในการบันทึกข้อมูล');
            }
        }
    }

    protected function sendLineNotification($incident)
    {
        $token = 'WgOkh5G71mTFF9oUM7Cc4CKHegCeLmjPskY7cvgfuII'; // ใส่ Line Notify Token ที่นี่
        $message = "แจ้งเหตุใหม่\n";
        $message .= "เคส: {$incident->case_number}\n";
        $message .= "ตำแหน่ง: {$incident->location}\n";
        $message .= "รายละเอียด: {$incident->description}\n";
        $message .= "เกี่ยวกับ: {$incident->help_needed}\n";
        $message .= "ติดต่อ: {$incident->contact_number}\n";

        $client = new Client();
        $response = $client->post('https://notify-api.line.me/api/notify', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
            ],
            'form_params' => [
                'message' => $message,
            ],
        ]);

        if ($response->getStatusCode() !== 200) {
            throw new \Exception('เกิดข้อผิดพลาดในการส่งแจ้งเตือน Line Notify');
        }
    }


    public function show($id)
    {
        $incident = Incident::with('user')->findOrFail($id);
        return view('incident.show', compact('incident'));
    }
    public function showUser($id)
    {
        $incident = Incident::where('id', $id)
            ->where('user_id', Auth::id()) // ตรวจสอบให้แน่ใจว่าเป็นเหตุการณ์ที่ผู้ใช้ล็อกอินเป็นคนรายงาน
            ->firstOrFail();

        return view('incident.showuser', compact('incident'));
    }



    public function edit($id)
    {
        $incident = Incident::findOrFail($id);
        return view('incident.edit', compact('incident'));
    }

    public function update(Request $request, $id)
    {
        $incident = Incident::findOrFail($id);

        $validatedData = $request->validate([
            'rate' => 'required',
            'location' => 'required',
            'help_needed' => 'required',
            'quantity' => 'required|integer',
            'description' => 'required',
            'contact_number' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // อัปเดตข้อมูล
        $incident->update($validatedData);

        return redirect()->route('incident.index')->with('success', 'ข้อมูลอุบัติเหตุถูกอัปเดตเรียบร้อยแล้ว');
    }

    public function destroy($id)
    {
        $incident = Incident::findOrFail($id);
        $incident->delete();
        return redirect()->route('incident.index')->with('success', 'ลบข้อมูลสมาชิกเรียบร้อยแล้ว');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
            'remarks' => 'nullable|string',
        ]);

        $incident = Incident::findOrFail($id);
        $incident->status = $request->input('status');
        $incident->remarks = $request->input('remarks', $incident->remarks);
        $incident->save();

        if ($incident->status === 'เสร็จสิ้น') {
            return redirect()->route('incident.completed')->with('success', 'เหตุการณ์เสร็จสิ้นแล้ว.');
        } elseif ($incident->status === 'ยกเลิก') {
            return redirect()->route('incident.completed')->with('success', 'เหตุการณ์ถูกยกเลิกแล้ว.');
        } else {
            return redirect()->route('incident.progress')->with('success', 'อัปเดตสถานะเรียบร้อยแล้ว');
        }
    }

    public function progress()
    {
        $incidents = Incident::where('status', 'กำลังดำเนินการ')->get();
        return view('incident.progress', compact('incidents'));
    }

    public function completedIncidents()
    {
        $completedIncidents = Incident::whereIn('status', ['เสร็จสิ้น', 'ยกเลิก'])->get();
        return view('incident.completed', compact('completedIncidents'));
    }

    public function markAsCompleted($id)
    {
        $incident = Incident::findOrFail($id);
        $incident->status = 'เสร็จสิ้น';
        $incident->save();

        return redirect()->route('incident.progress')->with('success', 'เหตุการณ์เสร็จสิ้นแล้ว.');
    }

    public function operation()
    {
        // Your logic here
        return view('incident.operation'); // หรือหน้า view ที่คุณต้องการแสดงผล
    }
}
