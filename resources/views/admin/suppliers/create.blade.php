<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Supplier</title>

    <style>
        :root{
            --green:#52b788;
            --green-dark:#40916c;
            --bg:#f0fff0;
        }

        body{
            font-family:'Segoe UI',sans-serif;
            background:var(--bg);
            margin:0;
            padding:20px;
        }

        .container{
            max-width:700px;
            margin:auto;
            background:white;
            padding:24px;
            border-radius:16px;
            box-shadow:0 2px 10px rgba(0,0,0,.05);
        }

        h1{
            margin-top:0;
            color:var(--green-dark);
        }

        label{
            display:block;
            margin-top:16px;
            margin-bottom:6px;
            font-weight:600;
        }

        input, textarea{
            width:100%;
            padding:12px;
            border:1px solid #ddd;
            border-radius:10px;
        }

        button{
            margin-top:20px;
            background:var(--green);
            color:white;
            border:none;
            padding:12px 18px;
            border-radius:10px;
            cursor:pointer;
            font-weight:600;
        }

        button:hover{
            background:var(--green-dark);
        }

        .back{
            display:inline-block;
            margin-bottom:20px;
            text-decoration:none;
            color:#333;
        }
    </style>
</head>
<body>

<div class="container">

    <a href="{{ route('admin.suppliers.index') }}"
       class="back">
       ← Kembali
    </a>

    <h1>Tambah Supplier</h1>

    <form action="{{ route('admin.suppliers.store') }}"
          method="POST">

        @csrf

        <label>Nama Supplier</label>
        <input type="text"
               name="name"
               required>

        <label>No HP</label>
        <input type="text"
               name="phone">

        <label>Email</label>
        <input type="email"
               name="email">

        <label>Alamat</label>
        <textarea name="address"
                  rows="4"></textarea>

        <button type="submit">
            Simpan Supplier
        </button>

    </form>

</div>

</body>
</html>