<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use App\Models\Contact;

class BookTest extends TestCase
{
    /**
     * Test para crear un libro en MySQL existente.
     *
     * @return void
     */
    public function test_it_can_create_a_book()
    {
        // Crear un registro en la tabla ya existente
        $book = Book::create([
            'title' => 'Clean Code',
            'author' => 'Robert C. Martin',
            'contact_id' => 1 // si hay relación con contactos
        ]);

        // Comprobar que el registro se ha insertado
        $this->assertDatabaseHas('books', [
            'title' => 'Clean Code'
        ]);
    }
}
