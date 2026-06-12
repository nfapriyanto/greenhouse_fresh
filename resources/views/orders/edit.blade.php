@extends('layouts.app')

@section('content')
<div class="edit-order-page" style="padding: 10px 0 50px; max-width: 1000px; margin: auto;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <h2 style="font-size: 32px; font-weight: 800; color: #166534; margin: 0;">Edit Detail & Produk Pesanan #{{ $order->id }}</h2>
        <a href="{{ route('orders.mine') }}" style="color: #16a34a; font-weight: 600; text-decoration: none;">&larr; Kembali</a>
    </div>

    <!-- ERROR ALERT -->
    @if($errors->any())
        <div style="background:#fee2e2; color:#b91c1c; padding:16px; border-radius:18px; margin-bottom:24px; border:1px solid #fca5a5;">
            <ul style="margin: 0; padding-left:20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('orders.update_user', $order->id) }}" method="POST" id="edit-order-form">
        @csrf
        @method('PUT')

        <div style="display: grid; grid-template-columns: 1.2fr .8fr; gap: 28px; align-items: start;">
            
            <!-- LEFT: PRODUCT LIST -->
            <div style="background: white; border-radius: 28px; padding: 30px; box-shadow: 0 10px 30px rgba(0,0,0,.05); border: 1px solid #e2e8f0;">
                <h3 style="font-size: 20px; font-weight: 700; color: #166534; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                    <span>🥬</span> Sesuaikan Produk Pesanan
                </h3>

                <div style="display: flex; flex-direction: column; gap: 16px; max-height: 600px; overflow-y: auto; padding-right: 8px;">
                    @foreach($allProducts as $product)
                        @php
                            // Get current quantity in the order if exists
                            $currentOrderItem = $order->items->firstWhere('product_id', $product->id);
                            $currentQty = $currentOrderItem ? $currentOrderItem->quantity : 0;
                        @endphp
                        <div class="product-item-card" data-price="{{ $product->price }}" data-stock="{{ $product->stock }}" style="display: flex; align-items: center; justify-content: space-between; padding: 16px; border: 1px solid #f1f5f9; border-radius: 20px; transition: .3s; background: #f8fafc;">
                            <div style="flex: 1; min-width: 0; margin-right: 16px;">
                                <div style="font-weight: 700; color: #1e293b; font-size: 15px;">{{ $product->name }}</div>
                                <div style="font-size: 12px; color: var(--gray); margin-top: 4px;">
                                    Harga: <span style="font-weight: 600; color: #16a34a;">Rp {{ number_format($product->price, 0, ',', '.') }}</span> 
                                    | Stok: <span style="font-weight: 600;">{{ $product->stock }}</span>
                                </div>
                            </div>
                            
                            <!-- Quantity Controls -->
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <button type="button" class="qty-btn btn-minus" data-id="{{ $product->id }}" style="width: 36px; height: 36px; border-radius: 10px; border: 1px solid #cbd5e1; background: white; color: #1e293b; font-weight: 700; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: .2s;">-</button>
                                <input 
                                    type="number" 
                                    name="items[{{ $product->id }}]" 
                                    id="qty-input-{{ $product->id }}" 
                                    value="{{ old('items.'.$product->id, $currentQty) }}" 
                                    min="0" 
                                    max="{{ $product->stock }}"
                                    class="qty-field"
                                    data-id="{{ $product->id }}"
                                    style="width: 50px; height: 36px; text-align: center; border-radius: 10px; border: 1px solid #cbd5e1; font-family: inherit; font-weight: 700; outline: none; -moz-appearance: textfield;"
                                >
                                <button type="button" class="qty-btn btn-plus" data-id="{{ $product->id }}" style="width: 36px; height: 36px; border-radius: 10px; border: 1px solid #cbd5e1; background: white; color: #1e293b; font-weight: 700; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: .2s;">+</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- RIGHT: CUSTOMER INFO & SUMMARY -->
            <div style="display: flex; flex-direction: column; gap: 24px;">
                
                <!-- LIVE SUMMARY -->
                <div style="background: linear-gradient(135deg, #16a34a, #22c55e); color: white; padding: 24px; border-radius: 24px; box-shadow: 0 10px 30px rgba(22,163,74,.15);">
                    <h3 style="font-size: 16px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; opacity: 0.9;">Total Belanja Baru</h3>
                    <div style="font-size: 32px; font-weight: 800; margin-top: 6px;" id="live-grand-total">
                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                    </div>
                    <div style="font-size: 12px; margin-top: 10px; opacity: 0.8; line-height: 1.5;">
                        *Nominal pembayaran Midtrans akan disesuaikan otomatis dengan total belanja yang baru.
                    </div>
                </div>

                <!-- DELIVERY FORM -->
                <div style="background: white; border-radius: 28px; padding: 28px; box-shadow: 0 10px 30px rgba(0,0,0,.05); border: 1px solid #e2e8f0;">
                    <h3 style="font-size: 18px; font-weight: 700; color: #166534; margin-bottom: 20px;">👤 Data Pengiriman</h3>

                    <!-- NAME -->
                    <div style="margin-bottom: 18px;">
                        <label style="display: block; font-weight: 600; margin-bottom: 6px; color: #1e293b; font-size: 13px;">
                            Nama Penerima
                        </label>
                        <input 
                            type="text" 
                            name="name" 
                            value="{{ old('name', $order->name) }}" 
                            style="width: 100%; height: 48px; border-radius: 12px; border: 1px solid #cbd5e1; padding: 0 14px; outline: none; font-family: inherit; font-size: 14px;"
                            placeholder="Masukkan nama lengkap"
                            required
                        >
                    </div>

                    <!-- PHONE -->
                    <div style="margin-bottom: 18px;">
                        <label style="display: block; font-weight: 600; margin-bottom: 6px; color: #1e293b; font-size: 13px;">
                            No HP / WhatsApp
                        </label>
                        <input 
                            type="text" 
                            name="phone" 
                            value="{{ old('phone', $order->phone) }}" 
                            style="width: 100%; height: 48px; border-radius: 12px; border: 1px solid #cbd5e1; padding: 0 14px; outline: none; font-family: inherit; font-size: 14px;"
                            placeholder="08xxxxxxxxxx"
                            required
                        >
                    </div>

                    <!-- ADDRESS -->
                    <div style="margin-bottom: 24px;">
                        <label style="display: block; font-weight: 600; margin-bottom: 6px; color: #1e293b; font-size: 13px;">
                            Alamat Pengiriman
                        </label>
                        <textarea 
                            name="address" 
                            rows="3"
                            style="width: 100%; border-radius: 12px; border: 1px solid #cbd5e1; padding: 12px 14px; outline: none; font-family: inherit; font-size: 14px; resize: vertical;"
                            placeholder="Masukkan alamat lengkap"
                            required
                        >{{ old('address', $order->address) }}</textarea>
                    </div>

                    <!-- SUBMIT BUTTONS -->
                    <button 
                        type="submit" 
                        style="width: 100%; height: 50px; border-radius: 14px; border: none; background: #16a34a; color: white; font-weight: 700; font-size: 15px; cursor: pointer; transition: .3s; margin-bottom: 10px;"
                    >
                        Simpan Perubahan
                    </button>
                    <a 
                        href="{{ route('orders.mine') }}" 
                        style="display: flex; align-items: center; justify-content: center; width: 100%; height: 50px; border-radius: 14px; border: 1px solid #cbd5e1; background: white; color: #64748b; font-weight: 600; text-decoration: none; transition: .3s;"
                    >
                        Batal
                    </a>
                </div>

            </div>

        </div>

    </form>
