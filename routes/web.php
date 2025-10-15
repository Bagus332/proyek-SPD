<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TravelLetterController;

// Halaman utama akan langsung diarahkan ke form pembuatan surat
Route::get('/', [TravelLetterController::class, 'create'])->name('home');

// Grup rute untuk Surat Perjalanan Dinas
Route::prefix('travel-letter')->name('travel.letter.')->group(function () {
    Route::get('/create', [TravelLetterController::class, 'create'])->name('create');
    Route::post('/store', [TravelLetterController::class, 'store'])->name('store');
    Route::get('/{travelLetter}', [TravelLetterController::class, 'show'])->name('show');
    Route::get('/', [TravelLetterController::class, 'index'])->name('index');
});