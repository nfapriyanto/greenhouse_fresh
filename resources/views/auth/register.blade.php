<!-- resources/views/auth/register.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Register - Green House</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <style>
    :root{
      --bg:#f0fff0; --green:#52b788; --green-dark:#40916c; --text:#1b4332;
      --line:#95d5b2; --err:#dc2626; --card:#ffffff;
    }
    *{box-sizing:border-box}
    body{margin:0;font-family:'Segoe UI',Arial,sans-serif;background:var(--bg);color:var(--text)}
    .wrap{min-height:100dvh;display:flex;align-items:center;justify-content:center;padding:24px}
    .card{
      width:100%;max-width:480px;background:var(--card);border-radius:14px;padding:22px 22px 18px;
      box-shadow:0 10px 30px rgba(0,0,0,.08);border:1px solid #e7f5ea;position:relative;overflow:hidden
    }

    /* watermark logo di pojok kanan atas (BERWARNA, tidak grayscale) */
    .wm{
      position:absolute;right:10px;top:10px;width:72px;height:72px;
      opacity:.18;                 /* cukup samar tapi masih terlihat warna */
      user-select:none;pointer-events:none;
      filter:none;                  /* <- HAPUS grayscale */
      mix-blend-mode:normal;        /* atau 'multiply' kalau mau lebih menyatu */
    }

    /* header brand + judul */
    .brand-head{display:flex;align-items:center;gap:12px;margin-bottom:10px}
    .brand-badge{width:44px;height:44px;object-fit:contain;border-radius:10px;display:block}
    .title{margin:0;font-size:22px}
    .subtitle{margin:2px 0 0;color:#5c6b62;font-size:13px;font-weight:600}

    .row{margin-bottom:12px}
    label{display:block;font-weight:600;margin:0 0 6px}
    input[type="text"],input[type="email"],input[type="password"]{
      width:100%;padding:10px 12px;border:1px solid var(--line);border-radius:10px;background:#fff;
      outline:none;transition:border-color .2s, box-shadow .2s
    }
    input:focus{border-color:var(--green);box-shadow:0 0 0 3px rgba(82,183,136,.15)}
    .grid-2{display:grid;grid-template-columns:1fr 1fr;gap:10px}

    .btn{display:inline-block;width:100%;background:var(--green);color:#fff;border:0;border-radius:10px;
         padding:10px 14px;cursor:pointer;font-weight:700}
    .btn:hover{background:var(--green-dark)}
    .actions{display:flex;align-items:center;justify-content:space-between;margin-top:10px}
    .error{color:var(--err);font-size:12px;margin-top:6px}
    .alert{background:#fee2e2;color:#991b1b;border:1px solid #fecaca;padding:10px 12px;border-radius:10px;margin-bottom:12px}

    /* toggle mata */
    .pw-wrap{position:relative}
    .pw-wrap .toggle{
      position:absolute;right:8px;top:50%;transform:translateY(-50%);
      width:36px;height:36px;display:flex;align-items:center;justify-content:center;
      border:0;background:transparent;cursor:pointer;border-radius:8px;
    }
    .pw-wrap .toggle:hover{background:#eaf7ef}
    .pw-wrap .toggle svg{width:20px;height:20px;stroke:#2d6a4f;fill:none;stroke-width:2}

    a{color:var(--green-dark);text-decoration:none}
    a:hover{text-decoration:underline}
  </style>
</head>
<body>
  <div class="wrap">
    <div class="card">
      {{-- watermark logo samar --}}
      <img src="{{ asset('images/logo-greenhouse.png') }}" alt="" class="wm" loading="lazy"
           onerror="this.style.display='none'">

      {{-- header brand + judul --}}
      <div class="brand-head">
        <picture>
          <source srcset="{{ asset('images/logo-greenhouse.webp') }}" type="image/webp">
          <img src="{{ asset('images/logo-greenhouse.png') }}" alt="Logo Green House" class="brand-badge" loading="eager"
               onerror="this.style.display='none'">
        </picture>
        <div>
          <h1 class="title">Buat Akun</h1>
          <p class="subtitle">Gabung dan mulai berbelanja di Green House 🌿</p>
        </div>
      </div>

      {{-- global errors --}}
      @if ($errors->any())
        <div class="alert">
          <ul style="margin:0;padding-left:18px">
            @foreach ($errors->all() as $e)
              <li>{{ $e }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('register.post') }}" method="POST" novalidate>
        @csrf

        <div class="row">
          <label for="name">Nama Lengkap</label>
          <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus>
          @error('name')<div class="error">{{ $message }}</div>@enderror
        </div>

        <div class="row">
          <label for="email">Email</label>
          <input id="email" name="email" type="email" value="{{ old('email') }}" required>
          @error('email')<div class="error">{{ $message }}</div>@enderror
        </div>

        <div class="grid-2">
          <div class="row pw-wrap">
            <label for="password">Password</label>
            <input id="password" name="password" type="password" required minlength="6">
            <button type="button" class="toggle" aria-label="Tampilkan password" onclick="togglePw('password', this)">
              <svg class="icon-eye" viewBox="0 0 24 24"><path d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></svg>
              <svg class="icon-eye-off" viewBox="0 0 24 24" style="display:none">
                <path d="M3 3l18 18"/><path d="M10.5 6.3A10.8 10.8 0 0 1 12 5c6 0 10 7 10 7a21 21 0 0 1-3.1 4.3"/>
                <path d="M6.1 6.6A21 21 0 0 0 2 12s4 7 10 7c1.5 0 2.9-.3 4.2-.8"/>
              </svg>
            </button>
            @error('password')<div class="error" style="grid-column:1/-1">{{ $message }}</div>@enderror
          </div>

          <div class="row pw-wrap">
            <label for="password_confirmation">Konfirmasi Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required minlength="6">
            <button type="button" class="toggle" aria-label="Tampilkan password" onclick="togglePw('password_confirmation', this)">
              <svg class="icon-eye" viewBox="0 0 24 24"><path d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></svg>
              <svg class="icon-eye-off" viewBox="0 0 24 24" style="display:none">
                <path d="M3 3l18 18"/><path d="M10.5 6.3A10.8 10.8 0 0 1 12 5c6 0 10 7 10 7a21 21 0 0 1-3.1 4.3"/>
                <path d="M6.1 6.6A21 21 0 0 0 2 12s4 7 10 7c1.5 0 2.9-.3 4.2-.8"/>
              </svg>
            </button>
          </div>
        </div>

        <div class="row" style="margin-top:6px">
          <button class="btn" type="submit">Daftar</button>
        </div>

        <div class="actions">
          <span class="subtitle" style="font-weight:400">Sudah punya akun?</span>
          <a href="{{ route('login') }}">Masuk</a>
        </div>
      </form>
    </div>
  </div>

  <script>
    function togglePw(id, btn){
      const inp = document.getElementById(id);
      const isHidden = inp.type === 'password';
      inp.type = isHidden ? 'text' : 'password';
      btn.querySelector('.icon-eye').style.display     = isHidden ? 'none' : 'inline';
      btn.querySelector('.icon-eye-off').style.display = isHidden ? 'inline' : 'none';
      btn.setAttribute('aria-label', isHidden ? 'Sembunyikan password' : 'Tampilkan password');
    }
  </script>
</body>
</html>
