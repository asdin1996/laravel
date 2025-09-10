<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Models\Contact;
use App\Events\ContactRegistered;
class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('per_page',50);
        $contacts = Contact::paginate($perPage);
        return response()->json($contacts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request):JsonResponse
    {
         $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'file' => 'nullable|file|mimes:pdf,jpg,png,doc,docx|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('files', 'public');
            $validated['file'] = $path;
        }

        $contact = Contact::create($validated);

        //event(new ContactRegistered($contact));
        return response()->json($contact, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
