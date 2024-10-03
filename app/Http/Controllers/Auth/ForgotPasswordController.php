<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail (Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->back()->with('error', 'ไม่พบผู้ใช้งานที่มีอีเมลนี้');
        }

        // ส่งไปที่หน้ารีเซ็ตรหัสผ่านโดยไม่ต้องส่งอีเมล
        return redirect()->route('password.reset', ['token' => $user->id])->with('status', 'ไปหน้ากรอกรหัสผ่านใหม่');
    }

    public function showResetForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);
    
        $user = User::find($request->token);
        if (!$user) {
            return redirect()->back()->with('error', 'ไม่พบผู้ใช้งาน');
        }
    
        $user->password = Hash::make($request->password);
        $user->save();
    
        Auth::login($user);
    
        return redirect()->route('home')->with('status', 'รีเซ็ตรหัสผ่านสำเร็จ');
    }
    
}
