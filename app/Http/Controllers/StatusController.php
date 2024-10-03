<?php

// app/Http/Controllers/StatusController.php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index($id)
    {
        $status = Status::where('incident_id', $id)->first();
        return view('status', compact('status', 'id'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->only([
            'base_departure',
            'scene_arrival',
            'scene_departure',
            'hospital_arrival',
            'base_arrival'
        ]);

        Status::updateOrCreate(
            ['incident_id' => $id],
            $data
        );

        return redirect()->route('status.index', $id)->with('success', 'Status updated successfully!');
    }
    public function showStatus($id)
    {
        $status = Status::with('incident')->where('incident_id', $id)->first();
        if (!$status) {
            return redirect()->route('status.index')->with('error', 'Status not found.');
        }
        return view('status_show', ['status' => $status]);
    }
}
