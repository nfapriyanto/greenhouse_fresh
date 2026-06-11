<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Laporan Penjualan</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    :root{--line:#cfe9d8;--ink:#143d2a;--head:#b7e4c7}
    *{box-sizing:border-box}
    body{font-family:Segoe UI,Arial,sans-serif;margin:0;padding:16px;color:var(--ink);background:#fff}

    .tools{display:flex;gap:8px;align-items:center;margin-bottom:10px}
    .btn{padding:8px 12px;border-radius:8px;border:1px solid var(--line);background:#e9f7ef;cursor:pointer;text-decoration:none;color:var(--ink)}
    .btn.primary{background:#52b788;color:#fff;border-color:#52b788}

    h2{margin:0 0 8px}
    .meta{font-size:13px;margin-bottom:8px;color:#6b7f76}

    table{width:100%;border-collapse:collapse}
    th,td{padding:8px;border:1px solid #e5e7eb}
    thead th{background:var(--head);text-align:left}
    tfoot td{font-weight:700;background:#f6fff8}
    .right{text-align:right}

    @page { size: A4; margin: 10mm; }
    @media print{
      .tools{display:none}
      body{padding:0}
      thead{display: table-header-group}
      tfoot{display: table-row-group}
    }
  </style>
</head>
<body>

<div class="tools">
  {{-- << Tombol kembali ke halaman laporan + tetap bawa query filter --}}
  <a class="btn" href="{{ route('admin.reports.sales.index', request()->query()) }}">Kembali ke Laporan</a>

  <button class="btn" onclick="window.print()">Cetak</button>
  <button class="btn primary" onclick="downloadAsPdf()">Unduh PDF</button>
  <span style="margin-left:auto;opacity:.7">Halaman ini otomatis mengunduh PDF jika memungkinkan…</span>
</div>

@php
  $totalTransaksi = count($orders);
  $totalNilai = $orders->sum('total_price');
@endphp

<div id="printArea">
  <h2>Laporan Penjualan</h2>
  <div class="meta">
    Periode: <strong>{{ $from ?: '–' }}</strong> s/d <strong>{{ $to ?: '–' }}</strong>
    &nbsp;|&nbsp; Status: <strong>{{ $status ?: '(semua)' }}</strong>
    &nbsp;|&nbsp; Total transaksi: <strong>{{ number_format($totalTransaksi) }}</strong>
    &nbsp;|&nbsp; Total nilai: <strong>Rp {{ number_format($totalNilai,0,',','.') }}</strong>
  </div>

  <table>
    <thead>
      <tr>
        <th style="width:56px">ID</th>
        <th style="width:160px">Tanggal</th>
        <th>Pelanggan</th>
        <th style="width:140px">Status</th>
        <th class="right" style="width:160px">Total</th>
      </tr>
    </thead>
    <tbody>
      @forelse($orders as $o)
        <tr>
          <td>{{ $o->id }}</td>
          <td>{{ optional($o->created_at)->format('Y-m-d H:i') }}</td>
          <td>{{ $o->user->name ?? '-' }}</td>
          <td>{{ $o->status }}</td>
          <td class="right">Rp {{ number_format($o->total_price,0,',','.') }}</td>
        </tr>
      @empty
        <tr><td colspan="5" style="opacity:.7">Tidak ada data.</td></tr>
      @endforelse
    </tbody>
    <tfoot>
      <tr>
        <td colspan="4" class="right">TOTAL</td>
        <td class="right">Rp {{ number_format($totalNilai,0,',','.') }}</td>
      </tr>
    </tfoot>
  </table>
</div>

<script src="https://unpkg.com/html2pdf.js@0.10.1/dist/html2pdf.bundle.min.js"></script>
<script>
  function downloadAsPdf(){
    const el = document.getElementById('printArea');
    html2pdf().set({
      margin: [10,10,10,10],
      filename: 'laporan-penjualan_{{ now()->format('Ymd_His') }}.pdf',
      image: { type: 'jpeg', quality: 0.98 },
      html2canvas: { scale: 2, useCORS: true },
      jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
    }).from(el).save();
  }

  // Auto-download saat fallback dipanggil dari controller
  @if(!empty($forceDownload))
    window.addEventListener('load', downloadAsPdf);
  @endif
</script>
</body>
</html>
