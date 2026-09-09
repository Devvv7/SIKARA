<?php

namespace Database\Seeders;

use App\Models\TransaksiMasuk;
use Illuminate\Database\Seeder;

class TransaksiMasukSeeder extends Seeder
{
    public function run(): void
    {
        $transaksi = [
            // =========================================================
            // Pulpen Biru
            // =========================================================
            [
                'tanggal_masuk' => '2026-01-05',
                'keterangan' => 'Pengadaan alat tulis kantor',
                'kode_barang' => '1010301001000001',
                'jumlah_masuk' => 20,
                'harga_satuan' => 50000,
            ],
            [
                'tanggal_masuk' => '2026-03-18',
                'keterangan' => 'Pengadaan alat tulis kantor',
                'kode_barang' => '1010301001000001',
                'jumlah_masuk' => 30,
                'harga_satuan' => 52000,
            ],
            [
                'tanggal_masuk' => '2026-06-12',
                'keterangan' => 'Pengadaan alat tulis kantor',
                'kode_barang' => '1010301001000001',
                'jumlah_masuk' => 40,
                'harga_satuan' => 55000,
            ],

            // =========================================================
            // Pulpen Hitam
            // =========================================================
            [
                'tanggal_masuk' => '2026-01-08',
                'keterangan' => 'Pengadaan alat tulis kantor',
                'kode_barang' => '1010301001000002',
                'jumlah_masuk' => 20,
                'harga_satuan' => 50000,
            ],
            [
                'tanggal_masuk' => '2026-04-15',
                'keterangan' => 'Pengadaan alat tulis kantor',
                'kode_barang' => '1010301001000002',
                'jumlah_masuk' => 25,
                'harga_satuan' => 52000,
            ],
            [
                'tanggal_masuk' => '2026-08-10',
                'keterangan' => 'Pengadaan alat tulis kantor',
                'kode_barang' => '1010301001000002',
                'jumlah_masuk' => 30,
                'harga_satuan' => 54000,
            ],

            // =========================================================
            // Pensil 2B
            // =========================================================
            [
                'tanggal_masuk' => '2026-01-12',
                'keterangan' => 'Pengadaan alat tulis kantor',
                'kode_barang' => '1010301001000003',
                'jumlah_masuk' => 15,
                'harga_satuan' => 45000,
            ],
            [
                'tanggal_masuk' => '2026-05-20',
                'keterangan' => 'Pengadaan alat tulis kantor',
                'kode_barang' => '1010301001000003',
                'jumlah_masuk' => 20,
                'harga_satuan' => 47000,
            ],

            // =========================================================
            // Kertas A4
            // =========================================================
            [
                'tanggal_masuk' => '2026-01-15',
                'keterangan' => 'Pengadaan kertas administrasi',
                'kode_barang' => '1010301001000004',
                'jumlah_masuk' => 50,
                'harga_satuan' => 65000,
            ],
            [
                'tanggal_masuk' => '2026-04-10',
                'keterangan' => 'Pengadaan kertas administrasi',
                'kode_barang' => '1010301001000004',
                'jumlah_masuk' => 75,
                'harga_satuan' => 68000,
            ],
            [
                'tanggal_masuk' => '2026-07-15',
                'keterangan' => 'Pengadaan kertas administrasi',
                'kode_barang' => '1010301001000004',
                'jumlah_masuk' => 60,
                'harga_satuan' => 70000,
            ],
            [
                'tanggal_masuk' => '2026-09-01',
                'keterangan' => 'Pengadaan kertas administrasi',
                'kode_barang' => '1010301001000004',
                'jumlah_masuk' => 50,
                'harga_satuan' => 70000,
            ],

            // =========================================================
            // Map Folder
            // =========================================================
            [
                'tanggal_masuk' => '2026-01-20',
                'keterangan' => 'Pengadaan perlengkapan administrasi',
                'kode_barang' => '1010301001000005',
                'jumlah_masuk' => 100,
                'harga_satuan' => 12000,
            ],
            [
                'tanggal_masuk' => '2026-05-05',
                'keterangan' => 'Pengadaan perlengkapan administrasi',
                'kode_barang' => '1010301001000005',
                'jumlah_masuk' => 150,
                'harga_satuan' => 12500,
            ],
            [
                'tanggal_masuk' => '2026-08-20',
                'keterangan' => 'Pengadaan perlengkapan administrasi',
                'kode_barang' => '1010301001000005',
                'jumlah_masuk' => 100,
                'harga_satuan' => 13000,
            ],

            // =========================================================
            // Kertas F4
            // =========================================================
            [
                'tanggal_masuk' => '2026-01-22',
                'keterangan' => 'Pengadaan kertas administrasi',
                'kode_barang' => '1010301001000006',
                'jumlah_masuk' => 40,
                'harga_satuan' => 68000,
            ],
            [
                'tanggal_masuk' => '2026-04-22',
                'keterangan' => 'Pengadaan kertas administrasi',
                'kode_barang' => '1010301001000006',
                'jumlah_masuk' => 60,
                'harga_satuan' => 70000,
            ],
            [
                'tanggal_masuk' => '2026-08-05',
                'keterangan' => 'Pengadaan kertas administrasi',
                'kode_barang' => '1010301001000006',
                'jumlah_masuk' => 50,
                'harga_satuan' => 72000,
            ],

            // =========================================================
            // Map Snelhecter
            // =========================================================
            [
                'tanggal_masuk' => '2026-02-02',
                'keterangan' => 'Pengadaan perlengkapan arsip',
                'kode_barang' => '1010301001000007',
                'jumlah_masuk' => 100,
                'harga_satuan' => 15000,
            ],
            [
                'tanggal_masuk' => '2026-06-02',
                'keterangan' => 'Pengadaan perlengkapan arsip',
                'kode_barang' => '1010301001000007',
                'jumlah_masuk' => 100,
                'harga_satuan' => 16000,
            ],

            // =========================================================
            // Stopmap Folio
            // =========================================================
            [
                'tanggal_masuk' => '2026-02-05',
                'keterangan' => 'Pengadaan perlengkapan arsip',
                'kode_barang' => '1010301001000008',
                'jumlah_masuk' => 100,
                'harga_satuan' => 10000,
            ],
            [
                'tanggal_masuk' => '2026-07-02',
                'keterangan' => 'Pengadaan perlengkapan arsip',
                'kode_barang' => '1010301001000008',
                'jumlah_masuk' => 150,
                'harga_satuan' => 10500,
            ],

            // =========================================================
            // Spidol Permanen
            // =========================================================
            [
                'tanggal_masuk' => '2026-02-08',
                'keterangan' => 'Pengadaan alat tulis kantor',
                'kode_barang' => '1010301001000009',
                'jumlah_masuk' => 15,
                'harga_satuan' => 60000,
            ],
            [
                'tanggal_masuk' => '2026-06-15',
                'keterangan' => 'Pengadaan alat tulis kantor',
                'kode_barang' => '1010301001000009',
                'jumlah_masuk' => 20,
                'harga_satuan' => 62000,
            ],

            // =========================================================
            // Spidol Whiteboard
            // =========================================================
            [
                'tanggal_masuk' => '2026-02-12',
                'keterangan' => 'Pengadaan alat tulis kantor',
                'kode_barang' => '1010301001000010',
                'jumlah_masuk' => 15,
                'harga_satuan' => 55000,
            ],
            [
                'tanggal_masuk' => '2026-07-12',
                'keterangan' => 'Pengadaan alat tulis kantor',
                'kode_barang' => '1010301001000010',
                'jumlah_masuk' => 20,
                'harga_satuan' => 58000,
            ],

            // =========================================================
            // Isi Staples
            // =========================================================
            [
                'tanggal_masuk' => '2026-02-15',
                'keterangan' => 'Pengadaan perlengkapan kantor',
                'kode_barang' => '1010301001000011',
                'jumlah_masuk' => 30,
                'harga_satuan' => 18000,
            ],
            [
                'tanggal_masuk' => '2026-06-20',
                'keterangan' => 'Pengadaan perlengkapan kantor',
                'kode_barang' => '1010301001000011',
                'jumlah_masuk' => 40,
                'harga_satuan' => 20000,
            ],

            // =========================================================
            // Stapler
            // =========================================================
            [
                'tanggal_masuk' => '2026-02-18',
                'keterangan' => 'Pengadaan perlengkapan kantor',
                'kode_barang' => '1010301001000012',
                'jumlah_masuk' => 20,
                'harga_satuan' => 35000,
            ],
            [
                'tanggal_masuk' => '2026-07-18',
                'keterangan' => 'Pengadaan perlengkapan kantor',
                'kode_barang' => '1010301001000012',
                'jumlah_masuk' => 25,
                'harga_satuan' => 38000,
            ],

            // =========================================================
            // Lem Kertas
            // =========================================================
            [
                'tanggal_masuk' => '2026-02-20',
                'keterangan' => 'Pengadaan perlengkapan kantor',
                'kode_barang' => '1010301001000013',
                'jumlah_masuk' => 30,
                'harga_satuan' => 10000,
            ],
            [
                'tanggal_masuk' => '2026-06-25',
                'keterangan' => 'Pengadaan perlengkapan kantor',
                'kode_barang' => '1010301001000013',
                'jumlah_masuk' => 40,
                'harga_satuan' => 11000,
            ],

            // =========================================================
            // Lakban
            // =========================================================
            [
                'tanggal_masuk' => '2026-02-22',
                'keterangan' => 'Pengadaan perlengkapan kantor',
                'kode_barang' => '1010301001000014',
                'jumlah_masuk' => 30,
                'harga_satuan' => 15000,
            ],
            [
                'tanggal_masuk' => '2026-07-20',
                'keterangan' => 'Pengadaan perlengkapan kantor',
                'kode_barang' => '1010301001000014',
                'jumlah_masuk' => 40,
                'harga_satuan' => 16000,
            ],

            // =========================================================
            // Gunting
            // =========================================================
            [
                'tanggal_masuk' => '2026-03-01',
                'keterangan' => 'Pengadaan perlengkapan kantor',
                'kode_barang' => '1010301001000015',
                'jumlah_masuk' => 20,
                'harga_satuan' => 25000,
            ],
            [
                'tanggal_masuk' => '2026-08-01',
                'keterangan' => 'Pengadaan perlengkapan kantor',
                'kode_barang' => '1010301001000015',
                'jumlah_masuk' => 25,
                'harga_satuan' => 28000,
            ],

            // =========================================================
            // Cutter
            // =========================================================
            [
                'tanggal_masuk' => '2026-03-05',
                'keterangan' => 'Pengadaan perlengkapan kantor',
                'kode_barang' => '1010301001000016',
                'jumlah_masuk' => 25,
                'harga_satuan' => 18000,
            ],
            [
                'tanggal_masuk' => '2026-08-05',
                'keterangan' => 'Pengadaan perlengkapan kantor',
                'kode_barang' => '1010301001000016',
                'jumlah_masuk' => 30,
                'harga_satuan' => 20000,
            ],

            // =========================================================
            // Isi Cutter
            // =========================================================
            [
                'tanggal_masuk' => '2026-03-08',
                'keterangan' => 'Pengadaan perlengkapan kantor',
                'kode_barang' => '1010301001000017',
                'jumlah_masuk' => 20,
                'harga_satuan' => 22000,
            ],
            [
                'tanggal_masuk' => '2026-08-08',
                'keterangan' => 'Pengadaan perlengkapan kantor',
                'kode_barang' => '1010301001000017',
                'jumlah_masuk' => 25,
                'harga_satuan' => 24000,
            ],

            // =========================================================
            // Amplop Cokelat
            // =========================================================
            [
                'tanggal_masuk' => '2026-03-10',
                'keterangan' => 'Pengadaan perlengkapan administrasi',
                'kode_barang' => '1010301001000018',
                'jumlah_masuk' => 40,
                'harga_satuan' => 35000,
            ],
            [
                'tanggal_masuk' => '2026-07-10',
                'keterangan' => 'Pengadaan perlengkapan administrasi',
                'kode_barang' => '1010301001000018',
                'jumlah_masuk' => 50,
                'harga_satuan' => 38000,
            ],

            // =========================================================
            // Amplop Putih
            // =========================================================
            [
                'tanggal_masuk' => '2026-03-12',
                'keterangan' => 'Pengadaan perlengkapan administrasi',
                'kode_barang' => '1010301001000019',
                'jumlah_masuk' => 40,
                'harga_satuan' => 30000,
            ],
            [
                'tanggal_masuk' => '2026-08-12',
                'keterangan' => 'Pengadaan perlengkapan administrasi',
                'kode_barang' => '1010301001000019',
                'jumlah_masuk' => 50,
                'harga_satuan' => 32000,
            ],

            // =========================================================
            // Buku Agenda
            // =========================================================
            [
                'tanggal_masuk' => '2026-03-15',
                'keterangan' => 'Pengadaan buku administrasi',
                'kode_barang' => '1010301001000020',
                'jumlah_masuk' => 50,
                'harga_satuan' => 28000,
            ],
            [
                'tanggal_masuk' => '2026-07-15',
                'keterangan' => 'Pengadaan buku administrasi',
                'kode_barang' => '1010301001000020',
                'jumlah_masuk' => 60,
                'harga_satuan' => 30000,
            ],

            // =========================================================
            // Buku Ekspedisi
            // =========================================================
            [
                'tanggal_masuk' => '2026-03-18',
                'keterangan' => 'Pengadaan buku administrasi',
                'kode_barang' => '1010301001000021',
                'jumlah_masuk' => 40,
                'harga_satuan' => 22000,
            ],
            [
                'tanggal_masuk' => '2026-08-18',
                'keterangan' => 'Pengadaan buku administrasi',
                'kode_barang' => '1010301001000021',
                'jumlah_masuk' => 50,
                'harga_satuan' => 24000,
            ],

            // =========================================================
            // Buku Nota
            // =========================================================
            [
                'tanggal_masuk' => '2026-03-20',
                'keterangan' => 'Pengadaan buku administrasi',
                'kode_barang' => '1010301001000022',
                'jumlah_masuk' => 50,
                'harga_satuan' => 15000,
            ],
            [
                'tanggal_masuk' => '2026-08-20',
                'keterangan' => 'Pengadaan buku administrasi',
                'kode_barang' => '1010301001000022',
                'jumlah_masuk' => 60,
                'harga_satuan' => 16000,
            ],

            // =========================================================
            // Tinta Printer Hitam
            // =========================================================
            [
                'tanggal_masuk' => '2026-03-25',
                'keterangan' => 'Pengadaan perlengkapan printer',
                'kode_barang' => '1010301001000023',
                'jumlah_masuk' => 15,
                'harga_satuan' => 85000,
            ],
            [
                'tanggal_masuk' => '2026-06-30',
                'keterangan' => 'Pengadaan perlengkapan printer',
                'kode_barang' => '1010301001000023',
                'jumlah_masuk' => 20,
                'harga_satuan' => 90000,
            ],
            [
                'tanggal_masuk' => '2026-09-05',
                'keterangan' => 'Pengadaan perlengkapan printer',
                'kode_barang' => '1010301001000023',
                'jumlah_masuk' => 15,
                'harga_satuan' => 92000,
            ],

            // =========================================================
            // Tinta Printer Warna
            // =========================================================
            [
                'tanggal_masuk' => '2026-03-28',
                'keterangan' => 'Pengadaan perlengkapan printer',
                'kode_barang' => '1010301001000024',
                'jumlah_masuk' => 12,
                'harga_satuan' => 90000,
            ],
            [
                'tanggal_masuk' => '2026-07-28',
                'keterangan' => 'Pengadaan perlengkapan printer',
                'kode_barang' => '1010301001000024',
                'jumlah_masuk' => 15,
                'harga_satuan' => 95000,
            ],

            // =========================================================
            // Toner Printer
            // =========================================================
            [
                'tanggal_masuk' => '2026-04-02',
                'keterangan' => 'Pengadaan perlengkapan printer',
                'kode_barang' => '1010301001000025',
                'jumlah_masuk' => 10,
                'harga_satuan' => 350000,
            ],
            [
                'tanggal_masuk' => '2026-08-02',
                'keterangan' => 'Pengadaan perlengkapan printer',
                'kode_barang' => '1010301001000025',
                'jumlah_masuk' => 12,
                'harga_satuan' => 375000,
            ],

            // =========================================================
            // Flashdisk
            // =========================================================
            [
                'tanggal_masuk' => '2026-04-05',
                'keterangan' => 'Pengadaan perangkat pendukung komputer',
                'kode_barang' => '1010301001000026',
                'jumlah_masuk' => 15,
                'harga_satuan' => 75000,
            ],
            [
                'tanggal_masuk' => '2026-08-15',
                'keterangan' => 'Pengadaan perangkat pendukung komputer',
                'kode_barang' => '1010301001000026',
                'jumlah_masuk' => 20,
                'harga_satuan' => 80000,
            ],

            // =========================================================
            // Kabel USB
            // =========================================================
            [
                'tanggal_masuk' => '2026-04-08',
                'keterangan' => 'Pengadaan perangkat pendukung komputer',
                'kode_barang' => '1010301001000027',
                'jumlah_masuk' => 15,
                'harga_satuan' => 35000,
            ],
            [
                'tanggal_masuk' => '2026-08-18',
                'keterangan' => 'Pengadaan perangkat pendukung komputer',
                'kode_barang' => '1010301001000027',
                'jumlah_masuk' => 20,
                'harga_satuan' => 38000,
            ],

            // =========================================================
            // Mouse
            // =========================================================
            [
                'tanggal_masuk' => '2026-04-12',
                'keterangan' => 'Pengadaan perangkat komputer',
                'kode_barang' => '1010301001000028',
                'jumlah_masuk' => 15,
                'harga_satuan' => 85000,
            ],
            [
                'tanggal_masuk' => '2026-08-22',
                'keterangan' => 'Pengadaan perangkat komputer',
                'kode_barang' => '1010301001000028',
                'jumlah_masuk' => 20,
                'harga_satuan' => 90000,
            ],

            // =========================================================
            // Keyboard
            // =========================================================
            [
                'tanggal_masuk' => '2026-04-15',
                'keterangan' => 'Pengadaan perangkat komputer',
                'kode_barang' => '1010301001000029',
                'jumlah_masuk' => 10,
                'harga_satuan' => 150000,
            ],
            [
                'tanggal_masuk' => '2026-08-25',
                'keterangan' => 'Pengadaan perangkat komputer',
                'kode_barang' => '1010301001000029',
                'jumlah_masuk' => 15,
                'harga_satuan' => 165000,
            ],

            // =========================================================
            // Label Sticker
            // =========================================================
            [
                'tanggal_masuk' => '2026-04-20',
                'keterangan' => 'Pengadaan perlengkapan administrasi',
                'kode_barang' => '1010301001000030',
                'jumlah_masuk' => 30,
                'harga_satuan' => 25000,
            ],
            [
                'tanggal_masuk' => '2026-07-20',
                'keterangan' => 'Pengadaan perlengkapan administrasi',
                'kode_barang' => '1010301001000030',
                'jumlah_masuk' => 40,
                'harga_satuan' => 27000,
            ],
            [
                'tanggal_masuk' => '2026-09-02',
                'keterangan' => 'Pengadaan perlengkapan administrasi',
                'kode_barang' => '1010301001000030',
                'jumlah_masuk' => 30,
                'harga_satuan' => 28000,
            ],
        ];

        foreach ($transaksi as $data) {
            TransaksiMasuk::firstOrCreate($data);
        }
    }
}
