@extends('layouts.app')

@section('content')

    <h1>Tambah Transaksi Keluar</h1>

    <hr>

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

    <form action="{{ route('transaksi-keluar.store') }}" method="POST">
        @csrf

        <div>
            <label for="tanggal_keluar">Tanggal Keluar</label>
            <input
                type="date"
                id="tanggal_keluar"
                name="tanggal_keluar"
                value="{{ old('tanggal_keluar') }}"
                required
            >
        </div>

        <br>

        <div>
            <label for="kode_barang">Barang</label>

            <select
                id="kode_barang"
                name="kode_barang"
                required
            >
                <option value="">-- Pilih Barang --</option>

                @foreach ($barang as $item)
                    <option
                        value="{{ $item->kode_barang }}"
                        {{ old('kode_barang') == $item->kode_barang ? 'selected' : '' }}
                    >
                        {{ $item->nama_barang }}
                    </option>
                @endforeach
            </select>
        </div>

        <br>

        <div>
            <label for="jumlah_keluar">Jumlah Keluar</label>
            <input
                type="number"
                id="jumlah_keluar"
                name="jumlah_keluar"
                value="{{ old('jumlah_keluar') }}"
                min="1"
                required
            >
        </div>

        <br>

        <div>
            <label for="keterangan">Keterangan</label>
            <input
                type="text"
                id="keterangan"
                name="keterangan"
                value="{{ old('keterangan') }}"
                placeholder="Contoh: Pengeluaran alat tulis kantor"
                required
            >
        </div>

        <br>

        <button type="submit">
            Simpan Transaksi
        </button>
    </form>

    <br>

    <a href="{{ route('transaksi-keluar.index') }}">
        Kembali ke Riwayat Transaksi
    </a>

@endsection