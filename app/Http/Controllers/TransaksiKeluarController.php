<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\DetailBarang;
use App\Models\TransaksiKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TransaksiKeluarController extends Controller
{
    public function index()
    {
        $barang = Barang::orderBy('nama_barang')->get();

        $transaksiKeluar = TransaksiKeluar::with('barang')
            ->orderByDesc('tanggal_keluar')
            ->orderByDesc('id')
            ->get();

        return view('transaksi-keluar', compact(
            'barang',
            'transaksiKeluar'
        ));
    }

    public function create()
    {
        $barang = Barang::orderBy('nama_barang')->get();

        return view('transaksi-keluar.create', compact('barang'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal_keluar' => ['required', 'date'],
            'keterangan' => ['required', 'string', 'max:255'],
            'kode_barang' => ['required', 'exists:barang,kode_barang'],
            'jumlah_keluar' => ['required', 'integer', 'min:1'],
        ]);

        DB::transaction(function () use ($validated) {

            $barang = Barang::where(
                'kode_barang',
                $validated['kode_barang']
            )
                ->lockForUpdate()
                ->firstOrFail();

            // Periksa apakah stok mencukupi.
            if ($barang->stok < $validated['jumlah_keluar']) {
                throw ValidationException::withMessages([
                    'jumlah_keluar' => 'Stok barang tidak mencukupi. Stok tersedia: '
                        .$barang->stok,
                ]);
            }

            $jumlahKeluar = $validated['jumlah_keluar'];

            // Ambil detail stok berdasarkan FIFO:
            // stok dari tanggal masuk paling lama digunakan terlebih dahulu.
            $detailBarang = DetailBarang::where(
                'kode_barang',
                $validated['kode_barang']
            )
                ->where('stok', '>', 0)
                ->orderBy('tanggal_masuk')
                ->orderBy('id')
                ->lockForUpdate()
                ->get();

            foreach ($detailBarang as $detail) {

                if ($jumlahKeluar <= 0) {
                    break;
                }

                $jumlahDiambil = min(
                    $detail->stok,
                    $jumlahKeluar
                );

                $detail->decrement(
                    'stok',
                    $jumlahDiambil
                );

                $jumlahKeluar -= $jumlahDiambil;
            }

            // Kurangi stok total pada tabel barang.
            $barang->decrement(
                'stok',
                $validated['jumlah_keluar']
            );

            // Simpan riwayat transaksi keluar.
            TransaksiKeluar::create($validated);
        });

        return redirect()
            ->route('transaksi-keluar.index')
            ->with(
                'success',
                'Transaksi keluar berhasil disimpan.'
            );
    }
}
