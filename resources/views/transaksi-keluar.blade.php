@extends('layouts.app')

@section('content')

    <h1>Riwayat Transaksi Keluar</h1>

    <hr>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if (session('error'))
        <p>{{ session('error') }}</p>
    @endif

    @if ($errors->any())
        <div>
            <strong>Terjadi kesalahan:</strong>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <a href="{{ route('transaksi-keluar.create') }}">
        Tambah Transaksi
    </a>

    <br>
    <br>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Jumlah Keluar</th>
                <th>Keterangan</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($transaksiKeluar as $transaksi)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>
                        {{ $transaksi->tanggal_keluar->format('d-m-Y') }}
                    </td>

                    <td>
                        {{ $transaksi->kode_barang }}
                    </td>

                    <td>
                        {{ $transaksi->barang->nama_barang }}
                    </td>

                    <td>
                        {{ $transaksi->jumlah_keluar }}
                    </td>

                    <td>
                        {{ $transaksi->keterangan }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">
                        Belum ada transaksi keluar.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

@endsection