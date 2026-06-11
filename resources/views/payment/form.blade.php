<!DOCTYPE html>
<html>
<head>
    <title>Pembayaran - Green House</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="form-container">
        <h2>Checkout & Pembayaran</h2>

        @if(session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif

        <form method="POST" action="/checkout" enctype="multipart/form-data">
            @csrf
            <label>Pilih Metode Pembayaran:</label><br>
            <select name="method" required>
                <option value="cash">Cash</option>
                <option value="qris">QRIS</option>
                <option value="transfer">Transfer Bank</option>
                <option value="kartu">Kartu Kredit</option>
            </select><br><br>

            <label>Bukti Pembayaran (jika non-cash):</label><br>
            <input type="file" name="proof"><br><br>

            <button type="submit">Bayar</button>
        </form>
    </div>
</body>
</html>
