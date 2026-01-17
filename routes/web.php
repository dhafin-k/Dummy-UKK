<?php

use App\Http\Controllers\AreaParkirController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\TarifParkirController;
use App\Http\Controllers\UserController;
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
        Route::post('/', [TarifParkirController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [TarifParkirController::class, 'edit'])->name('edit');
        Route::put('/{id}', [TarifParkirController::class, 'update'])->name('update');
        Route::delete('/{id}', [TarifParkirController::class, 'destroy'])->name('destroy');
    });

    Route::resource('users', UserController::class);
    Route::resource('area-parkir', AreaParkirController::class);
    Route::resource('kendaraan', KendaraanController::class);
});



require __DIR__.'/settings.php';
