@extends('layouts.app')

@section('content')

    <h1>Detail Barang</h1>

    <hr>

    <h2>Informasi Barang</h2>

    <p>
        <strong>Kode Barang:</strong>
        {{ $barang->kode_barang }}
    </p>

    <p>
        <strong>Nama Barang:</strong>
        {{ $barang->nama_barang }}
    </p>

    <p>
        <strong>Satuan:</strong>
        {{ $barang->satuan }}
    </p>

    <p>
        <strong>Total Stok:</strong>
        {{ $barang->stok }}
    </p>

    <hr>

    <h2>Detail Stok Barang</h2>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Masuk</th>
                <th>Harga Satuan</th>
                <th>Sisa Stok</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($detailBarang as $detail)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>
                        {{ $detail->tanggal_masuk->format('d-m-Y') }}
                    </td>

                    <td>
                        Rp {{ number_format($detail->harga, 0, ',', '.') }}
                    </td>

                    <td>
                        {{ $detail->stok }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">
                        Belum ada detail stok barang.
                    </td>
                </tr>
            @endforelse
        </tbody>

        @if ($detailBarang->count() > 0)
            <tfoot>
                <tr>
                    <th colspan="3">Total Sisa Stok</th>
                    <th>{{ $detailBarang->sum('stok') }}</th>
                </tr>
            </tfoot>
        @endif
    </table>

    <br>

    <a href="{{ route('barang.index') }}">
        Kembali ke Data Barang
    </a>

@endsection