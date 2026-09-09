@extends('layouts.app')

@section('title', 'Data Barang')

@section('content')
    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-slate-900">
                    Detail Barang
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Informasi barang dan rincian stok berdasarkan setiap batch masuk.
                </p>
            </div>

            <a
                href="{{ route('barang.index') }}"
                class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-100"
            >
                ← Kembali
            </a>
        </div>

        {{-- Informasi Barang --}}
        <div class="rounded-xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 px-6 py-5">
                <h2 class="text-base font-semibold text-slate-900">
                    Informasi Barang
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Informasi utama barang yang tersimpan dalam sistem.
                </p>
            </div>

            <div class="grid grid-cols-1 divide-y divide-slate-200 sm:grid-cols-2 sm:divide-x sm:divide-y-0">

                {{-- Kode Barang --}}
                <div class="px-6 py-5">
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                        Kode Barang
                    </p>

                    <p class="mt-2 text-sm font-semibold text-slate-900">
                        {{ $barang->kode_barang }}
                    </p>
                </div>

                {{-- Nama Barang --}}
                <div class="px-6 py-5">
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                        Nama Barang
                    </p>

                    <p class="mt-2 text-sm font-semibold text-slate-900">
                        {{ $barang->nama_barang }}
                    </p>
                </div>

                {{-- Satuan --}}
                <div class="border-t border-slate-200 px-6 py-5 sm:border-t-0">
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                        Satuan
                    </p>

                    <p class="mt-2 text-sm font-semibold text-slate-900">
                        {{ $barang->satuan }}
                    </p>
                </div>

                {{-- Total Stok --}}
                <div class="border-t border-slate-200 px-6 py-5 sm:border-t-0">
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                        Total Stok
                    </p>

                    <div class="mt-2 flex items-center gap-2">
                        <span class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-sm font-bold text-slate-800">
                            {{ $barang->stok }}
                        </span>

                        <span class="text-sm text-slate-500">
                            {{ $barang->satuan }}
                        </span>
                    </div>
                </div>

            </div>
        </div>

        {{-- Detail Stok --}}
        <div class="rounded-xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-6 py-5">
                <h2 class="text-base font-semibold text-slate-900">
                    Detail Stok Barang
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Rincian stok yang tersisa pada setiap batch barang.
                </p>
            </div>

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
                                Tanggal Masuk
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
                                Sisa Stok
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-200 bg-white">

                        @forelse ($detailBarang as $detail)
                            <tr class="transition hover:bg-slate-50">

                                <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-700">
                                    {{ $detail->tanggal_masuk->format('d-m-Y') }}
                                </td>

                                <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-slate-700">
                                    Rp {{ number_format($detail->harga, 0, ',', '.') }}
                                </td>

                                <td class="whitespace-nowrap px-6 py-4">
                                    <span
                                        class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold
                                        {{ $detail->stok > 0
                                            ? 'bg-emerald-50 text-emerald-700'
                                            : 'bg-slate-100 text-slate-500'
                                        }}"
                                    >
                                        {{ $detail->stok }}
                                    </span>
                                </td>

                            </tr>
                        @empty

                            <tr>
                                <td
                                    colspan="4"
                                    class="px-6 py-12 text-center"
                                >
                                    <p class="text-sm font-medium text-slate-600">
                                        Belum ada detail stok barang.
                                    </p>

                                    <p class="mt-1 text-xs text-slate-400">
                                        Detail stok akan muncul setelah terdapat transaksi masuk.
                                    </p>
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                    @if ($detailBarang->count() > 0)
                        <tfoot class="border-t border-slate-200 bg-slate-50">
                            <tr>
                                <th
                                    colspan="3"
                                    class="px-6 py-4 text-right text-sm font-semibold text-slate-700"
                                >
                                    Total Sisa Stok
                                </th>

                                <th class="px-6 py-4 text-left">
                                    <span class="inline-flex rounded-full bg-slate-900 px-3 py-1 text-sm font-bold text-white">
                                        {{ $detailBarang->sum('stok') }}
                                    </span>
                                </th>
                            </tr>
                        </tfoot>
                    @endif

                </table>
            </div>
        </div>

    </div>
@endsection