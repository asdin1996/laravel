<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Book;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Http\Requests\Book\StoreBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;

class BookController extends Controller
{
    
    public function index(): JsonResponse
    {
        $books = Book::with('contact:id,name,email')
            ->select('id','title','contact_id','created_at')
            ->latest()
            ->paginate(15);

        return response()->json([
            'success' => true,
            'data' => BookResource::collection($books),
        ]);
    }

    
    public function store(StoreBookRequest $request): JsonResponse
    {
        $book = Book::create($request->validated());

        return response()->json([
            'success' => true,
            'data' => new BookResource($book),
        ], 201);
    }

    
    public function show(Book $book): JsonResponse
    {
        $book->load('contact:id,name,email');

        return response()->json([
            'success' => true,
            'data' => new BookResource($book),
        ]);
    }

    
    public function update(UpdateBookRequest $request, Book $book): JsonResponse
    {
        $book->update($request->validated());

        return response()->json([
            'success' => true,
            'data' => new BookResource($book),
        ]);
    }

    
    public function destroy(Book $book): JsonResponse
    {
        $book->delete();

        return response()->json([
            'success' => true,
            'message' => 'Book deleted successfully',
        ]);
    }
}
