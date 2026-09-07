@extends('layouts.app')

@section('content')

    <h1>Dashboard SIKARA</h1>

    <hr>

    <h2>Ringkasan</h2>

    <p>
        Total Jenis Barang:
        <strong>{{ $totalBarang }}</strong>
    </p>

    <p>
        Total Stok:
        <strong>{{ $totalStok }}</strong>
    </p>

    <p>
        Total Transaksi Masuk:
        <strong>{{ $totalTransaksiMasuk }}</strong>
    </p>

    <p>
        Total Transaksi Keluar:
        <strong>{{ $totalTransaksiKeluar }}</strong>
    </p>

    <hr>

    <h2>Transaksi Masuk Terbaru</h2>

    <table border="1" cellpadding="8" cellspacing="0">

        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Barang</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
            </tr>
        </thead>

        <tbody>

            @forelse ($transaksiMasukTerbaru as $transaksi)

                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $transaksi->tanggal_masuk->format('d-m-Y') }}</td>
                    <td>{{ $transaksi->barang->nama_barang }}</td>
                    <td>{{ $transaksi->jumlah_masuk }}</td>
                    <td>{{ $transaksi->keterangan }}</td>
                </tr>

            @empty

                <tr>
                    <td colspan="5">
                        Belum ada transaksi masuk.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

    <hr>

    <h2>Transaksi Keluar Terbaru</h2>

    <table border="1" cellpadding="8" cellspacing="0">

        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Barang</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
            </tr>
        </thead>

        <tbody>

            @forelse ($transaksiKeluarTerbaru as $transaksi)

                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $transaksi->tanggal_keluar->format('d-m-Y') }}</td>
                    <td>{{ $transaksi->barang->nama_barang }}</td>
                    <td>{{ $transaksi->jumlah_keluar }}</td>
                    <td>{{ $transaksi->keterangan }}</td>
                </tr>

            @empty

                <tr>
                    <td colspan="5">
                        Belum ada transaksi keluar.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

@endsection