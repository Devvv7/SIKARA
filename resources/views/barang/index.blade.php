@extends('layouts.app')

@section('title', 'Data Barang')

@section('content')

    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h1 class="text-2xl font-bold tracking-tight text-slate-900">
                    Data Barang
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Kelola data barang dan stok inventaris.
                </p>
            </div>

            <a
                href="{{ route('barang.create') }}"
                class="inline-flex items-center justify-center rounded-lg bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-700"
            >
                + Tambah Barang
            </a>

        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        {{-- Error Message --}}
        @if (session('error'))
            <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                {{ session('error') }}
            </div>
        @endif

        {{-- Search --}}
        <form
            method="GET"
            action="{{ route('barang.index') }}"
            class="flex flex-col gap-3 sm:flex-row"
        >

            <div class="relative flex-1">

                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                    🔍
                </span>

                <input
                    type="text"
                    name="search"
                    value="{{ $search }}"
                    placeholder="Cari kode atau nama barang..."
                    class="w-full rounded-lg border border-slate-300 bg-white py-2.5 pl-10 pr-4 text-sm text-slate-700 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
                >

            </div>

            <input
                type="hidden"
                name="per_page"
                value="{{ $perPage }}"
            >

            <button
                type="submit"
                class="rounded-lg bg-slate-900 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-700"
            >
                Cari
            </button>

            @if ($search !== '')
                <a
                    href="{{ route('barang.index') }}"
                    class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-5 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
                >
                    Reset
                </a>
            @endif

        </form>

        {{-- Table Card --}}
        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

            {{-- Table Header / Pagination Control --}}
            <div class="flex flex-col gap-3 border-b border-slate-200 px-6 py-4 sm:flex-row sm:items-center sm:justify-between">

                <div class="text-sm text-slate-500">

                    @if ($barang->total() > 0)

                        Menampilkan

                        <span class="font-medium text-slate-700">
                            {{ $barang->firstItem() }}
                        </span>

                        -

                        <span class="font-medium text-slate-700">
                            {{ $barang->lastItem() }}
                        </span>

                        dari

                        <span class="font-medium text-slate-700">
                            {{ $barang->total() }}
                        </span>

                        barang

                        @if ($search !== '')
                            <span class="text-slate-400">
                                untuk pencarian
                                "<span class="font-medium text-slate-600">{{ $search }}</span>"
                            </span>
                        @endif

                    @else

                        @if ($search !== '')

                            Tidak ditemukan barang untuk pencarian
                            "<span class="font-medium text-slate-700">{{ $search }}</span>"

                        @else

                            Tidak ada data barang

                        @endif

                    @endif

                </div>

                {{-- Per Page --}}
                <form
                    method="GET"
                    action="{{ route('barang.index') }}"
                    class="flex items-center gap-2"
                >

                    {{-- Pertahankan search ketika mengganti jumlah data --}}
                    <input
                        type="hidden"
                        name="search"
                        value="{{ $search }}"
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
                                Satuan
                            </th>

                            <th
                                scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500"
                            >
                                Stok
                            </th>

                            <th
                                scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500"
                            >
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-slate-200 bg-white">

                        @forelse ($barang as $item)

                            <tr class="transition hover:bg-slate-50">

                                {{-- Nomor --}}
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600">
                                    {{ $barang->firstItem() + $loop->index }}
                                </td>

                                {{-- Kode Barang --}}
                                <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-slate-900">
                                    {{ $item->kode_barang }}
                                </td>

                                {{-- Nama Barang --}}
                                <td class="px-6 py-4 text-sm text-slate-700">
                                    {{ $item->nama_barang }}
                                </td>

                                {{-- Satuan --}}
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600">
                                    {{ $item->satuan }}
                                </td>

                                {{-- Stok --}}
                                <td class="whitespace-nowrap px-6 py-4">

                                    <span class="inline-flex rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700">
                                        {{ $item->stok }}
                                    </span>

                                </td>

                                {{-- Aksi --}}
                                <td class="whitespace-nowrap px-6 py-4">

                                    <div class="flex items-center gap-3 text-sm">

                                        {{-- Detail --}}
                                        <a
                                            href="{{ route('barang.show', $item->kode_barang) }}"
                                            class="font-medium text-slate-600 transition hover:text-slate-900"
                                        >
                                            Detail
                                        </a>

                                        {{-- Edit --}}
                                        <a
                                            href="{{ route('barang.edit', $item->kode_barang) }}"
                                            class="font-medium text-blue-600 transition hover:text-blue-800"
                                        >
                                            Edit
                                        </a>

                                        {{-- Hapus --}}
                                        <form
                                            id="delete-form-{{ $item->kode_barang }}"
                                            action="{{ route('barang.destroy', $item->kode_barang) }}"
                                            method="POST"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="button"
                                                onclick="openDeleteModal(
                                                    '{{ $item->kode_barang }}',
                                                    @js($item->nama_barang)
                                                )"
                                                class="font-medium text-red-600 transition hover:text-red-800"
                                            >
                                                Hapus
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="6"
                                    class="px-6 py-12 text-center text-sm text-slate-500"
                                >
                                    Belum ada data barang.
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            {{-- Pagination --}}
            @if ($barang->hasPages())

                <div class="border-t border-slate-200 px-6 py-4">
                    {{ $barang->links() }}
                </div>

            @endif

        </div>

    </div>


    {{-- ====================================================== --}}
    {{-- MODAL KONFIRMASI HAPUS --}}
    {{-- ====================================================== --}}

    <div
        id="delete-modal"
        class="fixed inset-0 z-50 hidden"
        aria-labelledby="delete-modal-title"
        role="dialog"
        aria-modal="true"
    >

        {{-- Overlay --}}
        <div
            class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm"
            onclick="closeDeleteModal()"
        ></div>

        {{-- Modal Wrapper --}}
        <div class="relative flex min-h-full items-center justify-center p-4">

            {{-- Modal --}}
            <div
                id="delete-modal-content"
                class="w-full max-w-md rounded-xl bg-white shadow-xl"
            >

                {{-- Header --}}
                <div class="flex items-start justify-between border-b border-slate-200 px-6 py-5">

                    <div class="flex items-start gap-4">

                        {{-- Warning Icon --}}
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-red-50">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                class="h-5 w-5 text-red-600"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 9v4m0 4h.01M10.29 3.86l-7.82 13.5A2 2 0 0 0 4.2 20.36h15.6a2 2 0 0 0 1.73-3L13.71 3.86a2 2 0 0 0-3.42 0Z"
                                />
                            </svg>

                        </div>

                        <div>

                            <h2
                                id="delete-modal-title"
                                class="text-base font-semibold text-slate-900"
                            >
                                Hapus Barang?
                            </h2>

                            <p class="mt-1 text-sm text-slate-500">
                                Anda akan menghapus data barang berikut.
                            </p>

                        </div>

                    </div>

                    {{-- Close Button --}}
                    <button
                        type="button"
                        onclick="closeDeleteModal()"
                        class="rounded-lg p-1.5 text-slate-400 transition hover:bg-slate-100 hover:text-slate-600"
                        aria-label="Tutup"
                    >

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            class="h-5 w-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6 18 18 6M6 6l12 12"
                            />
                        </svg>

                    </button>

                </div>

                {{-- Body --}}
                <div class="px-6 py-5">

                    <div class="rounded-lg border border-slate-200 bg-slate-50 px-4 py-3">

                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                            Nama Barang
                        </p>

                        <p
                            id="delete-item-name"
                            class="mt-1 text-sm font-semibold text-slate-800"
                        >
                        </p>

                    </div>

                    <p class="mt-4 text-sm leading-6 text-slate-500">
                        Apakah Anda yakin ingin menghapus barang ini?
                        Tindakan ini tidak dapat dibatalkan.
                    </p>

                </div>

                {{-- Footer --}}
                <div class="flex flex-col-reverse gap-3 border-t border-slate-200 bg-slate-50 px-6 py-4 sm:flex-row sm:justify-end">

                    <button
                        type="button"
                        onclick="closeDeleteModal()"
                        class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-100"
                    >
                        Batal
                    </button>

                    <button
                        type="button"
                        onclick="submitDeleteForm()"
                        class="inline-flex items-center justify-center rounded-lg bg-red-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-red-700"
                    >
                        Hapus Barang
                    </button>

                </div>

            </div>

        </div>

    </div>


    {{-- ====================================================== --}}
    {{-- JAVASCRIPT MODAL --}}
    {{-- ====================================================== --}}

    <script>

        let deleteItemCode = null;

        function openDeleteModal(kodeBarang, namaBarang) {

            deleteItemCode = kodeBarang;

            document.getElementById('delete-item-name').textContent = namaBarang;

            const modal = document.getElementById('delete-modal');

            modal.classList.remove('hidden');

            document.body.classList.add('overflow-hidden');
        }


        function closeDeleteModal() {

            const modal = document.getElementById('delete-modal');

            modal.classList.add('hidden');

            document.body.classList.remove('overflow-hidden');

            deleteItemCode = null;
        }


        function submitDeleteForm() {

            if (!deleteItemCode) {
                return;
            }

            const form = document.getElementById(
                'delete-form-' + deleteItemCode
            );

            if (form) {
                form.submit();
            }

        }


        document.addEventListener('keydown', function (event) {

            if (event.key === 'Escape') {

                const modal = document.getElementById('delete-modal');

                if (!modal.classList.contains('hidden')) {
                    closeDeleteModal();
                }

            }

        });

    </script>

@endsection