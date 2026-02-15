<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\ContactResource;
use App\Http\Requests\Contact\StoreContactRequest;

class ContactController extends Controller
{
    
    public function index(Request $request): JsonResponse
    {
        $query = Contact::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('id')) {
            $query->where('id', $request->id);
        }

        $contacts = $query
            ->select('id','name','email','file','created_at')
            ->paginate($request->per_page ?? 10);

        return response()->json([
            'success' => true,
            'data' => ContactResource::collection($contacts->items()),
            'meta' => [
                'current_page' => $contacts->currentPage(),
                'last_page' => $contacts->lastPage(),
                'per_page' => $contacts->perPage(),
                'total' => $contacts->total(),
            ],
        ]);
    }

    
    public function store(StoreContactRequest $request): JsonResponse
    {
        $data = $request->validated();

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')
                ->store('files', 'public');
        }

        $contact = Contact::create($data);

        return response()->json([
            'success' => true,
            'data' => new ContactResource($contact),
        ], 201);
    }

    
    public function show(Contact $contact): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => new ContactResource($contact),
        ]);
    }

    
    public function destroy(Contact $contact): JsonResponse
    {
        $contact->delete();

        return response()->json([
            'success' => true,
            'message' => 'Contact deleted successfully',
        ]);
    }
}
