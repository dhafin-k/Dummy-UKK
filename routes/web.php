<?php

use App\Http\Controllers\AreaParkirController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\LogAktivitasController;
use App\Http\Controllers\TarifParkirController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::get('/', function() {
    return view('welcome');
})->name('home');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
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
    Route::resource('log-aktivitas', LogAktivitasController::class)->only(['index', 'destroy']);
});

Route::middleware(['auth', 'role:petugas'])->prefix('petugas')->name('petugas.')->group(function () {
    Route::resource('transaksi', TransaksiController::class);
    Route::get('cetak-struk/{id}', [TransaksiController::class, 'cetakStruk'])->name('transaksi.cetak-struk');
});

Route::middleware(['auth', 'role:owner'])->group(function () {
    Route::get('dashboard/cetak-rekap-transaksi', [DashboardController::class, 'cetakRekapTransaksi'])->name('dashboard.cetak-rekap-transaksi');
});



require __DIR__ . '/settings.php';
