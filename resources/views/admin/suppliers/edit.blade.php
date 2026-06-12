<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Supplier - Green House</title>
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
        .layout-grid{
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
        .form-group{
            margin-bottom: 20px;
        }
        label{
            display:block;
            margin-bottom:8px;
            font-weight:600;
            font-size: 14px;
            color: var(--text);
        }
        input, textarea{
            width:100%;
            padding:14px;
            border:1px solid var(--border);
            border-radius:12px;
            outline: none;
            font-family: inherit;
            font-size: 14px;
            transition: .3s;
        }
        input:focus, textarea:focus{
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.1);
        }
        .btn-submit{
            width: 100%;
            background: var(--primary);
            color: white;
            border: none;
            padding: 14px;
            border-radius: 12px;
            cursor: pointer;
            font-weight: 700;
            font-size: 15px;
            transition: .3s;
        }
        .btn-submit:hover{
            background: #15803d;
        }
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
        .empty{
            text-align:center;
            padding:50px 20px;
            color:#64748b;
        }
        .empty-icon{
            font-size: 36px;
            margin-bottom: 12px;
        }
        @media(max-width:992px){
            .layout-grid{
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
            <a href="{{ route('admin.suppliers.index') }}" class="back-btn">
                ← Daftar Supplier
            </a>
        </div>
    </div>
</div>

<div class="container">
    <div class="hero">
        <h1>Edit Supplier: {{ $supplier->name }}</h1>
        <p>Perbarui informasi detail supplier atau pantau produk yang disuplai di bawah ini.</p>
    </div>

    <div class="layout-grid">
        <!-- LEFT Column: Edit Form -->
        <div class="card">
            <h3>📝 Informasi Supplier</h3>
            
            <form action="{{ route('admin.suppliers.update', $supplier->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Nama Supplier</label>
                    <input type="text" name="name" value="{{ old('name', $supplier->name) }}" required>
                </div>

                <div class="form-group">
                    <label>No HP</label>
                    <input type="text" name="phone" value="{{ old('phone', $supplier->phone) }}">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email', $supplier->email) }}">
                </div>

                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="address" rows="3">{{ old('address', $supplier->address) }}</textarea>
                </div>

                <div class="form-group">
                    <label>Pilih Produk Yang Disuplai</label>
                    <div style="max-height: 220px; overflow-y: auto; border: 1px solid var(--border); border-radius: 12px; padding: 12px; display: flex; flex-direction: column; gap: 10px; background: #fafafa;">
                        @foreach($allProducts as $product)
                            @php
                                $isChecked = $product->supplier_id === $supplier->id;
                            @endphp
                            <label style="display: flex; align-items: center; gap: 10px; font-weight: normal; margin: 0; cursor: pointer; font-size: 13px; color: var(--text);">
                                <input type="checkbox" name="products[]" value="{{ $product->id }}" {{ $isChecked ? 'checked' : '' }} style="width: 18px; height: 18px; cursor: pointer; accent-color: var(--primary);">
                                <span>
                                    <strong>{{ $product->name }}</strong>
                                    <span style="font-size: 11px; color: var(--gray);"> (Rp {{ number_format($product->price, 0, ',', '.') }} | Kategori: {{ $product->category }})</span>
                                    @if($product->supplier && $product->supplier_id !== $supplier->id)
                                        <span style="font-size: 11px; color: #b91c1c; font-weight:600;"> [Suplier: {{ $product->supplier->name }}]</span>
                                    @endif
                                </span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <button type="submit" class="btn-submit">
                    Simpan Perubahan
                </button>
            </form>
        </div>

        <!-- RIGHT Column: Products List -->
        <div class="card">
            <h3>📦 Produk yang Disuplai</h3>
            
            <div style="overflow-x: auto; border: 1px solid var(--border); border-radius: 18px;">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($supplier->products as $product)
                        <tr>
                            <td>#{{ $product->id }}</td>
                            <td>
                                <strong>{{ $product->name }}</strong>
                            </td>
                            <td>
                                <span style="display:inline-block; padding: 4px 8px; border-radius: 8px; font-size: 11px; font-weight:700; background:#ecfdf5; color:#166534; text-transform:uppercase;">
                                    {{ $product->category }}
                                </span>
                            </td>
                            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td>
                                <span style="font-weight: 700; color: {{ $product->stock < 5 ? '#ef4444' : '#1e293b' }};">
                                    {{ $product->stock }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty">
                                    <div class="empty-icon">📦</div>
                                    <p>Supplier ini belum menyuplai produk apapun.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>
