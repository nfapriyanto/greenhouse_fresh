<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kelola Produk</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <style>
    body{font-family:'Segoe UI',sans-serif;background:#f6fff6;margin:0;padding:20px}
    h1{margin:0 0 12px}
    .topbar{display:flex;justify-content:space-between;align-items:center;margin-bottom:14px}
    .btn{display:inline-block;background:#52b788;color:#fff;text-decoration:none;padding:8px 12px;border-radius:6px}
    .btn:hover{background:#40916c}
    .btn-danger{background:#e11d48}
    .btn-danger:hover{background:#be123c}
    table{width:100%;border-collapse:collapse;background:#fff;border-radius:10px;overflow:hidden}
    th,td{padding:10px 12px;border-bottom:1px solid #eee;text-align:left}
    th{background:#e8f6ee;color:#1b4332}
    img.thumb{width:60px;height:60px;object-fit:cover;border-radius:6px}
    .actions{display:flex;gap:8px;align-items:center}
    .empty{padding:14px;background:#fff;border:1px solid #eee;border-radius:10px}
  </style>
</head>
<body>
  <div class="topbar">
    <h1>Kelola Produk</h1>
    <a href="{{ route('admin.products.create') }}" class="btn">➕ Tambah Produk</a>
  </div>

  @if(session('success'))
    <div style="margin:10px 0;padding:10px;border-radius:8px;background:#d1fae5;color:#065f46;border:1px solid #a7f3d0">
      {{ session('success') }}
    </div>
  @endif
  @if(session('error'))
    <div style="margin:10px 0;padding:10px;border-radius:8px;background:#fee2e2;color:#991b1b;border:1px solid #fecaca">
      {{ session('error') }}
    </div>
  @endif

  @if($products->count())
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Gambar</th>
          <th>Nama</th>
          <th>Harga</th>
          <th>Stok</th>
          <th style="width:160px">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($products as $i => $product)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
              @php
                $img = $product->image ? asset('storage/products/'.$product->image)
                                       : 'https://via.placeholder.com/120?text=No+Image';
              @endphp
              <img src="{{ $product->image_url }}" alt="{{ $product->name }}" style="width:64px;height:64px;object-fit:cover;border-radius:8px">
            </td>
            <td>{{ $product->name }}</td>
            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
            <td>{{ $product->stock }}</td>
            <td>
              <div class="actions">
                <a href="{{ route('admin.products.create') }}" class="btn">➕ Tambah Produk</a>

                <form action="{{ route('admin.products.delete', $product->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">🗑️ Hapus</button>
                </form>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    {{-- Jika $products adalah paginator --}}
    @if(method_exists($products, 'links'))
      <div style="margin-top:12px">
        {{ $products->withQueryString()->onEachSide(1)->links() }}
      </div>
    @endif
  @else
    <div class="empty">Belum ada produk.</div>
  @endif
</body>
</html>
