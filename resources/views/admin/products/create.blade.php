<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Produk</title>
  <style>
    :root{--green:#52b788;--danger:#e11d48;--border:#dcdcdc;--bg:#f0fff0}
    *{box-sizing:border-box}
    body{font-family:'Segoe UI',sans-serif;background:var(--bg);margin:0;padding:24px}
    .wrap{max-width:760px;margin:0 auto}
    .card{background:#fff;border-radius:12px;padding:20px;box-shadow:0 6px 18px rgba(0,0,0,.06)}
    .row{display:grid;grid-template-columns:1fr 1fr;gap:12px}
    label{display:block;margin-top:12px;font-weight:600}
    input,select,textarea{
      width:100%;padding:10px;border:1px solid var(--border);border-radius:8px
    }
    input.is-invalid, select.is-invalid, textarea.is-invalid{border-color:var(--danger)}
    .hint{font-size:12px;color:#6b7280;margin-top:6px}
    .error{color:#b91c1c;font-size:12px;margin-top:6px}
    .actions{margin-top:18px;display:flex;gap:10px}
    .btn{background:var(--green);color:#fff;border:0;padding:10px 14px;border-radius:8px;cursor:pointer}
    .btn-secondary{background:#94a3b8;color:#fff;text-decoration:none;display:inline-block}
    .preview{margin-top:8px;width:120px;height:120px;border:1px solid var(--border);border-radius:10px;object-fit:cover;display:none}
    .alert{padding:10px 12px;border-radius:10px;margin-bottom:16px}
    .alert-error{background:#fee2e2;color:#991b1b;border:1px solid #fecaca}
  </style>
</head>
<body>
<div class="wrap">
  <h2 style="margin:0 0 16px">Tambah Produk</h2>

  {{-- tampilkan error global --}}
  @if ($errors->any())
    <div class="alert alert-error">
      <strong>Periksa kembali form di bawah:</strong>
      <ul style="margin:6px 0 0 18px">
        @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
      </ul>
    </div>
  @endif

  <div class="card">
    {{-- WAJIB: method POST + enctype --}}
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <label for="name">Nama</label>
      <input id="name" type="text" name="name" value="{{ old('name') }}" maxlength="255"
             class="@error('name') is-invalid @enderror" required>

      <div class="row">
        <div>
          <label for="price">Harga</label>
          <input id="price" type="number" name="price" value="{{ old('price') }}" min="0" step="1"
                 class="@error('price') is-invalid @enderror" required>
          <div class="hint">Dalam rupiah (tanpa titik/koma).</div>
          @error('price')<div class="error">{{ $message }}</div>@enderror
        </div>
        <div>
          <label for="stock">Stok</label>
          <input id="stock" type="number" name="stock" value="{{ old('stock') }}" min="0" step="1"
                 class="@error('stock') is-invalid @enderror" required>
          @error('stock')<div class="error">{{ $message }}</div>@enderror
        </div>
      </div>

      <label for="category">Kategori</label>
      <select id="category" name="category" class="@error('category') is-invalid @enderror" required>
        <option value="">-- Pilih --</option>
        <option value="sayuran" {{ old('category')=='sayuran'?'selected':'' }}>Sayuran</option>
        <option value="sembako" {{ old('category')=='sembako'?'selected':'' }}>Sembako</option>
      </select>
      @error('category')<div class="error">{{ $message }}</div>@enderror

      <label for="description">Deskripsi</label>
      <textarea id="description" name="description" rows="4"
                class="@error('description') is-invalid @enderror"
                placeholder="Opsional">{{ old('description') }}</textarea>
      @error('description')<div class="error">{{ $message }}</div>@enderror

      <label for="image">Gambar (jpg/png, maks 4MB)</label>
      <input id="image" type="file" name="image" accept="image/jpeg,image/png"
             class="@error('image') is-invalid @enderror" onchange="previewFile(event)">
      @error('image')<div class="error">{{ $message }}</div>@enderror
      <img id="imgPreview" class="preview" alt="Preview">

      <div class="actions">
        <button type="submit" class="btn">Simpan</button>
        <a href="{{ route('admin.products.index') }}" class="btn-secondary">Batal</a>
      </div>
    </form>
  </div>
</div>

<script>
  function previewFile(e){
    const file = e.target.files?.[0];
    const img = document.getElementById('imgPreview');
    if(!file){ img.style.display='none'; img.src=''; return; }
    const url = URL.createObjectURL(file);
    img.src = url; img.style.display = 'block';
    img.onload = () => URL.revokeObjectURL(url);
  }
</script>
</body>
</html>
