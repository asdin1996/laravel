<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of contacts with optional filtering and pagination.
     *
     * Supports filtering by name (`title`) or by specific contact ID (`contact_id`).
     * Can also reset filters if `clean` is present in the request.
     * Returns the `contacts.index` Blade view with paginated contacts.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Contact::query();

        // Filter by name if 'title' is provided
        if ($request->filled('title')) {
            $query->where('name', 'like', '%' . $request->title . '%');
        }

        // Filter by specific contact ID
        if ($request->filled('contact_id')) {
            $query->where('id', $request->contact_id);
        }

        // Reset all filters
        if ($request->has('clean')) {
            return redirect()->route('contacts.index');
        }

        // Paginate results and keep query parameters in links
        $contacts = $query->paginate(10)->appends($request->query());

        return view('contacts.index', compact('contacts'));
    }

    /**
     * Store a newly created contact in the database.
     *
     * Validates input data including optional file upload.
     * Stores uploaded file in 'public/files' and saves its path.
     * Redirects back to contacts index with a success message.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email',
            'file'  => 'nullable|file|mimes:pdf,jpg,png,doc,docx|max:2048',
        ]);

        // Handle file upload if present
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('files', 'public');
            $validated['file'] = $path;
        }

        // Create the contact
        Contact::create($validated);

        return redirect()->route('contacts.index')
            ->with('success', 'Contact successfully registered');
    }

    /**
     * Remove the specified contact from storage.
     *
     * Deletes the given Contact record and redirects back
     * with a success message.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->back()->with('success', 'Contact deleted successfully');
    }
}
