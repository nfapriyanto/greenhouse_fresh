<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Upload Bukti Pembayaran</title>
  <style>
    body {font-family:'Segoe UI',sans-serif;background:#f0fff0;margin:0;padding:24px}
    .wrap {max-width:640px;margin:0 auto}
    .card {background:#fff;border-radius:10px;padding:20px;box-shadow:0 4px 10px rgba(0,0,0,.06)}
    h2 {text-align:center;margin-top:0}
    label {display:block;margin-top:12px;font-weight:600}
    select, input[type=file] {width:100%;padding:10px;margin-top:6px;border:1px solid #dcdcdc;border-radius:8px}
    button {margin-top:18px;background:#52b788;color:#fff;padding:12px 14px;border:none;border-radius:8px;cursor:pointer;width:100%}
    button:hover {background:#40916c}
    .alert {margin:12px 0;padding:10px 12px;border-radius:8px}
    .alert-success {background:#d1fae5;color:#065f46;border:1px solid #a7f3d0}
    .alert-error {background:#fee2e2;color:#991b1b;border:1px solid #fecaca}
  </style>
</head>
<body>
<div class="wrap">
  <h2>Upload Bukti Pembayaran</h2>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  @if($errors->any())
    <div class="alert alert-error">
      <ul style="margin:0;padding-left:18px">
        @foreach($errors->all() as $e)
          <li>{{ $e }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class="card">
    {{-- WAJIB: method POST + enctype multipart --}}
    <form action="{{ route('payment.upload') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <label for="order_id">Pilih ID Pesanan</label>
      <select name="order_id" id="order_id" required>
        @foreach ($orders as $o)
          <option value="{{ $o->id }}" {{ request('order_id') == $o->id ? 'selected' : '' }}>
            Order #{{ $o->id }} - Rp {{ number_format($o->total_price,0,',','.') }}
          </option>
        @endforeach
      </select>

      <label for="bukti_transfer">Upload Gambar Bukti (jpg/png)</label>
      {{-- Pastikan name="bukti_transfer" sesuai dengan PaymentController --}}
      <input type="file" name="bukti_transfer" id="bukti_transfer"
             accept="image/jpeg,image/png" required>

      <button type="submit">Upload</button>
    </form>
  </div>
</div>
</body>
</html>
