@extends('layouts.app')

@section('content')

    <h1>Laporan Transaksi</h1>

    <hr>

    <h2>Filter Laporan</h2>

    <form action="{{ route('laporan.transaksi') }}" method="GET">

        <div>
            <label for="tanggal_mulai">Tanggal Mulai</label>
            <input
                type="date"
                id="tanggal_mulai"
                name="tanggal_mulai"
                value="{{ $tanggalMulai }}"
            >
        </div>

        <br>

        <div>
            <label for="tanggal_akhir">Tanggal Akhir</label>
            <input
                type="date"
                id="tanggal_akhir"
                name="tanggal_akhir"
                value="{{ $tanggalAkhir }}"
            >
        </div>

        <br>

        <div>
            <label for="kode_barang">Barang</label>
            <select id="kode_barang" name="kode_barang">
                <option value="">-- Semua Barang --</option>

                @foreach ($barang as $item)
                    <option
                        value="{{ $item->kode_barang }}"
                        {{ $kodeBarang == $item->kode_barang ? 'selected' : '' }}
                    >
                        {{ $item->nama_barang }}
                    </option>
                @endforeach
            </select>
        </div>

        <br>

        <div>
            <label for="jenis">Jenis Transaksi</label>
            <select id="jenis" name="jenis">
                <option value="">-- Semua Transaksi --</option>

                <option
                    value="Masuk"
                    {{ $jenis == 'Masuk' ? 'selected' : '' }}
                >
                    Masuk
                </option>

                <option
                    value="Keluar"
                    {{ $jenis == 'Keluar' ? 'selected' : '' }}
                >
                    Keluar
                </option>
            </select>
        </div>

        <br>

        <button type="submit">
            Tampilkan
        </button>

        <a href="{{ route('laporan.transaksi') }}">
            Reset
        </a>

    </form>

    <hr>

    <h2>Data Transaksi</h2>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Jenis</th>
                <th>Jumlah</th>
                <th>Saldo</th>
                <th>Harga Satuan</th>
                <th>Keterangan</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($transaksi as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>
                        {{ $item['tanggal']->format('d-m-Y') }}
                    </td>

                    <td>
                        {{ $item['kode_barang'] }}
                    </td>

                    <td>
                        {{ $item['nama_barang'] }}
                    </td>

                    <td>
                        {{ $item['jenis'] }}
                    </td>

                    <td>
                        {{ $item['jumlah'] }}
                    </td>

                    <td>
                        {{ $item['saldo'] }}
                    </td>

                    <td>
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
                    <td colspan="9">
                        Tidak ada transaksi yang ditemukan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <hr>

    <h2>Ringkasan</h2>

    <p>
        Total Barang Masuk:
        <strong>{{ $totalMasuk }}</strong>
    </p>

    <p>
        Total Barang Keluar:
        <strong>{{ $totalKeluar }}</strong>
    </p>

    <br>

    <a
        href="{{ route('laporan.transaksi.pdf', request()->query()) }}"
        target="_blank"
    >
        Cetak PDF
    </a>

@endsection