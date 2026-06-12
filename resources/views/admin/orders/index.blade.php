<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Pesanan Masuk - Green House
    </title>

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

        .nav-right{

            display:flex;

            gap:14px;
        }

        .back-btn{

            background:#ecfdf5;

            color:#166534;

            padding:12px 18px;

            border-radius:14px;

            font-weight:600;
        }

        .add-btn{

            background:
            linear-gradient(
                135deg,
                #16a34a,
                #22c55e
            );

            color:white;

            padding:12px 20px;

            border-radius:14px;

            font-weight:700;
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

        .filter-top{

            display:flex;

            justify-content:space-between;

            align-items:center;

            margin-bottom:20px;
        }

        .filter-title{

            font-size:24px;

            font-weight:700;

            color:#166534;
        }

        .search-form{

            display:flex;

            gap:14px;
        }

        .search-input{

            flex:1;

            height:56px;

            border-radius:16px;

            border:1px solid var(--border);

            padding:0 18px;

            outline:none;
        }

        .search-btn{

            border:none;

            background:#f1f5f9;

            padding:0 26px;

            border-radius:16px;

            font-weight:700;

            cursor:pointer;
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

        <div class="nav-right">

            <a
                href="{{ route('admin.dashboard') }}"
                class="back-btn"
            >

                ← Dashboard

            </a>

        </div>

    </div>

</div>

<!-- CONTAINER -->

<div class="container">

    <!-- HERO -->

    <div class="hero">

        <h1>
            Pesanan Masuk
        </h1>

        <p>
            Kelola seluruh pesanan pelanggan Green House dengan tampilan modern dan nyaman.
        </p>

    </div>

    <!-- FILTER -->

    <div class="filter-card">

        <div class="filter-top">

            <div class="filter-title">

                Daftar Pesanan

            </div>

            <div>

                Total {{ $orders->count() }} Pesanan

            </div>

        </div>

        <form
            action="{{ route('admin.orders') }}"
            method="GET"
            class="search-form"
        >

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                class="search-input"
                placeholder="Cari nama pelanggan / ID pesanan..."
            >

            <button
                type="submit"
                class="search-btn"
            >

                Cari

            </button>

        </form>

    </div>

    <!-- TABLE -->

    <div class="table-card">

        <table>

            <thead>

                <tr>

                    <th>ID</th>

                    <th>Pelanggan</th>

                    <th>Total</th>

                    <th>Status</th>

                    <th>Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($orders as $order)

                <tr>

                    <td>
                        #{{ $order->id }}
                    </td>

                    <td>
                        <strong>{{ $order->name ?? $order->user->name ?? '-' }}</strong>
                        <div style="font-size: 13px; color: var(--gray); margin-top: 6px;">
                            <strong>Alamat:</strong> {{ $order->address }}<br>
                            <strong>Telp:</strong> {{ $order->phone }}<br>
                            <strong>Pengiriman:</strong> {{ ucfirst($order->shipping_method) }} | <strong>Pembayaran:</strong> {{ strtoupper($order->payment_method) }}
                            @if($order->bukti_transfer)
                                <br><strong style="color: #16a34a;">Bukti Transfer:</strong> <a href="{{ asset('storage/'.$order->bukti_transfer) }}" target="_blank" style="color: #2563eb; text-decoration: underline;">Lihat Bukti</a>
                            @endif
                        </div>
                        <div style="margin-top: 8px; border-top: 1px dashed #e2e8f0; padding-top: 6px;">
                            <span style="font-size: 12px; font-weight: 700; color: #166534;">Produk:</span>
                            <div style="font-size: 12px; color: #475569; padding-left: 6px;">
                                @foreach($order->items as $item)
                                    <div>• {{ $item->product->name ?? 'Produk' }} (x{{ $item->quantity }}) @ Rp {{ number_format($item->price,0,',','.') }}</div>
                                @endforeach
                            </div>
                        </div>
                    </td>

                    <td>
                        Rp {{ number_format($order->total_price,0,',','.') }}
                    </td>

                    <td style="min-width: 200px;">
                        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                            @csrf
                            @method('PUT')                             <select name="status" class="status-select" style="width: 100%; padding: 10px; border-radius: 10px; border: 1px solid var(--border); background: white; font-family: 'Poppins', sans-serif; font-size: 13px; outline: none;">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="ready_to_ship" {{ $order->status == 'ready_to_ship' ? 'selected' : '' }}>Ready to Ship</option>
                                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>

                            <button type="submit" class="btn" style="width: 100%; margin-top: 8px; padding: 8px 12px; background: #ecfdf5; color: #166534; border-radius: 8px; font-size: 12px; font-weight: 700;">
                                Update Status
                            </button>
                        </form>
                    </td>

                    <td>
                        <a href="{{ route('orders.show', $order->id) }}" target="_blank" style="color: #16a34a; font-weight: 700; font-size: 14px; text-decoration: underline;">
                            Detail
                        </a>
                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="5">

                        <div class="empty">

                            <div class="empty-icon">

                                📋

                            </div>

                            <h3>
                                Belum ada pesanan.
                            </h3>

                            <p>
                                Pesanan yang masuk akan muncul di sini.
                            </p>

                        </div>

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>



</body>
</html>