@extends('layouts.app')

@section('content')

    <h1>Tambah Transaksi Masuk</h1>

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

    <form action="{{ route('transaksi-masuk.store') }}" method="POST">
        @csrf

        <div>
            <label for="tanggal_masuk">Tanggal Masuk</label>

            <input
                type="date"
                id="tanggal_masuk"
                name="tanggal_masuk"
                value="{{ old('tanggal_masuk') }}"
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
            <label for="jumlah_masuk">Jumlah Masuk</label>

            <input
                type="number"
                id="jumlah_masuk"
                name="jumlah_masuk"
                value="{{ old('jumlah_masuk') }}"
                min="1"
                required
            >
        </div>

        <br>

        <div>
            <label for="harga_satuan">Harga Satuan</label>

            <input
                type="number"
                id="harga_satuan"
                name="harga_satuan"
                value="{{ old('harga_satuan') }}"
                min="0"
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
                placeholder="Contoh: Pengadaan alat tulis kantor"
                required
            >
        </div>

        <br>

        <button type="submit">
            Simpan Transaksi
        </button>
    </form>

    <br>

    <a href="{{ route('transaksi-masuk.index') }}">
        Kembali ke Riwayat Transaksi
    </a>

@endsection