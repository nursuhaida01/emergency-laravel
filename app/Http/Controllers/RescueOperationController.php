<?php

namespace App\Http\Controllers;

use App\Models\RescueOperation;
use Illuminate\Http\Request;

class RescueOperationController extends Controller
{
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'unit_name' => 'required|string|max:255',
            'operation_details' => 'required|string',
            'location' => 'required|string',
            'operation_date' => 'required|date',
        ]);

        // Create a new rescue operation record
        RescueOperation::create([
            'unit_name' => $request->unit_name,
            'operation_details' => $request->operation_details,
            'location' => $request->location,
            'operation_date' => $request->operation_date,
        ]);

        // Return a JSON response for AJAX handling
        return response()->json(['success' => true]);
    }
}
