<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <style>
    *{font-family: DejaVu Sans, Arial, sans-serif; font-size:12px}
    h3{margin:0 0 10px}
    table{width:100%;border-collapse:collapse}
    th,td{border:1px solid #ddd;padding:6px}
    thead th{background:#eee;text-align:left}
    .right{text-align:right}
    .muted{opacity:.7}
  </style>
</head>
<body>
  <h3>Laporan Penjualan</h3>
  <div class="muted" style="margin-bottom:8px">
    Periode:
    {{ $from ?: 'awal' }} — {{ $to ?: 'akhir' }},
    Status: {{ $status ?: 'semua' }}
  </div>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Tanggal</th>
        <th>Pelanggan</th>
        <th>Status</th>
        <th class="right">Total</th>
      </tr>
    </thead>
    <tbody>
      @php $grand=0; @endphp
      @foreach($orders as $o)
        @php $grand += (int)$o->total_price; @endphp
        <tr>
          <td>{{ $o->id }}</td>
          <td>{{ optional($o->created_at)->format('Y-m-d H:i') }}</td>
          <td>{{ $o->user->name ?? '-' }}</td>
          <td>{{ $o->status }}</td>
          <td class="right">Rp {{ number_format($o->total_price,0,',','.') }}</td>
        </tr>
      @endforeach
      <tr>
        <td colspan="4" class="right"><strong>Grand Total</strong></td>
        <td class="right"><strong>Rp {{ number_format($grand,0,',','.') }}</strong></td>
      </tr>
    </tbody>
  </table>
</body>
</html>
