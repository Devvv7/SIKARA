<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <title>Kartu Stok</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 18px;
        }

        .header p {
            margin: 4px 0;
        }

        .informasi {
            margin-bottom: 20px;
        }

        .informasi table {
            width: 100%;
        }

        .informasi td {
            padding: 3px;
        }

        .data {
            width: 100%;
            border-collapse: collapse;
        }

        .data th,
        .data td {
            border: 1px solid #000;
            padding: 6px;
        }

        .data th {
            text-align: center;
            background-color: #f2f2f2;
        }

        .angka {
            text-align: center;
        }

        .total {
            font-weight: bold;
            background-color: #f2f2f2;
        }

        .total-label {
            text-align: right;
        }
    </style>
</head>

<body>

    {{-- Header --}}
    <div class="header">

        <h1>
            KARTU STOK
        </h1>

        <p>
            SIKARA - Sistem Inventaris Kantor Imigrasi Ngurah Rai
        </p>

    </div>


    {{-- Informasi Barang --}}
    <div class="informasi">

        <table>

            <tr>
                <td width="120">
                    <strong>Kode Barang</strong>
                </td>

                <td>
                    : {{ $barang->kode_barang }}
                </td>
            </tr>


            <tr>
                <td>
                    <strong>Nama Barang</strong>
                </td>

                <td>
                    : {{ $barang->nama_barang }}
                </td>
            </tr>


            <tr>
                <td>
                    <strong>Satuan</strong>
                </td>

                <td>
                    : {{ $barang->satuan }}
                </td>
            </tr>


            <tr>
                <td>
                    <strong>Stok Saat Ini</strong>
                </td>

                <td>
                    : {{ $barang->stok }}
                </td>
            </tr>

        </table>

    </div>


    {{-- Tabel Kartu Stok --}}
    <table class="data">

        <thead>

            <tr>

                <th width="40">
                    No
                </th>

                <th width="80">
                    Tanggal
                </th>

                <th>
                    Keterangan
                </th>

                <th width="60">
                    Masuk
                </th>

                <th width="60">
                    Keluar
                </th>

                <th width="60">
                    Saldo
                </th>

            </tr>

        </thead>


        <tbody>

            @forelse ($kartuStok as $item)

                <tr>

                    {{-- No --}}
                    <td class="angka">
                        {{ $loop->iteration }}
                    </td>


                    {{-- Tanggal --}}
                    <td class="angka">
                        {{ $item['tanggal']->format('d-m-Y') }}
                    </td>


                    {{-- Keterangan --}}
                    <td>
                        {{ $item['keterangan'] }}
                    </td>


                    {{-- Masuk --}}
                    <td class="angka">

                        @if ($item['masuk'] > 0)

                            {{ $item['masuk'] }}

                        @else

                            -

                        @endif

                    </td>


                    {{-- Keluar --}}
                    <td class="angka">

                        @if ($item['keluar'] > 0)

                            {{ $item['keluar'] }}

                        @else

                            -

                        @endif

                    </td>


                    {{-- Saldo --}}
                    <td class="angka">
                        {{ $item['saldo'] }}
                    </td>

                </tr>

            @empty

                <tr>

                    <td
                        colspan="6"
                        class="angka"
                    >
                        Belum ada transaksi untuk barang ini.
                    </td>

                </tr>

            @endforelse


            {{-- Total --}}
            @if ($kartuStok->count() > 0)

                <tr class="total">

                    <td
                        colspan="3"
                        class="total-label"
                    >
                        Total
                    </td>


                    {{-- Total Masuk --}}
                    <td class="angka">
                        {{ $totalMasuk }}
                    </td>


                    {{-- Total Keluar --}}
                    <td class="angka">
                        {{ $totalKeluar }}
                    </td>


                    {{-- Saldo Akhir --}}
                    <td class="angka">
                        {{ $totalSaldo }}
                    </td>

                </tr>

            @endif

        </tbody>

    </table>

</body>
</html>