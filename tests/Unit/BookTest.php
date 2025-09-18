<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use App\Models\Contact;

class BookTest extends TestCase
{
    /**
     * Test creating a book in the database.
     *
     * This test inserts a book record and verifies it exists in the database.
     *
     * @return void
     */
    public function test_it_can_create_a_book()
    {
        // ---------------------------
        // Create a book record
        // ---------------------------
        // Note: Ensure a Contact with ID=1 exists if using foreign key
        $book = Book::create([
            'title'      => 'Clean Code',
            'author'     => 'Robert C. Martin',
            'contact_id' => 1 // Optional: relation to a contact
        ]);

        // ---------------------------
        // Assert database has the new book
        // ---------------------------
        $this->assertDatabaseHas('books', [
            'title' => 'Clean Code',
            'author'=> 'Robert C. Martin'
        ]);
    }
}
