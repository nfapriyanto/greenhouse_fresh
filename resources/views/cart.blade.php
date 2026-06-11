@extends('layouts.app')

@section('content')

@php
    $cart = session('cart', []);
@endphp

<style>

    /*
    |--------------------------------------------------------------------------
    | PAGE
    |--------------------------------------------------------------------------
    */

    .cart-page{

        padding:10px 0 40px;
    }

    /*
    |--------------------------------------------------------------------------
    | HEADER
    |--------------------------------------------------------------------------
    */

    .cart-header{

        display:flex;

        justify-content:space-between;

        align-items:center;

        margin-bottom:30px;

        flex-wrap:wrap;

        gap:20px;
    }

    .cart-header h1{

        font-size:38px;

        color:#166534;

        margin-bottom:6px;
    }

    .cart-header p{

        color:#64748b;
    }

    .btn-shop{

        background:
        linear-gradient(
            135deg,
            #16a34a,
            #22c55e
        );

        color:white;

        padding:14px 24px;

        border-radius:16px;

        font-weight:700;

        text-decoration:none;

        box-shadow:
        0 10px 20px rgba(22,163,74,.16);

        transition:.3s;
    }

    .btn-shop:hover{

        transform:translateY(-2px);
    }

    /*
    |--------------------------------------------------------------------------
    | EMPTY
    |--------------------------------------------------------------------------
    */

    .empty-cart{

        background:white;

        border-radius:28px;

        padding:70px 30px;

        text-align:center;

        box-shadow:
        0 10px 30px rgba(0,0,0,.05);
    }

    .empty-cart img{

        width:130px;

        margin-bottom:24px;

        opacity:.9;
    }

    .empty-cart h2{

        font-size:34px;

        color:#166534;

        margin-bottom:10px;
    }

    .empty-cart p{

        color:#64748b;

        margin-bottom:28px;
    }

    .btn-empty{

        display:inline-flex;

        align-items:center;

        justify-content:center;

        padding:15px 28px;

        border-radius:16px;

        background:
        linear-gradient(
            135deg,
            #16a34a,
            #22c55e
        );

        color:white;

        font-weight:700;

        text-decoration:none;

        transition:.3s;
    }

    .btn-empty:hover{

        transform:translateY(-2px);
    }

    /*
    |--------------------------------------------------------------------------
    | LAYOUT
    |--------------------------------------------------------------------------
    */

    .cart-layout{

        display:grid;

        grid-template-columns:2fr 1fr;

        gap:24px;
    }

    /*
    |--------------------------------------------------------------------------
    | CARD
    |--------------------------------------------------------------------------
    */

    .cart-card{

        background:white;

        border-radius:24px;

        padding:20px;

        display:flex;

        align-items:center;

        gap:18px;

        margin-bottom:20px;

        box-shadow:
        0 8px 24px rgba(0,0,0,.05);

        transition:.3s;
    }

    .cart-card:hover{

        transform:translateY(-4px);
    }

    .cart-image{

        width:110px;

        height:110px;

        object-fit:contain;

        background:#f8fafc;

        border-radius:18px;

        padding:12px;

        border:1px solid #eef2f7;
    }

    .cart-info{

        flex:1;
    }

    .cart-info h3{

        font-size:20px;

        margin-bottom:10px;

        line-height:1.4;
    }

    .price{

        color:#16a34a;

        font-size:22px;

        font-weight:700;

        margin-bottom:10px;
    }

    /*
    |--------------------------------------------------------------------------
    | QTY
    |--------------------------------------------------------------------------
    */

    .qty-box{

        display:flex;

        align-items:center;

        gap:10px;
    }

    .qty-btn{

        width:34px;

        height:34px;

        border:none;

        border-radius:10px;

        background:#16a34a;

        color:white;

        font-size:18px;

        font-weight:700;

        cursor:pointer;

        transition:.3s;
    }

    .qty-btn:hover{

        background:#15803d;
    }

    .qty-number{

        min-width:30px;

        text-align:center;

        font-weight:700;

        font-size:16px;
    }

    /*
    |--------------------------------------------------------------------------
    | RIGHT
    |--------------------------------------------------------------------------
    */

    .cart-right{

        text-align:right;
    }

    .subtotal{

        font-size:22px;

        font-weight:800;

        margin-bottom:14px;
    }

    .btn-remove{

        border:none;

        background:#fee2e2;

        color:#dc2626;

        padding:12px 18px;

        border-radius:14px;

        cursor:pointer;

        font-weight:700;

        transition:.3s;
    }

    .btn-remove:hover{

        background:#fecaca;
    }

    /*
    |--------------------------------------------------------------------------
    | SUMMARY
    |--------------------------------------------------------------------------
    */

    .summary-card{

        background:white;

        border-radius:24px;

        padding:28px;

        height:fit-content;

        box-shadow:
        0 8px 24px rgba(0,0,0,.05);

        position:sticky;

        top:110px;
    }

    .summary-card h2{

        color:#166534;

        margin-bottom:24px;
    }

    .summary-row{

        display:flex;

        justify-content:space-between;

        margin-bottom:24px;

        font-size:20px;
    }

    .btn-checkout{

        width:100%;

        display:flex;

        align-items:center;

        justify-content:center;

        height:56px;

        border-radius:16px;

        background:
        linear-gradient(
            135deg,
            #16a34a,
            #22c55e
        );

        color:white;

        font-weight:700;

        text-decoration:none;

        margin-bottom:14px;

        transition:.3s;
    }

    .btn-checkout:hover{

        transform:translateY(-2px);
    }

    .btn-clear{

        width:100%;

        display:flex;

        align-items:center;

        justify-content:center;

        height:52px;

        border-radius:16px;

        background:#fee2e2;

        color:#dc2626;

        text-decoration:none;

        font-weight:700;
    }

    /*
    |--------------------------------------------------------------------------
    | MOBILE
    |--------------------------------------------------------------------------
    */

    @media(max-width:900px){

        .cart-layout{

            grid-template-columns:1fr;
        }

        .cart-card{

            flex-direction:column;

            text-align:center;
        }

        .cart-right{

            text-align:center;
        }

        .summary-card{

            position:static;
        }

        .cart-header{

            flex-direction:column;

            align-items:flex-start;
        }
    }

