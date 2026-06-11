<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Laporan Penjualan - Green House
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

            --bg:#f5f7fb;

            --white:#ffffff;

            --text:#1e293b;

            --gray:#64748b;

            --border:#e2e8f0;

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

            font-size:30px;

            font-weight:800;

            color:#166534;
        }

        .logo span{

            font-size:13px;

            color:var(--gray);
        }

        .back-btn{

            background:#ecfdf5;

            color:#166534;

            padding:12px 18px;

            border-radius:14px;

            font-weight:600;
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

            padding:44px;

            margin-bottom:30px;

            box-shadow:
            0 18px 45px rgba(34,197,94,.18);
        }

        .hero h1{

            font-size:46px;

            font-weight:800;

            margin-bottom:10px;
        }

        .hero p{

            font-size:16px;

            opacity:.95;
        }

        /*
        |--------------------------------------------------------------------------
        | FILTER
        |--------------------------------------------------------------------------
        */

        .filter-card{

            background:white;

            border-radius:28px;

            padding:24px;

            margin-bottom:28px;

            box-shadow:var(--shadow);
        }

        .filter-grid{

            display:grid;

            grid-template-columns:
            repeat(auto-fit,minmax(220px,1fr));

            gap:18px;

            margin-bottom:24px;
        }

        .form-group{

            display:flex;

            flex-direction:column;

            gap:8px;
        }

        .form-group label{

            font-weight:600;

            color:#334155;
        }

        .form-control{

            height:54px;

            border-radius:16px;

            border:1px solid var(--border);

            padding:0 16px;

            font-family:'Poppins',sans-serif;

            outline:none;
        }

        .form-control:focus{

            border-color:#16a34a;
        }

        .filter-actions{

            display:flex;

            gap:14px;

            flex-wrap:wrap;
        }

        .btn{

            border:none;

            padding:14px 22px;

            border-radius:16px;

            font-weight:700;

            cursor:pointer;

            transition:.3s;
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

        .btn-secondary{

            background:#ecfdf5;

            color:#166534;
        }

        /*
        |--------------------------------------------------------------------------
        | SUMMARY
        |--------------------------------------------------------------------------
        */

        .summary{

            display:grid;

            grid-template-columns:
            repeat(auto-fit,minmax(240px,1fr));

            gap:20px;

            margin-bottom:30px;
        }

        .summary-card{

            background:white;

            border-radius:26px;

            padding:28px;

            box-shadow:var(--shadow);
        }

        .summary-title{

            color:#64748b;

            font-size:14px;

            margin-bottom:10px;
        }

        .summary-value{

            font-size:34px;

            font-weight:800;

            color:#166534;
        }

        /*
        |--------------------------------------------------------------------------
        | TABLE
        |--------------------------------------------------------------------------
        */

        .table-card{

            background:white;

            border-radius:30px;

            overflow:hidden;

            box-shadow:var(--shadow);
        }

        table{

            width:100%;

            border-collapse:collapse;
        }

        thead{

            background:#f8fafc;
        }

        th{

            padding:22px;

            text-align:left;

            color:#475569;

            font-size:14px;
        }

        td{

            padding:22px;

            border-top:1px solid #f1f5f9;
        }

        tbody tr:hover{

            background:#fafafa;
        }

        /*
        |--------------------------------------------------------------------------
        | STATUS
        |--------------------------------------------------------------------------
        */

        .status{

            display:inline-block;

            padding:8px 14px;

            border-radius:999px;

            font-size:13px;

            font-weight:700;
        }

        .completed{

            background:#dcfce7;

            color:#166534;
        }

        .pending{

            background:#fef9c3;

            color:#854d0e;
        }

        .waiting_verification {
            background: #ffe4e6;
            color: #9f1239;
        }

        .processing {
            background: #dbeafe;
            color: #1e40af;
        }

        .packing {
            background: #ffedd5;
            color: #9a3412;
        }

        .shipped {
            background: #e0f2fe;
            color: #0369a1;
        }

        .cancelled {
            background: #f1f5f9;
            color: #334155;
        }

        /*
        |--------------------------------------------------------------------------
        | EMPTY
        |--------------------------------------------------------------------------
        */

        .empty{

            text-align:center;

            padding:70px 20px;

            color:#64748b;
        }

        .empty-icon{

            width:110px;

            height:110px;

            border-radius:50%;

            background:#ecfdf5;

            display:flex;

            align-items:center;

            justify-content:center;

            margin:auto auto 20px;

            font-size:42px;
        }

        .empty h3{

            font-size:28px;

            color:#166534;

            margin-bottom:10px;
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

        <a
            href="{{ route('admin.dashboard') }}"
            class="back-btn"
        >

            ← Dashboard

        </a>

    </div>

</div>

<!-- CONTAINER -->

<div class="container">

    <!-- HERO -->

    <div class="hero">

        <h1>
            Laporan Penjualan
        </h1>

        <p>
            Kelola dan pantau seluruh laporan transaksi Green House dengan tampilan modern.
        </p>

    </div>

    <!-- FILTER -->

    <div class="filter-card">

        <form method="GET" action="{{ route('admin.reports.sales.index') }}">

            <div class="filter-grid">

                <div class="form-group">

                    <label>
                        Dari Tanggal
                    </label>

                    <input
                        type="date"
                        name="from"
                        value="{{ $from }}"
                        class="form-control"
                    >

                </div>

                <div class="form-group">

                    <label>
                        Sampai Tanggal
                    </label>

                    <input
                        type="date"
                        name="to"
                        value="{{ $to }}"
                        class="form-control"
                    >

                </div>

                <div class="form-group">

                    <label>
                        Status
                    </label>

                    <select name="status" class="form-control">

                        <option value="completed" {{ $status == 'completed' ? 'selected' : '' }}>
                            Selesai (Completed)
                        </option>

                        <option value="pending" {{ $status == 'pending' ? 'selected' : '' }}>
                            Belum Dibayar (Pending)
                        </option>

                        <option value="waiting_verification" {{ $status == 'waiting_verification' ? 'selected' : '' }}>
                            Menunggu Verifikasi
                        </option>

                        <option value="processing" {{ $status == 'processing' ? 'selected' : '' }}>
                            Diproses
                        </option>

                        <option value="packing" {{ $status == 'packing' ? 'selected' : '' }}>
                            Dikemas
                        </option>

                        <option value="shipped" {{ $status == 'shipped' ? 'selected' : '' }}>
                            Dikirim
                        </option>

                        <option value="cancelled" {{ $status == 'cancelled' ? 'selected' : '' }}>
                            Dibatalkan
                        </option>

                        <option value="" {{ $status === '' ? 'selected' : '' }}>
                            Semua Status
                        </option>

                    </select>

                </div>

            </div>

            <div class="filter-actions">

                <button
                    type="submit"
                    class="btn btn-primary"
                >

                    Terapkan Filter

                </button>

                <a
                    href="{{ route('admin.reports.sales.export.csv', request()->query()) }}"
                    class="btn btn-secondary"
                    style="text-decoration:none; display:inline-block; text-align:center;"
                >

                    Export Excel

                </a>

                <a
                    href="{{ route('admin.reports.sales.export.pdf', request()->query()) }}"
                    class="btn btn-secondary"
                    style="text-decoration:none; display:inline-block; text-align:center;"
                >

                    Export PDF

                </a>

            </div>

        </form>

    </div>

    <!-- SUMMARY -->

    <div class="summary">

        <div class="summary-card">

            <div class="summary-title">

                Total Transaksi

            </div>

            <div class="summary-value">

                {{ $summary['count'] }}

            </div>

        </div>

        <div class="summary-card">

            <div class="summary-title">

                Total Penjualan

            </div>

            <div class="summary-value">

                Rp {{ number_format($summary['total'],0,',','.') }}

            </div>

        </div>

    </div>

    <!-- TABLE -->

    <div class="table-card">

        <table>

            <thead>

                <tr>

                    <th>ID</th>

                    <th>Tanggal</th>

                    <th>Pelanggan</th>

                    <th>Status</th>

                    <th>Total</th>

                </tr>

            </thead>

            <tbody>

                @forelse($orders as $order)

                <tr>

                    <td>

                        #{{ $order->id }}

                    </td>

                    <td>

                        {{ optional($order->created_at)->format('Y-m-d H:i') }}

                    </td>

                    <td>

                        {{ $order->name ?? $order->user->name ?? '-' }}

                    </td>

                    <td>

                        <span class="status {{ $order->status }}">

                            {{ ucwords(str_replace('_', ' ', $order->status)) }}

                        </span>

                    </td>

                    <td>

                        Rp {{ number_format($order->total_price,0,',','.') }}

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="5">

                        <div class="empty">

                            <div class="empty-icon">

                                📊

                            </div>

                            <h3>
                                Belum ada laporan.
                            </h3>

                            <p>
                                Data laporan penjualan akan muncul di sini.
                            </p>

                        </div>

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    @if(method_exists($orders, 'links') && $orders->links())
        <div style="margin-top: 25px;">
            {{ $orders->links() }}
        </div>
    @endif

</div>

</body>
</html>