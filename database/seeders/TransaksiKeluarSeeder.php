<?php

namespace Database\Seeders;

use App\Models\TransaksiKeluar;
use Illuminate\Database\Seeder;

class TransaksiKeluarSeeder extends Seeder
{
    public function run(): void
    {
        $transaksi = [
            // =========================================================
            // 1. Pulpen Biru
            // =========================================================
            [
                'tanggal_keluar' => '2026-01-15',
                'keterangan' => 'Distribusi alat tulis untuk bagian pelayanan',
                'kode_barang' => '1010301001000001',
                'jumlah_keluar' => 5,
            ],
            [
                'tanggal_keluar' => '2026-02-20',
                'keterangan' => 'Distribusi alat tulis untuk bagian tata usaha',
                'kode_barang' => '1010301001000001',
                'jumlah_keluar' => 4,
            ],
            [
                'tanggal_keluar' => '2026-04-05',
                'keterangan' => 'Pemakaian kegiatan administrasi kantor',
                'kode_barang' => '1010301001000001',
                'jumlah_keluar' => 6,
            ],
            [
                'tanggal_keluar' => '2026-07-10',
                'keterangan' => 'Distribusi alat tulis untuk kegiatan pelayanan',
                'kode_barang' => '1010301001000001',
                'jumlah_keluar' => 8,
            ],
            [
                'tanggal_keluar' => '2026-08-25',
                'keterangan' => 'Pemakaian rutin administrasi kantor',
                'kode_barang' => '1010301001000001',
                'jumlah_keluar' => 7,
            ],

            // =========================================================
            // 2. Pulpen Hitam
            // =========================================================
            [
                'tanggal_keluar' => '2026-01-20',
                'keterangan' => 'Distribusi alat tulis untuk bagian pelayanan',
                'kode_barang' => '1010301001000002',
                'jumlah_keluar' => 5,
            ],
            [
                'tanggal_keluar' => '2026-03-10',
                'keterangan' => 'Pemakaian kegiatan administrasi kantor',
                'kode_barang' => '1010301001000002',
                'jumlah_keluar' => 4,
            ],
            [
                'tanggal_keluar' => '2026-05-20',
                'keterangan' => 'Distribusi alat tulis untuk bagian tata usaha',
                'kode_barang' => '1010301001000002',
                'jumlah_keluar' => 7,
            ],
            [
                'tanggal_keluar' => '2026-08-20',
                'keterangan' => 'Pemakaian rutin administrasi kantor',
                'kode_barang' => '1010301001000002',
                'jumlah_keluar' => 8,
            ],

            // =========================================================
            // 3. Pensil 2B
            // =========================================================
            [
                'tanggal_keluar' => '2026-02-05',
                'keterangan' => 'Distribusi perlengkapan administrasi',
                'kode_barang' => '1010301001000003',
                'jumlah_keluar' => 3,
            ],
            [
                'tanggal_keluar' => '2026-06-10',
                'keterangan' => 'Pemakaian kegiatan administrasi kantor',
                'kode_barang' => '1010301001000003',
                'jumlah_keluar' => 5,
            ],
            [
                'tanggal_keluar' => '2026-08-15',
                'keterangan' => 'Distribusi alat tulis untuk bagian pelayanan',
                'kode_barang' => '1010301001000003',
                'jumlah_keluar' => 2,
            ],

            // =========================================================
            // 4. Kertas A4
            // =========================================================
            [
                'tanggal_keluar' => '2026-02-01',
                'keterangan' => 'Pemakaian kertas untuk administrasi kantor',
                'kode_barang' => '1010301001000004',
                'jumlah_keluar' => 10,
            ],
            [
                'tanggal_keluar' => '2026-03-20',
                'keterangan' => 'Pemakaian kertas untuk pencetakan dokumen',
                'kode_barang' => '1010301001000004',
                'jumlah_keluar' => 8,
            ],
            [
                'tanggal_keluar' => '2026-05-15',
                'keterangan' => 'Pemakaian kertas untuk kegiatan pelayanan',
                'kode_barang' => '1010301001000004',
                'jumlah_keluar' => 12,
            ],
            [
                'tanggal_keluar' => '2026-08-10',
                'keterangan' => 'Pemakaian kertas untuk administrasi kantor',
                'kode_barang' => '1010301001000004',
                'jumlah_keluar' => 10,
            ],

            // =========================================================
            // 5. Map Folder
            // =========================================================
            [
                'tanggal_keluar' => '2026-02-10',
                'keterangan' => 'Distribusi perlengkapan arsip',
                'kode_barang' => '1010301001000005',
                'jumlah_keluar' => 15,
            ],
            [
                'tanggal_keluar' => '2026-04-20',
                'keterangan' => 'Penggunaan untuk penyimpanan dokumen',
                'kode_barang' => '1010301001000005',
                'jumlah_keluar' => 20,
            ],
            [
                'tanggal_keluar' => '2026-06-15',
                'keterangan' => 'Distribusi perlengkapan arsip',
                'kode_barang' => '1010301001000005',
                'jumlah_keluar' => 18,
            ],
            [
                'tanggal_keluar' => '2026-09-01',
                'keterangan' => 'Penggunaan untuk penyimpanan dokumen',
                'kode_barang' => '1010301001000005',
                'jumlah_keluar' => 15,
            ],

            // =========================================================
            // 6. Kertas F4
            // =========================================================
            [
                'tanggal_keluar' => '2026-02-15',
                'keterangan' => 'Pemakaian kertas untuk dokumen administrasi',
                'kode_barang' => '1010301001000006',
                'jumlah_keluar' => 10,
            ],
            [
                'tanggal_keluar' => '2026-05-10',
                'keterangan' => 'Pemakaian kertas untuk pencetakan dokumen',
                'kode_barang' => '1010301001000006',
                'jumlah_keluar' => 12,
            ],
            [
                'tanggal_keluar' => '2026-08-15',
                'keterangan' => 'Pemakaian kertas untuk kegiatan pelayanan',
                'kode_barang' => '1010301001000006',
                'jumlah_keluar' => 8,
            ],

            // =========================================================
            // 7. Map Snelhecter
            // =========================================================
            [
                'tanggal_keluar' => '2026-03-01',
                'keterangan' => 'Distribusi perlengkapan arsip',
                'kode_barang' => '1010301001000007',
                'jumlah_keluar' => 20,
            ],
            [
                'tanggal_keluar' => '2026-07-01',
                'keterangan' => 'Penggunaan untuk pengarsipan dokumen',
                'kode_barang' => '1010301001000007',
                'jumlah_keluar' => 25,
            ],

            // =========================================================
            // 8. Stopmap Folio
            // =========================================================
            [
                'tanggal_keluar' => '2026-03-05',
                'keterangan' => 'Distribusi perlengkapan arsip',
                'kode_barang' => '1010301001000008',
                'jumlah_keluar' => 20,
            ],
            [
                'tanggal_keluar' => '2026-08-05',
                'keterangan' => 'Penggunaan untuk pengarsipan dokumen',
                'kode_barang' => '1010301001000008',
                'jumlah_keluar' => 25,
            ],

            // =========================================================
            // 9. Spidol Permanen
            // =========================================================
            [
                'tanggal_keluar' => '2026-03-10',
                'keterangan' => 'Distribusi perlengkapan kantor',
                'kode_barang' => '1010301001000009',
                'jumlah_keluar' => 5,
            ],
            [
                'tanggal_keluar' => '2026-07-15',
                'keterangan' => 'Pemakaian kegiatan administrasi',
                'kode_barang' => '1010301001000009',
                'jumlah_keluar' => 6,
            ],

            // =========================================================
            // 10. Spidol Whiteboard
            // =========================================================
            [
                'tanggal_keluar' => '2026-03-15',
                'keterangan' => 'Distribusi perlengkapan ruang kerja',
                'kode_barang' => '1010301001000010',
                'jumlah_keluar' => 5,
            ],
            [
                'tanggal_keluar' => '2026-07-20',
                'keterangan' => 'Pemakaian perlengkapan kantor',
                'kode_barang' => '1010301001000010',
                'jumlah_keluar' => 7,
            ],

            // =========================================================
            // 11. Isi Staples
            // =========================================================
            [
                'tanggal_keluar' => '2026-03-20',
                'keterangan' => 'Pemakaian perlengkapan administrasi',
                'kode_barang' => '1010301001000011',
                'jumlah_keluar' => 10,
            ],
            [
                'tanggal_keluar' => '2026-07-25',
                'keterangan' => 'Distribusi perlengkapan kantor',
                'kode_barang' => '1010301001000011',
                'jumlah_keluar' => 15,
            ],

            // =========================================================
            // 12. Stapler
            // =========================================================
            [
                'tanggal_keluar' => '2026-03-25',
                'keterangan' => 'Distribusi perlengkapan administrasi',
                'kode_barang' => '1010301001000012',
                'jumlah_keluar' => 5,
            ],
            [
                'tanggal_keluar' => '2026-08-01',
                'keterangan' => 'Pengadaan perlengkapan ruang kerja',
                'kode_barang' => '1010301001000012',
                'jumlah_keluar' => 6,
            ],

            // =========================================================
            // 13. Lem Kertas
            // =========================================================
            [
                'tanggal_keluar' => '2026-03-28',
                'keterangan' => 'Pemakaian perlengkapan administrasi',
                'kode_barang' => '1010301001000013',
                'jumlah_keluar' => 8,
            ],
            [
                'tanggal_keluar' => '2026-07-30',
                'keterangan' => 'Distribusi perlengkapan kantor',
                'kode_barang' => '1010301001000013',
                'jumlah_keluar' => 10,
            ],

            // =========================================================
            // 14. Lakban
            // =========================================================
            [
                'tanggal_keluar' => '2026-04-01',
                'keterangan' => 'Pemakaian perlengkapan pengemasan',
                'kode_barang' => '1010301001000014',
                'jumlah_keluar' => 8,
            ],
            [
                'tanggal_keluar' => '2026-08-05',
                'keterangan' => 'Pemakaian perlengkapan kantor',
                'kode_barang' => '1010301001000014',
                'jumlah_keluar' => 10,
            ],

            // =========================================================
            // 15. Gunting
            // =========================================================
            [
                'tanggal_keluar' => '2026-04-05',
                'keterangan' => 'Distribusi perlengkapan kantor',
                'kode_barang' => '1010301001000015',
                'jumlah_keluar' => 5,
            ],
            [
                'tanggal_keluar' => '2026-08-10',
                'keterangan' => 'Pemakaian perlengkapan administrasi',
                'kode_barang' => '1010301001000015',
                'jumlah_keluar' => 6,
            ],

            // =========================================================
            // 16. Cutter
            // =========================================================
            [
                'tanggal_keluar' => '2026-04-10',
                'keterangan' => 'Distribusi perlengkapan kantor',
                'kode_barang' => '1010301001000016',
                'jumlah_keluar' => 6,
            ],
            [
                'tanggal_keluar' => '2026-08-15',
                'keterangan' => 'Pemakaian perlengkapan administrasi',
                'kode_barang' => '1010301001000016',
                'jumlah_keluar' => 8,
            ],

            // =========================================================
            // 17. Isi Cutter
            // =========================================================
            [
                'tanggal_keluar' => '2026-04-15',
                'keterangan' => 'Pemakaian perlengkapan kantor',
                'kode_barang' => '1010301001000017',
                'jumlah_keluar' => 7,
            ],
            [
                'tanggal_keluar' => '2026-08-20',
                'keterangan' => 'Distribusi perlengkapan kantor',
                'kode_barang' => '1010301001000017',
                'jumlah_keluar' => 8,
            ],

            // =========================================================
            // 18. Amplop Cokelat
            // =========================================================
            [
                'tanggal_keluar' => '2026-04-20',
                'keterangan' => 'Pemakaian perlengkapan surat menyurat',
                'kode_barang' => '1010301001000018',
                'jumlah_keluar' => 10,
            ],
            [
                'tanggal_keluar' => '2026-08-25',
                'keterangan' => 'Pemakaian perlengkapan surat menyurat',
                'kode_barang' => '1010301001000018',
                'jumlah_keluar' => 15,
            ],

            // =========================================================
            // 19. Amplop Putih
            // =========================================================
            [
                'tanggal_keluar' => '2026-04-25',
                'keterangan' => 'Pemakaian perlengkapan surat menyurat',
                'kode_barang' => '1010301001000019',
                'jumlah_keluar' => 12,
            ],
            [
                'tanggal_keluar' => '2026-08-28',
                'keterangan' => 'Distribusi perlengkapan administrasi',
                'kode_barang' => '1010301001000019',
                'jumlah_keluar' => 15,
            ],

            // =========================================================
            // 20. Buku Agenda
            // =========================================================
            [
                'tanggal_keluar' => '2026-05-01',
                'keterangan' => 'Distribusi buku administrasi',
                'kode_barang' => '1010301001000020',
                'jumlah_keluar' => 15,
            ],
            [
                'tanggal_keluar' => '2026-08-30',
                'keterangan' => 'Distribusi buku administrasi',
                'kode_barang' => '1010301001000020',
                'jumlah_keluar' => 20,
            ],

            // =========================================================
            // 21. Buku Ekspedisi
            // =========================================================
            [
                'tanggal_keluar' => '2026-05-05',
                'keterangan' => 'Distribusi buku administrasi',
                'kode_barang' => '1010301001000021',
                'jumlah_keluar' => 12,
            ],
            [
                'tanggal_keluar' => '2026-09-01',
                'keterangan' => 'Pemakaian administrasi kantor',
                'kode_barang' => '1010301001000021',
                'jumlah_keluar' => 15,
            ],

            // =========================================================
            // 22. Buku Nota
            // =========================================================
            [
                'tanggal_keluar' => '2026-05-10',
                'keterangan' => 'Distribusi buku administrasi',
                'kode_barang' => '1010301001000022',
                'jumlah_keluar' => 15,
            ],
            [
                'tanggal_keluar' => '2026-09-02',
                'keterangan' => 'Pemakaian administrasi kantor',
                'kode_barang' => '1010301001000022',
                'jumlah_keluar' => 20,
            ],

            // =========================================================
            // 23. Tinta Printer Hitam
            // =========================================================
            [
                'tanggal_keluar' => '2026-04-15',
                'keterangan' => 'Penggantian tinta printer',
                'kode_barang' => '1010301001000023',
                'jumlah_keluar' => 3,
            ],
            [
                'tanggal_keluar' => '2026-07-15',
                'keterangan' => 'Penggantian tinta printer',
                'kode_barang' => '1010301001000023',
                'jumlah_keluar' => 4,
            ],
            [
                'tanggal_keluar' => '2026-09-08',
                'keterangan' => 'Penggantian tinta printer',
                'kode_barang' => '1010301001000023',
                'jumlah_keluar' => 3,
            ],

            // =========================================================
            // 24. Tinta Printer Warna
            // =========================================================
            [
                'tanggal_keluar' => '2026-05-01',
                'keterangan' => 'Penggantian tinta printer',
                'kode_barang' => '1010301001000024',
                'jumlah_keluar' => 3,
            ],
            [
                'tanggal_keluar' => '2026-08-01',
                'keterangan' => 'Penggantian tinta printer',
                'kode_barang' => '1010301001000024',
                'jumlah_keluar' => 4,
            ],

            // =========================================================
            // 25. Toner Printer
            // =========================================================
            [
                'tanggal_keluar' => '2026-05-15',
                'keterangan' => 'Penggantian toner printer',
                'kode_barang' => '1010301001000025',
                'jumlah_keluar' => 3,
            ],
            [
                'tanggal_keluar' => '2026-08-20',
                'keterangan' => 'Penggantian toner printer',
                'kode_barang' => '1010301001000025',
                'jumlah_keluar' => 4,
            ],

            // =========================================================
            // 26. Flashdisk 32GB
            // =========================================================
            [
                'tanggal_keluar' => '2026-05-20',
                'keterangan' => 'Distribusi perangkat penyimpanan data',
                'kode_barang' => '1010301001000026',
                'jumlah_keluar' => 4,
            ],
            [
                'tanggal_keluar' => '2026-08-25',
                'keterangan' => 'Distribusi perangkat pendukung komputer',
                'kode_barang' => '1010301001000026',
                'jumlah_keluar' => 5,
            ],

            // =========================================================
            // 27. Kabel USB
            // =========================================================
            [
                'tanggal_keluar' => '2026-05-25',
                'keterangan' => 'Distribusi perangkat pendukung komputer',
                'kode_barang' => '1010301001000027',
                'jumlah_keluar' => 4,
            ],
            [
                'tanggal_keluar' => '2026-08-28',
                'keterangan' => 'Penggantian kabel perangkat',
                'kode_barang' => '1010301001000027',
                'jumlah_keluar' => 5,
            ],

            // =========================================================
            // 28. Mouse
            // =========================================================
            [
                'tanggal_keluar' => '2026-06-01',
                'keterangan' => 'Distribusi perangkat komputer',
                'kode_barang' => '1010301001000028',
                'jumlah_keluar' => 4,
            ],
            [
                'tanggal_keluar' => '2026-09-01',
                'keterangan' => 'Penggantian perangkat komputer',
                'kode_barang' => '1010301001000028',
                'jumlah_keluar' => 5,
            ],

            // =========================================================
            // 29. Keyboard
            // =========================================================
            [
                'tanggal_keluar' => '2026-06-05',
                'keterangan' => 'Distribusi perangkat komputer',
                'kode_barang' => '1010301001000029',
                'jumlah_keluar' => 3,
            ],
            [
                'tanggal_keluar' => '2026-09-05',
                'keterangan' => 'Penggantian perangkat komputer',
                'kode_barang' => '1010301001000029',
                'jumlah_keluar' => 4,
            ],

            // =========================================================
            // 30. Label Sticker
            // =========================================================
            [
                'tanggal_keluar' => '2026-06-10',
                'keterangan' => 'Pemakaian perlengkapan pelabelan arsip',
                'kode_barang' => '1010301001000030',
                'jumlah_keluar' => 10,
            ],
            [
                'tanggal_keluar' => '2026-08-15',
                'keterangan' => 'Pemakaian perlengkapan pelabelan arsip',
                'kode_barang' => '1010301001000030',
                'jumlah_keluar' => 15,
            ],
            [
                'tanggal_keluar' => '2026-09-05',
                'keterangan' => 'Pemakaian perlengkapan pelabelan arsip',
                'kode_barang' => '1010301001000030',
                'jumlah_keluar' => 10,
            ],
        ];

        foreach ($transaksi as $data) {
            TransaksiKeluar::firstOrCreate($data);
        }
    }
}