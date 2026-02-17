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
        $this->assertDatabaseMissing('books', [
            'title' => 'Test unit 17/02/2026'
        ]);

        $book = Book::create([
            'title'      => 'Test unit 17/02/2026',
            'contact_id' => 4
        ]);

        $this->assertDatabaseHas('books', [
            'title' => 'Test unit 17/02/2026'
        ]);
    }
}
