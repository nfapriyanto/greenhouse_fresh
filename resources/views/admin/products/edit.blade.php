<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Produk</title>
  <style>
    body{font-family:'Segoe UI',sans-serif;background:#f0fff0;margin:0;padding:24px}
    .wrap{max-width:760px;margin:0 auto}
    .card{background:#fff;border-radius:12px;padding:20px;box-shadow:0 6px 18px rgba(0,0,0,.06)}
    .row{display:grid;grid-template-columns:1fr 1fr;gap:12px}
    label{display:block;margin-top:10px;font-weight:600}
    input,select,textarea{width:100%;padding:10px;border:1px solid #dcdcdc;border-radius:8px}
    .actions{margin-top:16px;display:flex;gap:10px}
    .btn{background:#52b788;color:#fff;border:0;padding:10px 14px;border-radius:8px;cursor:pointer}
    .btn-secondary{background:#94a3b8}
    img.preview{margin-top:8px;width:96px;height:96px;object-fit:cover;border-radius:8px;border:1px solid #ddd}
  </style>
</head>
<body>
<div class="wrap">
  <h2>Edit Produk</h2>

  <div class="card">
    {{-- method POST + PUT --}}
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <label>Nama</label>
      <input type="text" name="name" value="{{ old('name',$product->name) }}" required>

      <div class="row">
        <div>
          <label>Harga</label>
          <input type="number" name="price" value="{{ old('price',$product->price) }}" min="0" required>
        </div>
        <div>
          <label>Stok</label>
          <input type="number" name="stock" value="{{ old('stock',$product->stock) }}" min="0" required>
        </div>
      </div>

      <label>Kategori</label>
      <select name="category" required>
        <option value="">-- Pilih --</option>
        <option value="sayuran" {{ old('category',$product->category)=='sayuran'?'selected':'' }}>Sayuran</option>
        <option value="sembako" {{ old('category',$product->category)=='sembako'?'selected':'' }}>Sembako</option>
      </select>

      <label>Deskripsi</label>
      <textarea name="description" rows="4">{{ old('description',$product->description) }}</textarea>

      <label>Gambar (jpg/png)</label>
      <input type="file" name="image" accept="image/jpeg,image/png">

      {{-- Preview gambar lama --}}
      @if($product->image)
        <div>
          <img src="{{ $product->image_url }}" alt="{{ $product->name }}" style="width:64px;height:64px;object-fit:cover;border-radius:8px">
        </div>
      @endif

      <div class="actions">
        <button type="submit" class="btn">Update</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary" style="text-decoration:none;display:inline-block;text-align:center;">Batal</a>
      </div>
    </form>
  </div>
</div>
</body>
</html>
