<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;

Route::get('/', function () {
    return view('welcome');
});

// Profile Routes
Route::resource('profiles', ProfileController::class)->only(['index', 'show']);

// Ajax Routes
Route::get('/users', [AjaxController::class, 'fetchUsers'])->name('users.fetch');