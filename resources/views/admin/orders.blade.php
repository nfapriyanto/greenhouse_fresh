<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Pesanan Masuk - Admin</title>
  <style>
    body{font-family:'Segoe UI',sans-serif;background:#f0fff0;margin:0;padding:20px}
    h2{margin:0 0 16px}
    table{width:100%;border-collapse:collapse;background:#fff}
    th,td{border:1px solid #e5e5e5;padding:10px}
    thead th{background:#b7e4c7;text-align:left}
    .success{background:#d1fae5;color:#065f46;border:1px solid #a7f3d0;padding:10px;border-radius:6px;margin-bottom:12px}
    select,button{padding:6px 8px;border-radius:6px;border:1px solid #cbd5e1}
    button{background:#52b788;color:#fff;border:none;cursor:pointer}
    button:hover{background:#40916c}
  </style>
</head>
<body>
  <h2>Pesanan Masuk</h2>

  @if(session('success'))
    <div class="success">{{ session('success') }}</div>
  @endif

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Pelanggan</th>
        <th>Total</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
      <tr>
        <td>{{ $order->id }}</td>
        <td>{{ $order->user->name ?? '-' }}</td>
        <td>Rp {{ number_format($order->total_price,0,',','.') }}</td>
        <td>{{ $order->status }}</td>
        <td>
          {{-- PENTING:
               - route name: admin.orders.update
               - parameter: $order (pakai implicit model binding {order})
               - method spoofing: PUT
               - name="status" HARUS ada dan nilainya sesuai validasi controller
          --}}
          <form action="{{ route('admin.orders.update', $order) }}" method="POST" style="display:inline-flex;gap:6px;align-items:center">
            @csrf
            @method('PUT')
            <select name="status">
              @php
                $choices = ['pending','waiting_verification','processing','packing','shipped','completed','cancelled'];
              @endphp
              @foreach($choices as $s)
                <option value="{{ $s }}" @selected($order->status === $s)>{{ $s }}</option>
              @endforeach
            </select>
            <button type="submit">Update</button>
          </form>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
</body>
</html>
