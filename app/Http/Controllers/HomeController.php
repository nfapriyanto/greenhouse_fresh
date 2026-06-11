<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Collection;

class HomeController extends Controller
{
    /**
     * Beranda publik.
     */
    public function index(Request $request)
    {
        return view('home', $this->buildListVars($request));
    }

    /**
     * Dashboard user (setelah login).
     */
    public function dashboard(Request $request)
    {
        return view('user.dashboard', $this->buildListVars($request));
    }

    /**
     * Kumpulkan variabel untuk listing produk (dipakai beranda & dashboard).
     */
    protected function buildListVars(Request $request): array
    {
        // --- Daftar kategori unik dari DB (dipakai untuk validasi & UI) ---
        /** @var Collection<int,string> $categories */
        $categories = Product::query()
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category')
            ->filter()
            ->unique()
            ->sort()
            ->values();

        // --- Ambil & normalisasi parameter query ---
        $q        = trim((string) $request->query('q', ''));
        $category = (string) $request->query('category', '');

        // Validasi kategori: kosong atau harus ada di daftar
        if ($category === '' || !$categories->contains($category)) {
            $category = '';
        }

        // Kontrol jumlah item per halaman
        // per boleh: 12, 24, 48, 'all'
        $perRaw = (string) $request->query('per', '12');
        $per    = in_array($perRaw, ['12','24','48','all'], true) ? $perRaw : '12';

        // --- Bangun query produk ---
        $query = Product::query()->latest('id');

        if ($category !== '') {
            $query->where('category', $category);
        }

        if ($q !== '') {
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%");
            });
        }

        // Jika per=all ambil semua tanpa pagination; lainnya pakai paginate
        if ($per === 'all') {
            $products = $query->get();
        } else {
            $products = $query->paginate((int) $per)->withQueryString();
        }

        // --- Hitung badge keranjang dari session (opsional) ---
        $cart = (array) session('cart', []);
        $cartCount = 0;
        foreach ($cart as $row) {
            $cartCount += (int) ($row['qty'] ?? $row['quantity'] ?? 0);
        }

        return [
            'products'   => $products,
            'categories' => $categories,
            'category'   => $category,
            'q'          => $q,
            'per'        => $per,
            'cartCount'  => $cartCount,
        ];
    }
}
