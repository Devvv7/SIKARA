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
            [
                'kode_barang' => '1010301001000006',
                'nama_barang' => 'Kertas F4',
                'satuan' => 'rim',
                'stok' => 0,
            ],
            [
                'kode_barang' => '1010301001000007',
                'nama_barang' => 'Map Snelhecter',
                'satuan' => 'pcs',
                'stok' => 0,
            ],
            [
                'kode_barang' => '1010301001000008',
                'nama_barang' => 'Stopmap Folio',
                'satuan' => 'pcs',
                'stok' => 0,
            ],
            [
                'kode_barang' => '1010301001000009',
                'nama_barang' => 'Spidol Permanen',
                'satuan' => 'box',
                'stok' => 0,
            ],
            [
                'kode_barang' => '1010301001000010',
                'nama_barang' => 'Spidol Whiteboard',
                'satuan' => 'box',
                'stok' => 0,
            ],
            [
                'kode_barang' => '1010301001000011',
                'nama_barang' => 'Isi Staples',
                'satuan' => 'box',
                'stok' => 0,
            ],
            [
                'kode_barang' => '1010301001000012',
                'nama_barang' => 'Stapler',
                'satuan' => 'pcs',
                'stok' => 0,
            ],
            [
                'kode_barang' => '1010301001000013',
                'nama_barang' => 'Lem Kertas',
                'satuan' => 'botol',
                'stok' => 0,
            ],
            [
                'kode_barang' => '1010301001000014',
                'nama_barang' => 'Lakban',
                'satuan' => 'roll',
                'stok' => 0,
            ],
            [
                'kode_barang' => '1010301001000015',
                'nama_barang' => 'Gunting',
                'satuan' => 'pcs',
                'stok' => 0,
            ],
            [
                'kode_barang' => '1010301001000016',
                'nama_barang' => 'Cutter',
                'satuan' => 'pcs',
                'stok' => 0,
            ],
            [
                'kode_barang' => '1010301001000017',
                'nama_barang' => 'Isi Cutter',
                'satuan' => 'box',
                'stok' => 0,
            ],
            [
                'kode_barang' => '1010301001000018',
                'nama_barang' => 'Amplop Cokelat',
                'satuan' => 'box',
                'stok' => 0,
            ],
            [
                'kode_barang' => '1010301001000019',
                'nama_barang' => 'Amplop Putih',
                'satuan' => 'box',
                'stok' => 0,
            ],
            [
                'kode_barang' => '1010301001000020',
                'nama_barang' => 'Buku Agenda',
                'satuan' => 'pcs',
                'stok' => 0,
            ],
            [
                'kode_barang' => '1010301001000021',
                'nama_barang' => 'Buku Ekspedisi',
                'satuan' => 'pcs',
                'stok' => 0,
            ],
            [
                'kode_barang' => '1010301001000022',
                'nama_barang' => 'Buku Nota',
                'satuan' => 'pcs',
                'stok' => 0,
            ],
            [
                'kode_barang' => '1010301001000023',
                'nama_barang' => 'Tinta Printer Hitam',
                'satuan' => 'botol',
                'stok' => 0,
            ],
            [
                'kode_barang' => '1010301001000024',
                'nama_barang' => 'Tinta Printer Warna',
                'satuan' => 'botol',
                'stok' => 0,
            ],
            [
                'kode_barang' => '1010301001000025',
                'nama_barang' => 'Toner Printer',
                'satuan' => 'pcs',
                'stok' => 0,
            ],
            [
                'kode_barang' => '1010301001000026',
                'nama_barang' => 'Flashdisk 32GB',
                'satuan' => 'pcs',
                'stok' => 0,
            ],
            [
                'kode_barang' => '1010301001000027',
                'nama_barang' => 'Kabel USB',
                'satuan' => 'pcs',
                'stok' => 0,
            ],
            [
                'kode_barang' => '1010301001000028',
                'nama_barang' => 'Mouse',
                'satuan' => 'pcs',
                'stok' => 0,
            ],
            [
                'kode_barang' => '1010301001000029',
                'nama_barang' => 'Keyboard',
                'satuan' => 'pcs',
                'stok' => 0,
            ],
            [
                'kode_barang' => '1010301001000030',
                'nama_barang' => 'Label Sticker',
                'satuan' => 'roll',
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
