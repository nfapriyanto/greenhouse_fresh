<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Admin Dashboard - Green House
    </title>

    <!-- GOOGLE FONT -->

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        :root{

            --primary:#16a34a;

            --primary-dark:#15803d;

            --bg:#f5f7fb;

            --white:#ffffff;

            --text:#1e293b;

            --gray:#64748b;

            --border:#e2e8f0;

            --danger:#ef4444;

            --shadow:
            0 10px 30px rgba(0,0,0,.06);

        }

        body{

            font-family:'Poppins',sans-serif;

            background:var(--bg);

            color:var(--text);
        }

        a{
            text-decoration:none;
        }

        /*
        |--------------------------------------------------------------------------
        | NAVBAR
        |--------------------------------------------------------------------------
        */

        .navbar{

            background:white;

            position:sticky;

            top:0;

            z-index:999;

            box-shadow:
            0 4px 20px rgba(0,0,0,.04);
        }

        .navbar-container{

            width:92%;

            max-width:1400px;

            margin:auto;

            padding:18px 0;

            display:flex;

            justify-content:space-between;

            align-items:center;
        }

        .logo{

            display:flex;

            align-items:center;

            gap:14px;
        }

        .logo img{

            width:58px;

            height:58px;

            object-fit:cover;

            border-radius:50%;
        }

        .logo h2{

            font-size:32px;

            font-weight:800;

            color:#166534;

            line-height:1;
        }

        .logo span{

            font-size:13px;

            color:var(--gray);
        }

        .nav-right{

            display:flex;

            align-items:center;

            gap:18px;
        }

        .admin-badge{

            background:#ecfdf5;

            color:#166534;

            padding:10px 16px;

            border-radius:14px;

            font-weight:600;
        }

        .logout-btn{

            border:none;

            background:#ef4444;

            color:white;

            padding:12px 20px;

            border-radius:14px;

            font-weight:700;

            cursor:pointer;

            transition:.3s;
        }

        .logout-btn:hover{

            background:#dc2626;
        }

        /*
        |--------------------------------------------------------------------------
        | CONTAINER
        |--------------------------------------------------------------------------
        */

        .container{

            width:92%;

            max-width:1400px;

            margin:40px auto;
        }

        /*
        |--------------------------------------------------------------------------
        | HERO
        |--------------------------------------------------------------------------
        */

        .hero{

            background:
            linear-gradient(
                135deg,
                #16a34a,
                #22c55e
            );

            color:white;

            border-radius:34px;

            padding:50px;

            margin-bottom:35px;

            box-shadow:
            0 18px 45px rgba(34,197,94,.18);
        }

        .hero h1{

            font-size:48px;

            font-weight:800;

            margin-bottom:12px;
        }

        .hero p{

            font-size:17px;

            opacity:.95;
        }

        /*
        |--------------------------------------------------------------------------
        | MENU
        |--------------------------------------------------------------------------
        */

        .menu-grid{

            display:grid;

            grid-template-columns:
            repeat(auto-fit,minmax(240px,1fr));

            gap:24px;

            margin-bottom:35px;
        }

        .menu-card{

            background:white;

            border-radius:24px;

            padding:26px;

            box-shadow:var(--shadow);

            transition:.3s;

            border:1px solid #eef2f7;

            display:block;

            color:inherit;
        }

        .menu-card:hover{

            transform:
            translateY(-6px);

            box-shadow:
            0 18px 34px rgba(0,0,0,.08);
        }

        .menu-icon{

            width:58px;

            height:58px;

            border-radius:18px;

            background:#ecfdf5;

            display:flex;

            align-items:center;

            justify-content:center;

            font-size:28px;

            margin-bottom:18px;
        }

        .menu-card h3{

            font-size:22px;

            margin-bottom:10px;

            color:#166534;
        }

        .menu-card p{

            color:var(--gray);

            line-height:1.7;

            font-size:14px;
        }

        /*
        |--------------------------------------------------------------------------
        | STATS
        |--------------------------------------------------------------------------
        */

        .stats-grid{

            display:grid;

            grid-template-columns:
            repeat(auto-fit,minmax(250px,1fr));

            gap:24px;

            margin-bottom:35px;
        }

        .stat-card{

            background:white;

            border-radius:24px;

            padding:28px;

            box-shadow:var(--shadow);

            border:1px solid #eef2f7;
        }

        .stat-title{

            color:var(--gray);

            margin-bottom:14px;

            font-size:15px;
        }

        .stat-value{

            font-size:42px;

            font-weight:800;

            color:#16a34a;
        }

        /*
        |--------------------------------------------------------------------------
        | REPORT
        |--------------------------------------------------------------------------
        */

        .report-card{

            background:white;

            border-radius:28px;

            padding:30px;

            box-shadow:var(--shadow);

            border:1px solid #eef2f7;
        }

        .report-title{

            font-size:28px;

            font-weight:700;

            margin-bottom:24px;

            color:#166534;
        }

        .form-grid{

            display:grid;

            grid-template-columns:
            repeat(auto-fit,minmax(250px,1fr));

            gap:20px;

            margin-bottom:24px;
        }

        label{

            display:block;

            margin-bottom:8px;

            font-weight:600;
        }

        input{

            width:100%;

            height:56px;

            border-radius:16px;

            border:1px solid var(--border);

            padding:0 18px;

            outline:none;

            font-family:'Poppins',sans-serif;
        }

        /*
        |--------------------------------------------------------------------------
        | BUTTON
        |--------------------------------------------------------------------------
        */

        .btn-group{

            display:flex;

            flex-wrap:wrap;

            gap:14px;
        }

        .btn{

            border:none;

            padding:14px 24px;

            border-radius:16px;

            font-weight:700;

            cursor:pointer;

            font-family:'Poppins',sans-serif;
        }

        .btn-primary{

            background:
            linear-gradient(
                135deg,
                #16a34a,
                #22c55e
            );

            color:white;
        }

        .btn-light{

            background:#f1f5f9;

            color:#334155;
        }

        /*
        |--------------------------------------------------------------------------
        | MOBILE
        |--------------------------------------------------------------------------
        */

        @media(max-width:768px){

            .navbar-container{

                flex-direction:column;

                gap:18px;
            }

            .hero{

                padding:36px;
            }

            .hero h1{

                font-size:34px;
            }

            .logo h2{

                font-size:26px;
            }

            .stat-value{

                font-size:34px;
            }

        }

    </style>

