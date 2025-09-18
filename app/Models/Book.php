<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * Allows mass assignment for 'title' and optional 'contact_id'.
     *
     * @var array
     */
    protected $fillable = ['title', 'contact_id'];

    /**
     * Relationship: Book belongs to a Contact.
     *
     * Enables access to the related Contact via $book->contact.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
