@extends('layouts.app')

@section('content')

    <h1>Tambah Barang</h1>

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

    <form action="{{ route('barang.store') }}" method="POST">

        @csrf

        <div>
            <label for="kode_barang">Kode Barang</label>

            <input
                type="text"
                id="kode_barang"
                name="kode_barang"
                value="{{ old('kode_barang') }}"
                required
            >
        </div>

        <br>

        <div>
            <label for="nama_barang">Nama Barang</label>

            <input
                type="text"
                id="nama_barang"
                name="nama_barang"
                value="{{ old('nama_barang') }}"
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
                value="{{ old('satuan') }}"
                placeholder="Contoh: pcs, box, rim"
                required
            >
        </div>

        <br>

        <button type="submit">
            Simpan Barang
        </button>

    </form>

    <br>

    <a href="{{ route('barang.index') }}">
        Kembali ke Data Barang
    </a>

@endsection