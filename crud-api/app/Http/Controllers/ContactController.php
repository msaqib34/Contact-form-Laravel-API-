<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return response()->json(Contact::all(), 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'message' => 'required|string',
        ]);

        $contact = Contact::create($validatedData);
        return response()->json($contact, 201);
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return response()->json($contact, 200);
    }

    public function update(Request $request, $id)
    {
        // Validate incoming data
        $validatedData = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255',
            'message' => 'nullable|string',
        ]);

        // Find the contact or return a 404 error
        $contact = Contact::findOrFail($id);

        // Update only the fields that are present in the request
        $contact->update(array_filter($validatedData));

        return response()->json($contact, 200);
    }

    public function destroy($id)
    {
        // Find the contact or return a 404 error
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return response()->json(null, 204);
    }
}
