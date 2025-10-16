<?php
// app/Http/Controllers/ContactController.php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function showForm()
    {
        return view('contact');
    }

    public function submitForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
            'form_id' => 'nullable|string',
            'form_token' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Contact::create($request->all());

        return redirect()->back()
            ->with('success', 'Thank you for your message. We will get back to you soon!');
    }

    public function adminIndex()
    {
        // Use paginate() instead of get()
        $contacts = Contact::latest()->paginate(10); // 10 items per page
        return view('admin.contacts.index', compact('contacts'));
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin.contacts.show', compact('contact'));
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        
        return redirect()->route('admin.contacts.index')
            ->with('success', 'Contact message deleted successfully.');
    }
}