<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\DetailBarang;
use App\Models\TransaksiKeluar;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TransaksiKeluarController extends Controller
{
    public function index(Request $request): View
    {
        // Pilihan jumlah data per halaman
        $perPage = (int) $request->input('per_page', 10);

        // Batasi pilihan yang diperbolehkan
        $allowedPerPage = [10, 25, 50, 100];

        if (! in_array($perPage, $allowedPerPage)) {
            $perPage = 10;
        }

        // Data barang untuk kebutuhan halaman transaksi
        $barang = Barang::orderBy('nama_barang')->get();

        // Data transaksi keluar dengan pagination
        $transaksiKeluar = TransaksiKeluar::with('barang')
            ->orderByDesc('tanggal_keluar')
            ->orderByDesc('id')
            ->paginate($perPage)
            ->withQueryString();

        return view('transaksi-keluar', compact(
            'barang',
            'transaksiKeluar',
            'perPage'
        ));
    }

    public function create(): View
    {
        $barang = Barang::orderBy('nama_barang')->get();

        return view('transaksi-keluar.create', compact('barang'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'tanggal_keluar' => ['required', 'date'],
            'keterangan' => ['required', 'string', 'max:255'],
            'kode_barang' => ['required', 'exists:barang,kode_barang'],
            'jumlah_keluar' => ['required', 'integer', 'min:1'],
        ]);

        DB::transaction(function () use ($validated) {

            /** @var Barang $barang */
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
