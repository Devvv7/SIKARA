@extends('layouts.app')

@section('title', 'Transaksi Masuk')

@section('content')
    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-slate-900">
                    Riwayat Transaksi Masuk
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Catatan seluruh transaksi barang yang masuk ke inventaris.
                </p>
            </div>

            <a
                href="{{ route('transaksi-masuk.create') }}"
                class="inline-flex items-center justify-center rounded-lg bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-700"
            >
                + Tambah Transaksi
            </a>
        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        {{-- Error Message --}}
        @if ($errors->any())
            <div class="rounded-lg border border-red-200 bg-red-50 p-4">
                <h2 class="text-sm font-semibold text-red-800">
                    Terjadi kesalahan
                </h2>

                <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-red-700">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Table Card --}}
        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

            {{-- Table Header / Pagination Control --}}
            <div class="flex flex-col gap-3 border-b border-slate-200 px-6 py-4 sm:flex-row sm:items-center sm:justify-between">

                <div class="text-sm text-slate-500">
                    @if ($transaksiMasuk->total() > 0)
                        Menampilkan
                        <span class="font-medium text-slate-700">
                            {{ $transaksiMasuk->firstItem() }}
                        </span>
                        -
                        <span class="font-medium text-slate-700">
                            {{ $transaksiMasuk->lastItem() }}
                        </span>
                        dari
                        <span class="font-medium text-slate-700">
                            {{ $transaksiMasuk->total() }}
                        </span>
                        transaksi
                    @else
                        Tidak ada transaksi
                    @endif
                </div>

                {{-- Per Page --}}
                <form
                    method="GET"
                    action="{{ route('transaksi-masuk.index') }}"
                    class="flex items-center gap-2"
                >
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
                        <option value="10" @selected($perPage == 10)>
                            10
                        </option>

                        <option value="25" @selected($perPage == 25)>
                            25
                        </option>

                        <option value="50" @selected($perPage == 50)>
                            50
                        </option>

                        <option value="100" @selected($perPage == 100)>
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
                <table class="min-w-full divide-y divide-slate-200">

                    <thead class="bg-slate-50">
                        <tr>
                            <th
                                scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500"
                            >
                                No
                            </th>

                            <th
                                scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500"
                            >
                                Tanggal
                            </th>

                            <th
                                scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500"
                            >
                                Kode Barang
                            </th>

                            <th
                                scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500"
                            >
                                Nama Barang
                            </th>

                            <th
                                scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500"
                            >
                                Jumlah Masuk
                            </th>

                            <th
                                scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500"
                            >
                                Harga Satuan
                            </th>

                            <th
                                scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500"
                            >
                                Keterangan
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-200 bg-white">

                        @forelse ($transaksiMasuk as $transaksi)
                            <tr class="transition hover:bg-slate-50">

                                {{-- Nomor --}}
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600">
                                    {{ $transaksiMasuk->firstItem() + $loop->index }}
                                </td>

                                {{-- Tanggal --}}
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-700">
                                    {{ $transaksi->tanggal_masuk->format('d-m-Y') }}
                                </td>

                                {{-- Kode Barang --}}
                                <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-slate-900">
                                    {{ $transaksi->kode_barang }}
                                </td>

                                {{-- Nama Barang --}}
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-700">
                                    {{ $transaksi->barang->nama_barang }}
                                </td>

                                {{-- Jumlah Masuk --}}
                                <td class="whitespace-nowrap px-6 py-4">
                                    <span class="inline-flex rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">
                                        +{{ $transaksi->jumlah_masuk }}
                                    </span>
                                </td>

                                {{-- Harga Satuan --}}
                                <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-slate-700">
                                    Rp {{ number_format($transaksi->harga_satuan, 0, ',', '.') }}
                                </td>

                                {{-- Keterangan --}}
                                <td class="min-w-56 px-6 py-4 text-sm text-slate-600">
                                    {{ $transaksi->keterangan }}
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td
                                    colspan="7"
                                    class="px-6 py-12 text-center"
                                >
                                    <p class="text-sm font-medium text-slate-600">
                                        Belum ada transaksi masuk.
                                    </p>

                                    <p class="mt-1 text-xs text-slate-400">
                                        Transaksi masuk akan muncul setelah data ditambahkan.
                                    </p>
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>
            </div>

            {{-- Pagination --}}
            @if ($transaksiMasuk->hasPages())
                <div class="border-t border-slate-200 px-6 py-4">
                    {{ $transaksiMasuk->links() }}
                </div>
            @endif

        </div>

    </div>
@endsection