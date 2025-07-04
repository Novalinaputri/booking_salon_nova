<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

// Route register
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Route login
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

// Route home (hanya bisa diakses jika sudah login)
Route::get('/home', function () {
    return view('home');
})->name('home')->middleware('auth');

// Route halaman utama
Route::get('/', function () {
    return view('welcome');
});