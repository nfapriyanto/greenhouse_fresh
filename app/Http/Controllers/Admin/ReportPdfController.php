<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportPdfController extends Controller
{
    public function export()
    {
        $orders = Order::with('user')->get();
        $pdf = Pdf::loadView('admin.report-pdf', compact('orders'));
        return $pdf->download('laporan-penjualan.pdf');
    }
}
