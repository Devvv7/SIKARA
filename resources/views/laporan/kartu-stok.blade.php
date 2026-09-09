@extends('layouts.app')

@section('title', 'Laporan')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div>
        <h1 class="text-2xl font-bold tracking-tight text-slate-900">
            Kartu Stok
        </h1>

        <p class="mt-1 text-sm text-slate-500">
            Lihat riwayat pergerakan stok dan saldo barang berdasarkan barang yang dipilih.
        </p>
    </div>


    {{-- Pilih Barang --}}
    <div class="rounded-xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-200 px-6 py-4">

            <h2 class="text-sm font-semibold text-slate-900">
                Pilih Barang
            </h2>

            <p class="mt-1 text-xs text-slate-500">
                Pilih barang untuk melihat kartu stok dan riwayat pergerakannya.
            </p>

        </div>


        <form
            action="{{ route('laporan.kartu-stok') }}"
            method="GET"
        >

            <div class="p-6">

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
                        required
                        class="mt-2 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-900 outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
                    >

                        <option value="">
                            -- Pilih Barang --
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

            </div>


            {{-- Actions --}}
            <div class="flex flex-col gap-3 border-t border-slate-200 bg-slate-50 px-6 py-4 sm:flex-row sm:justify-end">

                <a
                    href="{{ route('laporan.kartu-stok') }}"
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


    @if ($barangTerpilih)

        {{-- Informasi Barang --}}
        <div class="rounded-xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-6 py-4">

                <h2 class="text-sm font-semibold text-slate-900">
                    Informasi Barang
                </h2>

                <p class="mt-1 text-xs text-slate-500">
                    Informasi barang yang sedang ditampilkan pada kartu stok.
                </p>

            </div>


            <div class="grid gap-5 p-6 sm:grid-cols-2 lg:grid-cols-4">

                {{-- Kode Barang --}}
                <div>

                    <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                        Kode Barang
                    </p>

                    <p class="mt-1 font-mono text-sm font-semibold text-slate-800">
                        {{ $barangTerpilih->kode_barang }}
                    </p>

                </div>


                {{-- Nama Barang --}}
                <div>

                    <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                        Nama Barang
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">
                        {{ $barangTerpilih->nama_barang }}
                    </p>

                </div>


                {{-- Satuan --}}
                <div>

                    <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                        Satuan
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">
                        {{ $barangTerpilih->satuan }}
                    </p>

                </div>


                {{-- Stok Saat Ini --}}
                <div>

                    <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                        Stok Saat Ini
                    </p>

                    <p class="mt-1 text-lg font-bold text-slate-900">
                        {{ $barangTerpilih->stok }}
                    </p>

                </div>

            </div>

        </div>


        {{-- Riwayat Pergerakan Stok --}}
        <div class="rounded-xl border border-slate-200 bg-white shadow-sm">

            {{-- Header --}}
            <div class="flex flex-col gap-3 border-b border-slate-200 px-6 py-4 sm:flex-row sm:items-center sm:justify-between">

                <div>

                    <h2 class="text-sm font-semibold text-slate-900">
                        Riwayat Pergerakan Stok
                    </h2>

                    <p class="mt-1 text-xs text-slate-500">
                        Riwayat barang masuk dan keluar beserta saldo stok.
                    </p>

                </div>


                {{-- Cetak PDF --}}
                <a
                    href="{{ route('laporan.kartu-stok.pdf', ['kode_barang' => $kodeBarang]) }}"
                    target="_blank"
                    class="inline-flex items-center justify-center rounded-lg bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-700"
                >
                    Cetak PDF
                </a>

            </div>


            {{-- Pagination Header --}}
            <div class="flex flex-col gap-3 border-b border-slate-200 px-6 py-4 sm:flex-row sm:items-center sm:justify-between">

                <div class="text-sm text-slate-500">

                    @if ($kartuStok->total() > 0)

                        Menampilkan

                        <span class="font-medium text-slate-700">
                            {{ $kartuStok->firstItem() }}
                        </span>

                        -

                        <span class="font-medium text-slate-700">
                            {{ $kartuStok->lastItem() }}
                        </span>

                        dari

                        <span class="font-medium text-slate-700">
                            {{ $kartuStok->total() }}
                        </span>

                        transaksi

                    @else

                        Tidak ada transaksi

                    @endif

                </div>


                {{-- Jumlah Data --}}
                <form
                    method="GET"
                    action="{{ route('laporan.kartu-stok') }}"
                    class="flex items-center gap-2"
                >

                    {{-- Pertahankan barang yang dipilih --}}
                    @if ($kodeBarang)

                        <input
                            type="hidden"
                            name="kode_barang"
                            value="{{ $kodeBarang }}"
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
                                Keterangan
                            </th>

                            <th class="whitespace-nowrap px-4 py-3 text-center font-semibold text-slate-600">
                                Masuk
                            </th>

                            <th class="whitespace-nowrap px-4 py-3 text-center font-semibold text-slate-600">
                                Keluar
                            </th>

                            <th class="whitespace-nowrap px-4 py-3 text-center font-semibold text-slate-600">
                                Saldo
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100">

                        @forelse ($kartuStok as $item)

                            <tr class="transition hover:bg-slate-50">

                                {{-- No --}}
                                <td class="whitespace-nowrap px-4 py-3 text-center text-slate-600">
                                    {{ $kartuStok->firstItem() + $loop->index }}
                                </td>


                                {{-- Tanggal --}}
                                <td class="whitespace-nowrap px-4 py-3 text-slate-700">
                                    {{ $item['tanggal']->format('d-m-Y') }}
                                </td>


                                {{-- Keterangan --}}
                                <td class="min-w-52 px-4 py-3 text-slate-600">
                                    {{ $item['keterangan'] }}
                                </td>


                                {{-- Masuk --}}
                                <td class="whitespace-nowrap px-4 py-3 text-center font-semibold">

                                    @if ($item['masuk'] > 0)

                                        <span class="text-emerald-600">
                                            +{{ $item['masuk'] }}
                                        </span>

                                    @else

                                        <span class="text-slate-400">
                                            -
                                        </span>

                                    @endif

                                </td>


                                {{-- Keluar --}}
                                <td class="whitespace-nowrap px-4 py-3 text-center font-semibold">

                                    @if ($item['keluar'] > 0)

                                        <span class="text-red-600">
                                            -{{ $item['keluar'] }}
                                        </span>

                                    @else

                                        <span class="text-slate-400">
                                            -
                                        </span>

                                    @endif

                                </td>


                                {{-- Saldo --}}
                                <td class="whitespace-nowrap px-4 py-3 text-center font-semibold text-slate-800">
                                    {{ $item['saldo'] }}
                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="6"
                                    class="px-6 py-12 text-center"
                                >

                                    <div class="flex flex-col items-center">

                                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-slate-100">

                                            <span class="text-lg text-slate-400">
                                                —
                                            </span>

                                        </div>

                                        <p class="mt-3 text-sm font-medium text-slate-700">
                                            Belum ada transaksi
                                        </p>

                                        <p class="mt-1 text-xs text-slate-500">
                                            Belum terdapat riwayat pergerakan stok untuk barang ini.
                                        </p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse


                        {{-- Total --}}
                        @if ($kartuStok->total() > 0)

                            <tr class="border-t-2 border-slate-300 bg-slate-50">

                                {{-- Label Total --}}
                                <td
                                    colspan="3"
                                    class="px-4 py-4 text-right text-sm font-bold text-slate-800"
                                >
                                    Total
                                </td>


                                {{-- Total Masuk --}}
                                <td class="whitespace-nowrap px-4 py-4 text-center text-sm font-bold text-emerald-700">
                                    +{{ $totalMasuk }}
                                </td>


                                {{-- Total Keluar --}}
                                <td class="whitespace-nowrap px-4 py-4 text-center text-sm font-bold text-red-600">
                                    -{{ $totalKeluar }}
                                </td>


                                {{-- Total Saldo --}}
                                <td class="whitespace-nowrap px-4 py-4 text-center text-sm font-bold text-slate-900">
                                    {{ $totalSaldo }}
                                </td>

                            </tr>

                        @endif

                    </tbody>

                </table>

            </div>


            {{-- Pagination --}}
            @if ($kartuStok->hasPages())

                <div class="border-t border-slate-200 px-6 py-4">

                    {{ $kartuStok->links() }}

                </div>

            @endif

        </div>

    @endif

</div>

@endsection