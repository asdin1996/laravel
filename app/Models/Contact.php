<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['name', 'email','file'];
    public function index()
    {
        $contacts = Contact::all();

        // Pasa la colección completa a la vista
        return view('contacts.index', compact('contacts'));
    }
}