</div>

<!-- STYLING HOVER & ANIMATIONS -->
<style>
    .product-item-card:hover {
        border-color: #bbf7d0 !important;
        background: #f0fdf4 !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(22,163,74,.04);
    }
    .qty-btn:hover {
        background: #ecfdf5 !important;
        border-color: #16a34a !important;
        color: #16a34a !important;
    }
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button { 
        -webkit-appearance: none; 
        margin: 0; 
    }
</style>

<!-- LIVE CALCULATION JAVASCRIPT -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const qtyInputs = document.querySelectorAll('.qty-field');
        const minusBtns = document.querySelectorAll('.btn-minus');
        const plusBtns = document.querySelectorAll('.btn-plus');
        const liveTotalElement = document.getElementById('live-grand-total');

        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(number).replace("Rp", "Rp ");
        }

        function calculateGrandTotal() {
            let total = 0;
            const cards = document.querySelectorAll('.product-item-card');
            
            cards.forEach(card => {
                const price = parseFloat(card.getAttribute('data-price'));
                const input = card.querySelector('.qty-field');
                const qty = parseInt(input.value) || 0;
                total += price * qty;
            });
            
            liveTotalElement.textContent = formatRupiah(total);
        }

        minusBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const input = document.getElementById('qty-input-' + id);
                let currentVal = parseInt(input.value) || 0;
                if (currentVal > 0) {
                    input.value = currentVal - 1;
                    calculateGrandTotal();
                }
            });
        });

        plusBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const input = document.getElementById('qty-input-' + id);
                const maxStock = parseInt(input.getAttribute('max')) || 0;
                let currentVal = parseInt(input.value) || 0;
                if (currentVal < maxStock) {
                    input.value = currentVal + 1;
                    calculateGrandTotal();
                } else {
                    alert('Jumlah tidak boleh melebihi stok yang tersedia (' + maxStock + ')');
                }
            });
        });

        qtyInputs.forEach(input => {
            input.addEventListener('change', function() {
                const maxStock = parseInt(this.getAttribute('max')) || 0;
                let currentVal = parseInt(this.value) || 0;
                
                if (currentVal < 0) {
                    this.value = 0;
                } else if (currentVal > maxStock) {
                    alert('Jumlah tidak boleh melebihi stok yang tersedia (' + maxStock + ')');
                    this.value = maxStock;
                }
                calculateGrandTotal();
            });
        });
    });
</script>
@endsection
