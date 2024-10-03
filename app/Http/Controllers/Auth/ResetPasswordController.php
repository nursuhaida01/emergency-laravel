<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ResetPasswordController extends Controller
{
    public function showResetForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::find($request->token);
        if (!$user) {
            return redirect()->back()->with('error', 'ไม่พบผู้ใช้งาน');
        }

        // รีเซ็ตรหัสผ่าน
        $user->password = Hash::make($request->password);
        $user->save();

        // ล็อกอินผู้ใช้ทันทีหลังจากรีเซ็ตรหัสผ่าน
        Auth::login($user);

        return redirect()->route('user.login')->with('status', 'รีเซ็ตรหัสผ่านสำเร็จ');
    }
}
