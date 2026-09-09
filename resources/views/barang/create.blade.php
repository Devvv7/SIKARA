@extends('layouts.app')

@section('title', 'Data Barang')

@section('content')
    <div class="mx-auto max-w-3xl space-y-6">

        {{-- Header --}}
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900">
                Tambah Barang
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Tambahkan data barang baru ke dalam inventaris.
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
            <form action="{{ route('barang.store') }}" method="POST">
                @csrf

                <div class="space-y-6 p-6 lg:p-8">

                    {{-- Kode Barang --}}
                    <div>
                        <label
                            for="kode_barang"
                            class="block text-sm font-semibold text-slate-800"
                        >
                            Kode Barang
                        </label>

                        <p class="mt-1 text-xs text-slate-500">
                            Masukkan kode unik untuk barang.
                        </p>

                        <input
                            type="text"
                            id="kode_barang"
                            name="kode_barang"
                            value="{{ old('kode_barang') }}"
                            required
                            class="mt-3 block w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
                            placeholder="Contoh: 1010301001000001"
                        >
                    </div>

                    {{-- Nama Barang --}}
                    <div>
                        <label
                            for="nama_barang"
                            class="block text-sm font-semibold text-slate-800"
                        >
                            Nama Barang
                        </label>

                        <p class="mt-1 text-xs text-slate-500">
                            Masukkan nama barang yang akan disimpan.
                        </p>

                        <input
                            type="text"
                            id="nama_barang"
                            name="nama_barang"
                            value="{{ old('nama_barang') }}"
                            required
                            class="mt-3 block w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
                            placeholder="Contoh: Pulpen Biru"
                        >
                    </div>

                    {{-- Satuan --}}
                    <div>
                        <label
                            for="satuan"
                            class="block text-sm font-semibold text-slate-800"
                        >
                            Satuan
                        </label>

                        <p class="mt-1 text-xs text-slate-500">
                            Tentukan satuan barang, misalnya pcs, box, atau rim.
                        </p>

                        <input
                            type="text"
                            id="satuan"
                            name="satuan"
                            value="{{ old('satuan') }}"
                            placeholder="Contoh: pcs, box, rim"
                            required
                            class="mt-3 block w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
                        >
                    </div>

                </div>

                {{-- Form Footer --}}
                <div class="flex flex-col-reverse gap-3 border-t border-slate-200 bg-slate-50 px-6 py-4 sm:flex-row sm:items-center sm:justify-end lg:px-8">

                    <a
                        href="{{ route('barang.index') }}"
                        class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-100"
                    >
                        Kembali
                    </a>

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center rounded-lg bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-700"
                    >
                        Simpan Barang
                    </button>

                </div>
            </form>
        </div>

    </div>
@endsection