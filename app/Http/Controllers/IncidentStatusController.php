<?php

// app/Http/Controllers/IncidentStatusController.php
namespace App\Http\Controllers;

use App\Models\Incident;
use Illuminate\Http\Request;

class IncidentStatusController extends Controller
{
    public function show($id)
    {
        $incident = Incident::find($id);

        if (!$incident) {
            return redirect()->route('home')->with('error', 'Incident not found.');
        }

        return view('incident.status', compact('incident'));
    }
}
