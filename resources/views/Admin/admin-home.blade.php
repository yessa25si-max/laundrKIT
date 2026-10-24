<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin LaundryKIT</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #FFF7FA;
            color: #704457;
        }

        .sidebar {
            position: fixed;
            width: 240px;
            height: 100vh;
            background: #F8DCE8;
            padding: 25px 18px;
            overflow-y: auto;
        }

        .brand {
            font-size: 25px;
            font-weight: bold;
            color: #C94F83;
            margin-bottom: 35px;
            display: flex;
            align-items: center;
        }

        .sidebar a {
            display: block;
            text-decoration: none;
            color: #704457;
            padding: 12px 14px;
            margin-bottom: 8px;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.2s ease;
        }

        .sidebar a.active,
        .sidebar a:hover {
            background: #E98CB4;
            color: white;
        }

        .sidebar-divider {
            height: 1px;
            background: #edd2df;
            margin: 15px 0;
        }

        .sidebar-title {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #a46d84;
            padding: 4px 14px 8px;
            font-weight: bold;
        }

        .main {
            margin-left: 240px;
            padding: 30px;
        }

        .topbar {
            background: white;
            padding: 22px;
            border-radius: 15px;
            margin-bottom: 25px;
            box-shadow: 0 3px 12px #eedbe3;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .topbar h1 {
            color: #C94F83;
            margin-bottom: 8px;
            font-size: 26px;
        }

        .topbar p {
            color: #8a576e;
            font-size: 14px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 20px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 3px 12px #eedbe3;
            position: relative;
        }

        .card p {
            margin-bottom: 12px;
            color: #8a576e;
            font-size: 14px;
            font-weight: 600;
        }

        .card h2 {
            color: #D95F91;
            font-size: 32px;
            font-weight: bold;
        }

        .card-link {
            display: inline-block;
            margin-top: 14px;
            font-size: 13px;
            color: #C94F83;
            text-decoration: none;
            font-weight: bold;
        }

        .card-link:hover {
            text-decoration: underline;
        }

        .content {
            background: white;
            margin-top: 25px;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 3px 12px #eedbe3;
        }

        .content h2 {
            color: #C94F83;
            font-size: 20px;
            margin-bottom: 10px;
        }

        .content p {
            margin-top: 8px;
            line-height: 1.6;
            color: #704457;
            font-size: 14px;
        }

        .btn-pink {
            display: inline-block;
            background: #E98CB4;
            color: white;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: bold;
            transition: background 0.2s;
            border: none;
            cursor: pointer;
        }

        .btn-pink:hover {
            background: #d86c99;
            color: white;
        }

        .btn-pink-outline {
            display: inline-block;
            background: transparent;
            color: #C94F83;
            text-decoration: none;
            padding: 7px 14px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: bold;
            border: 1px solid #E98CB4;
            transition: all 0.2s;
        }

        .btn-pink-outline:hover {
            background: #F8DCE8;
            color: #C94F83;
        }

        .table-custom {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 14px;
        }

        .table-custom th {
            text-align: left;
            padding: 10px 12px;
            background: #FFF7FA;
            color: #8a576e;
            border-bottom: 2px solid #F8DCE8;
            font-weight: 600;
        }

        .table-custom td {
            padding: 10px 12px;
            border-bottom: 1px solid #f6e6ee;
            color: #553344;
        }

        .table-custom tr:hover {
            background: #fffcfd;
        }

        @media (max-width: 900px) {
            .cards {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 750px) {
            .sidebar {
                width: 180px;
            }

            .main {
                margin-left: 180px;
                padding: 15px;
            }
        }
    </style>
</head>

<body>

    <aside class="sidebar">
        <div class="brand">
            <img src="{{ asset('assets-admin/assets/img/logo/logo.png') }}" alt="LaundryKIT" style="height: 38px; width: auto;">
        </div>

        <a href="{{ url('/admin-home') }}" class="active">Dashboard Admin</a>
        
        <div class="sidebar-title">Master Data</div>
        <a href="{{ route('pelanggan.index') }}">Data Pelanggan</a>
        <a href="{{ route('layanan.index') }}">Data Layanan Cuci</a>
        <a href="{{ route('barang.index') }}">Data Perlengkapan</a>

        <div class="sidebar-divider"></div>

        <div class="sidebar-title">Menu Lainnya</div>
        <a href="#transaksi">Data Transaksi</a>
        <a href="#laporan">Laporan</a>
        <a href="{{ url('/') }}">Kembali ke Dashboard</a>
    </aside>

    <main class="main">
        <header class="topbar">
            <div>
                <h1>Dashboard Admin 🎀</h1>
                <p>Selamat datang di panel Admin LaundryKIT!</p>
            </div>
            <div>
                <a href="{{ url('/') }}" class="btn-pink-outline">
                    &larr; Halaman Publik
                </a>
            </div>
        </header>

        <section class="cards">
            <div class="card">
                <p>Total Pelanggan</p>
                <h2>{{ $totalPelanggan ?? 0 }}</h2>
                <a href="{{ route('pelanggan.index') }}" class="card-link">Kelola Pelanggan &rarr;</a>
            </div>

            <div class="card">
                <p>Paket Layanan Cuci</p>
                <h2>{{ $totalLayanan ?? 0 }}</h2>
                <a href="{{ route('layanan.index') }}" class="card-link">Kelola Layanan &rarr;</a>
            </div>

            <div class="card">
                <p>Perlengkapan / Stok</p>
                <h2>{{ $totalBarang ?? 0 }}</h2>
                <a href="{{ route('barang.index') }}" class="card-link">Kelola Perlengkapan &rarr;</a>
            </div>

            <div class="card">
                <p>Total Transaksi</p>
                <h2>0</h2>
                <a href="#transaksi" class="card-link">Lihat Transaksi &rarr;</a>
            </div>

            <div class="card">
                <p>Pesanan Selesai</p>
                <h2>0</h2>
                <a href="#transaksi" class="card-link">Lihat Pesanan &rarr;</a>
            </div>
        </section>

        <!-- Seksi Data Pelanggan -->
        <section class="content" id="pelanggan">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
                <h2>Data Pelanggan</h2>
                <div style="display: flex; gap: 8px;">
                    <a href="{{ route('pelanggan.create') }}" class="btn-pink">+ Tambah Pelanggan</a>
                    <a href="{{ route('pelanggan.index') }}" class="btn-pink-outline">Lihat Semua Data</a>
                </div>
            </div>
            <p>Daftar pelanggan terbaru yang terdaftar dalam sistem LaundryKIT:</p>

            @if(isset($latestPelanggan) && $latestPelanggan->count() > 0)
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th>Nama Pelanggan</th>
                            <th>Email</th>
                            <th>No. Telepon</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($latestPelanggan as $item)
                            <tr>
                                <td><strong>{{ $item->first_name }} {{ $item->last_name }}</strong></td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p style="color: #999; font-style: italic; margin-top: 15px;">Belum ada data pelanggan.</p>
            @endif
        </section>

        <!-- Seksi Data Layanan Cuci -->
        <section class="content" id="layanan">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
                <h2>Data Layanan Cuci</h2>
                <div style="display: flex; gap: 8px;">
                    <a href="{{ route('layanan.create') }}" class="btn-pink">+ Tambah Layanan</a>
                    <a href="{{ route('layanan.index') }}" class="btn-pink-outline">Lihat Semua Layanan</a>
                </div>
            </div>
            <p>Daftar paket layanan cuci yang tersedia saat ini:</p>

            @if(isset($latestLayanan) && $latestLayanan->count() > 0)
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama Layanan</th>
                            <th>Kategori</th>
                            <th>Tarif</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($latestLayanan as $lay)
                            <tr>
                                <td><code>{{ $lay->kode_layanan }}</code></td>
                                <td><strong>{{ $lay->nama_layanan }}</strong></td>
                                <td>{{ $lay->kategori }}</td>
                                <td>Rp {{ number_format($lay->harga, 0, ',', '.') }} / {{ $lay->satuan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p style="color: #999; font-style: italic; margin-top: 15px;">Belum ada data layanan.</p>
            @endif
        </section>

        <!-- Seksi Data Perlengkapan / Barang -->
        <section class="content" id="barang">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
                <h2>Data Perlengkapan & Stok</h2>
                <div style="display: flex; gap: 8px;">
                    <a href="{{ route('barang.create') }}" class="btn-pink">+ Tambah Barang</a>
                    <a href="{{ route('barang.index') }}" class="btn-pink-outline">Lihat Semua Barang</a>
                </div>
            </div>
            <p>Daftar inventaris bahan dan peralatan laundry:</p>

            @if(isset($latestBarang) && $latestBarang->count() > 0)
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($latestBarang as $brg)
                            <tr>
                                <td><code>{{ $brg->kode_barang }}</code></td>
                                <td><strong>{{ $brg->nama_barang }}</strong></td>
                                <td>{{ $brg->kategori }}</td>
                                <td>{{ $brg->stok }} {{ $brg->satuan }}</td>
                                <td>
                                    <span style="font-weight: bold; color: {{ $brg->status == 'Tersedia' ? '#2e7d32' : ($brg->status == 'Menipis' ? '#ed6c02' : '#d32f2f') }};">
                                        {{ $brg->status }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p style="color: #999; font-style: italic; margin-top: 15px;">Belum ada data barang.</p>
            @endif
        </section>

        <!-- Seksi Transaksi -->
        <section class="content" id="transaksi">
            <h2>Data Transaksi</h2>
            <p>Halaman pengelolaan transaksi laundry akan kita buat berikutnya.</p>
        </section>

        <!-- Seksi Laporan -->
        <section class="content" id="laporan">
            <h2>Laporan Laundry</h2>
            <p>Ringkasan pendapatan dan laporan laundry akan ditambahkan nanti.</p>
        </section>
    </main>

</body>
</html>
