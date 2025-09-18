<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * Allows mass assignment for 'name', 'email', and optional 'file'.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'file'];
}
