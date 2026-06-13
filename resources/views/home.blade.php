@extends('layouts.app')

@section('content')

@php

    use Illuminate\Support\Facades\Storage;

@endphp

<!-- HERO -->

<div class="hero">

    <h1>

        Belanja Sayur & Sembako Fresh

    </h1>

    <p>

        Produk segar, berkualitas, dan harga terbaik setiap hari

    </p>

</div>

<!-- ALERT -->

@if(session('success'))

    <div class="alert alert-success">

        {{ session('success') }}

    </div>

@endif

@if(session('error'))

    <div class="alert error">

        {{ session('error') }}

    </div>

@endif

<!-- CONTROLS -->

<div class="controls">

    <div class="left-controls">

        <form
            action="{{ route('home') }}"
            method="GET"
        >

            <label>

                Kategori

            </label>

            <select
                name="category"
                onchange="this.form.submit()"
            >

                <option value="">
                    Semua Produk
                </option>

                <option
                    value="sayuran"
                    {{ request('category') == 'sayuran' ? 'selected' : '' }}
                >
                    Sayuran
                </option>

                <option
                    value="sembako"
                    {{ request('category') == 'sembako' ? 'selected' : '' }}
                >
                    Sembako
                </option>

            </select>

        </form>

    </div>

    <button
        class="toggle-btn"
        type="button"
        id="toggleCompact"
    >

        Tampilan :
        <span id="modeTxt">

            Cozy

        </span>

    </button>

</div>

<!-- PRODUCTS -->

<div
    class="products-grid"
    id="productGrid"
>

@forelse($products as $product)

    @php

        $placeholder =
        'https://via.placeholder.com/400x300?text=Green+House';

        $image = $placeholder;

        if(!empty($product->image)){

            $filename =
            basename($product->image);

            if(
                Storage::disk('public')
                ->exists('products/'.$filename)
            ){

                $image =
                asset(
                    'storage/products/'.$filename
                );
            }
        }

    @endphp

    <!-- PRODUCT CARD -->

    <div class="product-card">

        <!-- IMAGE -->

        <img
            src="{{ $image }}"
            alt="{{ $product->name }}"
            class="product-image"
            loading="lazy"
            onerror="this.onerror=null;this.src='{{ $placeholder }}'"
        >

        <!-- CONTENT -->

        <div class="product-content">

            <div class="product-title">

                {{ $product->name }}

            </div>

            <div class="product-price">

                Rp {{ number_format($product->price,0,',','.') }}

            </div>

            <form
                action="{{ route('cart.add',$product->id) }}"
                method="POST"
            >

                @csrf

                @if($product->stock > 0)
                    <button
                        type="submit"
                        class="btn-cart"
                    >
                        + Tambah Keranjang
                    </button>
                @else
                    <button
                        type="button"
                        class="btn-cart"
                        disabled
                        style="background: #94a3b8; cursor: not-allowed; transform: none; box-shadow: none;"
                    >
                        Stok Habis
                    </button>
                @endif

            </form>

        </div>

    </div>

@empty

    <div class="alert error">

        Produk tidak tersedia.

    </div>

@endforelse

</div>

<!-- PAGINATION -->

@if(is_object($products) && method_exists($products,'links'))

    <div style="margin-top:35px">

        {{ $products->links() }}

    </div>

@endif

<!-- COMPACT MODE -->

<script>

    (function(){

        const key = 'gh_compact';

        const modeTxt =
        document.getElementById('modeTxt');

        const productGrid =
        document.getElementById('productGrid');

        function setMode(on){

            if(on){

                productGrid.style.gridTemplateColumns =
                'repeat(auto-fill,minmax(190px,1fr))';

                modeTxt.innerText =
                'Compact';

            }else{

                productGrid.style.gridTemplateColumns =
                'repeat(auto-fill,minmax(250px,1fr))';

                modeTxt.innerText =
                'Cozy';
            }
        }

        setMode(

            localStorage.getItem(key) === '1'

        );

        document
        .getElementById('toggleCompact')
        .addEventListener('click', function(){

            const active =
            modeTxt.innerText === 'Cozy';

            setMode(active);

            localStorage.setItem(
                key,
                active ? '1' : '0'
            );

        });

    })();

</script>

@endsection