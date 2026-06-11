<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Pesanan Berhasil</title>
  <style>
    body{font-family:Segoe UI,Arial,sans-serif;background:#f0fff0;margin:0}
    .wrap{max-width:720px;margin:40px auto;padding:0 16px}
    .card{background:#fff;border-radius:12px;box-shadow:0 6px 18px rgba(0,0,0,.06);padding:20px}
    .alert{background:#d1fae5;color:#065f46;border:1px solid #a7f3d0;padding:14px;border-radius:10px;text-align:center;font-size:1.1rem}
    .btn{display:inline-block;background:#52b788;color:#fff;text-decoration:none;padding:10px 14px;border-radius:8px;margin-top:14px}
  </style>
</head>
<body>
  <div class="wrap">
    <div class="alert">🎉 Pesanan #{{ $order->id }} berhasil dibuat!</div>
    <div class="card">
      <p><b>Total:</b> Rp {{ number_format($order->total_price,0,',','.') }}</p>
      <p><b>Status:</b> {{ ucfirst($order->status) }}</p>
      <a class="btn" href="{{ route('user.dashboard') }}">Kembali ke Dashboard</a>
    </div>
  </div>
</body>
</html>
