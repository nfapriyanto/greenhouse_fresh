{{-- resources/views/user/dashboard.blade.php --}}
@extends('layouts.app')

@section('head')

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

body{

    background:#f5f7fb;

    font-family:'Poppins',sans-serif;
}

/*
|--------------------------------------------------------------------------
| CONTAINER
|--------------------------------------------------------------------------
*/

.dashboard-container{

    width:92%;

    max-width:1400px;

    margin:30px auto;
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

    border-radius:30px;

    padding:34px;

    color:white;

    margin-bottom:28px;

    box-shadow:
    0 18px 40px rgba(34,197,94,.18);
}

.hero h2{

    font-size:36px;

    font-weight:800;

    margin-bottom:10px;
}

.hero p{

    font-size:16px;

    opacity:.95;

    margin-bottom:20px;
}

.actions{

    display:flex;

    gap:14px;

    flex-wrap:wrap;
}

.btn{

    display:inline-flex;

    align-items:center;

    justify-content:center;

    gap:8px;

    padding:12px 18px;

    border-radius:14px;

    text-decoration:none;

    font-weight:700;

    transition:.3s;

    border:none;

    cursor:pointer;

    font-size:14px;
}

.btn:hover{

    transform:translateY(-2px);
}

.btn-primary{

    background:white;

    color:#166534;
}

.btn-outline{

    background:rgba(255,255,255,.15);

    border:1px solid rgba(255,255,255,.35);

    color:white;
}

/*
|--------------------------------------------------------------------------
| CARD
|--------------------------------------------------------------------------
*/

.card{

    background:white;

    border-radius:26px;

    padding:28px;

    margin-bottom:28px;

    box-shadow:
    0 10px 30px rgba(0,0,0,.05);
}

.section-title{

    font-size:28px;

    font-weight:800;

    color:#166534;

    margin-bottom:18px;
}

.muted{

    color:#64748b;
}

/*
|--------------------------------------------------------------------------
| STATUS BADGE
|--------------------------------------------------------------------------
*/

.badge{

    display:inline-block;

    padding:8px 14px;

    border-radius:999px;

    color:white;

    font-size:13px;

    font-weight:700;
}

/*
|--------------------------------------------------------------------------
| PRODUCTS GRID
|--------------------------------------------------------------------------
*/

.products{

    display:grid;

    grid-template-columns:
    repeat(auto-fill,minmax(250px,1fr));

    gap:24px;
}

/*
|--------------------------------------------------------------------------
| PRODUCT CARD
|--------------------------------------------------------------------------
*/

.p-card{

    background:white;

    border-radius:24px;

    overflow:hidden;

    border:1px solid #e2e8f0;

    transition:.3s;

    box-shadow:
    0 6px 18px rgba(0,0,0,.04);
}

.p-card:hover{

    transform:translateY(-6px);

    box-shadow:
    0 20px 35px rgba(0,0,0,.08);
}

/*
|--------------------------------------------------------------------------
| PRODUCT IMAGE
|--------------------------------------------------------------------------
*/

.p-image{

    width:100%;

    height:220px;

    background:#f8fafc;

    display:flex;

    align-items:center;

    justify-content:center;

    overflow:hidden;

    padding:14px;
}

.p-image img{

    width:100%;

    height:100%;

    object-fit:contain;

    transition:.3s;
}

.p-card:hover .p-image img{

    transform:scale(1.05);
}

/*
|--------------------------------------------------------------------------
| PRODUCT CONTENT
|--------------------------------------------------------------------------
*/

.p-content{

    padding:20px;
}

.p-title{

    font-size:18px;

    font-weight:700;

    color:#166534;

    margin-bottom:10px;

    line-height:1.4;

    min-height:50px;
}

.price{

    font-size:24px;

    font-weight:800;

    color:#16a34a;

    margin-bottom:16px;
}

/*
|--------------------------------------------------------------------------
| BUTTON CART
|--------------------------------------------------------------------------
*/

.cart-btn{

    width:100%;

    height:50px;

    border:none;

    border-radius:14px;

    background:
    linear-gradient(
        135deg,
        #16a34a,
        #22c55e
    );

    color:white;

    font-weight:700;

    font-size:15px;

    cursor:pointer;

    transition:.3s;
}

