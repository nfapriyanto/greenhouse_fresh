<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pelanggan - Green House</title>
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
        .hero{
            background:linear-gradient(135deg, #15803d, #16a34a);
            color:white;
            border-radius:34px;
            padding:44px;
            margin-bottom:30px;
            box-shadow: 0 18px 45px rgba(34,197,94,.18);
        }
        .hero h1{
            font-size:46px;
            font-weight:800;
            margin-bottom:10px;
        }
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
            width: 100%;
        }
        .search-input{
            flex:1;
            height:56px;
            border-radius:16px;
            border:1px solid var(--border);
            padding:0 18px;
            outline:none;
            font-family: inherit;
            font-size: 14px;
        }
        .search-btn{
            border:none;
            background:#16a34a;
            color: white;
            padding:0 26px;
            border-radius:16px;
            font-weight:700;
            cursor:pointer;
            transition: .3s;
        }
        .search-btn:hover{
            background:#15803d;
        }
        .clear-btn{
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 56px;
            border: 1px solid var(--border);
            background: white;
            color: var(--gray);
            padding: 0 20px;
            border-radius: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: .3s;
        }
        .clear-btn:hover{
            background: #f8fafc;
            color: var(--text);
        }
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
            font-weight: 600;
        }
        td{
            padding:22px;
            border-top:1px solid #f1f5f9;
            font-size: 14px;
        }
        .customer-name{
            font-weight: 700;
            color: var(--text);
        }
        .customer-email{
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
        }
        .badge-orders{
            background: #ecfdf5;
            color: #166534;
        }
        .badge-spent{
            background: #fef3c7;
            color: #92400e;
        }
        .action-link{
            color: #16a34a;
            font-weight: 700;
            transition: .3s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
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
            .hero{
                padding:36px;
            }
            .hero h1{
                font-size:34px;
            }
            .logo h2{
                font-size:26px;
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
            <a href="{{ route('admin.dashboard') }}" class="back-btn">
                ← Dashboard
            </a>
        </div>
    </div>
</div>

<div class="container">
    <div class="hero">
        <h1>Daftar Pelanggan</h1>
        <p>Kelola dan analisis riwayat transaksi serta detail belanja dari pelanggan Green House.</p>
    </div>

    <div class="filter-card">
        <form action="{{ route('admin.customers.index') }}" method="GET" class="search-form">
            <input 
                type="text" 
                name="q" 
                value="{{ $q }}" 
                placeholder="Cari nama atau email pelanggan..." 
                class="search-input"
            >
            <button type="submit" class="search-btn">Cari</button>
            @if($q)
                <a href="{{ route('admin.customers.index') }}" class="clear-btn">Reset</a>
            @endif
        </form>
    </div>

    <div class="table-card">
        <table>
            <thead>
                <tr>
                    <th>Pelanggan</th>
                    <th>Tanggal Bergabung</th>
                    <th>Jumlah Pesanan</th>
                    <th>Total Transaksi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($customers as $customer)
                <tr>
                    <td>
                        <div class="customer-name">{{ $customer->name }}</div>
                        <div class="customer-email">✉ {{ $customer->email }}</div>
                    </td>
                    <td>
                        {{ $customer->created_at ? $customer->created_at->format('d M Y') : '-' }}
                    </td>
                    <td>
                        <span class="badge badge-orders">
                            📦 {{ $customer->orders_count }} Pesanan
                        </span>
                    </td>
                    <td>
                        <span class="badge badge-spent">
                            Rp {{ number_format($customer->total_spent ?? 0, 0, ',', '.') }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.customers.show', $customer->id) }}" class="action-link">
                            Lihat Riwayat →
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">
                        <div class="empty">
                            <div class="empty-icon">👥</div>
                            <h3>Tidak Ada Pelanggan</h3>
                            <p>Data pelanggan tidak ditemukan atau belum ada registrasi.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if(method_exists($customers, 'links') && $customers->links())
        <div style="margin-top: 25px;">
            {{ $customers->links() }}
        </div>
    @endif
</div>

</body>
</html>
