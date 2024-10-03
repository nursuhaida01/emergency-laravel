<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * แสดงฟอร์มการลงทะเบียน
     */
    public function showRegistrationForm()
    {
        return view('auth.register'); // ระบุเส้นทางไปยังฟอร์มการลงทะเบียน
    }

    /**
     * ฟังก์ชันสำหรับสมัครสมาชิก
     */
    public function register(Request $request)
    {
        // ตรวจสอบข้อมูลที่ส่งมา
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:15',
        ]);

        // บันทึกข้อมูลผู้ใช้ในฐานข้อมูล
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password), // แฮชรหัสผ่านก่อนบันทึก
            'phone' => $request->phone,
        ]);

        // ตรวจสอบว่าการสมัครสมาชิกสำเร็จหรือไม่
        if ($user) {
            // หากสำเร็จให้แสดงข้อความ success บนหน้าสมัครสมาชิก
            return redirect()->back()->with('success', 'สมัครสมาชิกสำเร็จ');
        } else {
            // หากล้มเหลวให้แสดง error บนหน้าสมัครสมาชิก
            return redirect()->back()->with('error', 'การสมัครสมาชิกล้มเหลว');
        }
    }
}
