<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    // กำหนดชื่อของตารางในฐานข้อมูล
    protected $table = 'news';

    // กำหนดคอลัมน์ที่สามารถกรอกข้อมูลได้
    protected $fillable = [
        'title',
        'content',
        'image',
        'username',
        'location',
        'time',
        'category',
        
    ];
}
