@extends('layouts.app')

@section('title', 'Laporan')

@section('content')

    <div class="space-y-6">

        {{-- Header --}}
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900">
                Laporan Transaksi
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Lihat riwayat transaksi barang berdasarkan periode, barang, dan jenis transaksi.
            </p>
        </div>

        {{-- Filter --}}
        <div class="rounded-xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-6 py-4">
                <h2 class="text-sm font-semibold text-slate-900">
                    Filter Laporan
                </h2>

                <p class="mt-1 text-xs text-slate-500">
                    Gunakan filter untuk menampilkan transaksi sesuai kebutuhan.
                </p>
            </div>

            <form
                action="{{ route('laporan.transaksi') }}"
                method="GET"
            >

                <div class="space-y-5 p-6">

                    {{-- Search --}}
                    <div>
                        <label
                            for="search"
                            class="block text-sm font-semibold text-slate-800"
                        >
                            Cari Barang
                        </label>

                        <div class="relative mt-2">
                            <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                                🔍
                            </span>

                            <input
                                type="text"
                                id="search"
                                name="search"
                                value="{{ $search }}"
                                placeholder="Cari berdasarkan kode atau nama barang..."
                                class="block w-full rounded-lg border border-slate-300 bg-white py-2.5 pl-10 pr-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
                            >
                        </div>

                        <p class="mt-1.5 text-xs text-slate-500">
                            Pencarian dapat dilakukan berdasarkan kode atau nama barang.
                        </p>
                    </div>

                    {{-- Filter Utama --}}
                    <div class="grid gap-5 md:grid-cols-2 lg:grid-cols-4">

                        {{-- Tanggal Mulai --}}
                        <div>
                            <label
                                for="tanggal_mulai"
                                class="block text-sm font-semibold text-slate-800"
                            >
                                Tanggal Mulai
                            </label>

                            <input
                                type="date"
                                id="tanggal_mulai"
                                name="tanggal_mulai"
                                value="{{ $tanggalMulai }}"
                                class="mt-2 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-900 outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
                            >
                        </div>

                        {{-- Tanggal Akhir --}}
                        <div>
                            <label
                                for="tanggal_akhir"
                                class="block text-sm font-semibold text-slate-800"
                            >
                                Tanggal Akhir
                            </label>

                            <input
                                type="date"
                                id="tanggal_akhir"
                                name="tanggal_akhir"
                                value="{{ $tanggalAkhir }}"
                                class="mt-2 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-900 outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
                            >
                        </div>

                        {{-- Barang --}}
                        <div>
                            <label
                                for="kode_barang"
                                class="block text-sm font-semibold text-slate-800"
                            >
                                Barang
                            </label>

                            <select
                                id="kode_barang"
                                name="kode_barang"
                                class="mt-2 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-900 outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
                            >
                                <option value="">
                                    -- Semua Barang --
                                </option>

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

                        {{-- Jenis Transaksi --}}
                        <div>
                            <label
                                for="jenis"
                                class="block text-sm font-semibold text-slate-800"
                            >
                                Jenis Transaksi
                            </label>

                            <select
                                id="jenis"
                                name="jenis"
                                class="mt-2 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-900 outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
                            >
                                <option value="">
                                    -- Semua Transaksi --
                                </option>

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

                    </div>

                </div>

                {{-- Filter Actions --}}
                <div class="flex flex-col gap-3 border-t border-slate-200 bg-slate-50 px-6 py-4 sm:flex-row sm:justify-end">

                    <a
                        href="{{ route('laporan.transaksi') }}"
                        class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-100"
                    >
                        Reset
                    </a>

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center rounded-lg bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-700"
                    >
                        Tampilkan
                    </button>

                </div>

            </form>

        </div>

        {{-- Data Transaksi --}}
        <div class="rounded-xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-6 py-4">
                <h2 class="text-sm font-semibold text-slate-900">
                    Data Transaksi
                </h2>

                <p class="mt-1 text-xs text-slate-500">
                    Riwayat transaksi berdasarkan filter yang dipilih.
                </p>
            </div>

            {{-- Pagination Header --}}
            <div class="flex flex-col gap-3 border-b border-slate-200 px-6 py-4 sm:flex-row sm:items-center sm:justify-between">

                <div class="text-sm text-slate-500">

                    @if ($transaksi->total() > 0)

                        Menampilkan

                        <span class="font-medium text-slate-700">
                            {{ $transaksi->firstItem() }}
                        </span>

                        -

                        <span class="font-medium text-slate-700">
                            {{ $transaksi->lastItem() }}
                        </span>

                        dari

                        <span class="font-medium text-slate-700">
                            {{ $transaksi->total() }}
                        </span>

                        transaksi

                        @if ($search !== '')
                            <span class="text-slate-400">
                                untuk pencarian
                                "<span class="font-medium text-slate-600">{{ $search }}</span>"
                            </span>
                        @endif

                    @else

                        @if ($search !== '')
                            Tidak ditemukan transaksi untuk pencarian
                            "<span class="font-medium text-slate-700">{{ $search }}</span>"
                        @else
                            Tidak ada transaksi
                        @endif

                    @endif

                </div>

                {{-- Jumlah Data --}}
                <form
                    method="GET"
                    action="{{ route('laporan.transaksi') }}"
                    class="flex items-center gap-2"
                >

                    {{-- Pertahankan search ketika mengubah jumlah data --}}
                    @if ($search)
                        <input
                            type="hidden"
                            name="search"
                            value="{{ $search }}"
                        >
                    @endif

                    {{-- Pertahankan filter ketika mengubah jumlah data --}}
                    @if ($tanggalMulai)
                        <input
                            type="hidden"
                            name="tanggal_mulai"
                            value="{{ $tanggalMulai }}"
                        >
                    @endif

                    @if ($tanggalAkhir)
                        <input
                            type="hidden"
                            name="tanggal_akhir"
                            value="{{ $tanggalAkhir }}"
                        >
                    @endif

                    @if ($kodeBarang)
                        <input
                            type="hidden"
                            name="kode_barang"
                            value="{{ $kodeBarang }}"
                        >
                    @endif

                    @if ($jenis)
                        <input
                            type="hidden"
                            name="jenis"
                            value="{{ $jenis }}"
                        >
                    @endif

                    <label
                        for="per_page"
                        class="text-sm text-slate-600"
                    >
                        Tampilkan
                    </label>

                    <select
                        id="per_page"
                        name="per_page"
                        onchange="this.form.submit()"
                        class="rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-700 shadow-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
                    >

                        <option
                            value="10"
                            @selected($perPage == 10)
                        >
                            10
                        </option>

                        <option
                            value="25"
                            @selected($perPage == 25)
                        >
                            25
                        </option>

                        <option
                            value="50"
                            @selected($perPage == 50)
                        >
                            50
                        </option>

                        <option
                            value="100"
                            @selected($perPage == 100)
                        >
                            100
                        </option>

                    </select>

                    <span class="text-sm text-slate-600">
                        data
                    </span>

                </form>

            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">

                <table class="min-w-full text-sm">

                    <thead class="bg-slate-50">

                        <tr class="border-b border-slate-200">

                            <th class="whitespace-nowrap px-4 py-3 text-center font-semibold text-slate-600">
                                No
                            </th>

                            <th class="whitespace-nowrap px-4 py-3 text-left font-semibold text-slate-600">
                                Tanggal
                            </th>

                            <th class="whitespace-nowrap px-4 py-3 text-left font-semibold text-slate-600">
                                Kode Barang
                            </th>

                            <th class="whitespace-nowrap px-4 py-3 text-left font-semibold text-slate-600">
                                Nama Barang
                            </th>

                            <th class="whitespace-nowrap px-4 py-3 text-center font-semibold text-slate-600">
                                Jenis
                            </th>

                            <th class="whitespace-nowrap px-4 py-3 text-center font-semibold text-slate-600">
                                Jumlah
                            </th>

                            <th class="whitespace-nowrap px-4 py-3 text-center font-semibold text-slate-600">
                                Saldo
                            </th>

                            <th class="whitespace-nowrap px-4 py-3 text-right font-semibold text-slate-600">
                                Harga Satuan
                            </th>

                            <th class="whitespace-nowrap px-4 py-3 text-left font-semibold text-slate-600">
                                Keterangan
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        @forelse ($transaksi as $item)

                            <tr class="transition hover:bg-slate-50">

                                {{-- Nomor mengikuti halaman --}}
                                <td class="whitespace-nowrap px-4 py-3 text-center text-slate-600">
                                    {{ $transaksi->firstItem() + $loop->index }}
                                </td>

                                <td class="whitespace-nowrap px-4 py-3 text-slate-700">
                                    {{ $item['tanggal']->format('d-m-Y') }}
                                </td>

                                <td class="whitespace-nowrap px-4 py-3 font-mono text-xs text-slate-600">
                                    {{ $item['kode_barang'] }}
                                </td>

                                <td class="whitespace-nowrap px-4 py-3 font-medium text-slate-800">
                                    {{ $item['nama_barang'] }}
                                </td>

                                <td class="whitespace-nowrap px-4 py-3 text-center">

                                    @if ($item['jenis'] === 'Masuk')

                                        <span class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">
                                            Masuk
                                        </span>

                                    @else

                                        <span class="inline-flex items-center rounded-full bg-red-50 px-2.5 py-1 text-xs font-semibold text-red-700">
                                            Keluar
                                        </span>

                                    @endif

                                </td>

                                <td class="whitespace-nowrap px-4 py-3 text-center font-semibold">

                                    @if ($item['jenis'] === 'Masuk')

                                        <span class="text-emerald-600">
                                            +{{ $item['jumlah'] }}
                                        </span>

                                    @else

                                        <span class="text-red-600">
                                            -{{ $item['jumlah'] }}
                                        </span>

                                    @endif

                                </td>

                                <td class="whitespace-nowrap px-4 py-3 text-center font-medium text-slate-700">
                                    {{ $item['saldo'] }}
                                </td>

                                <td class="whitespace-nowrap px-4 py-3 text-right text-slate-700">

                                    @if ($item['harga_satuan'] !== null)

                                        Rp {{ number_format($item['harga_satuan'], 0, ',', '.') }}

                                    @else

                                        <span class="text-slate-400">
                                            -
                                        </span>

                                    @endif

                                </td>

                                <td class="min-w-52 px-4 py-3 text-slate-600">
                                    {{ $item['keterangan'] }}
                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="9"
                                    class="px-6 py-12 text-center"
                                >

                                    <div class="flex flex-col items-center">

                                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-slate-100">

                                            <span class="text-lg text-slate-400">
                                                —
                                            </span>

                                        </div>

                                        <p class="mt-3 text-sm font-medium text-slate-700">
                                            Tidak ada transaksi yang ditemukan.
                                        </p>

                                        <p class="mt-1 text-xs text-slate-500">
                                            Coba ubah filter laporan yang digunakan.
                                        </p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            {{-- Pagination --}}
            @if ($transaksi->hasPages())

                <div class="border-t border-slate-200 px-6 py-4">
                    {{ $transaksi->links() }}
                </div>

            @endif

        </div>

        {{-- Ringkasan --}}
        <div>

            <h2 class="mb-3 text-sm font-semibold text-slate-900">
                Ringkasan
            </h2>

            <div class="grid gap-4 sm:grid-cols-2">

                {{-- Total Masuk --}}
                <div class="rounded-xl border border-emerald-200 bg-emerald-50 p-5">

                    <p class="text-sm font-medium text-emerald-700">
                        Total Barang Masuk
                    </p>

                    <p class="mt-2 text-2xl font-bold text-emerald-800">
                        {{ $totalMasuk }}
                    </p>

                    <p class="mt-1 text-xs text-emerald-600">
                        Jumlah seluruh barang masuk berdasarkan filter.
                    </p>

                </div>

                {{-- Total Keluar --}}
                <div class="rounded-xl border border-red-200 bg-red-50 p-5">

                    <p class="text-sm font-medium text-red-700">
                        Total Barang Keluar
                    </p>

                    <p class="mt-2 text-2xl font-bold text-red-800">
                        {{ $totalKeluar }}
                    </p>

                    <p class="mt-1 text-xs text-red-600">
                        Jumlah seluruh barang keluar berdasarkan filter.
                    </p>

                </div>

            </div>

        </div>

        {{-- PDF --}}
        <div class="flex justify-end">

            <a
                href="{{ route('laporan.transaksi.pdf', request()->query()) }}"
                target="_blank"
                class="inline-flex items-center justify-center rounded-lg bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-700"
            >
                Cetak PDF
            </a>

        </div>

    </div>

@endsection