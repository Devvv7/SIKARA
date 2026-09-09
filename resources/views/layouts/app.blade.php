<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @hasSection('title')
            @yield('title') - SIKARA
        @else
            SIKARA
        @endif
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 text-slate-800">

    <div class="min-h-screen">

        {{-- SIDEBAR --}}
        <aside class="fixed inset-y-0 left-0 z-40 hidden w-64 bg-slate-800 lg:flex lg:flex-col">

            <div class="flex h-20 shrink-0 items-center border-b border-slate-700 px-6">
                <div>
                    <h1 class="text-xl font-bold tracking-tight text-white">
                        SIKARA
                    </h1>

                    <p class="mt-0.5 text-xs text-slate-400">
                        Sistem Inventaris
                    </p>
                </div>
            </div>

            <nav class="flex-1 space-y-1 overflow-y-auto px-4 py-6">
                <p class="mb-3 px-3 text-xs font-semibold uppercase tracking-wider text-slate-400">
                    Menu Utama
                </p>

                {{-- Dashboard --}}
                <a
                    href="{{ route('dashboard') }}"
                    class="{{ request()->routeIs('dashboard')
                        ? 'bg-slate-700 text-white'
                        : 'text-slate-200 hover:bg-slate-700 hover:text-white'
                    }} flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition"
                >
                    <span class="text-lg">⌂</span>
                    Dashboard
                </a>

                {{-- Data Barang --}}
                <a
                    href="{{ route('barang.index') }}"
                    class="{{ request()->routeIs('barang.*')
                        ? 'bg-slate-700 text-white'
                        : 'text-slate-200 hover:bg-slate-700 hover:text-white'
                    }} flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition"
                >
                    <span class="text-lg">▣</span>
                    Data Barang
                </a>

                <p class="mb-3 mt-8 px-3 text-xs font-semibold uppercase tracking-wider text-slate-400">
                    Transaksi
                </p>

                {{-- Transaksi Masuk --}}
                <a
                    href="{{ route('transaksi-masuk.index') }}"
                    class="{{ request()->routeIs('transaksi-masuk.*')
                        ? 'bg-slate-700 text-white'
                        : 'text-slate-200 hover:bg-slate-700 hover:text-white'
                    }} flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition"
                >
                    <span class="text-lg">↓</span>
                    Transaksi Masuk
                </a>

                {{-- Transaksi Keluar --}}
                <a
                    href="{{ route('transaksi-keluar.index') }}"
                    class="{{ request()->routeIs('transaksi-keluar.*')
                        ? 'bg-slate-700 text-white'
                        : 'text-slate-200 hover:bg-slate-700 hover:text-white'
                    }} flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition"
                >
                    <span class="text-lg">↑</span>
                    Transaksi Keluar
                </a>

                <p class="mb-3 mt-8 px-3 text-xs font-semibold uppercase tracking-wider text-slate-400">
                    Laporan
                </p>

                {{-- Kartu Stok --}}
                <a
                    href="{{ route('laporan.kartu-stok') }}"
                    class="{{ request()->routeIs('laporan.kartu-stok*')
                        ? 'bg-slate-700 text-white'
                        : 'text-slate-200 hover:bg-slate-700 hover:text-white'
                    }} flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition"
                >
                    <span class="text-lg">▤</span>
                    Kartu Stok
                </a>

                {{-- Laporan Transaksi --}}
                <a
                    href="{{ route('laporan.transaksi') }}"
                    class="{{ request()->routeIs('laporan.transaksi*')
                        ? 'bg-slate-700 text-white'
                        : 'text-slate-200 hover:bg-slate-700 hover:text-white'
                    }} flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition"
                >
                    <span class="text-lg">▤</span>
                    Laporan Transaksi
                </a>

            </nav>

            <div class="shrink-0 border-t border-slate-700 p-4">
                <div class="rounded-lg bg-slate-700/50 p-3">
                    <p class="text-xs font-medium text-slate-300">
                        Sistem Inventaris
                    </p>

                    <p class="mt-1 text-xs text-slate-400">
                        Kantor Imigrasi Ngurah Rai
                    </p>
                </div>
            </div>

        </aside>

        {{-- AREA KONTEN --}}
        <div class="min-h-screen lg:ml-64">

            {{-- HEADER --}}
            <header class="flex h-20 items-center justify-between border-b border-slate-200 bg-white px-6 lg:px-8">

                <div>
                    <h2 class="text-lg font-bold text-slate-900">
                        @yield('title', 'Dashboard')
                    </h2>

                    <p class="text-sm text-slate-500">
                        Sistem Inventaris Kantor Imigrasi Ngurah Rai
                    </p>
                </div>

                @auth
                    <div class="flex items-center gap-4">

                        <div class="hidden text-right sm:block">
                            <p class="text-sm font-semibold text-slate-800">
                                {{ auth()->user()->name }}
                            </p>

                            <p class="text-xs text-slate-500">
                                Admin Inventaris
                            </p>
                        </div>

                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-slate-900 text-sm font-semibold text-white">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf

                            <button
                                type="submit"
                                class="rounded-lg border border-slate-200 px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
                            >
                                Logout
                            </button>
                        </form>

                    </div>
                @endauth

            </header>

            {{-- KONTEN HALAMAN --}}
            <main class="min-h-[calc(100vh-5rem)] bg-slate-50 p-6 lg:p-8">
                @yield('content')
            </main>

        </div>

    </div>

</body>
</html>