@php
  // Pakai route('admin.dashboard') kalau ada; kalau tidak, fallback ke /admin
  $adminHome = \Illuminate\Support\Facades\Route::has('admin.dashboard')
      ? route('admin.dashboard')
      : url('/admin');
@endphp

<div style="
  position:sticky; top:0; z-index:50;
  background:#d8f3dc; border-bottom:1px solid #b7e4c7;
  padding:10px 12px; display:flex; gap:8px; align-items:center;
  box-shadow:0 2px 8px rgba(0,0,0,.05);
">
  <a href="{{ $adminHome }}" style="
    display:inline-flex; align-items:center; gap:8px;
    background:#e9f7ef; color:#1b4332; border:1px solid #b7e4c7;
    padding:8px 12px; border-radius:10px; font-weight:700; text-decoration:none;
  ">
    ← Kembali ke Beranda Admin
  </a>
</div>
