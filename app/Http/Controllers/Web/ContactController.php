<?php

namespace App\Http\Controllers\Web;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Contact\StoreContactRequest;


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

        if ($request->filled('title')) {
            $query->where('name', 'like', '%' . $request->title . '%');
        }

        if ($request->filled('contact_id')) {
            $query->where('id', $request->contact_id);
        }

        if ($request->has('clean')) {
            return redirect()->route('contacts.index');
        }

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
    public function store(StoreContactRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')
                ->store('files', 'public');
        }

        $contact = Contact::create($validated);

        // event(new ContactRegistered($contact));

        return redirect()
            ->route('contacts.index')
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
