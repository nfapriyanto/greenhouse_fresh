<!-- resources/views/profile.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Saya</title>
    <style>
        body { font-family: sans-serif; padding: 20px; background-color: #f4fff4; }
        .box { max-width: 400px; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); margin: auto; }
        h1 { text-align: center; }
        p { margin-bottom: 8px; }
    </style>
</head>
<body>
    <div class="box">
        <h1>Profil Saya</h1>
        <p><strong>Nama:</strong> {{ auth()->user()->name }}</p>
        <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
        <p><strong>Tanggal Daftar:</strong> {{ auth()->user()->created_at->format('d M Y') }}</p>
    </div>
</body>
</html>
