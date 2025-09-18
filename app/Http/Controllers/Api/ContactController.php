<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Contact;
use App\Events\ContactRegistered;

class ContactController extends Controller
{
    /**
     * Display a paginated listing of contacts.
     *
     * Supports query parameter "per_page" to customize pagination size.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @example
     * GET /api/contacts?per_page=20
     * Authorization: Bearer {token}
     */
    public function index(Request $request): JsonResponse
    {
        $perPage  = $request->query('per_page', 50);
        $contacts = Contact::paginate($perPage);

        return response()->json($contacts);
    }

    /**
     * Store a newly created contact in storage.
     *
     * Validates request data and optionally uploads a file
     * (PDF, JPG, PNG, DOC, DOCX) with a maximum size of 2MB.
     *
     * Fires ContactRegistered event after creation (currently commented).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @example
     * POST /api/contacts
     * Authorization: Bearer {token}
     * {
     *   "name": "John Doe",
     *   "email": "john@example.com",
     *   "file": (attached file)
     * }
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email',
            'file'  => 'nullable|file|mimes:pdf,jpg,png,doc,docx|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('files', 'public');
            $validated['file'] = $path;
        }

        $contact = Contact::create($validated);

        // event(new ContactRegistered($contact));

        return response()->json($contact, 201);
    }

    /**
     * Display the specified contact.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     *
     * @example
     * GET /api/contacts/{id}
     * Authorization: Bearer {token}
     */
    public function show(int $id): JsonResponse
    {
        $contact = Contact::findOrFail($id);

        return response()->json($contact);
    }

    /**
     * Update the specified contact in storage.
     *
     * Validates input data and updates an existing contact.
     * Supports file replacement.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     *
     * @example
     * PUT /api/contacts/{id}
     * Authorization: Bearer {token}
     * {
     *   "name": "Updated Name",
     *   "email": "newemail@example.com",
     *   "file": (attached file)
     * }
     */
    public function update(Request $request, int $id
