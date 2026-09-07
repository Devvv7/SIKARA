@extends('layouts.app')

@section('content')

    <h1>Edit Barang</h1>

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

    <form
        action="{{ route('barang.update', $barang->kode_barang) }}"
        method="POST"
    >

        @csrf
        @method('PUT')

        <div>
            <label for="kode_barang">Kode Barang</label>

            <input
                type="text"
                id="kode_barang"
                value="{{ $barang->kode_barang }}"
                readonly
            >
        </div>

        <br>

        <div>
            <label for="nama_barang">Nama Barang</label>

            <input
                type="text"
                id="nama_barang"
                name="nama_barang"
                value="{{ old('nama_barang', $barang->nama_barang) }}"
                required
            >
        </div>

        <br>

        <div>
            <label for="satuan">Satuan</label>

            <input
                type="text"
                id="satuan"
                name="satuan"
                value="{{ old('satuan', $barang->satuan) }}"
                required
            >
        </div>

        <br>

        <div>
            <label for="stok">Stok Saat Ini</label>

            <input
                type="number"
                id="stok"
                value="{{ $barang->stok }}"
                readonly
            >
        </div>

        <br>

        <button type="submit">
            Simpan Perubahan
        </button>

    </form>

    <br>

    <a href="{{ route('barang.index') }}">
        Kembali ke Data Barang
    </a>

@endsection