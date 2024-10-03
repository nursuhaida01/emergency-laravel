<?php
// app/Http/Controllers/ContactController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        return view('contacts.index', compact('contacts')); // แก้เป็น 'contacts.index'
    }

    public function create()
    {
        return view('contacts.create'); // แก้เป็น 'contacts.create'
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:15',
            'message' => 'required|string|unique:contacts,message',
        ]);
    
        Contact::create($request->all());
    // Check if the request expects a JSON response (AJAX)
   
if ($request->expectsJson()) {
       
    return response()->json(['success' => true]);
      
        // Redirect พร้อมกับข้อความแจ้งเตือน
     }
}
    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact('contact')); // แก้เป็น 'contacts.edit'
    }

    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:15',
           'message' => 'required|string|unique:messages,text',
        ]);

        $contact->update($request->all());

        return redirect()->route('contacts.index')->with('success', 'Message updated successfully!'); // แก้เป็น 'contacts.index'
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('contacts.index')->with('success', 'Message deleted successfully!'); // แก้เป็น 'contacts.index'
    }
}
