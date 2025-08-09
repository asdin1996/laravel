<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('tasks', TaskController::class);
Route::resource('contacts', ContactController::class);
Route::get('/books', [BookController::class, 'index']);
Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])
    ->name('login');
Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'es'])) {
        Session::put('locale', $locale);
    }
    return redirect()->back();
})->name('lang.switch');
