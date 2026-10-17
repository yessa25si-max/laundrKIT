
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
        }

        .brand {
            font-size: 25px;
            font-weight: bold;
            color: #C94F83;
            margin-bottom: 35px;
        }

        .sidebar a {
            display: block;
            text-decoration: none;
            color: #704457;
            padding: 14px;
            margin-bottom: 8px;
            border-radius: 10px;
        }

        .sidebar a.active,
        .sidebar a:hover {
            background: #E98CB4;
            color: white;
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
        }

        .topbar h1 {
            color: #C94F83;
            margin-bottom: 8px;
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
        }

        .card p {
            margin-bottom: 15px;
        }

        .card h2 {
            color: #D95F91;
            font-size: 30px;
        }

        .content {
            background: white;
            margin-top: 25px;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 3px 12px #eedbe3;
        }

        .content p {
            margin-top: 12px;
            line-height: 1.6;
        }

        @media (max-width: 750px) {
            .sidebar {
                width: 175px;
            }

            .main {
                margin-left: 175px;
                padding: 15px;
            }

            .cards {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <aside class="sidebar">
        <div class="brand">
            <img src="{{ asset('assets-admin/assets/img/logo/logo.png') }}" alt="LaundryKIT" style="height: 38px; width: auto;">
        </div>

        <a href="/admin-home" class="active">Dashboard Admin</a>
        <a href="/admin-home#pelanggan">Data Pelanggan</a>
        <a href="/admin-home#transaksi">Data Transaksi</a>
        <a href="/admin-home#laporan">Laporan</a>
        <a href="/">Kembali ke Dashboard</a>
    </aside>

    <main class="main">
        <header class="topbar">
            <h1>Dashboard Admin 🎀</h1>
            <p>Selamat datang di panel Admin LaundryKIT!</p>
        </header>

        <section class="cards">
            <div class="card">
                <p>Total Pelanggan</p>
                <h2>0</h2>
            </div>

            <div class="card">
                <p>Total Transaksi</p>
                <h2>0</h2>
            </div>

            <div class="card">
                <p>Pesanan Selesai</p>
                <h2>0</h2>
            </div>
        </section>

        <section class="content" id="pelanggan">
            <h2>Data Pelanggan</h2>
            <p>Halaman pengelolaan pelanggan akan kita buat pada langkah berikutnya.</p>
        </section>

        <section class="content" id="transaksi">
            <h2>Data Transaksi</h2>
            <p>Halaman pengelolaan transaksi laundry akan kita buat berikutnya.</p>
        </section>

        <section class="content" id="laporan">
            <h2>Laporan Laundry</h2>
            <p>Ringkasan pendapatan dan laporan laundry akan ditambahkan nanti.</p>
        </section>
    </main>

</body>
</html>
