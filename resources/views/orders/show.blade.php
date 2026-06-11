@extends('layouts.app')

@section('content')
<div class="orders-container" style="max-width: 800px; margin: auto; padding: 30px 20px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <h2 style="font-size: 32px; font-weight: 800; color: #166534; margin: 0;">Detail Pesanan #{{ $order->id }}</h2>
        <a href="{{ route('orders.mine') }}" style="color: #16a34a; font-weight: 600; text-decoration: none;">&larr; Kembali</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success" style="background:#dcfce7; color:#166534; padding:12px; border-radius:12px; margin-bottom:20px;">
            {{ session('success') }}
        </div>
    @endif

    <!-- DETAIL CARD -->
    <div style="background: white; border-radius: 24px; padding: 28px; box-shadow: 0 10px 30px rgba(0,0,0,.05); border: 1px solid #e5e7eb; margin-bottom: 24px;">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; border-bottom: 1px solid #eee; padding-bottom: 20px; margin-bottom: 20px;">
            <div>
                <p style="margin: 0 0 6px; color: #64748b; font-size: 13px;">Tanggal Transaksi</p>
                <strong style="font-size: 16px; color: #1e293b;">{{ $order->created_at->format('d M Y H:i') }}</strong>
            </div>
            <div>
                <p style="margin: 0 0 6px; color: #64748b; font-size: 13px;">Status Pesanan</p>
                @php
                  $mapColor = [
                    'pending' => '#6b7280',
                    'waiting_verification' => '#a16207',
                    'processing' => '#2563eb',
                    'packing' => '#f59e0b',
                    'shipped' => '#0ea5e9',
                    'completed' => '#16a34a',
                    'cancelled' => '#ef4444',
                  ];
                  $label = ucwords(str_replace('_',' ', $order->status ?? 'pending'));
                  $color = $mapColor[$order->status ?? 'pending'] ?? '#6b7280';
                @endphp
                <span style="display:inline-block; padding:6px 14px; border-radius:999px; color:#fff; background:{{ $color }}; font-weight:700; font-size:13px;">
                  {{ $label }}
                </span>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
            <div>
                <h4 style="margin: 0 0 8px; color: #166534; font-size: 16px;">Penerima & Alamat</h4>
                <p style="margin: 0 0 4px; font-weight: 600; color: #1e293b;">{{ $order->name }}</p>
                <p style="margin: 0 0 4px; color: #475569; font-size: 14px;">{{ $order->phone }}</p>
                <p style="margin: 0; color: #64748b; font-size: 14px; line-height: 1.5;">{{ $order->address }}</p>
            </div>
            <div>
                <h4 style="margin: 0 0 8px; color: #166534; font-size: 16px;">Metode Pengiriman & Pembayaran</h4>
                <p style="margin: 0 0 6px; color: #475569; font-size: 14px;">
                    <strong>Pengiriman:</strong> {{ ucfirst($order->shipping_method) }}
                </p>
                <p style="margin: 0 0 6px; color: #475569; font-size: 14px;">
                    <strong>Pembayaran:</strong> {{ strtoupper($order->payment_method) }}
                </p>
            </div>
        </div>

        @if($order->courier || $order->resi)
            <div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 18px; padding: 16px; margin-top: 20px;">
                <h4 style="margin: 0 0 8px; color: #166534; font-size: 15px;">Informasi Pengiriman</h4>
                <p style="margin: 0 0 4px; color: #475569; font-size: 14px;">
                    <strong>Kurir:</strong> {{ $order->courier ?? '-' }}
                </p>
                <p style="margin: 0; color: #475569; font-size: 14px;">
                    <strong>Nomor Resi:</strong> <span style="font-family: monospace; font-weight: 700; color: #166534; font-size: 15px;">{{ $order->resi ?? 'Belum tersedia' }}</span>
                </p>
            </div>
        @endif
    </div>

    <!-- ITEMS CARD -->
    <div style="background: white; border-radius: 24px; padding: 28px; box-shadow: 0 10px 30px rgba(0,0,0,.05); border: 1px solid #e5e7eb;">
        <h3 style="color: #166534; margin: 0 0 18px; font-size: 20px; font-weight: 700;">Daftar Produk</h3>
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="border-bottom: 2px solid #f1f5f9;">
                    <th style="text-align: left; padding: 12px 8px; color: #64748b; font-size: 14px;">Produk</th>
                    <th style="text-align: center; padding: 12px 8px; color: #64748b; font-size: 14px;">Harga</th>
                    <th style="text-align: center; padding: 12px 8px; color: #64748b; font-size: 14px;">Jumlah</th>
                    <th style="text-align: right; padding: 12px 8px; color: #64748b; font-size: 14px;">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="padding: 16px 8px; font-weight: 600; color: #1e293b;">
                            {{ $item->product->name ?? 'Produk Tidak Ditemukan' }}
                        </td>
                        <td style="text-align: center; padding: 16px 8px; color: #475569;">
                            Rp {{ number_format($item->price, 0, ',', '.') }}
                        </td>
                        <td style="text-align: center; padding: 16px 8px; color: #475569; font-weight: 600;">
                            {{ $item->quantity }}
                        </td>
                        <td style="text-align: right; padding: 16px 8px; font-weight: 700; color: #16a34a;">
                            Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3" style="text-align: right; padding: 20px 8px 0; font-weight: 700; color: #64748b; font-size: 16px;">
                        GRAND TOTAL
                    </td>
                    <td style="text-align: right; padding: 20px 8px 0; font-weight: 800; color: #166534; font-size: 22px;">
                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