.cart-btn:hover{

    transform:translateY(-2px);

    box-shadow:
    0 10px 24px rgba(34,197,94,.18);
}

/*
|--------------------------------------------------------------------------
| EMPTY
|--------------------------------------------------------------------------
*/

.empty{

    text-align:center;

    padding:30px;

    color:#64748b;
}

/*
|--------------------------------------------------------------------------
| MOBILE
|--------------------------------------------------------------------------
*/

@media(max-width:768px){

    .hero{

        padding:24px;
    }

    .hero h2{

        font-size:28px;
    }

    .products{

        grid-template-columns:1fr;
    }

}

</style>
@endsection

@section('content')

<div class="dashboard-container">

{{-- HERO --}}

<div class="hero">

    <h2>
        Halo, {{ auth()->user()->name ?? 'Pembeli' }} 👋
    </h2>

    <p>
        Selamat datang kembali di Green House. Selamat berbelanja!
    </p>

    <div class="actions">

        <a
            href="{{ route('cart.index') }}"
            class="btn btn-primary"
        >
            🛒 Keranjang
        </a>

        <a
            href="{{ route('orders.mine') }}"
            class="btn btn-outline"
        >
            📦 Pesanan Saya
        </a>

        <a
            href="{{ route('checkout.show') }}"
            class="btn btn-outline"
        >
            💳 Checkout
        </a>

    </div>

</div>

{{-- PESANAN TERAKHIR --}}

@php

$last = \App\Models\Order::where(
    'user_id',
    auth()->id()
)->latest('id')->first();

$statusMap = [

    'pending' => '#6b7280',

    'waiting_verification' => '#a16207',

    'processing' => '#2563eb',

    'packing' => '#0ea5e9',

    'shipped' => '#10b981',

    'delivered' => '#16a34a',

    'paid' => '#16a34a',

];

$lastStatus = $last?->status ?? null;

@endphp

<div class="card">

    <div class="section-title">
        Ringkasan Pesanan Terakhir
    </div>

    @if($last)

        <div
            class="muted"
            style="margin-bottom:12px"
        >

            #{{ $last->id }}
            •

            {{ $last->created_at?->format('d M Y H:i') }}

        </div>

        <div
            style="
            display:flex;
            gap:14px;
            align-items:center;
            flex-wrap:wrap;
            "
        >

            <div>

                <b>Total:</b>

                Rp {{ number_format($last->total_price,0,',','.') }}

            </div>

            <span
                class="badge"
                style="
                background:
                {{ $statusMap[$lastStatus] ?? '#6b7280' }}
                "
            >

                {{ ucwords(str_replace('_',' ', $lastStatus ?? 'pending')) }}

            </span>

        </div>

    @else

        <div class="muted">
            Belum ada pesanan. Ayo mulai belanja!
        </div>

    @endif

</div>

{{-- PRODUK --}}

<div class="card">

    <div class="section-title">
        Produk Tersedia
    </div>

    @if(isset($products) && count($products))

    <div class="products">

        @foreach($products as $product)

        @php

        $placeholder =
        'https://via.placeholder.com/500x400?text=Green+House';

        $src =
        $product->image_url
        ?:
        (
            !empty($product->image)
            ? asset($product->image)
            : $placeholder
        );

        @endphp

        <div class="p-card">

            <div class="p-image">

                <img
                    src="{{ $src }}"
                    alt="{{ $product->name }}"
                    loading="lazy"
                    onerror="
                    this.onerror=null;
                    this.src='{{ $placeholder }}';
                    "
                >

            </div>

            <div class="p-content">

                <div class="p-title">

                    {{ $product->name }}

                </div>

                <div class="price">

                    Rp {{ number_format($product->price,0,',','.') }}

                </div>

                <form
                    action="{{ route('cart.add',$product->id) }}"
                    method="POST"
                >

                    @csrf

                    <button
                        type="submit"
                        class="cart-btn"
                    >

                        + Tambah ke Keranjang

                    </button>

                </form>

            </div>

        </div>

        @endforeach

    </div>

    @else

    <div class="empty">

        Belum ada produk tersedia.

    </div>

    @endif

</div>

</div>

@endsection