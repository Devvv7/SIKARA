@extends('layouts.app')

@section('title', 'Transaksi Masuk')

@section('content')
    <div class="mx-auto max-w-3xl space-y-6">

        {{-- Header --}}
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900">
                Tambah Transaksi Masuk
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Catat barang yang masuk ke dalam inventaris.
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
                action="{{ route('transaksi-masuk.store') }}"
                method="POST"
            >
                @csrf

                <div class="space-y-6 p-6 lg:p-8">

                    {{-- Tanggal Masuk --}}
                    <div>
                        <label
                            for="tanggal_masuk"
                            class="block text-sm font-semibold text-slate-800"
                        >
                            Tanggal Masuk
                        </label>

                        <p class="mt-1 text-xs text-slate-500">
                            Tentukan tanggal barang diterima atau masuk ke gudang.
                        </p>

                        <input
                            type="date"
                            id="tanggal_masuk"
                            name="tanggal_masuk"
                            value="{{ old('tanggal_masuk') }}"
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
                            Pilih barang yang akan ditambahkan ke dalam stok.
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

                    {{-- Jumlah Masuk --}}
                    <div>
                        <label
                            for="jumlah_masuk"
                            class="block text-sm font-semibold text-slate-800"
                        >
                            Jumlah Masuk
                        </label>

                        <p class="mt-1 text-xs text-slate-500">
                            Masukkan jumlah barang yang diterima.
                        </p>

                        <input
                            type="number"
                            id="jumlah_masuk"
                            name="jumlah_masuk"
                            value="{{ old('jumlah_masuk') }}"
                            min="1"
                            required
                            class="mt-3 block w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
                            placeholder="Contoh: 25"
                        >
                    </div>

                    {{-- Harga Satuan --}}
                    <div>
                        <label
                            for="harga_satuan"
                            class="block text-sm font-semibold text-slate-800"
                        >
                            Harga Satuan
                        </label>

                        <p class="mt-1 text-xs text-slate-500">
                            Masukkan harga per satuan barang pada transaksi ini.
                        </p>

                        <div class="relative mt-3">
                            <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-sm font-medium text-slate-500">
                                Rp
                            </span>

                            <input
                                type="number"
                                id="harga_satuan"
                                name="harga_satuan"
                                value="{{ old('harga_satuan') }}"
                                min="0"
                                required
                                class="block w-full rounded-lg border border-slate-300 bg-white py-2.5 pl-11 pr-4 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
                                placeholder="Contoh: 50000"
                            >
                        </div>
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
                            Jelaskan sumber atau tujuan barang yang masuk.
                        </p>

                        <input
                            type="text"
                            id="keterangan"
                            name="keterangan"
                            value="{{ old('keterangan') }}"
                            placeholder="Contoh: Pengadaan alat tulis kantor"
                            required
                            class="mt-3 block w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
                        >
                    </div>

                </div>

                {{-- Form Footer --}}
                <div class="flex flex-col-reverse gap-3 border-t border-slate-200 bg-slate-50 px-6 py-4 sm:flex-row sm:items-center sm:justify-end lg:px-8">

                    <a
                        href="{{ route('transaksi-masuk.index') }}"
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