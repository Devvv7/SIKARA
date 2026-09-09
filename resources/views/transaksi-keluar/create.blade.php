@extends('layouts.app')

@section('title', 'Transaksi Keluar')

@section('content')
    <div class="mx-auto max-w-3xl space-y-6">

        {{-- Header --}}
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900">
                Tambah Transaksi Keluar
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Catat barang yang keluar dari dalam inventaris.
            </p>
        </div>

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="rounded-xl border border-red-200 bg-red-50 p-4">
                <div class="flex gap-3">
                    <div class="shrink-0">
                        <span class="text-red-600">!</span>
                    </div>

                    <div>
                        <h2 class="text-sm font-semibold text-red-800">
                            Terjadi kesalahan
                        </h2>

                        <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-red-700">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        {{-- Form --}}
        <div class="rounded-xl border border-slate-200 bg-white shadow-sm">
            <form
                action="{{ route('transaksi-keluar.store') }}"
                method="POST"
            >
                @csrf

                <div class="space-y-6 p-6 lg:p-8">

                    {{-- Tanggal Keluar --}}
                    <div>
                        <label
                            for="tanggal_keluar"
                            class="block text-sm font-semibold text-slate-800"
                        >
                            Tanggal Keluar
                        </label>

                        <p class="mt-1 text-xs text-slate-500">
                            Tentukan tanggal barang dikeluarkan dari gudang.
                        </p>

                        <input
                            type="date"
                            id="tanggal_keluar"
                            name="tanggal_keluar"
                            value="{{ old('tanggal_keluar') }}"
                            required
                            class="mt-3 block w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-900 outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
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

                        <p class="mt-1 text-xs text-slate-500">
                            Pilih barang yang akan dikeluarkan dari stok.
                        </p>

                        <select
                            id="kode_barang"
                            name="kode_barang"
                            required
                            class="mt-3 block w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-900 outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
                        >
                            <option value="">
                                -- Pilih Barang --
                            </option>

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

                    {{-- Jumlah Keluar --}}
                    <div>
                        <label
                            for="jumlah_keluar"
                            class="block text-sm font-semibold text-slate-800"
                        >
                            Jumlah Keluar
                        </label>

                        <p class="mt-1 text-xs text-slate-500">
                            Masukkan jumlah barang yang akan dikeluarkan dari stok.
                        </p>

                        <input
                            type="number"
                            id="jumlah_keluar"
                            name="jumlah_keluar"
                            value="{{ old('jumlah_keluar') }}"
                            min="1"
                            required
                            class="mt-3 block w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
                            placeholder="Contoh: 10"
                        >
                    </div>

                    {{-- Keterangan --}}
                    <div>
                        <label
                            for="keterangan"
                            class="block text-sm font-semibold text-slate-800"
                        >
                            Keterangan
                        </label>

                        <p class="mt-1 text-xs text-slate-500">
                            Jelaskan tujuan atau penggunaan barang yang dikeluarkan.
                        </p>

                        <input
                            type="text"
                            id="keterangan"
                            name="keterangan"
                            value="{{ old('keterangan') }}"
                            placeholder="Contoh: Pengeluaran alat tulis kantor"
                            required
                            class="mt-3 block w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
                        >
                    </div>

                </div>

                {{-- Form Footer --}}
                <div class="flex flex-col-reverse gap-3 border-t border-slate-200 bg-slate-50 px-6 py-4 sm:flex-row sm:items-center sm:justify-end lg:px-8">

                    <a
                        href="{{ route('transaksi-keluar.index') }}"
                        class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-100"
                    >
                        Kembali
                    </a>

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center rounded-lg bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-700"
                    >
                        Simpan Transaksi
                    </button>

                </div>
            </form>
        </div>

    </div>
@endsection