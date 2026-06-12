<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Log;

class MidtransController extends Controller
{
    public function notification(Request $request)
    {
        $payload = $request->all();
        Log::info('Midtrans Notification Payload:', $payload);

        $orderIdPayload = $payload['order_id'] ?? null;
        $transactionStatus = $payload['transaction_status'] ?? null;

        if (!$orderIdPayload) {
            return response()->json(['message' => 'Invalid order ID'], 400);
        }

        // Parse order_id from format 'ORDER-{id}-{timestamp}'
        $parts = explode('-', $orderIdPayload);
        $orderId = $parts[1] ?? null;

        if (!$orderId) {
            return response()->json(['message' => 'Order ID not parsed'], 400);
        }

        $order = Order::find($orderId);
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $paymentType = $payload['payment_type'] ?? 'midtrans';

        // Midtrans transaction status handling
        if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
            $order->update([
                'status' => 'processing',
                'payment_method' => $paymentType
            ]);
            Log::info("Order #{$orderId} status updated to processing and payment method set to {$paymentType} via Midtrans settlement.");
        } elseif ($transactionStatus == 'pending') {
            $order->update(['status' => 'pending']);
        } elseif ($transactionStatus == 'deny' || $transactionStatus == 'expire' || $transactionStatus == 'cancel') {
            $order->update(['status' => 'cancelled']);
            Log::info("Order #{$orderId} status updated to cancelled via Midtrans {$transactionStatus}.");
        }

        return response()->json(['message' => 'Success']);
    }
}
