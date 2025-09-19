<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of all books.
     *
     * Retrieves all books from the database along with their related contact.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @example
     * GET /api/books
     * Authorization: Bearer {token}
     */
    public function index(): JsonResponse
    {
        $books = Book::with('contact')->get();
        return response()->json($books);
    }

    /**
     * Store a newly created book in storage.
     *
     * Validates the incoming request and creates a new book record.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @example
     * POST /api/books
     * Authorization: Bearer {token}
     * {
     *   "title": "Clean Code",
     *   "author": "Robert C. Martin"
     * }
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title'  => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'contact_id' => 'nullable|exists:contacts,id'
            // add other fields defined in the books table
        ]);

        $book = Book::create($validated);

        return response()->json($book, 201);
    }

    /**
     * Display the specified book.
     *
     * Shows a single book by its ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     *
     * @example
     * GET /api/books/{id}
     * Authorization: Bearer {token}
     */
    public function show(int $id): JsonResponse
    {
        $book = Book::with('contact')->findOrFail($id);

        return response()->json($book);
    }

    /**
     * Update the specified book in storage.
     *
     * Validates the request and updates the book with the given ID.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     *
     * @example
     * PUT /api/books/{id}
     * Authorization: Bearer {token}
     * {
     *   "title": "Updated Title",
     *   "author": "Updated Author"
     * }
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $validated = $request->validate([
            'title'  => 'sometimes|required|string|max:255',
            'contact_id' => 'sometimes|required|int',
        ]);

        $book = Book::findOrFail($id);
        $book->update($validated);

        return response()->json($book);
    }

    /**
     * Remove the specified book from storage.
     *
     * Deletes a book record by its ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     *
     * @example
     * DELETE /api/books/{id}
     * Authorization: Bearer {token}
     */
    public function destroy(int $id): JsonResponse
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return response()->json(['message' => 'Book deleted successfully']);
    }
}
