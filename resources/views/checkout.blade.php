@extends('layouts.app')

@section('content')

<div class="checkout-page">

    <style>

        /*
        |--------------------------------------------------------------------------
        | PAGE
        |--------------------------------------------------------------------------
        */

        .checkout-page{

            padding:10px 0 50px;
        }

        .checkout-header{

            margin-bottom:30px;
        }

        .checkout-header h1{

            font-size:40px;

            color:#166534;

            margin-bottom:8px;
        }

        .checkout-header p{

            color:#64748b;

            font-size:15px;
        }

        /*
        |--------------------------------------------------------------------------
        | LAYOUT
        |--------------------------------------------------------------------------
        */

        .checkout-layout{

            display:grid;

            grid-template-columns:1.2fr .8fr;

            gap:28px;
        }

        /*
        |--------------------------------------------------------------------------
        | CARD
        |--------------------------------------------------------------------------
        */

        .checkout-card{

            background:white;

            border-radius:28px;

            padding:30px;

            box-shadow:
            0 10px 30px rgba(0,0,0,.05);
        }

        /*
        |--------------------------------------------------------------------------
        | SUMMARY
        |--------------------------------------------------------------------------
        */

        .summary-box{

            background:
            linear-gradient(
                135deg,
                #16a34a,
                #22c55e
            );

            color:white;

            padding:24px;

            border-radius:24px;

            margin-bottom:28px;
        }

        .summary-box h2{

            font-size:18px;

            margin-bottom:10px;
        }

        .summary-price{

            font-size:38px;

            font-weight:800;
        }

        .summary-text{

            margin-top:10px;

            opacity:.9;

            font-size:14px;
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

            font-size:14px;
        }

        .alert-success{

            background:#dcfce7;

            color:#166534;
        }

        .alert-error{

            background:#fee2e2;

            color:#991b1b;
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

            color:#334155;
        }

        .form-control{

            width:100%;

            border:1px solid #dbe4ee;

            background:#f8fafc;

            border-radius:16px;

            padding:15px 18px;

            font-size:15px;

            outline:none;

            transition:.3s;

            font-family:'Poppins',sans-serif;
        }

        textarea.form-control{

            min-height:120px;

            resize:none;
        }

        .form-control:focus{

            border-color:#16a34a;

            background:white;

            box-shadow:
            0 0 0 4px rgba(22,163,74,.12);
        }

        /*
        |--------------------------------------------------------------------------
        | PICKUP INFO
        |--------------------------------------------------------------------------
        */

        .pickup-info{

            background:#fff7ed;

            border:1px solid #fdba74;

            color:#9a3412;

            padding:16px;

            border-radius:16px;

            margin-bottom:22px;

            display:none;

            font-size:14px;

            line-height:1.6;
        }

        /*
        |--------------------------------------------------------------------------
        | BUTTON
        |--------------------------------------------------------------------------
        */

        .btn-order{

            width:100%;

            border:none;

            height:58px;

            border-radius:18px;

            background:
            linear-gradient(
                135deg,
                #16a34a,
                #22c55e
            );

            color:white;

            font-size:17px;

            font-weight:700;

            cursor:pointer;

            transition:.3s;

            margin-top:10px;
        }

        .btn-order:hover{

            transform:translateY(-2px);

            box-shadow:
            0 10px 24px rgba(22,163,74,.22);
        }

        /*
        |--------------------------------------------------------------------------
        | SIDE
        |--------------------------------------------------------------------------
        */

        .side-card{

            background:white;

            border-radius:28px;

            padding:28px;

            box-shadow:
            0 10px 30px rgba(0,0,0,.05);

            height:fit-content;

            position:sticky;

            top:110px;
        }

        .side-card h3{

            margin-bottom:20px;

            color:#166534;
        }

        .feature{

            display:flex;

            gap:14px;

            margin-bottom:20px;
        }

        .feature-icon{

            width:46px;

            height:46px;

            border-radius:14px;

            background:#dcfce7;

            display:flex;

            align-items:center;

            justify-content:center;

            font-size:20px;
        }

        .feature-text strong{

            display:block;

            margin-bottom:4px;
        }

        .feature-text span{

            color:#64748b;

            font-size:14px;
        }

        /*
        |--------------------------------------------------------------------------
        | MOBILE
        |--------------------------------------------------------------------------
        */

        @media(max-width:900px){

            .checkout-layout{

                grid-template-columns:1fr;
            }

            .side-card{

                position:static;
            }

            .checkout-header h1{

                font-size:32px;
            }

            .checkout-card{

                padding:22px;
            }

        }

    </style>

    <!-- HEADER -->

    <div class="checkout-header">

        <h1>

            Checkout Pesanan

        </h1>

        <p>

            Lengkapi data pengiriman dan pembayaran

        </p>

    </div>

    <!-- SUCCESS -->

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    <!-- ERROR -->

    @if($errors->any())

        <div class="alert alert-error">

            <ul style="padding-left:18px">

                @foreach($errors->all() as $e)

                    <li>{{ $e }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <div class="checkout-layout">

        <!-- LEFT -->

        <div class="checkout-card">

            <!-- SUMMARY -->

            <div class="summary-box">

                <h2>

                    Total Belanja

                </h2>

                <div class="summary-price">

                    Rp {{ number_format($total ?? 0,0,',','.') }}

                </div>

                <div class="summary-text">

                    Pastikan data checkout sudah benar sebelum membuat pesanan.

                </div>

            </div>

            <!-- FORM -->

            <form
                action="{{ route('checkout.place') }}"
                method="POST"
            >

                @csrf

                <!-- NAME -->

                <div class="form-group">

                    <label>

                        Nama Penerima

                    </label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ old('name', auth()->user()->name ?? '') }}"
                        placeholder="Masukkan nama lengkap"
                        required
                    >

                </div>

                <!-- ADDRESS -->

                <div class="form-group">

                    <label>

                        Alamat Pengiriman

                    </label>

                    <textarea
                        name="address"
                        id="address"
                        class="form-control"
                        placeholder="Masukkan alamat lengkap"
                        required
                    >{{ old('address') }}</textarea>

                </div>

                <!-- PHONE -->

                <div class="form-group">

                    <label>

                        No HP / WhatsApp

                    </label>

                    <input
                        type="text"
                        name="phone"
                        class="form-control"
                        value="{{ old('phone') }}"
                        placeholder="08xxxxxxxxxx"
                        required
                    >

                </div>



                <!-- BUTTON -->

                <button
                    type="submit"
                    class="btn-order"
                >

                    Buat Pesanan

                </button>

            </form>

        </div>

        <!-- RIGHT -->

        <div class="side-card">

            <h3>

                Kenapa Belanja di Green House?

            </h3>

            <div class="feature">

                <div class="feature-icon">

                    🥬

                </div>

                <div class="feature-text">

                    <strong>

                        Produk Fresh

                    </strong>

                    <span>

                        Sayur dan sembako kualitas terbaik setiap hari.

                    </span>

                </div>

            </div>

            <div class="feature">

                <div class="feature-icon">

                    🚚

                </div>

                <div class="feature-text">

                    <strong>

                        Pengiriman Cepat

                    </strong>

                    <span>

                        Pengiriman instant & same day tersedia.

                    </span>

                </div>

            </div>

            <div class="feature">

                <div class="feature-icon">

                    🔒

                </div>

                <div class="feature-text">

                    <strong>

                        Pembayaran Aman

                    </strong>

                    <span>

                        Transfer, QRIS, dan COD tersedia.

                    </span>

                </div>

            </div>

        </div>

    </div>

</div>



@endsection