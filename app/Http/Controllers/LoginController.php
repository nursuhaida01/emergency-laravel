<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // ฟังก์ชั่นเพื่อแสดงฟอร์มการเข้าสู่ระบบ
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // ฟังก์ชั่นเพื่อจัดการการเข้าสู่ระบบ
    public function login(Request $request)
    {
        // ตรวจสอบข้อมูลที่รับเข้ามา
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // พยายามเข้าสู่ระบบ
        if (Auth::attempt($credentials)) {
            // หากเข้าสู่ระบบสำเร็จ ให้เปลี่ยนเส้นทางไปยังหน้าแรก
            return redirect()->intended('home');
        }

        // หากเข้าสู่ระบบไม่สำเร็จ ให้เปลี่ยนเส้นทางกลับไปยังฟอร์มการเข้าสู่ระบบและแสดงข้อผิดพลาด
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
