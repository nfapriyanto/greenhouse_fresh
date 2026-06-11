<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>

        {{ $title ?? 'Green House' }}

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

            --bg:#eef2f7;

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


            position:sticky;

            top:0;

            z-index:999;

            padding:6px 0;

            background:
            rgba(255,255,255,.94);

            backdrop-filter:blur(14px);

            border-bottom:
            1px solid rgba(255,255,255,.5);

            box-shadow:
            0 4px 20px rgba(0,0,0,.04);
        }

        .navbar-container{

            max-width:1350px;

            margin:auto;

            padding:14px 24px;

            display:flex;

            align-items:center;

            justify-content:space-between;

            gap:24px;
        }

        /*
        |--------------------------------------------------------------------------
        | BRAND
        |--------------------------------------------------------------------------
        */

        .brand{

            display:flex;

            align-items:center;

            gap:14px;
        }

        .brand img{

            width:56px;

            height:56px;

            object-fit:cover;
        }

        .brand-text h2{

            font-size:34px;

            font-weight:800;

            line-height:1;

            color:#166534;
        }

        .brand-text span{

            font-size:12px;

            color:var(--gray);
        }

        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        .search-box{

            flex:1;

            max-width:520px;

            background:white;

            border:1px solid var(--border);

            border-radius:18px;

            overflow:hidden;

            display:flex;

            box-shadow:
            0 4px 14px rgba(0,0,0,.04);
        }

        .search-box input{

            flex:1;

            border:none;

            outline:none;

            padding:15px 20px;

            background:none;

            font-size:15px;

            font-family:'Poppins',sans-serif;
        }

        .search-box button{

            width:60px;

            border:none;

            background:
            linear-gradient(
                135deg,
                #16a34a,
                #22c55e
            );

            color:white;

            cursor:pointer;

            font-size:18px;

            transition:.25s;
        }

        .search-box button:hover{

            background:
            linear-gradient(
                135deg,
                #15803d,
                #16a34a
            );
        }

        /*
        |--------------------------------------------------------------------------
        | MENU
        |--------------------------------------------------------------------------
        */

        .nav-menu{

            display:flex;

            align-items:center;

            gap:12px;
        }

        .nav-link{

            display:flex;

            align-items:center;

            justify-content:center;

            gap:8px;

            height:46px;

            padding:0 18px;

            border-radius:14px;

            color:var(--text);

            font-weight:600;

            transition:.25s;
        }

        .nav-link:hover{

            background:#f0fdf4;

            color:var(--primary);

            transform:translateY(-1px);
            
        }

        /*
        |--------------------------------------------------------------------------
        | CART
        |--------------------------------------------------------------------------
        */

        .cart-link{

            background:#f8fafc;
        }

        .cart-badge{

            min-width:20px;

            height:20px;

            display:flex;

            align-items:center;

            justify-content:center;

            border-radius:50%;

            background:var(--primary);

            color:white;

            font-size:11px;

            font-weight:700;
        }

        /*
        |--------------------------------------------------------------------------
        | BUTTON LOGIN
        |--------------------------------------------------------------------------
        */

        .btn-login{

            display:flex;

            align-items:center;

            justify-content:center;

            height:46px;

            padding:0 22px;

            background:
            linear-gradient(
                135deg,
                #16a34a,
                #22c55e
            );

            color:white;

            border-radius:14px;

            font-weight:700;

            transition:.25s;

            box-shadow:
            0 6px 16px rgba(22,163,74,.18);
        }

        .btn-login:hover{

            transform:
            translateY(-2px);

            background:
            linear-gradient(
                135deg,
                #15803d,
                #16a34a
            );
        }

        /*
        |--------------------------------------------------------------------------
        | BUTTON LOGOUT
        |--------------------------------------------------------------------------
        */

        .btn-logout{

            border:none;

            background:var(--danger);

            color:white;

            height:46px;

            padding:0 20px;

            border-radius:14px;

            cursor:pointer;

            font-weight:700;

            transition:.25s;
        }

        .btn-logout:hover{

            background:#dc2626;

            transform:
            translateY(-2px);
        }

        /*
        |--------------------------------------------------------------------------
        | CONTAINER
        |--------------------------------------------------------------------------
        */

        .container{

            width:92%;

            max-width:1350px;

            margin:auto;

            padding:35px 0;
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

            padding:36px 42px;

            border-radius:28px;

            margin-bottom:35px;

            box-shadow:
            0 14px 34px rgba(34,197,94,.16);

            position:relative;

            overflow:hidden;
        }

        .hero h1{

            font-size:42px;

            font-weight:800;

            margin-bottom:10px;

            line-height:1.2;
        }

        .hero p{

            font-size:18px;

            opacity:.95;
        }

        /*
        |--------------------------------------------------------------------------
        | CONTROLS
        |--------------------------------------------------------------------------
        */

        .controls{

            display:flex;

            justify-content:space-between;

            align-items:center;

            margin-bottom:30px;

            flex-wrap:wrap;

            gap:15px;
        }

        .left-controls form{

            display:flex;

            align-items:center;

            gap:12px;
        }

        .left-controls label{

            font-weight:600;

            color:#475569;
        }

        .left-controls select{

            border:1px solid #e2e8f0;

            background:white;

            padding:12px 16px;

            border-radius:14px;

            outline:none;

            font-family:'Poppins',sans-serif;

            font-weight:500;
        }

        .toggle-btn{

            border:none;

            background:white;

            padding:12px 18px;

            border-radius:14px;

            cursor:pointer;

            font-weight:600;

            box-shadow:
            0 4px 12px rgba(0,0,0,.05);

            transition:.25s;
        }

        .toggle-btn:hover{

            transform:
            translateY(-2px);
        }

        /*
        |--------------------------------------------------------------------------
        | PRODUCTS
        |--------------------------------------------------------------------------
        */

        .products-grid{

            display:grid;

            grid-template-columns:
            repeat(auto-fit,minmax(220px,1fr));

            gap:20px;
        }

        .product-card{

            background:
            linear-gradient(
              180deg,
              #ffffff
              #fcfcfc
            );

            border-radius:22px;

            overflow:hidden;

            border:1px solid #eef2f7;

            box-shadow:
            0 8px 24px rgba(0,0,0,.05);

            transition:.25s;

            display:flex;

            flex-direction:column;

            min-height:430px;
        }

        .product-card:hover{

            transform:
            translateY(-5px);

            box-shadow:
            0 18px 30px rgba(0,0,0,.07);
        }

        .product-image{

            width:100%;

            height:190px;

            object-fit:contain;

            background:#f8fafc;

            padding:20px;
        }

        .product-content{

            padding:22px;

            display:flex;

            flex-direction:column;

            flex:1;
        }

        .product-title{

            font-size:17px;

            font-weight:700;

            line-height:1.5;

            min-height:52px;

            margin-bottom:10px;
        }

        .product-price{

            color:var(--primary);

            font-size:24px;

            font-weight:800;

            margin-bottom:16px;
        }

        .btn-cart{

            width:100%;

            border:none;

            background:
            linear-gradient(
                135deg,
                #16a34a,
                #22c55e
            );

            color:white;

            padding:14px;

            border-radius:14px;

            cursor:pointer;

            font-weight:700;

            font-size:14px;

            transition:.25s;

            margin-top:auto;

            box-shadow:
            0 8px 18px rgba(22,163,74,.18);
        }

        .btn-cart:hover{

            transform:
            translateY(-2px);

            background:
            linear-gradient(
                135deg,
                #15803d,
                #16a34a
            );
        }

        .btn-cart:active{

            transform:scale(.98);
        }

        /*
        |--------------------------------------------------------------------------
        | ALERT
        |--------------------------------------------------------------------------
        */

        .alert{

            padding:16px 18px;

            border-radius:16px;

            margin-bottom:20px;

            font-weight:500;
        }

        .alert-success{

            background:#dcfce7;

            color:#166534;
        }

        .error{

            background:#fee2e2;

            color:#991b1b;
        }

        /*
        |--------------------------------------------------------------------------
        | MOBILE
        |--------------------------------------------------------------------------
        */

        @media(max-width:900px){

            .navbar-container{

                flex-direction:column;
            }

            .search-box{

                width:100%;

                max-width:100%;
            }

            .nav-menu{

                flex-wrap:wrap;

                justify-content:center;

                width:100%;
            }

            .hero{

                padding:36px 30px;
            }

            .hero h1{

                font-size:34px;
            }

            .brand-text h2{

                font-size:28px;
            }

            .products-grid{

                grid-template-columns:
                repeat(2,1fr);

                gap:16px;
            }

            .product-image{

                height:150px;
            }

            .product-title{

                font-size:15px;

                min-height:auto;
            }

            .product-price{

                font-size:20px;
            }

            .btn-cart{

                font-size:13px;

                padding:12px;
            }
        }

        /* PAGINATION CUSTOM STYLES */
        .pagination {
            display: flex;
            justify-content: center;
            list-style: none;
            padding: 0;
            gap: 6px;
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

<nav class="navbar">

    <div class="navbar-container">

        <!-- BRAND -->

        <a
            href="{{ route('home') }}"
            class="brand"
        >

            <img
                src="{{ asset('images/logo-greenhouse.png') }}"
                alt="Logo"
            >

            <div class="brand-text">

                <h2>

                    Green House

                </h2>

                <span>

                    Fresh Everyday

                </span>

            </div>

        </a>

        <!-- SEARCH -->

        <div class="search-box">

            <input
                type="text"
                placeholder="Cari produk..."
            >

            <button>

                🔍

            </button>

        </div>

        <!-- MENU -->

        <div class="nav-menu">

            <a
                href="{{ route('home') }}"
                class="nav-link"
            >

                Beranda

            </a>

            <a
                href="{{ route('cart.index') }}"
                class="nav-link cart-link"
            >

                🛒 Keranjang

                <span class="cart-badge">

                    {{ $cartCount ?? session('cart_count', 0) }}

                </span>

            </a>

            <a
                href="{{ route('checkout.show') }}"
                class="nav-link"
            >

                Checkout

            </a>

            @guest

                <a
                    href="{{ route('login') }}"
                    class="btn-login"
                >

                    Login

                </a>

            @endguest

            @auth

                <a
                    href="{{ route('orders.mine') }}"
                    class="nav-link"
                >

                    Pesanan

                </a>

                <form
                    action="{{ route('logout') }}"
                    method="POST"
                >

                    @csrf

                    <button
                        type="submit"
                        class="btn-logout"
                    >

                        Logout

                    </button>

                </form>

            @endauth

        </div>

    </div>

</nav>

<!-- CONTENT -->

<div class="container">

    @yield('content')

</div>

</body>
</html>