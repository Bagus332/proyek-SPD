<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TravelLetterController;
use App\Http\Controllers\AuthController;


// Login routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Register routes
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Halaman utama hanya bisa diakses setelah login
Route::get('/', [TravelLetterController::class, 'create'])
    ->middleware('auth')
    ->name('home');

// Grup route SPD 
Route::prefix('travel-letter')
    ->name('travel.letter.')
    ->middleware('auth')
    ->group(function () {
        Route::get('/create', [TravelLetterController::class, 'create'])->name('create');
        Route::post('/store', [TravelLetterController::class, 'store'])->name('store');
        Route::get('/{travelLetter}', [TravelLetterController::class, 'show'])->name('show');
        Route::get('/', [TravelLetterController::class, 'index'])->name('index');
    });
