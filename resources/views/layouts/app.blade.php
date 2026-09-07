<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'SIKARA' }}</title>
</head>
<body>

    <nav>
        <strong>SIKARA</strong>

        <a href="{{ route('dashboard') }}">
            Dashboard
        </a>

        <a href="{{ route('barang.index') }}">
            Data Barang
        </a>

        <a href="{{ route('transaksi-masuk.index') }}">
            Transaksi Masuk
        </a>

        <a href="{{ route('transaksi-keluar.index') }}">
            Transaksi Keluar
        </a>

        <details>
            <summary>Laporan</summary>

            <a href="{{ route('laporan.kartu-stok') }}">
                Kartu Stok
            </a>

            <a href="{{ route('laporan.transaksi') }}">
                Laporan Transaksi
            </a>
        </details>

        @auth
        <form action="{{ route('logout') }}" method="POST">
            @csrf

            <button type="submit">
                Logout
            </button>
        </form>
    @endauth
    </nav>

    <hr>

    <main>
        @yield('content')
    </main>

</body>
</html>