<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\BookingController;

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::resource('customers', CustomerController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('staffs', StaffController::class);
    Route::resource('bookings', BookingController::class);
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

Route::resource('services', ServiceController::class)->middleware('auth');
Route::get('/admin', [DashboardController::class, 'index'])->middleware('auth');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::resource('customers', CustomerController::class);
    // ... resource lain
});

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::resource('staffs', StaffController::class);
    // ... resource lain
});

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::resource('bookings', BookingController::class);
    // ... resource lain
});

// Route register
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Route login
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

// Route admin (hanya bisa diakses jika sudah login)
Route::get('/admin', function () {
    return view('admin.dashboard');
})->name('admin.dashboard')->middleware('auth');

// Route home (setelah login, bisa diarahkan ke dashboard atau halaman lain)
Route::get('/home', function () {
    return view('home');
})->name('home')->middleware('auth');

// Route logout
use Illuminate\Support\Facades\Auth;
Route::post('logout', function() {
    Auth::logout();
    return redirect('/login');
})->name('logout');

// Route halaman utama
Route::get('/', function () {
    return view('welcome');
});