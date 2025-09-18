<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

// ---------------------------
// Homepage
// ---------------------------
// Returns the default welcome view
Route::get('/', function () {
    return view('welcome');
});

// ---------------------------
// Task resource routes
// ---------------------------
// Creates standard CRUD routes for tasks (index, create, store, show, edit, update, destroy)
Route::resource('tasks', TaskController::class);

// ---------------------------
// Contact resource routes
// ---------------------------
// Creates standard CRUD routes for contacts
Route::resource('contacts', ContactController::class);

// ---------------------------
// Book resource routes
// ---------------------------
// Creates standard CRUD routes for books
Route::resource('books', BookController::class);

// ---------------------------
// Login route
// ---------------------------
// Handles login form submission via LoginController
Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])
    ->name('login');

// ---------------------------
// Language switcher
// ---------------------------
// Switch application locale between English and Spanish
// Stores selected locale in session and redirects back
Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'es'])) {
        Session::put('locale', $locale);
    }
    return redirect()->back();
})->name('lang.switch');
