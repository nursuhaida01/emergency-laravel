<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.member_login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('member')->attempt($credentials)) {
            return redirect()->intended('home');
        }

        return redirect()->back()->withErrors([
            'error' => 'Invalid credentials']);
    }

    public function logout()
    {
        Auth::guard('member')->logout();
        return redirect('/login');
    }
    public function index()
    {
        $members = Member::paginate(10); // แสดง 10 รายการต่อหน้า
        return view('member.index', compact('members'));
    }
    
    public function create()
    {
        return view('member.create');
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'username' => 'required|string|max:255|unique:members,username',
        'email' => 'required|email|unique:members,email',
        'password' => 'required|string|min:5|max:20',
        'phone' => 'nullable|string|max:20',
        'user_type' => 'required|in:ผู้ดูแลระบบ,พนักงาน',
    ], [
        'username.unique' => 'ชื่อผู้ใช้นี้ถูกใช้ไปแล้ว กรุณาใช้ชื่อผู้ใช้อื่น.',
        'email.unique' => 'อีเมล์นี้ถูกใช้ไปแล้ว กรุณาใช้อีเมล์อื่น.',
    ]);

    try {
        $member = new Member();
        $member->username = $validatedData['username'];
        $member->email = $validatedData['email'];
        $member->password = bcrypt($validatedData['password']);
        $member->phone = $validatedData['phone'];
        $member->user_type = $validatedData['user_type'];
        $member->save();

        return redirect()->route('member.index')->with('success', 'บันทึกข้อมูลสมาชิกเรียบร้อยแล้ว');
    } catch (\Exception $e) {
        return back()->with('error', 'เกิดข้อผิดพลาดในการบันทึกข้อมูล: ' . $e->getMessage());
    }
}


    public function edit($id)
    {
        $member = Member::findOrFail($id);
        return view('member.edit', compact('member'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:255|unique:members,username,' . $id,
            'email' => 'required|email|unique:members,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'user_type' => 'required|in:ผู้ดูแลระบบ,พนักงาน',
            'password' => 'nullable|string|min:5|max:20',
        ]);
    
        try {
            $member = Member::findOrFail($id);
    
            // Update fields
            $member->username = $validatedData['username'];
            $member->email = $validatedData['email'];
            $member->phone = $validatedData['phone'];
            $member->user_type = $validatedData['user_type'];
    
            // Update password only if provided
            if ($request->filled('password')) {
                $member->password = bcrypt($validatedData['password']);
            }
    
            $member->save();
    
            return redirect()->route('member.index')->with('success', 'แก้ไขข้อมูลสมาชิกเรียบร้อยแล้ว');
        } catch (\Exception $e) {
            return back()->with('error', 'เกิดข้อผิดพลาดในการบันทึกข้อมูล: ' . $e->getMessage());
        }
    }
    

    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $member->delete();

        return redirect()->route('member.index')->with('success', 'ลบข้อมูลสมาชิกเรียบร้อยแล้ว');
    }
}
