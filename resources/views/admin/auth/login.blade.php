<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Login - Green House</title>

    <!-- FONT -->

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins',sans-serif;
        }

        body{
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            background:#edf3ee;
            padding:20px;
        }

        /*
        |--------------------------------------------------------------------------
        | LOGIN WRAPPER
        |--------------------------------------------------------------------------
        */

        .login-wrapper{
            width:980px;
            max-width:100%;
            min-height:600px;
            background:#fff;
            border-radius:32px;
            overflow:hidden;
            display:grid;
            grid-template-columns:1fr 1fr;
            box-shadow:0 20px 45px rgba(0,0,0,0.08);
        }

        /*
        |--------------------------------------------------------------------------
        | LEFT SIDE
        |--------------------------------------------------------------------------
        */

        .left-side{
            background:linear-gradient(135deg,#15b84d,#1fd45e);
            position:relative;
            overflow:hidden;
            padding:60px;
            color:white;
            display:flex;
            flex-direction:column;
            justify-content:center;
        }

        .circle{
            position:absolute;
            width:320px;
            height:320px;
            border-radius:50%;
            background:rgba(255,255,255,0.08);
            top:-80px;
            right:-80px;
        }

        .circle2{
            position:absolute;
            width:220px;
            height:220px;
            border-radius:50%;
            background:rgba(255,255,255,0.05);
            bottom:-70px;
            left:-70px;
        }

        /*
        |--------------------------------------------------------------------------
        | LOGO
        |--------------------------------------------------------------------------
        */

        .logo-box{
            margin-bottom:30px;
        }

        .logo-box img{
            width:95px;
            height:95px;
            object-fit:contain;
            
            filter:drop-shadow(0 8px 18px rgba(0,0,0,0.18));
        }

        /*
        |--------------------------------------------------------------------------
        | TEXT
        |--------------------------------------------------------------------------
        */

        .left-side h1{
            font-size:58px;
            line-height:1.05;
            margin-bottom:24px;
            font-weight:700;
        }

        .left-side p{
            font-size:17px;
            line-height:1.9;
            max-width:400px;
            color:rgba(255,255,255,0.92);
        }

        /*
        |--------------------------------------------------------------------------
        | RIGHT SIDE
        |--------------------------------------------------------------------------
        */

        .right-side{
            padding:70px 60px;
            display:flex;
            flex-direction:column;
            justify-content:center;
        }

        .right-side h2{
            font-size:46px;
            color:#136f37;
            margin-bottom:10px;
        }

        .subtitle{
            color:#777;
            font-size:15px;
            margin-bottom:40px;
            line-height:1.7;
        }

        /*
        |--------------------------------------------------------------------------
        | ERROR
        |--------------------------------------------------------------------------
        */

        .error-box{
            background:#ffe8e8;
            color:#d63031;
            padding:15px 18px;
            border-radius:14px;
            margin-bottom:25px;
            font-size:14px;
        }

        /*
        |--------------------------------------------------------------------------
        | FORM
        |--------------------------------------------------------------------------
        */

        .form-group{
            margin-bottom:25px;
        }

        .form-group label{
            display:block;
            margin-bottom:10px;
            font-weight:600;
            color:#222;
        }

        .input-box{
            width:100%;
            height:60px;
            border:2px solid #e2e7e2;
            border-radius:18px;
            padding:0 20px;
            font-size:15px;
            outline:none;
            transition:.3s;
            background:#fafcfa;
        }

        .input-box:focus{
            border-color:#1fd45e;
            box-shadow:0 0 0 5px rgba(31,212,94,0.15);
            background:white;
        }

        /*
        |--------------------------------------------------------------------------
        | REMEMBER
        |--------------------------------------------------------------------------
        */

        .remember{
            display:flex;
            align-items:center;
            gap:10px;
            margin-bottom:25px;
            font-size:14px;
            color:#666;
        }

        /*
        |--------------------------------------------------------------------------
        | BUTTON
        |--------------------------------------------------------------------------
        */

        .login-btn{
            width:100%;
            height:60px;
            border:none;
            border-radius:18px;
            background:linear-gradient(135deg,#16b84d,#1fd45e);
            color:white;
            font-size:17px;
            font-weight:600;
            cursor:pointer;
            transition:.3s;
        }

        .login-btn:hover{
            transform:translateY(-2px);
            box-shadow:0 12px 25px rgba(31,212,94,0.28);
        }

        /*
        |--------------------------------------------------------------------------
        | FOOTER TEXT
        |--------------------------------------------------------------------------
        */

        .footer-text{
            margin-top:25px;
            text-align:center;
            color:#999;
            font-size:13px;
        }

        /*
        |--------------------------------------------------------------------------
        | RESPONSIVE
        |--------------------------------------------------------------------------
        */

        @media(max-width:900px){

            .login-wrapper{
                grid-template-columns:1fr;
            }

            .left-side{
                display:none;
            }

            .right-side{
                padding:45px 30px;
            }

            .right-side h2{
                font-size:38px;
            }
        }

    </style>
</head>

<body>

<div class="login-wrapper">

    <!-- LEFT SIDE -->

    <div class="left-side">

        <div class="circle"></div>
        <div class="circle2"></div>

        <!-- LOGO -->

        <div class="logo-box">

            <img src="{{ asset('images/logo-greenhouse.png') }}"
                 alt="Green House Logo"

                 onerror="this.style.display='none'; this.parentElement.innerHTML='<span style=&quot;font-size:40px&quot;>🌿</span>';">
        </div>

        <!-- TITLE -->

        <h1>
            Admin<br>
            Dashboard
        </h1>

        <!-- DESCRIPTION -->

        <p>
            Masuk ke panel admin Green House untuk mengelola produk,
            supplier, pesanan, dan laporan penjualan dengan lebih mudah
            dan modern.
        </p>

    </div>

    <!-- RIGHT SIDE -->

    <div class="right-side">

        <h2>Admin Login</h2>

        <p class="subtitle">
            Silakan login untuk melanjutkan ke dashboard admin Green House.
        </p>

        <!-- ERROR -->

        @if ($errors->any())
            <div class="error-box">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- FORM -->

        <form method="POST" action="{{ route('admin.login.post') }}">

            @csrf

            <!-- EMAIL -->

            <div class="form-group">

                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    class="input-box"
                    placeholder="Masukkan email admin"
                    required
                >

            </div>

            <!-- PASSWORD -->

            <div class="form-group">

                <label>Password</label>

                <input
                    type="password"
                    name="password"
                    class="input-box"
                    placeholder="Masukkan password"
                    required
                >

            </div>

            <!-- REMEMBER -->

            <div class="remember">

                <input type="checkbox">

                <span>Ingat saya</span>

            </div>

            <!-- BUTTON -->

            <button type="submit" class="login-btn">
                Masuk Dashboard
            </button>

        </form>

        <div class="footer-text">
            Green House Admin Panel
        </div>

    </div>

</div>

</body>
</html>