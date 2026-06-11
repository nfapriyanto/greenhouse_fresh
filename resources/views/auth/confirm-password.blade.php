<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><title>Konfirmasi Password</title></head>
<body style="font-family:sans-serif">
  <h2>Konfirmasi Password</h2>
  @if($errors->any()) <div style="color:red">{{ $errors->first() }}</div> @endif
  <form method="POST" action="{{ route('password.confirm') }}">
    @csrf
    <label>Password</label><br>
    <input type="password" name="password" required><br><br>
    <button type="submit">Konfirmasi</button>
  </form>
</body>
</html>
