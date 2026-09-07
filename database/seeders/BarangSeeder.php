<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $barang = [
            [
                'kode_barang' => '1010301001000001',
                'nama_barang' => 'Pulpen Biru',
                'satuan' => 'box',
                'stok' => 0,
            ],
            [
                'kode_barang' => '1010301001000002',
                'nama_barang' => 'Pulpen Hitam',
                'satuan' => 'box',
                'stok' => 0,
            ],
            [
                'kode_barang' => '1010301001000003',
                'nama_barang' => 'Pensil 2B',
                'satuan' => 'box',
                'stok' => 0,
            ],
            [
                'kode_barang' => '1010301001000004',
                'nama_barang' => 'Kertas A4',
                'satuan' => 'rim',
                'stok' => 0,
            ],
            [
                'kode_barang' => '1010301001000005',
                'nama_barang' => 'Map Folder',
                'satuan' => 'pcs',
                'stok' => 0,
            ],
        ];

        foreach ($barang as $data) {
            Barang::updateOrCreate(
                ['kode_barang' => $data['kode_barang']],
                $data
            );
        }
    }
}