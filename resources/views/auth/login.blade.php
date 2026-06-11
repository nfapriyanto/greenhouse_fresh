<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>

        Login - Green House

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

            --border:#dbe4ee;

            --danger:#dc2626;
        }

        body{

            font-family:'Poppins',sans-serif;

            background:
            linear-gradient(
                135deg,
                #eef7f0,
                #f4f7fb
            );

            min-height:100vh;

            display:flex;

            align-items:center;

            justify-content:center;

            padding:30px;
        }

        /*
        |--------------------------------------------------------------------------
        | CARD
        |--------------------------------------------------------------------------
        */

        .login-card{

            width:100%;

            max-width:980px;

            background:white;

            border-radius:34px;

            overflow:hidden;

            display:grid;

            grid-template-columns:1fr 1fr;

            box-shadow:
            0 20px 50px rgba(0,0,0,.08);
        }

        /*
        |--------------------------------------------------------------------------
        | LEFT SIDE
        |--------------------------------------------------------------------------
        */

        .login-left{

            background:
            linear-gradient(
                135deg,
                #16a34a,
                #22c55e
            );

            color:white;

            padding:60px;

            display:flex;

            flex-direction:column;

            justify-content:center;

            position:relative;

            overflow:hidden;
        }

        .login-left::before{

            content:'';

            position:absolute;

            width:280px;

            height:280px;

            background:
            rgba(255,255,255,.08);

            border-radius:50%;

            top:-80px;

            right:-80px;
        }

        .login-left h1{

            font-size:44px;

            line-height:1.2;

            margin-bottom:18px;

            font-weight:800;

            position:relative;

            z-index:2;
        }

        .login-left p{

            line-height:1.8;

            opacity:.95;

            margin-bottom:34px;

            position:relative;

            z-index:2;
        }

        .login-left img{

            width:120px;

            position:relative;

            z-index:2;
        }

        /*
        |--------------------------------------------------------------------------
        | RIGHT SIDE
        |--------------------------------------------------------------------------
        */

        .login-right{

            padding:60px;
        }

        .login-right h2{

            font-size:34px;

            color:#166534;

            margin-bottom:30px;

            font-weight:800;
        }

        /*
        |--------------------------------------------------------------------------
        | ALERT
        |--------------------------------------------------------------------------
        */

        .alert{

            background:#fee2e2;

            color:#991b1b;

            padding:14px 16px;

            border-radius:14px;

            margin-bottom:20px;

            font-size:14px;
        }

        /*
        |--------------------------------------------------------------------------
        | FORM
        |--------------------------------------------------------------------------
        */

        .form-group{

            margin-bottom:22px;
        }

        .form-group label{

            display:block;

            margin-bottom:10px;

            font-weight:600;
        }

        .form-group input{

            width:100%;

            height:56px;

            border:1px solid var(--border);

            border-radius:16px;

            padding:0 18px;

            outline:none;

            font-size:15px;

            font-family:'Poppins',sans-serif;

            transition:.25s;
        }

        .form-group input:focus{

            border-color:#16a34a;

            box-shadow:
            0 0 0 4px rgba(22,163,74,.08);
        }

        /*
        |--------------------------------------------------------------------------
        | PASSWORD
        |--------------------------------------------------------------------------
        */

        .pw-wrap{

            position:relative;
        }

        .pw-wrap input{

            padding-right:54px;
        }

        .toggle{

            position:absolute;

            right:10px;

            top:50%;

            transform:translateY(-50%);

            width:40px;

            height:40px;

            border:none;

            border-radius:12px;

            background:transparent;

            cursor:pointer;

            display:flex;

            align-items:center;

            justify-content:center;

            transition:.2s;
        }

        .toggle:hover{

            background:#f0fdf4;
        }

        .toggle svg{

            width:20px;

            height:20px;

            stroke:#166534;

            fill:none;

            stroke-width:2;
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

            margin-bottom:24px;

            color:#475569;

            font-size:14px;
        }

        /*
        |--------------------------------------------------------------------------
        | BUTTON
        |--------------------------------------------------------------------------
        */

        .btn-login{

            width:100%;

            height:56px;

            border:none;

            border-radius:16px;

            background:
            linear-gradient(
                135deg,
                #16a34a,
                #22c55e
            );

            color:white;

            font-size:15px;

            font-weight:700;

            cursor:pointer;

            transition:.25s;

            box-shadow:
            0 10px 20px rgba(22,163,74,.18);
        }

        .btn-login:hover{

            transform:
            translateY(-2px);
        }

        /*
        |--------------------------------------------------------------------------
        | FOOTER
        |--------------------------------------------------------------------------
        */

        .footer{

            margin-top:24px;

            text-align:center;

            color:#64748b;

            font-size:14px;
        }

        .footer a{

            color:#16a34a;

            font-weight:700;

            text-decoration:none;
        }

        /*
        |--------------------------------------------------------------------------
        | ERROR
        |--------------------------------------------------------------------------
        */

        .error{

            color:#dc2626;

            font-size:13px;

            margin-top:8px;
        }

        /*
        |--------------------------------------------------------------------------
        | MOBILE
        |--------------------------------------------------------------------------
        */

        @media(max-width:900px){

            .login-card{

                grid-template-columns:1fr;
            }

            .login-left{

                display:none;
            }

            .login-right{

                padding:40px 28px;
            }
        }

    </style>

