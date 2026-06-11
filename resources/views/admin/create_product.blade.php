<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Produk</title>
</head>
<body>
  <h2>Tambah Produk</h2>

  @if ($errors->any())
    <div style="background:#fee2e2;color:#991b1b;padding:8px;border-radius:6px;margin-bottom:10px">
      <ul style="margin:0;padding-left:18px">
        @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
      </ul>
    </div>
  @endif

  {{-- 👇 GUNAKAN route yang benar: admin.products.store --}}
  <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div>
      <label>Nama</label><br>
      <input type="text" name="name" value="{{ old('name') }}" required>
    </div>

    <div>
      <label>Harga</label><br>
      <input type="number" name="price" value="{{ old('price') }}" min="0" required>
    </div>

    <div>
      <label>Stok</label><br>
      <input type="number" name="stock" value="{{ old('stock', 0) }}" min="0" required>
    </div>

    <div>
      <label>Kategori</label><br>
      <select name="category" required>
        <option value="sayuran" {{ old('category')=='sayuran' ? 'selected' : '' }}>Sayuran</option>
        <option value="sembako"  {{ old('category')=='sembako'  ? 'selected' : '' }}>Sembako</option>
      </select>
    </div>

    <div>
      <label>Gambar (jpg/png)</label><br>
      <input type="file" name="image" accept="image/jpeg,image/png">
    </div>

    <button type="submit">Simpan</button>
    <a href="{{ route('admin.products') }}">Batal</a>
  </form>
</body>
</html>