</style>

<div class="cart-page">

    <!-- HEADER -->

    <div class="cart-header">

        <div>

            <h1>
                🛒 Keranjang Belanja
            </h1>

            <p>
                Produk pilihan kamu
            </p>

        </div>

        <a
            href="{{ route('home') }}"
            class="btn-shop"
        >

            + Belanja Lagi

        </a>

    </div>

    @if(empty($cart))

        <!-- EMPTY -->

        <div class="empty-cart">

            <img
                src="https://cdn-icons-png.flaticon.com/512/2038/2038854.png"
                alt="Empty Cart"
            >

            <h2>

                Keranjang masih kosong

            </h2>

            <p>

                Yuk mulai belanja sayur & sembako fresh

            </p>

            <a
                href="{{ route('home') }}"
                class="btn-empty"
            >

                Belanja Sekarang

            </a>

        </div>

    @else

        @php $total = 0; @endphp

        <div class="cart-layout">

            <!-- LEFT -->

            <div>

                @foreach($cart as $row)

                    @php

                        $sub =
                        $row['price'] * $row['quantity'];

                        $total += $sub;

                        if(!empty($row['image'])){

                            $image =
                            asset('storage/products/'.$row['image']);

                        }else{

                            $image =
                            'https://via.placeholder.com/150';
                        }

                    @endphp

                    <div class="cart-card">

                        <!-- IMAGE -->

                        <img
                            src="{{ $image }}"
                            class="cart-image"
                            alt="{{ $row['name'] }}"
                        >

                        <!-- INFO -->

                        <div class="cart-info">

                            <h3>

                                {{ $row['name'] }}

                            </h3>

                            <div class="price">

                                Rp {{ number_format($row['price'],0,',','.') }}

                            </div>

                            <!-- QTY -->

                            <div class="qty-box">

                                <form
                                    action="{{ route('cart.add',$row['id']) }}"
                                    method="GET"
                                >

                                    <input
                                        type="hidden"
                                        name="quantity"
                                        value="{{ max(1,$row['quantity'] - 1) }}"
                                    >

                                    <button
                                        class="qty-btn"
                                    >

                                        -

                                    </button>

                                </form>

                                <div class="qty-number">

                                    {{ $row['quantity'] }}

                                </div>

                                <form
                                    action="{{ route('cart.add',$row['id']) }}"
                                    method="GET"
                                >

                                    <input
                                        type="hidden"
                                        name="quantity"
                                        value="{{ $row['quantity'] + 1 }}"
                                    >

                                    <button
                                        class="qty-btn"
                                    >

                                        +

                                    </button>

                                </form>

                            </div>

                        </div>

                        <!-- RIGHT -->

                        <div class="cart-right">

                            <div class="subtotal">

                                Rp {{ number_format($sub,0,',','.') }}

                            </div>

                            <a
                                href="{{ route('cart.remove',$row['id']) }}"
                                class="btn-remove"
                                onclick="return confirm('Hapus produk ini?')"
                            >

                                Hapus

                            </a>

                        </div>

                    </div>

                @endforeach

            </div>

            <!-- RIGHT -->

            <div class="summary-card">

                <h2>

                    Ringkasan Belanja

                </h2>

                <div class="summary-row">

                    <span>Total</span>

                    <strong>

                        Rp {{ number_format($total,0,',','.') }}

                    </strong>

                </div>

                <a
                    href="{{ route('checkout.show') }}"
                    class="btn-checkout"
                >

                    Checkout Sekarang

                </a>

                <a
                    href="{{ route('cart.clear') }}"
                    class="btn-clear"
                    onclick="return confirm('Kosongkan keranjang?')"
                >

                    Kosongkan Keranjang

                </a>

            </div>

        </div>

    @endif

</div>

@endsection