</head>

<body>

<div class="login-card">

    <!-- LEFT -->

    <div class="login-left">

        <h1>

            Selamat Datang

        </h1>

        <p>

            Masuk untuk mulai belanja sayur dan sembako fresh dengan mudah dan cepat setiap hari.

        </p>

        <img
            src="{{ asset('images/logo-greenhouse.png') }}"
            alt="Green House"
        >

    </div>

    <!-- RIGHT -->

    <div class="login-right">

        <h2>

            Login

        </h2>

        @if ($errors->any())

            <div class="alert">

                {{ $errors->first() }}

            </div>

        @endif

        <form
            action="{{ route('login.post') }}"
            method="POST"
        >

            @csrf

            <!-- EMAIL -->

            <div class="form-group">

                <label>

                    Email

                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Masukkan email"
                    required
                >

                @error('email')

                    <div class="error">

                        {{ $message }}

                    </div>

                @enderror

            </div>

            <!-- PASSWORD -->

            <div class="form-group">

                <label>

                    Password

                </label>

                <div class="pw-wrap">

                    <input
                        id="password"
                        type="password"
                        name="password"
                        placeholder="Masukkan password"
                        required
                    >

                    <button
                        type="button"
                        class="toggle"
                        onclick="togglePw()"
                    >

                        <svg
                            id="eyeOpen"
                            viewBox="0 0 24 24"
                        >

                            <path d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7S2 12 2 12z"/>

                            <circle cx="12" cy="12" r="3"/>

                        </svg>

                        <svg
                            id="eyeClose"
                            viewBox="0 0 24 24"
                            style="display:none"
                        >

                            <path d="M3 3l18 18"/>

                            <path d="M10.5 6.3A10.8 10.8 0 0 1 12 5c6 0 10 7 10 7a21 21 0 0 1-3.1 4.3"/>

                            <path d="M6.1 6.6A21 21 0 0 0 2 12s4 7 10 7c1.5 0 2.9-.3 4.2-.8"/>

                        </svg>

                    </button>

                </div>

                @error('password')

                    <div class="error">

                        {{ $message }}

                    </div>

                @enderror

            </div>

            <!-- REMEMBER -->

            <div class="remember">

                <input
                    type="checkbox"
                    name="remember"
                    value="1"
                >

                Ingat saya

            </div>

            <!-- BUTTON -->

            <button
                type="submit"
                class="btn-login"
            >

                Masuk

            </button>

        </form>

        <!-- FOOTER -->

        <div class="footer">

            Belum punya akun?

            <a href="{{ route('register.show') }}">

                Register

            </a>

        </div>

    </div>

</div>

<script>

    function togglePw(){

        const input =
        document.getElementById('password');

        const eyeOpen =
        document.getElementById('eyeOpen');

        const eyeClose =
        document.getElementById('eyeClose');

        if(input.type === 'password'){

            input.type = 'text';

            eyeOpen.style.display = 'none';

            eyeClose.style.display = 'block';

        }else{

            input.type = 'password';

            eyeOpen.style.display = 'block';

            eyeClose.style.display = 'none';
        }
    }

</script>

</body>
</html>