<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\DetailBarang;
use App\Models\TransaksiMasuk;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiMasukController extends Controller
{
    public function index(): View
    {
        $barang = Barang::orderBy('nama_barang')->get();

        $transaksiMasuk = TransaksiMasuk::with('barang')
            ->orderByDesc('tanggal_masuk')
            ->orderByDesc('id')
            ->get();

        return view('transaksi-masuk', compact(
            'barang',
            'transaksiMasuk'
        ));
    }

    public function create(): View
    {
        $barang = Barang::orderBy('nama_barang')->get();

        return view('transaksi-masuk.create', compact('barang'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'tanggal_masuk' => ['required', 'date'],
            'keterangan' => ['required', 'string', 'max:255'],
            'kode_barang' => ['required', 'exists:barang,kode_barang'],
            'jumlah_masuk' => ['required', 'integer', 'min:1'],
            'harga_satuan' => ['required', 'numeric', 'min:0'],
        ]);

        DB::transaction(function () use ($validated): void {

            TransaksiMasuk::create($validated);

            DetailBarang::create([
                'tanggal_masuk' => $validated['tanggal_masuk'],
                'harga' => $validated['harga_satuan'],
                'stok' => $validated['jumlah_masuk'],
                'kode_barang' => $validated['kode_barang'],
            ]);

            /** @var Barang $barang */
            $barang = Barang::findOrFail(
                $validated['kode_barang']
            );

            $barang->increment(
                'stok',
                $validated['jumlah_masuk']
            );
        });

        return redirect()
            ->route('transaksi-masuk.index')
            ->with(
                'success',
                'Transaksi masuk berhasil disimpan.'
            );
    }
}
