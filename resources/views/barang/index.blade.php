@extends('layouts.app')

@section('content')

    <h1>Data Barang</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if (session('error'))
        <p>{{ session('error') }}</p>
    @endif

    <a href="{{ route('barang.create') }}">
        Tambah Barang
    </a>

    <br>
    <br>

    <table border="1" cellpadding="8" cellspacing="0">

        <thead>
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Satuan</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>

            @forelse ($barang as $item)

                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->kode_barang }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ $item->satuan }}</td>
                    <td>{{ $item->stok }}</td>

                    <td>
                        <a href="{{ route('barang.show', $item->kode_barang) }}">
                            Detail
                        </a>
                        |
                        <a href="{{ route('barang.edit', $item->kode_barang) }}">
                            Edit
                        </a>
                        |
                        <form
                            action="{{ route('barang.destroy', $item->kode_barang) }}"
                            method="POST"
                            style="display: inline;"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?');"
                        >
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>

            @empty

                <tr>
                    <td colspan="6">
                        Belum ada data barang.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

@endsection