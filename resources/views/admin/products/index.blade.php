<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Kelola Produk - Green House
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

            font-size:30px;

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

            gap:14px;
        }

        .back-btn{

            background:#ecfdf5;

            color:#166534;

            padding:12px 18px;

            border-radius:14px;

            font-weight:600;

            transition:.3s;
        }

        .back-btn:hover{

            background:#dcfce7;
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

            transition:.3s;
        }

        .add-btn:hover{

            transform:translateY(-2px);

            box-shadow:
            0 12px 24px rgba(22,163,74,.18);
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

        .filter-top{

            display:flex;

            justify-content:space-between;

            align-items:center;

            margin-bottom:20px;

            flex-wrap:wrap;

            gap:12px;
        }

        .filter-title{

            font-size:24px;

            font-weight:700;

            color:#166534;
        }

        .product-total{

            color:var(--gray);

            font-size:14px;
        }

        .search-form{

            display:flex;

            gap:14px;

            flex-wrap:wrap;
        }

        .search-input{

            flex:1;

            min-width:260px;

            height:56px;

            border-radius:16px;

            border:1px solid var(--border);

            padding:0 18px;

            font-family:'Poppins',sans-serif;

            outline:none;

            transition:.3s;
        }

        .search-input:focus{

            border-color:var(--primary);

            box-shadow:
            0 0 0 4px rgba(22,163,74,.12);
        }

        .search-btn{

            border:none;

            background:#f1f5f9;

            color:#334155;

            padding:0 26px;

            border-radius:16px;

            font-weight:700;

            cursor:pointer;

            transition:.3s;
        }

        .search-btn:hover{

            background:#e2e8f0;
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

        .table-wrap{

            overflow-x:auto;
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

            font-weight:700;
        }

        td{

            padding:22px;

            border-top:1px solid #f1f5f9;

            vertical-align:middle;
        }

        tbody tr{

            transition:.2s;
        }

        tbody tr:hover{

            background:#fafafa;
        }

        /*
        |--------------------------------------------------------------------------
        | PRODUCT
        |--------------------------------------------------------------------------
        */

        .product-info{

            display:flex;

            align-items:center;

            gap:18px;

            min-width:280px;
        }

        .product-image{

            width:80px;

            height:80px;

            object-fit:cover;

            border-radius:18px;

            border:1px solid #e2e8f0;

            background:#f8fafc;

            padding:4px;

            display:block;

            flex-shrink:0;
        }

        .product-name{

            font-size:16px;

            font-weight:700;

            color:#166534;

            margin-bottom:4px;
        }

        .product-category{

            font-size:13px;

            color:var(--gray);
        }

        /*
        |--------------------------------------------------------------------------
        | PRICE
        |--------------------------------------------------------------------------
        */

        .price{

            font-weight:700;

            color:#166534;

            font-size:16px;
        }

        /*
        |--------------------------------------------------------------------------
        | STOCK
        |--------------------------------------------------------------------------
        */

        .stock{

            display:inline-block;

            background:#ecfdf5;

            color:#166534;

            padding:8px 14px;

            border-radius:999px;

            font-size:13px;

            font-weight:700;
        }

        /*
        |--------------------------------------------------------------------------
        | ACTION
        |--------------------------------------------------------------------------
        */

        .action-group{

            display:flex;

            gap:10px;

            flex-wrap:wrap;
        }

        .btn{

            border:none;

            padding:10px 16px;

            border-radius:12px;

            font-size:13px;

            font-weight:700;

            cursor:pointer;

            transition:.3s;
        }

        .btn-edit{

            background:#ecfdf5;

            color:#166534;
        }

        .btn-edit:hover{

            background:#dcfce7;
        }

        .btn-delete{

            background:#fee2e2;

            color:#b91c1c;
        }

        .btn-delete:hover{

            background:#fecaca;
        }

        /*
        |--------------------------------------------------------------------------
        | EMPTY
        |--------------------------------------------------------------------------
        */

        .empty{

            text-align:center;

            padding:50px;

            color:#64748b;
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

                padding:34px;
            }

            .hero h1{

                font-size:34px;
            }

            .logo h2{

                font-size:24px;
            }

            .product-info{

                min-width:260px;
            }

        }

        /* PAGINATION CUSTOM STYLES */
        .pagination {
            display: flex;
            justify-content: center;
            list-style: none;
            padding: 0;
            gap: 6px;
            margin-top: 20px;
        }
        .page-item {
            display: inline-block;
        }
        .page-item .page-link {
            color: var(--primary);
            background-color: white;
            border: 1px solid var(--border);
            padding: 10px 16px;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            transition: 0.2s;
        }
        .page-item .page-link:hover {
            background-color: var(--primary);
            color: white;
            border-color: var(--primary);
        }
        .page-item.active .page-link {
            background-color: var(--primary);
            color: white;
            border-color: var(--primary);
        }
        .page-item.disabled .page-link {
            color: var(--gray);
            background-color: #f8fafc;
            border-color: var(--border);
            pointer-events: none;
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
                alt="Logo Green House"
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

            <a
                href="{{ route('admin.products.create') }}"
                class="add-btn"
            >

                + Tambah Produk

            </a>

        </div>

    </div>

</div>

<!-- CONTAINER -->

<div class="container">

    <!-- HERO -->

    <div class="hero">

        <h1>
            Kelola Produk
        </h1>

        <p>
            Kelola seluruh produk Green House dengan tampilan modern dan lebih nyaman.
        </p>

    </div>

    <!-- FILTER -->

    <div class="filter-card">

        <div class="filter-top">

            <div class="filter-title">

                Daftar Produk

            </div>

            <div class="product-total">

                Total {{ $products->count() }} Produk

            </div>

        </div>

        <form
            action=""
            method="GET"
            class="search-form"
        >

            <input
                type="text"
                name="q"
                class="search-input"
                placeholder="Cari nama produk..."
                value="{{ request('q') }}"
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

        <div class="table-wrap">

            <table>

                <thead>

                    <tr>

                        <th>#</th>

                        <th>Produk</th>

                        <th>Harga</th>

                        <th>Stok</th>

                        <th>Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($products as $product)

                    <tr>

                        <td>

                            {{ $loop->iteration }}

                        </td>

                        <td>

                            <div class="product-info">

                                <img
                                    class="product-image"
                                    src="{{ asset('storage/products/' . basename($product->image)) }}"
                                    alt="{{ $product->name }}"
                                    onerror="this.onerror=null;this.src='https://via.placeholder.com/80x80?text=No+Image';"
                                >

                                <div>

                                    <div class="product-name">

                                        {{ $product->name }}

                                    </div>

                                    <div class="product-category">

                                        {{ $product->category }}

                                    </div>

                                </div>

                            </div>

                        </td>

                        <td>

                            <div class="price">

                                Rp {{ number_format($product->price,0,',','.') }}

                            </div>

                        </td>

                        <td>

                            <span class="stock">

                                {{ $product->stock }} Stok

                            </span>

                        </td>

                        <td>

                            <div class="action-group">

                                <a
                                    href="{{ route('admin.products.edit',$product->id) }}"
                                >

                                    <button
                                        type="button"
                                        class="btn btn-edit"
                                    >

                                        Edit

                                    </button>

                                </a>

                                <form
                                    action="{{ route('admin.products.destroy',$product->id) }}"
                                    method="POST"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-delete"
                                        onclick="return confirm('Hapus produk ini?')"
                                    >

                                        Hapus

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="5">

                            <div class="empty">

                                Produk belum tersedia.

                            </div>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    @if(method_exists($products, 'links') && $products->links())
        <div style="margin-top: 25px;">
            {{ $products->links() }}
        </div>
    @endif

</div>

</body>
</html>