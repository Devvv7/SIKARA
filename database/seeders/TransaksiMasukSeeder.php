<?php

namespace Database\Seeders;

use App\Models\TransaksiMasuk;
use Illuminate\Database\Seeder;

class TransaksiMasukSeeder extends Seeder
{
    public function run(): void
    {
        $transaksi = [
            [
                'tanggal_masuk' => '2026-01-01',
                'keterangan' => 'Pengadaan alat tulis kantor',
                'kode_barang' => '1010301001000001',
                'jumlah_masuk' => 20,
                'harga_satuan' => 50000,
            ],
            [
                'tanggal_masuk' => '2026-03-15',
                'keterangan' => 'Pengadaan alat tulis kantor',
                'kode_barang' => '1010301001000001',
                'jumlah_masuk' => 30,
                'harga_satuan' => 55000,
            ],
            [
                'tanggal_masuk' => '2026-06-20',
                'keterangan' => 'Pengadaan alat tulis kantor',
                'kode_barang' => '1010301001000001',
                'jumlah_masuk' => 50,
                'harga_satuan' => 52000,
            ],
            [
                'tanggal_masuk' => '2026-02-10',
                'keterangan' => 'Pengadaan alat tulis kantor',
                'kode_barang' => '1010301001000002',
                'jumlah_masuk' => 15,
                'harga_satuan' => 50000,
            ],
            [
                'tanggal_masuk' => '2026-05-12',
                'keterangan' => 'Pengadaan alat tulis kantor',
                'kode_barang' => '1010301001000002',
                'jumlah_masuk' => 25,
                'harga_satuan' => 52000,
            ],
            [
                'tanggal_masuk' => '2026-01-20',
                'keterangan' => 'Pengadaan alat tulis kantor',
                'kode_barang' => '1010301001000003',
                'jumlah_masuk' => 10,
                'harga_satuan' => 45000,
            ],
            [
                'tanggal_masuk' => '2026-04-18',
                'keterangan' => 'Pengadaan alat tulis kantor',
                'kode_barang' => '1010301001000004',
                'jumlah_masuk' => 50,
                'harga_satuan' => 65000,
            ],
            [
                'tanggal_masuk' => '2026-07-05',
                'keterangan' => 'Pengadaan alat tulis kantor',
                'kode_barang' => '1010301001000005',
                'jumlah_masuk' => 100,
                'harga_satuan' => 12000,
            ],
        ];

        foreach ($transaksi as $data) {
            TransaksiMasuk::firstOrCreate($data);
        }
    }
}
