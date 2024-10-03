<?php

// app/Models/Status.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = [
        'incident_id',
        'base_departure',
        'scene_arrival',
        'scene_departure',
        'hospital_arrival',
        'base_arrival',
    ];

    public function incident()
    {
        return $this->belongsTo(Incident::class, 'incident_id');
    }
}
