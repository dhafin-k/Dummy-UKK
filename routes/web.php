<?php

use App\Http\Controllers\TarifParkirController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::prefix('tarif-parkir')->name('tarif-parkir.')->group(function () {
        Route::get('/', [TarifParkirController::class, 'index'])->name('index');
        Route::get('/create', [TarifParkirController::class, 'create'])->name('create');
    });
});



require __DIR__.'/settings.php';
