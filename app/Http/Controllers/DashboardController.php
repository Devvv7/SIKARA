<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\TransaksiMasuk;
use App\Models\TransaksiKeluar;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBarang = Barang::count();

        $totalStok = Barang::sum('stok');

        $totalTransaksiMasuk = TransaksiMasuk::count();

        $totalTransaksiKeluar = TransaksiKeluar::count();

        $transaksiMasukTerbaru = TransaksiMasuk::with('barang')
            ->orderByDesc('tanggal_masuk')
            ->orderByDesc('id')
            ->limit(5)
            ->get();

        $transaksiKeluarTerbaru = TransaksiKeluar::with('barang')
            ->orderByDesc('tanggal_keluar')
            ->orderByDesc('id')
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalBarang',
            'totalStok',
            'totalTransaksiMasuk',
            'totalTransaksiKeluar',
            'transaksiMasukTerbaru',
            'transaksiKeluarTerbaru'
        ));
    }
}