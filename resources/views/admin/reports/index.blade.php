<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Laporan Penjualan</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <style>
    body{font-family:Segoe UI,Arial,sans-serif;background:#f0fff0;margin:0}
    .wrap{max-width:1200px;margin:18px auto;padding:0 16px}
    h1{margin:0 0 12px}
    .bar{display:flex;gap:10px;flex-wrap:wrap;align-items:end;background:#e9f7ef;padding:10px;border:1px solid #cfe9d8;border-radius:10px}
    .bar label{display:block;font-size:12px;color:#345}
    .bar input,.bar select{padding:8px;border:1px solid #cbd5e1;border-radius:8px}
    .btn{padding:10px 14px;border-radius:10px;border:0;cursor:pointer;font-weight:700}
    .btn-primary{background:#40916c;color:#fff}
    .btn-light{background:#fff;color:#1b4332;border:1px solid #cbd5e1}
    table{width:100%;border-collapse:collapse;background:#fff;margin-top:12px}
    th,td{padding:10px;border-bottom:1px solid #eef2f1}
    thead th{background:#b7e4c7;text-align:left}
    .muted{color:#6b7280}
    .stats{margin-top:10px}
  </style>
</head>
<body>
<div class="wrap">

  <h1>Laporan Penjualan</h1>

  <form class="bar" action="{{ route('admin.reports.index') }}" method="GET">
    <div>
      <label>Dari tanggal</label>
      <input type="date" name="from" value="{{ $from }}">
    </div>
    <div>
      <label>Sampai tanggal</label>
      <input type="date" name="to" value="{{ $to }}">
    </div>
    <div>
      <label>Status</label>
      <select name="status">
        <option value="">(Semua, default completed+shipped)</option>
        @foreach($choices as $c)
          <option value="{{ $c }}" {{ $status===$c ? 'selected' : '' }}>{{ $c }}</option>
        @endforeach
      </select>
    </div>
    <div>
      <button class="btn btn-light" type="submit">Terapkan</button>
    </div>

    <div style="margin-left:auto;display:flex;gap:8px">
      <a class="btn btn-primary" href="{{ route('admin.reports.export.excel', request()->query()) }}">Export Excel</a>
      <a class="btn btn-light"   href="{{ route('admin.reports.export.pdf',   request()->query()) }}">Export PDF</a>
    </div>
  </form>

  <div class="stats muted">
    Total pesanan: <b>{{ number_format($count) }}</b> &mdash;
    Pendapatan: <b>Rp {{ number_format($sum,0,',','.') }}</b>
  </div>

  <table>
    <thead>
      <tr>
        <th>ID</th><th>Tanggal</th><th>Pelanggan</th><th>Total</th><th>Status</th>
      </tr>
    </thead>
    <tbody>
      @forelse($orders as $o)
        <tr>
          <td>#{{ $o->id }}</td>
          <td>{{ $o->created_at?->format('d M Y H:i') }}</td>
          <td>{{ $o->user->name ?? '-' }}</td>
          <td>Rp {{ number_format($o->total_price,0,',','.') }}</td>
          <td>{{ $o->status }}</td>
        </tr>
      @empty
        <tr><td colspan="5" class="muted">Tidak ada data dalam rentang ini.</td></tr>
      @endforelse
    </tbody>
  </table>

  <div style="margin-top:10px">
    {{ $orders->links() }}
  </div>
</div>
</body>
</html>
