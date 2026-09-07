<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiMasukController;
use App\Http\Controllers\TransaksiKeluarController;
use App\Http\Controllers\LaporanController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/barang', [BarangController::class, 'index'])
        ->name('barang.index');

    Route::get('/barang/create', [BarangController::class, 'create'])
        ->name('barang.create');

    Route::post('/barang', [BarangController::class, 'store'])
        ->name('barang.store');

    Route::get('/barang/{kode_barang}/edit', [BarangController::class, 'edit'])
        ->name('barang.edit');

    Route::put('/barang/{kode_barang}', [BarangController::class, 'update'])
        ->name('barang.update');

    Route::get('/barang/{kode_barang}', [BarangController::class, 'show'])
        ->name('barang.show');

    Route::delete('/barang/{kode_barang}', [BarangController::class, 'destroy'])
        ->name('barang.destroy');

    Route::get('/transaksi-masuk', [TransaksiMasukController::class, 'index'])
        ->name('transaksi-masuk.index');

    Route::get('/transaksi-masuk/create', [TransaksiMasukController::class, 'create'])
        ->name('transaksi-masuk.create');

    Route::post('/transaksi-masuk', [TransaksiMasukController::class, 'store'])
        ->name('transaksi-masuk.store');

    Route::get('/transaksi-keluar', [TransaksiKeluarController::class, 'index'])
        ->name('transaksi-keluar.index');

    Route::get('/transaksi-keluar/create', [TransaksiKeluarController::class, 'create'])
        ->name('transaksi-keluar.create');

    Route::post('/transaksi-keluar', [TransaksiKeluarController::class, 'store'])
        ->name('transaksi-keluar.store');

    Route::get('/laporan/transaksi', [LaporanController::class, 'transaksi'])
        ->name('laporan.transaksi');

    Route::get('/laporan/transaksi/pdf', [LaporanController::class, 'transaksiPdf'])
        ->name('laporan.transaksi.pdf');

    Route::get('/laporan/kartu-stok', [LaporanController::class, 'kartuStok'])
        ->name('laporan.kartu-stok');

    Route::get('/laporan/kartu-stok/pdf', [LaporanController::class, 'kartuStokPdf'])
        ->name('laporan.kartu-stok.pdf');
});