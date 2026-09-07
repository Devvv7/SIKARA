@extends('layouts.app')

@section('content')

    <h1>Riwayat Transaksi Masuk</h1>

    <hr>

    @if (session('success'))
        <p>{{ session('success') }}</p>
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

    <a href="{{ route('transaksi-masuk.create') }}">
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
                <th>Jumlah Masuk</th>
                <th>Harga Satuan</th>
                <th>Keterangan</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($transaksiMasuk as $transaksi)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>
                        {{ $transaksi->tanggal_masuk->format('d-m-Y') }}
                    </td>

                    <td>
                        {{ $transaksi->kode_barang }}
                    </td>

                    <td>
                        {{ $transaksi->barang->nama_barang }}
                    </td>

                    <td>
                        {{ $transaksi->jumlah_masuk }}
                    </td>

                    <td>
                        Rp {{ number_format($transaksi->harga_satuan, 0, ',', '.') }}
                    </td>

                    <td>
                        {{ $transaksi->keterangan }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">
                        Belum ada transaksi masuk.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

@endsection