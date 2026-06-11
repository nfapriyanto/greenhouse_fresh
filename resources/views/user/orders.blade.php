@extends('layouts.app')

@section('content')

<style>

.orders-container{

    max-width:1200px;
    margin:auto;
    padding:30px 20px;
}

.page-title{

    font-size:36px;
    font-weight:800;
    color:#166534;
    margin-bottom:30px;
}

.order-card{

    background:white;
    border-radius:24px;
    padding:24px;
    margin-bottom:24px;

    box-shadow:
    0 10px 30px rgba(0,0,0,.05);

    border:1px solid #e5e7eb;
}

.order-top{

    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;
    gap:14px;

    margin-bottom:18px;
}

.order-id{

    font-size:22px;
    font-weight:700;
}

.order-date{

    color:#64748b;
}

.order-total{

    font-size:28px;
    font-weight:800;
    color:#16a34a;
}

.badge{

    display:inline-block;
    padding:10px 18px;
    border-radius:999px;
    color:white;
    font-weight:700;
    font-size:14px;
}

.status-pending{
    background:#6b7280;
}

.status-processing{
    background:#2563eb;
}

.status-packing{
    background:#f59e0b;
}

.status-shipped{
    background:#0ea5e9;
}

.status-delivered{
    background:#16a34a;
}

.tracking-box{

    margin-top:18px;
    padding:18px;
    border-radius:18px;
    background:#f8fafc;
}

.tracking-title{

    font-weight:700;
    margin-bottom:10px;
}

.resi{

    font-size:18px;
    font-weight:700;
    color:#166534;
}

.empty{

    background:white;
    padding:40px;
    border-radius:24px;
    text-align:center;

    box-shadow:
    0 10px 30px rgba(0,0,0,.05);
}

</style>

<div class="orders-container">

    <div class="page-title">
        Pesanan Saya
    </div>

    @forelse($orders as $order)

    <div class="order-card">

        <div class="order-top">

            <div>

                <div class="order-id">
                    Pesanan #{{ $order->id }}
                </div>

                <div class="order-date">
                    {{ $order->created_at->format('d M Y H:i') }}
                </div>

            </div>

            <div class="order-total">

                Rp {{ number_format($order->total_price,0,',','.') }}

            </div>

        </div>

        <div>

            <span class="badge status-{{ $order->status }}">

                {{ ucfirst($order->status) }}

            </span>

        </div>

        <div class="tracking-box">

            <div class="tracking-title">

                Informasi Pengiriman

            </div>

            <p>
                <b>Kurir:</b>
                {{ $order->courier ?? '-' }}
            </p>

            <p>
                <b>Nomor Resi:</b>
            </p>

            <div class="resi">

                {{ $order->resi ?? 'Belum tersedia' }}

            </div>

        </div>

    </div>

    @empty

    <div class="empty">

        <h2>Belum ada pesanan</h2>

        <p>Silakan belanja terlebih dahulu.</p>

    </div>

    @endforelse

</div>

@endsection