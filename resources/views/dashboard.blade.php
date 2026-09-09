@extends('layouts.app')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div>
        <h1 class="text-2xl font-bold tracking-tight text-slate-900">
            Dashboard SIKARA
        </h1>

        <p class="mt-1 text-sm text-slate-500">
            Ringkasan informasi inventaris dan aktivitas transaksi terbaru.
        </p>
    </div>


    {{-- Ringkasan --}}
    <div>
        <h2 class="mb-3 text-sm font-semibold text-slate-900">
            Ringkasan
        </h2>

        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">

            {{-- Total Jenis Barang --}}
            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                    Total Jenis Barang
                </p>

                <p class="mt-2 text-2xl font-bold text-slate-900">
                    {{ $totalBarang }}
                </p>

                <p class="mt-1 text-xs text-slate-500">
                    Jenis barang terdaftar
                </p>
            </div>


            {{-- Total Stok --}}
            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                    Total Stok
                </p>

                <p class="mt-2 text-2xl font-bold text-slate-900">
                    {{ $totalStok }}
                </p>

                <p class="mt-1 text-xs text-slate-500">
                    Jumlah seluruh stok
                </p>
            </div>


            {{-- Total Transaksi Masuk --}}
            <div class="rounded-xl border border-emerald-200 bg-emerald-50 p-5 shadow-sm">
                <p class="text-xs font-medium uppercase tracking-wide text-emerald-700">
                    Transaksi Masuk
                </p>

                <p class="mt-2 text-2xl font-bold text-emerald-700">
                    {{ $totalTransaksiMasuk }}
                </p>

                <p class="mt-1 text-xs text-emerald-600">
                    Total transaksi barang masuk
                </p>
            </div>


            {{-- Total Transaksi Keluar --}}
            <div class="rounded-xl border border-red-200 bg-red-50 p-5 shadow-sm">
                <p class="text-xs font-medium uppercase tracking-wide text-red-700">
                    Transaksi Keluar
                </p>

                <p class="mt-2 text-2xl font-bold text-red-700">
                    {{ $totalTransaksiKeluar }}
                </p>

                <p class="mt-1 text-xs text-red-600">
                    Total transaksi barang keluar
                </p>
            </div>

        </div>
    </div>


    {{-- Transaksi Terbaru --}}
    <div class="grid gap-6 lg:grid-cols-2">

        {{-- Transaksi Masuk Terbaru --}}
        <div class="rounded-xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-6 py-4">

                <h2 class="text-sm font-semibold text-slate-900">
                    Transaksi Masuk Terbaru
                </h2>

                <p class="mt-1 text-xs text-slate-500">
                    Daftar transaksi barang masuk terbaru.
                </p>

            </div>


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
                                Barang
                            </th>

                            <th class="whitespace-nowrap px-4 py-3 text-center font-semibold text-slate-600">
                                Jumlah
                            </th>

                            <th class="whitespace-nowrap px-4 py-3 text-left font-semibold text-slate-600">
                                Keterangan
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100">

                        @forelse ($transaksiMasukTerbaru as $transaksi)

                            <tr class="transition hover:bg-slate-50">

                                <td class="whitespace-nowrap px-4 py-3 text-center text-slate-600">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="whitespace-nowrap px-4 py-3 text-slate-700">
                                    {{ $transaksi->tanggal_masuk->format('d-m-Y') }}
                                </td>

                                <td class="px-4 py-3 font-medium text-slate-800">
                                    {{ $transaksi->barang->nama_barang }}
                                </td>

                                <td class="whitespace-nowrap px-4 py-3 text-center font-semibold text-emerald-600">
                                    +{{ $transaksi->jumlah_masuk }}
                                </td>

                                <td class="min-w-40 px-4 py-3 text-slate-600">
                                    {{ $transaksi->keterangan }}
                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="5"
                                    class="px-6 py-12 text-center"
                                >

                                    <div class="flex flex-col items-center">

                                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-slate-100">
                                            <span class="text-lg text-slate-400">
                                                —
                                            </span>
                                        </div>

                                        <p class="mt-3 text-sm font-medium text-slate-700">
                                            Belum ada transaksi masuk
                                        </p>

                                        <p class="mt-1 text-xs text-slate-500">
                                            Belum terdapat transaksi barang masuk.
                                        </p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- Transaksi Keluar Terbaru --}}
        <div class="rounded-xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-6 py-4">

                <h2 class="text-sm font-semibold text-slate-900">
                    Transaksi Keluar Terbaru
                </h2>

                <p class="mt-1 text-xs text-slate-500">
                    Daftar transaksi barang keluar terbaru.
                </p>

            </div>


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
                                Barang
                            </th>

                            <th class="whitespace-nowrap px-4 py-3 text-center font-semibold text-slate-600">
                                Jumlah
                            </th>

                            <th class="whitespace-nowrap px-4 py-3 text-left font-semibold text-slate-600">
                                Keterangan
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100">

                        @forelse ($transaksiKeluarTerbaru as $transaksi)

                            <tr class="transition hover:bg-slate-50">

                                <td class="whitespace-nowrap px-4 py-3 text-center text-slate-600">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="whitespace-nowrap px-4 py-3 text-slate-700">
                                    {{ $transaksi->tanggal_keluar->format('d-m-Y') }}
                                </td>

                                <td class="px-4 py-3 font-medium text-slate-800">
                                    {{ $transaksi->barang->nama_barang }}
                                </td>

                                <td class="whitespace-nowrap px-4 py-3 text-center font-semibold text-red-600">
                                    -{{ $transaksi->jumlah_keluar }}
                                </td>

                                <td class="min-w-40 px-4 py-3 text-slate-600">
                                    {{ $transaksi->keterangan }}
                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="5"
                                    class="px-6 py-12 text-center"
                                >

                                    <div class="flex flex-col items-center">

                                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-slate-100">
                                            <span class="text-lg text-slate-400">
                                                —
                                            </span>
                                        </div>

                                        <p class="mt-3 text-sm font-medium text-slate-700">
                                            Belum ada transaksi keluar
                                        </p>

                                        <p class="mt-1 text-xs text-slate-500">
                                            Belum terdapat transaksi barang keluar.
                                        </p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection