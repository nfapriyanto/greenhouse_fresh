<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pelanggan - {{ $customer->name }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
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
            font-size:32px;
            font-weight:800;
            color:#166534;
            line-height:1;
        }
        .logo span{
            font-size:13px;
            color:var(--gray);
        }
        .back-btn{
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #ecfdf5;
            color: #166534;
            padding: 12px 20px;
            border-radius: 14px;
            font-weight: 700;
            transition: .3s;
        }
        .back-btn:hover{
            background: #dcfce7;
            transform: translateX(-4px);
        }
        .container{
            width:92%;
            max-width:1400px;
            margin:40px auto;
        }
        .profile-card{
            background: white;
            border-radius: 30px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
            border: 1px solid var(--border);
        }
        .profile-info{
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .profile-avatar{
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: #ecfdf5;
            color: #16a34a;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            font-weight: bold;
        }
        .profile-meta h1{
            font-size: 24px;
            font-weight: 800;
            color: #166534;
        }
        .profile-meta p{
            font-size: 14px;
            color: var(--gray);
            margin-top: 4px;
        }
        .profile-stats{
            display: flex;
            gap: 20px;
        }
        .stat-box{
            background: #f8fafc;
            border: 1px solid var(--border);
            padding: 16px 24px;
            border-radius: 20px;
            text-align: center;
        }
        .stat-box-title{
            font-size: 12px;
            color: var(--gray);
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        .stat-box-val{
            font-size: 20px;
            font-weight: 800;
            color: var(--text);
            margin-top: 6px;
        }
        .section-title{
            font-size: 22px;
            font-weight: 800;
            color: #166534;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .table-card{
            background:white;
            border-radius:30px;
            overflow:hidden;
            box-shadow:var(--shadow);
            border: 1px solid var(--border);
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
            font-weight: 600;
        }
        td{
            padding:22px;
            border-top:1px solid #f1f5f9;
            font-size: 14px;
            vertical-align: top;
        }
        .order-id{
            font-weight: 700;
            color: var(--text);
        }
        .order-date{
            font-size: 13px;
            color: var(--gray);
            margin-top: 4px;
        }
        .badge{
            display: inline-block;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
        }
        .badge-pending{
            background: #fef3c7;
            color: #d97706;
        }
        .badge-processing{
            background: #dbeafe;
            color: #2563eb;
        }
        .badge-ready_to_ship{
            background: #f3e8ff;
            color: #9333ea;
        }
        .badge-shipped{
            background: #ccfbf1;
            color: #0d9488;
        }
        .badge-completed{
            background: #dcfce7;
            color: #16a34a;
        }
        .badge-cancelled{
            background: #fee2e2;
            color: #dc2626;
        }
        .action-link{
            color: #16a34a;
            font-weight: 700;
            transition: .3s;
        }
        .action-link:hover{
            color: #15803d;
            text-decoration: underline;
        }
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
        @media(max-width:768px){
            .navbar-container{
                flex-direction:column;
                gap:18px;
            }
            .profile-card{
                flex-direction: column;
                align-items: flex-start;
            }
            .profile-stats{
                width: 100%;
                justify-content: space-between;
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
            <a href="{{ route('admin.customers.index') }}" class="back-btn">
                ← Daftar Pelanggan
            </a>
        </div>
    </div>
</div>

<div class="container">
    <div class="profile-card">
        <div class="profile-info">
            <div class="profile-avatar">
                {{ strtoupper(substr($customer->name, 0, 1)) }}
            </div>
            <div class="profile-meta">
                <h1>{{ $customer->name }}</h1>
                <p>✉ {{ $customer->email }}</p>
                <p style="font-size:12px; margin-top:8px;">Terdaftar sejak: <strong>{{ $customer->created_at ? $customer->created_at->format('d F Y H:i') : '-' }}</strong></p>
            </div>
        </div>
        <div class="profile-stats">
            <div class="stat-box">
                <div class="stat-box-title">Total Belanja</div>
                <div class="stat-box-val" style="color: #16a34a;">
                    Rp {{ number_format($customer->total_spent ?? 0, 0, ',', '.') }}
                </div>
            </div>
            <div class="stat-box">
                <div class="stat-box-title">Total Pesanan</div>
                <div class="stat-box-val">
                    {{ $customer->orders_count }}
                </div>
            </div>
        </div>
    </div>

    <div class="section-title">
        <span>📋</span> Riwayat Pembelian Pelanggan
    </div>

    <div class="table-card">
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Detail Pengiriman</th>
                    <th>Produk</th>
                    <th>Metode</th>
                    <th>Total Belanja</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td>
                        <span class="order-id">#{{ $order->id }}</span>
                        <div class="order-date">{{ $order->created_at->format('d M Y H:i') }}</div>
                    </td>
                    <td>
                        <div style="font-size: 13px; color: var(--text);">
                            <strong>Penerima:</strong> {{ $order->name }}<br>
                            <strong>Telp:</strong> {{ $order->phone }}<br>
                            <strong>Alamat:</strong> {{ $order->address }}
                        </div>
                    </td>
                    <td>
                        <div style="font-size: 13px; color: #475569;">
                            @foreach($order->items as $item)
                                <div>• {{ $item->product->name ?? 'Produk' }} (x{{ $item->quantity }})</div>
                            @endforeach
                        </div>
                    </td>
                    <td>
                        <div style="font-size: 12px; font-weight: 600;">
                            🚚 {{ strtoupper($order->shipping_method ?? 'None') }}<br>
                            💳 {{ strtoupper($order->payment_method ?? 'Midtrans') }}
                        </div>
                    </td>
                    <td style="font-weight: 700; color: #166534;">
                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                    </td>
                    <td>
                        <span class="badge badge-{{ $order->status }}">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="action-link">
                            Detail →
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">
                        <div class="empty">
                            <div class="empty-icon">🛒</div>
                            <h3>Belum Ada Transaksi</h3>
                            <p>Pelanggan ini belum melakukan pembelian produk.</p>
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
