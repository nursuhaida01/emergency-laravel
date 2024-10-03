<?php

namespace App\Http\Controllers;

use App\Models\Operation;
use App\Models\Incident;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OperationController extends Controller
{
    /**
     * แสดงรายการของ Operations
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $operations = Operation::with('incident', 'user')->get();
        return view('operations.index', compact('operations'));
    }
    public function show($id)
{
    $operation = Operation::findOrFail($id);
    return view('operations.show', compact('operation'));
}


    /**
     * แสดงฟอร์มสำหรับสร้าง Operation ใหม่
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $incident = Incident::all();
        $users = User::all();
        return view('operations.create', compact('incident', 'users'));
    }

    /**
     * เก็บข้อมูล Operation ใหม่
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'case' => 'required|exists:incident,id', // Ensure 'incidents' is correct
          'user_id' => 'required|exists:users,id',
            'action_taken' => 'required|string|max:255',
            'details' => 'nullable|string',
            'location' => 'required|string|max:255',
            'operation_date' => 'required|date',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $fileNames = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images'), $filename);
                $fileNames[] = $filename;
            }
        }
    
        $fileNamesJson = json_encode($fileNames);
    
        $operation = new Operation();
        $operation->case = $request->case; // Ensure 'case_id' is the correct column name in your 'operations' table
        $operation->user_id = $request->user_id;
        $operation->action_taken = $request->action_taken;
        $operation->details = $request->details;
        $operation->location = $request->location;
        $operation->operation_date = $request->operation_date;
        $operation->images = $fileNamesJson; // Save image filenames as JSON
    
        $operation->save();
    
        return redirect()->route('operations.index')->with('success', 'บันทึกข้อมุลสำเร็จ');
    }
    

    /**
     * แสดงฟอร์มสำหรับแก้ไข Operation
     *
     * @param  \App\Models\Operation  $operation
     * @return \Illuminate\View\View
     */
    public function edit(Operation $operation)
    {
        $incidents = Incident::all();
        $users = User::all();
        $operation->operation_date = \Carbon\Carbon::parse($operation->operation_date);

        return view('operations.edit', compact('operation', 'incidents', 'users'));
    }

    /**
     * อัปเดต Operation ที่มีอยู่
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Operation  $operation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Operation $operation)
    {
        $request->validate([
            'case' => 'required|exists:incident,id',
            'user_id' => 'required|exists:users,id',
            'action_taken' => 'required|string|max:255',
            'details' => 'nullable|string',
            'location' => 'required|string|max:255',
            'operation_date' => 'required|date',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $fileNames = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/images', $filename); // Store the file
                $fileNames[] = $filename;
            }
        }

        $fileNamesJson = json_encode($fileNames);

        $operation->case = $request->case;
        $operation->user_id = $request->user_id;
        $operation->action_taken = $request->action_taken;
        $operation->details = $request->details;
        $operation->location = $request->location;
        $operation->operation_date = $request->operation_date;
        $operation->images = $fileNamesJson; // Update image filenames as JSON

        $operation->save();

        return redirect()->route('operations.index')->with('success', 'บันทึกการแก้ไขสำเร้จ');
    }


    /**
     * ลบ Operation
     *
     * @param  \App\Models\Operation  $operation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Operation $operation)
    {
        $operation->delete();
        return redirect()->route('operations.index')->with('success', 'ลบข้อมูลสำเร็จ');
    }
}
