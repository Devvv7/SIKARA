<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\DetailBarang;
use Illuminate\Database\Seeder;

class DetailBarangSeeder extends Seeder
{
    public function run(): void
    {
        $detailBarang = [
            [
                'tanggal_masuk' => '2026-01-01',
                'harga' => 50000,
                'stok' => 20,
                'kode_barang' => '1010301001000001',
            ],
            [
                'tanggal_masuk' => '2026-03-15',
                'harga' => 55000,
                'stok' => 30,
                'kode_barang' => '1010301001000001',
            ],
            [
                'tanggal_masuk' => '2026-06-20',
                'harga' => 52000,
                'stok' => 50,
                'kode_barang' => '1010301001000001',
            ],
            [
                'tanggal_masuk' => '2026-02-10',
                'harga' => 50000,
                'stok' => 15,
                'kode_barang' => '1010301001000002',
            ],
            [
                'tanggal_masuk' => '2026-05-12',
                'harga' => 52000,
                'stok' => 25,
                'kode_barang' => '1010301001000002',
            ],
            [
                'tanggal_masuk' => '2026-01-20',
                'harga' => 45000,
                'stok' => 10,
                'kode_barang' => '1010301001000003',
            ],
            [
                'tanggal_masuk' => '2026-04-18',
                'harga' => 65000,
                'stok' => 50,
                'kode_barang' => '1010301001000004',
            ],
            [
                'tanggal_masuk' => '2026-07-05',
                'harga' => 12000,
                'stok' => 100,
                'kode_barang' => '1010301001000005',
            ],
        ];

        foreach ($detailBarang as $data) {
            DetailBarang::firstOrCreate($data);
        }

        // Sinkronkan stok barang dengan total stok setiap batch.
        $barang = Barang::all();

        foreach ($barang as $item) {
            $totalStok = $item->detailBarang()->sum('stok');

            $item->update([
                'stok' => $totalStok,
            ]);
        }
    }
}
