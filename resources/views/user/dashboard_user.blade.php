
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 style="color:#4caf50;">Beranda Pengguna</h1>

    <p>Selamat datang, {{ Auth::user()->name }}!</p>

    <div style="margin-top: 30px;">
        <a href="/products" style="background: #a5d6a7; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none;">
            🛒 Belanja Sekarang
        </a>
    </div>
</div>
@endsection
