@extends('layouts.app')

@section('content')
<div class="card">
  <h2 style="margin-top:0">Pesanan Saya</h2>

  @if($orders->isEmpty())
    <p>Belum ada pesanan.</p>
  @else
    <table style="width:100%; border-collapse:collapse">
      <thead>
        <tr>
          <th style="text-align:left; padding:8px; border-bottom:1px solid #eee">ID</th>
          <th style="text-align:left; padding:8px; border-bottom:1px solid #eee">Tanggal</th>
          <th style="text-align:left; padding:8px; border-bottom:1px solid #eee">Total</th>
          <th style="text-align:left; padding:8px; border-bottom:1px solid #eee">Status</th>
          <th style="text-align:left; padding:8px; border-bottom:1px solid #eee">Bukti</th>
        </tr>
      </thead>
      <tbody>
      @foreach($orders as $o)
        <tr>
          <td style="padding:8px;">#{{ $o->id }}</td>
          <td style="padding:8px;">{{ $o->created_at?->format('d M Y H:i') }}</td>
          <td style="padding:8px;">Rp {{ number_format($o->total_price, 0, ',', '.') }}</td>
          <td style="padding:8px;">
            @php
              $map = [
                'pending' => '#999',
                'waiting_verification' => '#a16207',
                'processing' => '#2563eb',
                'packing' => '#0ea5e9',
                'shipped' => '#10b981',
                'delivered' => '#16a34a',
              ];
              $label = ucwords(str_replace('_',' ', $o->status ?? 'pending'));
              $color = $map[$o->status ?? 'pending'] ?? '#999';
            @endphp
            <span style="display:inline-block;padding:4px 10px;border-radius:999px;color:#fff;background:{{ $color }}">
              {{ $label }}
            </span>
          </td>
          <td style="padding:8px;">
            @if($o->bukti_transfer)
              <a href="{{ asset('storage/'.$o->bukti_transfer) }}" target="_blank">Lihat</a>
            @else
              —
            @endif
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  @endif
</div>
@endsection
