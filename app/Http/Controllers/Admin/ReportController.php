<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /** Builder dasar + normalisasi parameter filter */
    protected function baseQuery(Request $request)
    {
        $from   = $request->query('from');                  // YYYY-MM-DD
        $to     = $request->query('to');                    // YYYY-MM-DD
        $status = $request->query('status', 'completed');   // default: selesai

        $q = Order::with('user')
            ->when($status !== '', fn ($qq) => $qq->where('status', $status))
            ->when($from, fn ($qq) => $qq->whereDate('created_at', '>=', $from))
            ->when($to,   fn ($qq) => $qq->whereDate('created_at', '<=', $to))
            ->orderByDesc('created_at');

        return [$q, $from, $to, $status];
    }

    /** Halaman laporan + filter */
    public function sales(Request $request)
    {
        [$q, $from, $to, $status] = $this->baseQuery($request);

        $orders  = $q->paginate(20)->withQueryString();
        $summary = [
            'count' => (clone $q)->count(),
            'total' => (clone $q)->sum('total_price'),
        ];

        return view('admin.reports.sales', compact('orders', 'from', 'to', 'status', 'summary'));
    }

    /** Export Excel (CSV) – tanpa paket tambahan */
    public function exportCsv(Request $request)
    {
        [$q] = $this->baseQuery($request);
        $rows = $q->get();

        $filename = 'laporan-penjualan_' . now()->format('Ymd_His') . '.csv';
        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($rows) {
            $out = fopen('php://output', 'w');
            // BOM UTF-8 agar Excel Windows aman
            fwrite($out, chr(0xEF) . chr(0xBB) . chr(0xBF));
            fputcsv($out, ['ID', 'Tanggal', 'Pelanggan', 'Status', 'Total']);

            foreach ($rows as $o) {
                fputcsv($out, [
                    $o->id,
                    optional($o->created_at)->format('Y-m-d H:i'),
                    optional($o->user)->name ?? '-',
                    $o->status,
                    $o->total_price,
                ]);
            }
            fclose($out);
        };

        return response()->stream($callback, 200, $headers);
    }

    /** Export PDF – pakai DomPDF jika tersedia, jika tidak fallback ke html2pdf.js */
    public function exportPdf(Request $request)
    {
        [$q, $from, $to, $status] = $this->baseQuery($request);
        $orders = $q->get();
        $data   = compact('orders', 'from', 'to', 'status');

        // Jika barryvdh/laravel-dompdf terpasang & kompatibel
        if (class_exists(\Barryvdh\DomPDF\Facade\Pdf::class)) {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.reports.sales_pdf', $data)
                ->setPaper('a4', 'portrait');

            return $pdf->download('laporan-penjualan_' . now()->format('Ymd_His') . '.pdf');
        }

        // Fallback: buka halaman yang akan auto-unduh via html2pdf.js
        return view('admin.reports.sales_print', $data + ['forceDownload' => true]);
    }
}
