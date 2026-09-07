<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <title>Laporan Transaksi</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 9px;
        }

        .header {
            text-align: center;
            margin-bottom: 15px;
        }

        .header h1 {
            margin: 0;
            font-size: 17px;
        }

        .header p {
            margin: 4px 0;
            font-size: 10px;
        }

        .filter {
            margin-bottom: 15px;
        }

        .filter table {
            width: 100%;
        }

        .filter td {
            padding: 2px;
        }

        .data {
            width: 100%;
            border-collapse: collapse;
        }

        .data th,
        .data td {
            border: 1px solid #000;
            padding: 5px;
        }

        .data th {
            text-align: center;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .ringkasan {
            margin-top: 15px;
            width: 300px;
            border-collapse: collapse;
        }

        .ringkasan td {
            border: 1px solid #000;
            padding: 5px;
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>LAPORAN TRANSAKSI</h1>

        <p>
            SIKARA - Sistem Inventaris Kantor Imigrasi Ngurah Rai
        </p>
    </div>

    <div class="filter">
        <strong>Filter Laporan</strong>

        <table>
            <tr>
                <td width="120">Tanggal Mulai</td>
                <td>
                    :
                    {{ $tanggalMulai ? date('d-m-Y', strtotime($tanggalMulai)) : 'Semua' }}
                </td>
            </tr>

            <tr>
                <td>Tanggal Akhir</td>
                <td>
                    :
                    {{ $tanggalAkhir ? date('d-m-Y', strtotime($tanggalAkhir)) : 'Semua' }}
                </td>
            </tr>

            <tr>
                <td>Jenis Transaksi</td>
                <td>
                    : {{ $jenis ?: 'Semua' }}
                </td>
            </tr>

            <tr>
                <td>Kode Barang</td>
                <td>
                    : {{ $kodeBarang ?: 'Semua' }}
                </td>
            </tr>
        </table>
    </div>

    <table class="data">
        <thead>
            <tr>
                <th width="30">No</th>
                <th width="65">Tanggal</th>
                <th width="100">Kode Barang</th>
                <th>Nama Barang</th>
                <th width="55">Jenis</th>
                <th width="55">Jumlah</th>
                <th width="55">Saldo</th>
                <th width="90">Harga Satuan</th>
                <th>Keterangan</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($transaksi as $item)
                <tr>
                    <td class="center">
                        {{ $loop->iteration }}
                    </td>

                    <td class="center">
                        {{ $item['tanggal']->format('d-m-Y') }}
                    </td>

                    <td>
                        {{ $item['kode_barang'] }}
                    </td>

                    <td>
                        {{ $item['nama_barang'] }}
                    </td>

                    <td class="center">
                        {{ $item['jenis'] }}
                    </td>

                    <td class="center">
                        {{ $item['jumlah'] }}
                    </td>

                    <td class="center">
                        {{ $item['saldo'] }}
                    </td>

                    <td class="right">
                        @if ($item['harga_satuan'] !== null)
                            Rp {{ number_format($item['harga_satuan'], 0, ',', '.') }}
                        @else
                            -
                        @endif
                    </td>

                    <td>
                        {{ $item['keterangan'] }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="center">
                        Tidak ada transaksi yang ditemukan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <table class="ringkasan">
        <tr>
            <td>
                <strong>Total Barang Masuk</strong>
            </td>

            <td class="center">
                {{ $totalMasuk }}
            </td>
        </tr>

        <tr>
            <td>
                <strong>Total Barang Keluar</strong>
            </td>

            <td class="center">
                {{ $totalKeluar }}
            </td>
        </tr>
    </table>

</body>
</html>