<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    /**
     * Display a listing of contact.
     */
    public function index()
    {
        return Contact::all();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            return response()->json(['error' => 'Contact not found.'], 404);
        }

        return response()->json($contact);
    }

    /**
     * Store a newly created contact.
     */
    public function store(Request $request)
    {
        try {
            // Validate the incoming request data
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'message' => 'required|string',
            ]);

            // Create a new contact
            $contact = Contact::create($validated);

            return response()->json($contact, 201);
        } catch (\Exception $e) {
            Log::error('Error creating contact: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while creating the contact.'], 500);
        }
    }

    /**
     * Update the specified contact in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            // Find the contact by ID
            $contact = Contact::findOrFail($id);

            // Validate the incoming request data
            $validated = $request->validate([
                'name' => 'sometimes|required|string|max:255',
                'email' => 'sometimes|required|email|max:255',
                'message' => 'sometimes|required|string',
            ]);

            // Update the contact
            $contact->update($validated);

            return response()->json($contact, 200);
        } catch (\Exception $e) {
            Log::error('Error updating contact: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while updating the contact.'], 500);
        }
    }

    /**
     * Remove the contact from storage.
     */
    public function destroy($id)
    {
        try {
            // Find the contact by ID
            $contact = Contact::findOrFail($id);

            // Attempt to delete the contact
            $deleted = $contact->delete();

            if ($deleted) {
                return response()->json(['message' => 'Contact deleted successfully.'], 200);
            } else {
                Log::error('Failed to delete contact: ' . $id);
                return response()->json(['error' => 'Failed to delete the contact.'], 500);
            }
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('Contact not found: ' . $id);
            return response()->json(['error' => 'Contact not found.'], 404);
        } catch (\Exception $e) {
            Log::error('Error deleting contact: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while deleting the contact.'], 500);
        }
    }
}
