<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
</head>
<body>
    <h1>Edit Produk</h1>

    <form action="{{ route('admin.update_product', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
        Nama Produk: <input type="text" name="name" value="{{ $product->name }}" required><br><br>
        Harga: <input type="number" name="price" value="{{ $product->price }}" required><br><br>
        Stok: <input type="number" name="stock" value="{{ $product->stock }}" required><br><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
