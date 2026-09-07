@extends('layouts.app')

@section('content')

    <h1>Kartu Stok</h1>

    <hr>

    <h2>Pilih Barang</h2>

    <form action="{{ route('laporan.kartu-stok') }}" method="GET">

        <div>
            <label for="kode_barang">Barang</label>

            <select id="kode_barang" name="kode_barang" required>
                <option value="">-- Pilih Barang --</option>

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

        <button type="submit">
            Tampilkan
        </button>

        <a href="{{ route('laporan.kartu-stok') }}">
            Reset
        </a>

    </form>

    @if ($barangTerpilih)

        <hr>

        <h2>Informasi Barang</h2>

        <p>
            <strong>Kode Barang:</strong>
            {{ $barangTerpilih->kode_barang }}
        </p>

        <p>
            <strong>Nama Barang:</strong>
            {{ $barangTerpilih->nama_barang }}
        </p>

        <p>
            <strong>Satuan:</strong>
            {{ $barangTerpilih->satuan }}
        </p>

        <p>
            <strong>Stok Saat Ini:</strong>
            {{ $barangTerpilih->stok }}
        </p>

        <hr>

        <h2>Riwayat Pergerakan Stok</h2>

        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Masuk</th>
                    <th>Keluar</th>
                    <th>Saldo</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($kartuStok as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            {{ $item['tanggal']->format('d-m-Y') }}
                        </td>

                        <td>
                            {{ $item['keterangan'] }}
                        </td>

                        <td>
                            @if ($item['masuk'] > 0)
                                {{ $item['masuk'] }}
                            @else
                                -
                            @endif
                        </td>

                        <td>
                            @if ($item['keluar'] > 0)
                                {{ $item['keluar'] }}
                            @else
                                -
                            @endif
                        </td>

                        <td>
                            {{ $item['saldo'] }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            Belum ada transaksi untuk barang ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <br>

        <a
            href="{{ route('laporan.kartu-stok.pdf', ['kode_barang' => $kodeBarang]) }}"
            target="_blank"
        >
            Cetak PDF
        </a>

    @endif

@endsection