<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // หรือ Auth::guard('users')->user() หากใช้ guard อื่น
        return view('home', compact('user'));
    }
    
}