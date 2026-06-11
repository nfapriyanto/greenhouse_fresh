<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /** (Opsional) Halaman info pembayaran umum */
    public function showForm()
    {
        return view('payment.form');
    }

    /** (Opsional) Proses pembayaran online */
    public function processPayment(Request $request)
    {
        return back()->with('success', 'Pembayaran diproses.');
    }

    /** Tampilkan form upload bukti transfer */
    public function uploadForm(Request $request)
    {
        $userId = Auth::id();

        // Ambil order milik user yang masih menunggu bukti/validasi
        $orders = Order::where('user_id', $userId)
            ->whereIn('status', ['pending', 'waiting_verification'])
            ->latest('id')
            ->get();

        if ($orders->isEmpty()) {
            return redirect()
                ->route('home')
                ->with('error', 'Tidak ada pesanan yang menunggu pembayaran.');
        }

        return view('payment.upload', [
            'orders'          => $orders,
            'selectedOrderId' => (int) $request->query('order_id'),
        ]);
    }

    /** Simpan bukti transfer dan tampilkan halaman sukses */
    public function upload(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'order_id'       => ['required', 'integer', 'exists:orders,id'],
            'bukti_transfer' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:4096'], // 4MB
        ], [
            'bukti_transfer.required' => 'Harap pilih file bukti transfer.',
            'bukti_transfer.image'    => 'File harus berupa gambar.',
            'bukti_transfer.mimes'    => 'Format gambar harus JPG atau PNG.',
            'bukti_transfer.max'      => 'Ukuran file maksimal 4MB.',
        ]);

        $userId = Auth::id();

        // Pastikan order milik user yang login
        $order = Order::where('id', $validated['order_id'])
            ->where('user_id', $userId)
            ->first();

        if (!$order) {
            return back()->withErrors(['order_id' => 'Pesanan tidak ditemukan atau bukan milik Anda.'])->withInput();
        }

        // Simpan file ke storage/app/public/payments
        $path = $request->file('bukti_transfer')->store('payments', 'public');

        // Hapus file lama jika ada
        if (!empty($order->bukti_transfer) && Storage::disk('public')->exists($order->bukti_transfer)) {
            Storage::disk('public')->delete($order->bukti_transfer);
        }

        // Update order: path bukti + status menunggu verifikasi
        $order->bukti_transfer = $path;
        if (in_array($order->status, [null, 'pending'], true)) {
            $order->status = 'waiting_verification';
        }
        $order->save();

        // TAMPILKAN HALAMAN SUKSES (bukan redirect ke form lagi)
        return view('payment.success', ['order' => $order]);
    }
}
