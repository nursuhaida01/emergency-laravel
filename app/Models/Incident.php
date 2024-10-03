<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Incident extends Model
{
    use HasFactory;

    protected $table = 'incident'; // ชื่อของตารางในฐานข้อมูล
    
    protected $fillable = [
        'case_number',
        'latitude',   // เพิ่มฟิลด์ละติจูด
        'longitude',  // เพิ่มฟิลด์ลองจิจูด
        'case_number',
        'rate',
        'location',
        'help_needed',
        'quantity',
        'images',
        'description',
        'contact_number',
        'status',
        'username',
        'additional_info', // ต้องมี
    ];
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Generate case number with date and temporary ID
            $lastId = static::max('id');
            $lastId = $lastId ? $lastId + 1 : 1;
            $model->case_number = date('Ymd') . '-' . str_pad($lastId, 4, '0', STR_PAD_LEFT);
        });
    }

    // Define the relationship with IncidentImage
    public function images()
    {
        return $this->hasMany(Image::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function operations()
    {
        return $this->hasMany(Operation::class, 'case');
    }
}
