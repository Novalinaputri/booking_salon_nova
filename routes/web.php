<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\DashboardController;

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('customers', CustomerController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('staffs', StaffController::class);
    Route::resource('bookings', BookingController::class);
});

Route::resource('services', ServiceController::class)->middleware('auth');

// Route register
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Route login
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

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

// Route tabel user
Route::view('/services', 'services')->name('user.services');
Route::view('/staffs', 'staffs')->name('user.staffs');
Route::view('/bookings', 'bookings')->name('user.bookings');
Route::view('/booking-form', 'booking-form')->name('user.booking-form');
Route::view('/user-bookings', 'user-bookings')->name('user.bookings.history');