<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TravelLetterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PageController;

// =======================
// ROUTE UNTUK USER YANG BELUM LOGIN
// =======================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// =======================
// ROUTE UNTUK USER YANG SUDAH LOGIN
// =======================
Route::middleware('auth')->group(function () {

    // Dashboard / Home
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Profil Pengguna
    Route::prefix('profile')->group(function () {
        Route::get('/', [PageController::class, 'profile'])->name('profile.show');
        Route::put('/', [PageController::class, 'profileUpdate'])->name('profile.update');
        Route::put('/deactivate', [PageController::class, 'deactivate'])
            ->name('profile.deactivate');
    });

    // Travel Letter
    Route::prefix('travel-letter')->name('travel.letter.')->group(function () {

        //  FORM INPUT
        Route::get('/', [TravelLetterController::class, 'index'])->name('index');

        // FORM INPUT
        Route::get('/create', [TravelLetterController::class, 'create'])->name('create');

        // Store data
        Route::post('/store', [TravelLetterController::class, 'store'])->name('store');

        // Detail (jika masih ingin lihat data sebelum cetak)
        Route::get('/{travelLetter}', [TravelLetterController::class, 'show'])->name('show');

        // === CETAK FILE WORD ===
        Route::get('/{travelLetter}/print-surat-tugas', [TravelLetterController::class, 'printSuratTugas'])
            ->name('print.surat_tugas');

        Route::get('/{travelLetter}/print-spd', [TravelLetterController::class, 'printSpd'])
            ->name('print.spd');
    });
});
