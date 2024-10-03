<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['incident_id', 'file_name'];

    public function incident()
    {
        return $this->belongsTo(Incident::class);
    }
}
