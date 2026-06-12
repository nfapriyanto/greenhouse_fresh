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

.status-ready_to_ship{
    background:#f59e0b;
}

.status-shipped{
    background:#0ea5e9;
}

.status-completed{
    background:#16a34a;
}

.status-cancelled{
    background:#ef4444;
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
                    <a href="{{ route('orders.show', $order->id) }}" style="color:#166534; text-decoration:none;">
                        Pesanan #{{ $order->id }}
                    </a>
                </div>

                <div class="order-date">
                    {{ $order->created_at->format('d M Y H:i') }}
                </div>

            </div>

            <div class="order-total">

                Rp {{ number_format($order->total_price,0,',','.') }}

            </div>

        </div>

        <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px;">

            <div>
                <span class="badge status-{{ $order->status }}">
                    {{ ucfirst($order->status) }}
                </span>
            </div>

            <div style="display: flex; align-items: center; gap: 10px;">
                <a href="{{ route('orders.show', $order->id) }}" style="display: inline-block; padding: 8px 16px; font-size: 14px; border-radius: 10px; background: linear-gradient(135deg, #16a34a, #22c55e); color: white; text-decoration: none; font-weight: bold; transition: .3s;">
                    Detail Pesanan
                </a>

                @if($order->status == 'pending')
                    <a href="{{ route('orders.edit', $order->id) }}" style="display: inline-block; padding: 8px 16px; font-size: 14px; border-radius: 10px; background: #ecfdf5; color: #166534; border: 1px solid #bbf7d0; text-decoration: none; font-weight: bold; transition: .3s;">
                        Edit Pesanan
                    </a>

                    <form action="{{ route('orders.cancel', $order->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')" style="margin: 0;">
                        @csrf
                        <button type="submit" style="display: inline-block; padding: 8px 16px; font-size: 14px; border-radius: 10px; background: #fee2e2; color: #dc2626; border: none; font-weight: bold; cursor: pointer; transition: .3s;">
                            Batalkan Pesanan
                        </button>
                    </form>
                @endif
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