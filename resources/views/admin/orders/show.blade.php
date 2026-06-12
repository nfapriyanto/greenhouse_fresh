<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan #{{ $order->id }} - Green House Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
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
            --shadow: 0 10px 30px rgba(0,0,0,.06);
        }
        body{
            font-family:'Poppins',sans-serif;
            background:var(--bg);
            color:var(--text);
        }
        a{
            text-decoration:none;
        }
        .navbar{
            background:white;
            position:sticky;
            top:0;
            z-index:999;
            box-shadow: 0 4px 20px rgba(0,0,0,.04);
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
            transition: .3s;
        }
        .back-btn:hover{
            background:#dcfce7;
            transform: translateX(-4px);
        }
        .container{
            width:92%;
            max-width:1400px;
            margin:40px auto;
        }
        .hero{
            background:linear-gradient(135deg, #16a34a, #22c55e);
            color:white;
            border-radius:34px;
            padding:44px;
            margin-bottom:30px;
            box-shadow: 0 18px 45px rgba(34,197,94,.18);
        }
        .hero h1{
            font-size:42px;
            font-weight:800;
            margin-bottom:10px;
        }
        .grid-layout{
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            gap: 28px;
            align-items: start;
        }
        .card{
            background:white;
            border-radius:28px;
            padding:30px;
            box-shadow:var(--shadow);
            border: 1px solid var(--border);
            margin-bottom: 28px;
        }
        .card h3{
            font-size: 20px;
            font-weight: 700;
            color: #166534;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .meta-list{
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .meta-item{
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            border-bottom: 1px dashed #f1f5f9;
            padding-bottom: 10px;
        }
        .meta-label{
            color: var(--gray);
            font-weight: 500;
        }
        .meta-value{
            font-weight: 600;
            color: var(--text);
            text-align: right;
        }
        .badge{
            display: inline-block;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
        }
        .badge-pending{ background: #fef3c7; color: #d97706; }
        .badge-processing{ background: #dbeafe; color: #2563eb; }
        .badge-ready_to_ship{ background: #f3e8ff; color: #9333ea; }
        .badge-shipped{ background: #ccfbf1; color: #0d9488; }
        .badge-completed{ background: #dcfce7; color: #16a34a; }
        .badge-cancelled{ background: #fee2e2; color: #dc2626; }

        table{
            width:100%;
            border-collapse:collapse;
        }
        thead{
            background:#f8fafc;
        }
        th{
            padding:16px;
            text-align:left;
            color:#475569;
            font-size:13px;
            font-weight: 600;
        }
        td{
            padding:16px;
            border-top:1px solid #f1f5f9;
            font-size: 13px;
        }
        .btn{
            border:none;
            padding:12px 20px;
            border-radius:12px;
            font-weight:700;
            cursor:pointer;
            transition: .3s;
        }
        .btn-update{
            background: var(--primary);
            color: white;
            width: 100%;
            margin-top: 14px;
        }
        .btn-update:hover{
            background: #15803d;
        }
        @media(max-width:992px){
            .grid-layout{
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<div class="navbar">
    <div class="navbar-container">
        <div class="logo">
            <img src="{{ asset('images/logo-greenhouse.png') }}" alt="Logo">
            <div>
                <h2>Green House</h2>
                <span>Admin Dashboard</span>
            </div>
        </div>
        <div class="nav-right">
            <a href="{{ route('admin.orders') }}" class="back-btn">
                ← Pesanan Masuk
            </a>
        </div>
    </div>
</div>

<div class="container">
    @if(session('success'))
        <div style="background:#dcfce7; color:#166534; padding:16px; border-radius:18px; margin-bottom:24px; border:1px solid #bbf7d0; font-weight:600;">
            {{ session('success') }}
        </div>
    @endif

    <div class="hero">
        <h1>Detail Pesanan #{{ $order->id }}</h1>
        <p>Kelola status pesanan, data pengiriman, dan tinjau item pembayaran di bawah ini.</p>
    </div>

    <div class="grid-layout">
        
        <!-- LEFT: Info and Status Update Form -->
        <div>
            <!-- Order Info -->
            <div class="card">
                <h3>📋 Ringkasan Pesanan</h3>
                <ul class="meta-list">
                    <li class="meta-item">
                        <span class="meta-label">ID Pesanan</span>
                        <span class="meta-value">#{{ $order->id }}</span>
                    </li>
                    <li class="meta-item">
                        <span class="meta-label">Tanggal Transaksi</span>
                        <span class="meta-value">{{ $order->created_at->format('d M Y H:i') }}</span>
                    </li>
                    <li class="meta-item">
                        <span class="meta-label">Status Saat Ini</span>
                        <span class="meta-value">
                            <span class="badge badge-{{ $order->status }}">
                                {{ $order->status }}
                            </span>
                        </span>
                    </li>
                    <li class="meta-item">
                        <span class="meta-label">Nama Pelanggan</span>
                        <span class="meta-value">{{ $order->user->name ?? '-' }}</span>
                    </li>
                    <li class="meta-item">
                        <span class="meta-label">Email</span>
                        <span class="meta-value">{{ $order->user->email ?? '-' }}</span>
                    </li>
                </ul>
            </div>

            <!-- Update Status Card -->
            <div class="card">
                <h3>⚙ Update Status Pesanan</h3>
                <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <label style="font-size: 13px; font-weight:600; margin-bottom:6px; display:block;">Pilih Status Baru</label>
                    <select name="status" style="width: 100%; padding: 14px; border-radius: 12px; border: 1px solid var(--border); font-family: inherit; font-size: 14px; outline:none; background:white;">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="ready_to_ship" {{ $order->status == 'ready_to_ship' ? 'selected' : '' }}>Ready to Ship</option>
                        <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>

                    <button type="submit" class="btn btn-update">
                        Update Status
                    </button>
                </form>
            </div>
        </div>

        <!-- RIGHT: Shipping & Ordered Products -->
        <div>
            <!-- Shipping Info -->
            <div class="card">
                <h3>🚚 Informasi Penerima & Pengiriman</h3>
                <ul class="meta-list">
                    <li class="meta-item">
                        <span class="meta-label">Penerima</span>
                        <span class="meta-value">{{ $order->name }}</span>
                    </li>
                    <li class="meta-item">
                        <span class="meta-label">No. Telepon / WA</span>
                        <span class="meta-value">{{ $order->phone }}</span>
                    </li>
                    <li class="meta-item">
                        <span class="meta-label">Alamat Lengkap</span>
                        <span class="meta-value" style="max-width: 300px;">{{ $order->address }}</span>
                    </li>
                    <li class="meta-item">
                        <span class="meta-label">Metode Pembayaran</span>
                        <span class="meta-value">{{ strtoupper($order->payment_method) }}</span>
                    </li>
                    @if($order->bukti_transfer)
                        <li class="meta-item" style="border:none;">
                            <span class="meta-label">Bukti Transfer</span>
                            <span class="meta-value">
                                <a href="{{ asset('storage/'.$order->bukti_transfer) }}" target="_blank" style="color: #2563eb; font-weight:700; text-decoration:underline;">Lihat Bukti</a>
                            </span>
                        </li>
                    @endif
                </ul>
            </div>

            <!-- Ordered Products -->
            <div class="card">
                <h3>📦 Daftar Produk Yang Dipesan</h3>
                <div style="overflow-x: auto; border: 1px solid var(--border); border-radius: 18px; margin-bottom: 20px;">
                    <table>
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th style="text-align: center;">Harga</th>
                                <th style="text-align: center;">Jumlah</th>
                                <th style="text-align: right;">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                            <tr>
                                <td>
                                    <strong>{{ $item->product->name ?? 'Produk' }}</strong>
                                </td>
                                <td style="text-align: center;">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                <td style="text-align: center; font-weight:700;">{{ $item->quantity }}</td>
                                <td style="text-align: right; font-weight: 700; color: var(--primary);">
                                    Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="3" style="text-align: right; font-weight: 700; color: var(--gray); font-size:14px; padding-top:20px;">GRAND TOTAL</td>
                                <td style="text-align: right; font-weight: 800; color: #166534; font-size: 18px; padding-top:20px;">
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

</body>
</html>
