<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\TransaksiKeluar;
use App\Models\TransaksiMasuk;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LaporanController extends Controller
{
    public function transaksi(Request $request): View
    {
        $barang = Barang::orderBy('nama_barang')->get();

        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalAkhir = $request->input('tanggal_akhir');
        $kodeBarang = $request->input('kode_barang');
        $jenis = $request->input('jenis');
        $search = trim((string) $request->input('search', ''));

        /*
        |--------------------------------------------------------------------------
        | Ambil seluruh transaksi masuk
        |--------------------------------------------------------------------------
        */

        $transaksiMasuk = TransaksiMasuk::with('barang')
            ->get()
            ->map(function (TransaksiMasuk $transaksi) {
                /** @var Barang $barang */
                $barang = $transaksi->barang;

                return [
                    'tanggal' => $transaksi->tanggal_masuk,
                    'kode_barang' => $transaksi->kode_barang,
                    'nama_barang' => $barang->nama_barang,
                    'jenis' => 'Masuk',
                    'jumlah' => $transaksi->jumlah_masuk,
                    'harga_satuan' => $transaksi->harga_satuan,
                    'keterangan' => $transaksi->keterangan,
                    'id' => $transaksi->id,
                ];
            });

        /*
        |--------------------------------------------------------------------------
        | Ambil seluruh transaksi keluar
        |--------------------------------------------------------------------------
        */

        $transaksiKeluar = TransaksiKeluar::with('barang')
            ->get()
            ->map(function (TransaksiKeluar $transaksi) {
                /** @var Barang $barang */
                $barang = $transaksi->barang;

                return [
                    'tanggal' => $transaksi->tanggal_keluar,
                    'kode_barang' => $transaksi->kode_barang,
                    'nama_barang' => $barang->nama_barang,
                    'jenis' => 'Keluar',
                    'jumlah' => $transaksi->jumlah_keluar,
                    'harga_satuan' => null,
                    'keterangan' => $transaksi->keterangan,
                    'id' => $transaksi->id,
                ];
            });

        /*
        |--------------------------------------------------------------------------
        | Gabungkan transaksi dan urutkan berdasarkan tanggal
        |--------------------------------------------------------------------------
        */

        $semuaTransaksi = $transaksiMasuk
            ->concat($transaksiKeluar)
            ->sortBy([
                ['kode_barang', 'asc'],
                ['tanggal', 'asc'],
                ['jenis', 'asc'],
                ['id', 'asc'],
            ])
            ->values();

        /*
        |--------------------------------------------------------------------------
        | Hitung saldo stok per barang
        |--------------------------------------------------------------------------
        */

        $saldoBarang = [];

        $semuaTransaksi = $semuaTransaksi->map(
            function (array $transaksi) use (&$saldoBarang) {
                $kodeBarang = $transaksi['kode_barang'];

                if (! isset($saldoBarang[$kodeBarang])) {
                    $saldoBarang[$kodeBarang] = 0;
                }

                if ($transaksi['jenis'] === 'Masuk') {
                    $saldoBarang[$kodeBarang] += $transaksi['jumlah'];
                } else {
                    $saldoBarang[$kodeBarang] -= $transaksi['jumlah'];
                }

                $transaksi['saldo'] = $saldoBarang[$kodeBarang];

                return $transaksi;
            }
        );

        /*
        |--------------------------------------------------------------------------
        | Terapkan filter laporan
        |--------------------------------------------------------------------------
        */

        $transaksi = $semuaTransaksi
            ->filter(
                function (array $transaksi) use (
                    $tanggalMulai,
                    $tanggalAkhir,
                    $kodeBarang,
                    $jenis,
                    $search
                ) {
                    // Filter tanggal mulai
                    if (
                        $tanggalMulai &&
                        $transaksi['tanggal']->format('Y-m-d') < $tanggalMulai
                    ) {
                        return false;
                    }

                    // Filter tanggal akhir
                    if (
                        $tanggalAkhir &&
                        $transaksi['tanggal']->format('Y-m-d') > $tanggalAkhir
                    ) {
                        return false;
                    }

                    // Filter barang
                    if (
                        $kodeBarang &&
                        $transaksi['kode_barang'] !== $kodeBarang
                    ) {
                        return false;
                    }

                    // Filter jenis transaksi
                    if (
                        $jenis &&
                        $transaksi['jenis'] !== $jenis
                    ) {
                        return false;
                    }

                    // Search kode atau nama barang
                    if ($search !== '') {
                        $searchLower = strtolower($search);

                        $kodeBarangLower = strtolower(
                            $transaksi['kode_barang']
                        );

                        $namaBarangLower = strtolower(
                            $transaksi['nama_barang']
                        );

                        if (
                            ! str_contains($kodeBarangLower, $searchLower) &&
                            ! str_contains($namaBarangLower, $searchLower)
                        ) {
                            return false;
                        }
                    }

                    return true;
                }
            )
            ->values();

        /*
        |--------------------------------------------------------------------------
        | Hitung ringkasan transaksi yang ditampilkan
        |--------------------------------------------------------------------------
        */

        $totalMasuk = $transaksi
            ->where('jenis', 'Masuk')
            ->sum('jumlah');

        $totalKeluar = $transaksi
            ->where('jenis', 'Keluar')
            ->sum('jumlah');

        /*
        |--------------------------------------------------------------------------
        | Pagination
        |--------------------------------------------------------------------------
        |
        | Pagination dilakukan setelah seluruh proses saldo dan filter selesai.
        | Hal ini penting agar saldo berjalan tidak berubah menjadi salah.
        |
        */

        $perPage = (int) $request->input('per_page', 10);

        $allowedPerPage = [10, 25, 50, 100];

        if (! in_array($perPage, $allowedPerPage)) {
            $perPage = 10;
        }

        $currentPage = max(
            1,
            (int) $request->input('page', 1)
        );

        $totalTransaksi = $transaksi->count();

        $transaksi = new \Illuminate\Pagination\LengthAwarePaginator(
            $transaksi
                ->forPage($currentPage, $perPage)
                ->values(),
            $totalTransaksi,
            $perPage,
            $currentPage,
            [
                'path' => $request->url(),
                'query' => $request->query(),
            ]
        );

        return view('laporan.transaksi', compact(
            'barang',
            'transaksi',
            'tanggalMulai',
            'tanggalAkhir',
            'kodeBarang',
            'jenis',
            'search',
            'totalMasuk',
            'totalKeluar',
            'perPage'
        ));
    }

    public function transaksiPdf(Request $request): Response
    {
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalAkhir = $request->input('tanggal_akhir');
        $kodeBarang = $request->input('kode_barang');
        $jenis = $request->input('jenis');
        $search = trim((string) $request->input('search', ''));

        /*
        |--------------------------------------------------------------------------
        | Ambil seluruh transaksi masuk
        |--------------------------------------------------------------------------
        */

        $transaksiMasuk = TransaksiMasuk::with('barang')
            ->get()
            ->map(function (TransaksiMasuk $transaksi) {
                /** @var Barang $barang */
                $barang = $transaksi->barang;

                return [
                    'tanggal' => $transaksi->tanggal_masuk,
                    'kode_barang' => $transaksi->kode_barang,
                    'nama_barang' => $barang->nama_barang,
                    'jenis' => 'Masuk',
                    'jumlah' => $transaksi->jumlah_masuk,
                    'harga_satuan' => $transaksi->harga_satuan,
                    'keterangan' => $transaksi->keterangan,
                    'id' => $transaksi->id,
                ];
            });

        /*
        |--------------------------------------------------------------------------
        | Ambil seluruh transaksi keluar
        |--------------------------------------------------------------------------
        */

        $transaksiKeluar = TransaksiKeluar::with('barang')
            ->get()
            ->map(function (TransaksiKeluar $transaksi) {
                /** @var Barang $barang */
                $barang = $transaksi->barang;

                return [
                    'tanggal' => $transaksi->tanggal_keluar,
                    'kode_barang' => $transaksi->kode_barang,
                    'nama_barang' => $barang->nama_barang,
                    'jenis' => 'Keluar',
                    'jumlah' => $transaksi->jumlah_keluar,
                    'harga_satuan' => null,
                    'keterangan' => $transaksi->keterangan,
                    'id' => $transaksi->id,
                ];
            });

        /*
        |--------------------------------------------------------------------------
        | Gabungkan transaksi dan urutkan berdasarkan tanggal
        |--------------------------------------------------------------------------
        */

        $semuaTransaksi = $transaksiMasuk
            ->concat($transaksiKeluar)
            ->sortBy([
                ['kode_barang', 'asc'],
                ['tanggal', 'asc'],
                ['jenis', 'asc'],
                ['id', 'asc'],
            ])
            ->values();

        /*
        |--------------------------------------------------------------------------
        | Hitung saldo stok per barang
        |--------------------------------------------------------------------------
        */

        $saldoBarang = [];

        $semuaTransaksi = $semuaTransaksi->map(
            function (array $transaksi) use (&$saldoBarang) {
                $kodeBarang = $transaksi['kode_barang'];

                if (! isset($saldoBarang[$kodeBarang])) {
                    $saldoBarang[$kodeBarang] = 0;
                }

                if ($transaksi['jenis'] === 'Masuk') {
                    $saldoBarang[$kodeBarang] += $transaksi['jumlah'];
                } else {
                    $saldoBarang[$kodeBarang] -= $transaksi['jumlah'];
                }

                $transaksi['saldo'] = $saldoBarang[$kodeBarang];

                return $transaksi;
            }
        );

        /*
        |--------------------------------------------------------------------------
        | Terapkan filter laporan
        |--------------------------------------------------------------------------
        */

        $transaksi = $semuaTransaksi
            ->filter(
                function (array $transaksi) use (
                    $tanggalMulai,
                    $tanggalAkhir,
                    $kodeBarang,
                    $jenis,
                    $search
                ) {
                    // Filter tanggal mulai
                    if (
                        $tanggalMulai &&
                        $transaksi['tanggal']->format('Y-m-d') < $tanggalMulai
                    ) {
                        return false;
                    }

                    // Filter tanggal akhir
                    if (
                        $tanggalAkhir &&
                        $transaksi['tanggal']->format('Y-m-d') > $tanggalAkhir
                    ) {
                        return false;
                    }

                    // Filter barang
                    if (
                        $kodeBarang &&
                        $transaksi['kode_barang'] !== $kodeBarang
                    ) {
                        return false;
                    }

                    // Filter jenis transaksi
                    if (
                        $jenis &&
                        $transaksi['jenis'] !== $jenis
                    ) {
                        return false;
                    }

                    // Search kode atau nama barang
                    if ($search !== '') {
                        $searchLower = strtolower($search);

                        $kodeBarangLower = strtolower(
                            $transaksi['kode_barang']
                        );

                        $namaBarangLower = strtolower(
                            $transaksi['nama_barang']
                        );

                        if (
                            ! str_contains($kodeBarangLower, $searchLower) &&
                            ! str_contains($namaBarangLower, $searchLower)
                        ) {
                            return false;
                        }
                    }

                    return true;
                }
            )
            ->values();

        /*
        |--------------------------------------------------------------------------
        | Hitung ringkasan transaksi
        |--------------------------------------------------------------------------
        */

        $totalMasuk = $transaksi
            ->where('jenis', 'Masuk')
            ->sum('jumlah');

        $totalKeluar = $transaksi
            ->where('jenis', 'Keluar')
            ->sum('jumlah');

        /*
        |--------------------------------------------------------------------------
        | Generate PDF
        |--------------------------------------------------------------------------
        */

        $pdf = Pdf::loadView(
            'laporan.transaksi-pdf',
            compact(
                'transaksi',
                'tanggalMulai',
                'tanggalAkhir',
                'kodeBarang',
                'jenis',
                'search',
                'totalMasuk',
                'totalKeluar'
            )
        );

        $pdf->setPaper('a4', 'landscape');

        return $pdf->download('laporan-transaksi.pdf');
    }

    public function kartuStok(Request $request): View
    {
        $barang = Barang::orderBy('nama_barang')->get();

        $kodeBarang = $request->input('kode_barang');

        $kartuStok = collect();

        if ($kodeBarang) {
            $transaksiMasuk = TransaksiMasuk::where('kode_barang', $kodeBarang)
                ->get()
                ->map(function (TransaksiMasuk $transaksi) {
                    return [
                        'tanggal' => $transaksi->tanggal_masuk,
                        'keterangan' => $transaksi->keterangan,
                        'masuk' => $transaksi->jumlah_masuk,
                        'keluar' => 0,
                        'id' => $transaksi->id,
                    ];
                });

            $transaksiKeluar = TransaksiKeluar::where('kode_barang', $kodeBarang)
                ->get()
                ->map(function (TransaksiKeluar $transaksi) {
                    return [
                        'tanggal' => $transaksi->tanggal_keluar,
                        'keterangan' => $transaksi->keterangan,
                        'masuk' => 0,
                        'keluar' => $transaksi->jumlah_keluar,
                        'id' => $transaksi->id,
                    ];
                });

            $semuaTransaksi = $transaksiMasuk
                ->concat($transaksiKeluar)
                ->sortBy([
                    ['tanggal', 'asc'],
                    ['id', 'asc'],
                ])
                ->values();

            $saldo = 0;

            $kartuStok = $semuaTransaksi->map(
                function (array $transaksi) use (&$saldo) {
                    $saldo += $transaksi['masuk'];
                    $saldo -= $transaksi['keluar'];

                    $transaksi['saldo'] = $saldo;

                    return $transaksi;
                }
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Hitung Total Kartu Stok
        |--------------------------------------------------------------------------
        |
        | Perhitungan dilakukan sebelum pagination agar total mencakup
        | seluruh transaksi, bukan hanya transaksi pada halaman aktif.
        |
        */

        $totalMasuk = $kartuStok->sum('masuk');
        $totalKeluar = $kartuStok->sum('keluar');
        $totalSaldo = $totalMasuk - $totalKeluar;

        /*
        |--------------------------------------------------------------------------
        | Pagination Kartu Stok
        |--------------------------------------------------------------------------
        */

        $perPage = (int) $request->input('per_page', 10);

        $allowedPerPage = [10, 25, 50, 100];

        if (! in_array($perPage, $allowedPerPage)) {
            $perPage = 10;
        }

        $currentPage = max(
            1,
            (int) $request->input('page', 1)
        );

        $totalKartuStok = $kartuStok->count();

        $kartuStok = new \Illuminate\Pagination\LengthAwarePaginator(
            $kartuStok
                ->forPage($currentPage, $perPage)
                ->values(),
            $totalKartuStok,
            $perPage,
            $currentPage,
            [
                'path' => $request->url(),
                'query' => $request->query(),
            ]
        );

        /** @var Barang|null $barangTerpilih */
        $barangTerpilih = $kodeBarang
            ? Barang::findOrFail($kodeBarang)
            : null;

        return view('laporan.kartu-stok', compact(
            'barang',
            'kodeBarang',
            'barangTerpilih',
            'kartuStok',
            'perPage',
            'totalMasuk',
            'totalKeluar',
            'totalSaldo'
        ));
    }

    public function kartuStokPdf(Request $request): Response
    {
        $kodeBarang = $request->input('kode_barang');

        if (! $kodeBarang) {
            return redirect()
                ->route('laporan.kartu-stok')
                ->with('error', 'Silakan pilih barang terlebih dahulu.');
        }

        /** @var Barang $barang */
        $barang = Barang::findOrFail($kodeBarang);

        $transaksiMasuk = TransaksiMasuk::where('kode_barang', $kodeBarang)
            ->get()
            ->map(function (TransaksiMasuk $transaksi) {
                return [
                    'tanggal' => $transaksi->tanggal_masuk,
                    'keterangan' => $transaksi->keterangan,
                    'masuk' => $transaksi->jumlah_masuk,
                    'keluar' => 0,
                    'id' => $transaksi->id,
                ];
            });

        $transaksiKeluar = TransaksiKeluar::where('kode_barang', $kodeBarang)
            ->get()
            ->map(function (TransaksiKeluar $transaksi) {
                return [
                    'tanggal' => $transaksi->tanggal_keluar,
                    'keterangan' => $transaksi->keterangan,
                    'masuk' => 0,
                    'keluar' => $transaksi->jumlah_keluar,
                    'id' => $transaksi->id,
                ];
            });

        $kartuStok = $transaksiMasuk
            ->concat($transaksiKeluar)
            ->sortBy([
                ['tanggal', 'asc'],
                ['id', 'asc'],
            ])
            ->values();

        /*
        |--------------------------------------------------------------------------
        | Hitung Saldo Berjalan
        |--------------------------------------------------------------------------
        */

        $saldo = 0;

        $kartuStok = $kartuStok->map(
            function (array $transaksi) use (&$saldo) {
                $saldo += $transaksi['masuk'];
                $saldo -= $transaksi['keluar'];

                $transaksi['saldo'] = $saldo;

                return $transaksi;
            }
        );


        /*
        |--------------------------------------------------------------------------
        | Hitung Total
        |--------------------------------------------------------------------------
        */

        $totalMasuk = $kartuStok->sum('masuk');

        $totalKeluar = $kartuStok->sum('keluar');

        $totalSaldo = $totalMasuk - $totalKeluar;


        /*
        |--------------------------------------------------------------------------
        | Generate PDF
        |--------------------------------------------------------------------------
        */

        $pdf = Pdf::loadView(
            'laporan.kartu-stok-pdf',
            compact(
                'barang',
                'kartuStok',
                'totalMasuk',
                'totalKeluar',
                'totalSaldo'
            )
        );

        return $pdf->download(
            'kartu-stok-'.$barang->kode_barang.'.pdf'
        );
    }
}