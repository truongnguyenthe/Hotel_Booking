<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

// Trang chính (welcome)
Route::get('/', function () {
    return view('welcome');
});

// Dashboard (layout)
Route::get('/dashboard', function () {
    return view('layout'); // Sử dụng tên view rõ ràng hơn
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile (cần xác thực)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Các route resource cho Rooms, Bookings và Customer
Route::resource('rooms', RoomController::class);
Route::resource('bookings', BookingController::class);
Route::resource('customers', CustomerController::class);



// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Các route liên quan đến xác thực (auth)
require __DIR__.'/auth.php';
