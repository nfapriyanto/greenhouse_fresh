<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pesanan</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 14px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: auto;
        }

        th, td {
            border: 1px solid #aaa;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #e6fffa;
        }
    </style>
</head>
<body>
    <h2>Laporan Pesanan - Green House</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Nama User</th>
                <th>Status</th>
                <th>Total</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $no => $order)
                <tr>
                    <td>{{ $no+1 }}</td>
                    <td>{{ $order->product_name ?? '-' }}</td>
                    <td>{{ $order->user->name ?? 'Tidak ditemukan' }}</td>
                    <td>{{ ucfirst($order->status) }}</td>
                    <td>Rp {{ number_format($order->total ?? 0, 0, ',', '.') }}</td>
                    <td>{{ $order->created_at->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
