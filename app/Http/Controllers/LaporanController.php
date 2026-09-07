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
                    $jenis
                ) {
                    if (
                        $tanggalMulai &&
                        $transaksi['tanggal']->format('Y-m-d') < $tanggalMulai
                    ) {
                        return false;
                    }

                    if (
                        $tanggalAkhir &&
                        $transaksi['tanggal']->format('Y-m-d') > $tanggalAkhir
                    ) {
                        return false;
                    }

                    if (
                        $kodeBarang &&
                        $transaksi['kode_barang'] !== $kodeBarang
                    ) {
                        return false;
                    }

                    if (
                        $jenis &&
                        $transaksi['jenis'] !== $jenis
                    ) {
                        return false;
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

        return view('laporan.transaksi', compact(
            'barang',
            'transaksi',
            'tanggalMulai',
            'tanggalAkhir',
            'kodeBarang',
            'jenis',
            'totalMasuk',
            'totalKeluar'
        ));
    }

    public function transaksiPdf(Request $request): Response
    {
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalAkhir = $request->input('tanggal_akhir');
        $kodeBarang = $request->input('kode_barang');
        $jenis = $request->input('jenis');

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

        $semuaTransaksi = $transaksiMasuk
            ->concat($transaksiKeluar)
            ->sortBy([
                ['tanggal', 'asc'],
                ['jenis', 'asc'],
                ['id', 'asc'],
            ])
            ->values();

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

        $transaksi = $semuaTransaksi
            ->filter(
                function (array $transaksi) use (
                    $tanggalMulai,
                    $tanggalAkhir,
                    $kodeBarang,
                    $jenis
                ) {
                    if (
                        $tanggalMulai &&
                        $transaksi['tanggal']->format('Y-m-d') < $tanggalMulai
                    ) {
                        return false;
                    }

                    if (
                        $tanggalAkhir &&
                        $transaksi['tanggal']->format('Y-m-d') > $tanggalAkhir
                    ) {
                        return false;
                    }

                    if (
                        $kodeBarang &&
                        $transaksi['kode_barang'] !== $kodeBarang
                    ) {
                        return false;
                    }

                    if (
                        $jenis &&
                        $transaksi['jenis'] !== $jenis
                    ) {
                        return false;
                    }

                    return true;
                }
            )
            ->values();

        $totalMasuk = $transaksi
            ->where('jenis', 'Masuk')
            ->sum('jumlah');

        $totalKeluar = $transaksi
            ->where('jenis', 'Keluar')
            ->sum('jumlah');

        $pdf = Pdf::loadView(
            'laporan.transaksi-pdf',
            compact(
                'transaksi',
                'tanggalMulai',
                'tanggalAkhir',
                'kodeBarang',
                'jenis',
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

        /** @var Barang|null $barangTerpilih */
        $barangTerpilih = $kodeBarang
            ? Barang::findOrFail($kodeBarang)
            : null;

        return view('laporan.kartu-stok', compact(
            'barang',
            'kodeBarang',
            'barangTerpilih',
            'kartuStok'
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

        $saldo = 0;

        $kartuStok = $kartuStok->map(
            function (array $transaksi) use (&$saldo) {
                $saldo += $transaksi['masuk'];
                $saldo -= $transaksi['keluar'];

                $transaksi['saldo'] = $saldo;

                return $transaksi;
            }
        );

        $pdf = Pdf::loadView(
            'laporan.kartu-stok-pdf',
            compact(
                'barang',
                'kartuStok'
            )
        );

        return $pdf->download(
            'kartu-stok-'.$barang->kode_barang.'.pdf'
        );
    }
}
