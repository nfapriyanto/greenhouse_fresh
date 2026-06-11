<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <style>
    body{font-family:DejaVu Sans, sans-serif;font-size:12px;color:#111}
    h2{margin:0 0 6px}
    .muted{color:#555}
    table{width:100%;border-collapse:collapse;margin-top:10px}
    th,td{border:1px solid #ccc;padding:6px}
    thead th{background:#eaf7ef}
    .right{text-align:right}
  </style>
</head>
<body>
  <h2>Laporan Penjualan</h2>
  <div class="muted">
    Periode: {{ $from->format('d M Y') }} s/d {{ $to->format('d M Y') }}
    @if($status) — Status: {{ $status }} @endif
  </div>

  <table>
    <thead>
      <tr>
        <th>ID</th><th>Tanggal</th><th>Pelanggan</th><th class="right">Total (Rp)</th><th>Status</th>
      </tr>
    </thead>
    <tbody>
      @foreach($rows as $o)
        <tr>
          <td>#{{ $o->id }}</td>
          <td>{{ $o->created_at?->format('d/m/Y H:i') }}</td>
          <td>{{ $o->user->name ?? '-' }}</td>
          <td class="right">{{ number_format($o->total_price,0,',','.') }}</td>
          <td>{{ $o->status }}</td>
        </tr>
      @endforeach
      <tr>
        <td colspan="3"><b>Total</b></td>
        <td class="right"><b>{{ number_format($sum,0,',','.') }}</b></td>
        <td></td>
      </tr>
    </tbody>
  </table>
</body>
</html>
