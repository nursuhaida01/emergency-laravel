<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginuserController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.user_login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect()->intended('Dashboards');
        }
        
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email', 'remember'));
    }
    public function logout(Request $request)
    {
        // ล็อกเอาท์ผู้ใช้
        Auth::guard('web')->logout();
        
        // ลบข้อมูลเซสชันที่เกี่ยวข้อง
        $request->session()->forget('user_data');
        
        // สร้างโทเค็นใหม่เพื่อป้องกัน CSRF token mismatch
        $request->session()->regenerateToken();
        
        // เปลี่ยนเส้นทางไปยังหน้า Dashboards หลังจากออกจากระบบ
        return redirect('/Dashboards'); // ใช้ URL แทน named route

    }
    
    
}