</head>

<body>

<!-- NAVBAR -->

<div class="navbar">

    <div class="navbar-container">

        <div class="logo">

            <img
                src="{{ asset('images/logo-greenhouse.png') }}"
                alt="Logo"
            >

            <div>

                <h2>
                    Green House
                </h2>

                <span>
                    Admin Dashboard
                </span>

            </div>

        </div>

        <div class="nav-right">

            <div class="admin-badge">

                👤 Halo, Super Admin

            </div>

            <form
                action="{{ route('admin.logout') }}"
                method="POST"
            >

                @csrf

                <button class="logout-btn">

                    Logout

                </button>

            </form>

        </div>

    </div>

</div>

<!-- CONTAINER -->

<div class="container">

    <!-- HERO -->

    <div class="hero">

        <h1>
            Dashboard Admin
        </h1>

        <p>
            Kelola toko Green House dengan tampilan modern dan lebih nyaman.
        </p>

    </div>

    <!-- MENU -->

    <div class="menu-grid">

        <!-- PRODUK -->

        <a
            href="{{ route('admin.products.index') }}"
            class="menu-card"
        >

            <div class="menu-icon">
                📦
            </div>

            <h3>
                Kelola Produk
            </h3>

            <p>
                Tambah, edit, dan hapus produk toko Green House.
            </p>

        </a>

        <!-- PESANAN -->

        <a
            href="{{ route('admin.orders') }}"
            class="menu-card"
        >

            <div class="menu-icon">
                🛒
            </div>

            <h3>
                Kelola Pesanan
            </h3>

            <p>
                Update status dan lihat seluruh pesanan customer.
            </p>

        </a>

        <!-- SUPPLIER -->

        <a
            href="{{ route('admin.suppliers.index') }}"
            class="menu-card"
        >

            <div class="menu-icon">
                🚚
            </div>

            <h3>
                Supplier
            </h3>

            <p>
                Kelola supplier dan data pemasok barang toko.
            </p>

        </a>

        <!-- LAPORAN -->

        <a
            href="{{ route('admin.reports.sales.index') }}"
            class="menu-card"
        >

            <div class="menu-icon">
                📊
            </div>

            <h3>
                Laporan
            </h3>

            <p>
                Export laporan penjualan ke Excel dan PDF.
            </p>

        </a>

    </div>

    <!-- STATS -->

    <div class="stats-grid">

        <div class="stat-card">

            <div class="stat-title">

                Total Produk

            </div>

            <div class="stat-value">

                {{ $stats['product_count'] }}

            </div>

        </div>

        <div class="stat-card">

            <div class="stat-title">

                Total Pesanan

            </div>

            <div class="stat-value">

                {{ $stats['order_count'] }}

            </div>

        </div>

        <a href="{{ route('admin.customers.index') }}" class="stat-card" style="text-decoration: none; display: block; color: inherit; cursor: pointer; transition: .3s; border: 1px solid #eef2f7;">

            <div class="stat-title">

                Total Pelanggan

            </div>

            <div class="stat-value">

                {{ $stats['customer_count'] }}

            </div>

        </a>

        <div class="stat-card">

            <div class="stat-title">

                Total Pendapatan (Penjualan)

            </div>

            <div class="stat-value" style="font-size: 28px; line-height: 1.8;">

                Rp {{ number_format($stats['revenue_sum'], 0, ',', '.') }}

            </div>

        </div>

    </div>

    <!-- MAIN DASHBOARD CONTENT -->
    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px; align-items: start;">
        
        <!-- LEFT COLUMN: Chart -->
        <div>
            <div style="background: white; border-radius: 28px; padding: 30px; box-shadow: var(--shadow); border: 1px solid #eef2f7; margin-bottom: 24px;">
                <h3 style="font-size: 22px; color: #166534; margin-bottom: 20px; font-weight: 700;">Grafik Perkembangan Penjualan (7 Hari Terakhir)</h3>
                <canvas id="salesChart" style="max-height: 350px; width: 100%;"></canvas>
            </div>
            
            <!-- TOP 5 PRODUCTS -->
            <div style="background: white; border-radius: 28px; padding: 28px; box-shadow: var(--shadow); border: 1px solid #eef2f7;">
                <h3 style="font-size: 20px; color: #166534; margin-bottom: 18px; font-weight: 700;">🛒 Produk Terlaris (Top 5)</h3>
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: #f8fafc;">
                            <th style="padding: 12px 16px; text-align: left; font-size: 13px; color: #475569;">Produk</th>
                            <th style="padding: 12px 16px; text-align: center; font-size: 13px; color: #475569;">Total Terjual</th>
                            <th style="padding: 12px 16px; text-align: right; font-size: 13px; color: #475569;">Harga Satuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($topProducts as $item)
                        <tr>
                            <td style="padding: 14px 16px; border-top: 1px solid #f1f5f9; font-weight: 600;">
                                {{ $item->product->name ?? 'Produk dihapus' }}
                            </td>
                            <td style="padding: 14px 16px; border-top: 1px solid #f1f5f9; text-align: center; font-weight: bold; color: #16a34a;">
                                {{ $item->total_sold }} item
                            </td>
                            <td style="padding: 14px 16px; border-top: 1px solid #f1f5f9; text-align: right; color: #475569;">
                                Rp {{ number_format($item->product->price ?? 0, 0, ',', '.') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" style="padding: 20px; text-align: center; color: #64748b;">Belum ada penjualan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- RIGHT COLUMN: Low Stock -->
        <div>
            <div style="background: white; border-radius: 28px; padding: 28px; box-shadow: var(--shadow); border: 1px solid #eef2f7;">
                <h3 style="font-size: 20px; color: #b91c1c; margin-bottom: 18px; font-weight: 700;">⚠️ Stok Menipis (&lt; 5)</h3>
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: #fdf2f2;">
                            <th style="padding: 12px 16px; text-align: left; font-size: 13px; color: #b91c1c;">Produk</th>
                            <th style="padding: 12px 16px; text-align: right; font-size: 13px; color: #b91c1c;">Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($lowStockProducts as $product)
                        <tr>
                            <td style="padding: 14px 16px; border-top: 1px solid #f1f5f9; font-weight: 600;">
                                {{ $product->name }}
                            </td>
                            <td style="padding: 14px 16px; border-top: 1px solid #f1f5f9; text-align: right; font-weight: bold; color: #ef4444;">
                                {{ $product->stock }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" style="padding: 20px; text-align: center; color: #166534; font-weight: 600;">Semua produk memiliki stok aman! ✨</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>

<!-- CHART.JS INTEGRATION -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('salesChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($chartLabels) !!},
            datasets: [{
                label: 'Penjualan (Rp)',
                data: {!! json_encode($chartValues) !!},
                borderColor: '#16a34a',
                backgroundColor: 'rgba(22, 163, 74, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.3,
                pointBackgroundColor: '#16a34a',
                pointRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            }
        }
    });
});
</script>

</body>
</html>