<?php

namespace App\Http\Controllers;
use App\Models\Incident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function notifications()
    {
        // ดึงข้อมูล incident ที่เกี่ยวข้องกับผู้ใช้ที่ล็อกอิน
        $user = Auth::user();
        $incidents = Incident::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(10);

        return view('notifications.index', compact('incidents'));
    }
}