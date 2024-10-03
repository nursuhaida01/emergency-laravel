<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory;

    // กำหนดชื่อของตารางในฐานข้อมูล
    protected $table = 'operations';

    // กำหนดคอลัมน์ที่สามารถกรอกข้อมูลได้
    protected $fillable = [
        'case',          // ใช้ 'case' แทน 'incident_id'
        'user_id',
        'action_taken',
        'details',
        'location',
        'operation_date',
        'images',
    ];

    /**
     * ความสัมพันธ์กับ Incident
     */
    public function incident()
    {
        return $this->belongsTo(Incident::class, 'case');
    }

    /**
     * ความสัมพันธ์กับ User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
