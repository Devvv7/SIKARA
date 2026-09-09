<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(Request $request): View
    {
        // Jumlah data per halaman
        $perPage = (int) $request->input('per_page', 10);

        // Batasi pilihan yang diperbolehkan
        $allowedPerPage = [10, 25, 50, 100];

        if (!in_array($perPage, $allowedPerPage)) {
            $perPage = 10;
        }

        // Kata pencarian
        $search = trim((string) $request->input('search', ''));

        // Query data barang
        $query = Barang::orderBy('kode_barang');

        // Filter berdasarkan kode atau nama barang
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('kode_barang', 'like', "%{$search}%")
                    ->orWhere('nama_barang', 'like', "%{$search}%");
            });
        }

        // Pagination + pertahankan parameter search dan per_page
        $barang = $query
            ->paginate($perPage)
            ->withQueryString();

        return view('barang.index', compact(
            'barang',
            'perPage',
            'search'
        ));
    }

    public function create(): View
    {
        return view('barang.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'kode_barang' => ['required', 'string', 'max:255', 'unique:barang,kode_barang'],
            'nama_barang' => ['required', 'string', 'max:255'],
            'satuan' => ['required', 'string', 'max:50'],
        ]);

        Barang::create([
            'kode_barang' => $validated['kode_barang'],
            'nama_barang' => $validated['nama_barang'],
            'satuan' => $validated['satuan'],
            'stok' => 0,
        ]);

        return redirect()
            ->route('barang.index')
            ->with('success', 'Barang berhasil ditambahkan.');
    }

    public function edit(string $kode_barang): View
    {
        $barang = Barang::findOrFail($kode_barang);

        return view('barang.edit', compact('barang'));
    }

    public function show(string $kode_barang): View
    {
        $barang = Barang::findOrFail($kode_barang);

        $detailBarang = $barang->detailBarang()
            ->orderBy('tanggal_masuk')
            ->orderBy('id')
            ->get();

        return view('barang.show', compact(
            'barang',
            'detailBarang'
        ));
    }

    public function update(
        Request $request,
        string $kode_barang
    ): RedirectResponse {
        $barang = Barang::findOrFail($kode_barang);

        $validated = $request->validate([
            'nama_barang' => ['required', 'string', 'max:255'],
            'satuan' => ['required', 'string', 'max:50'],
        ]);

        $barang->update($validated);

        return redirect()
            ->route('barang.index')
            ->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy(string $kode_barang): RedirectResponse
    {
        $barang = Barang::findOrFail($kode_barang);

        if (
            $barang->detailBarang()->exists() ||
            $barang->transaksiMasuk()->exists() ||
            $barang->transaksiKeluar()->exists()
        ) {
            return redirect()
                ->route('barang.index')
                ->with(
                    'error',
                    'Barang tidak dapat dihapus karena sudah memiliki riwayat transaksi.'
                );
        }

        $barang->delete();

        return redirect()
            ->route('barang.index')
            ->with('success', 'Barang berhasil dihapus.');
    }
}