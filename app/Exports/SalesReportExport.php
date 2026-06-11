<?php

namespace App\Exports;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class SalesReportExport implements FromArray, WithHeadings, ShouldAutoSize, WithColumnFormatting, Responsable
{
    /** @var \Illuminate\Support\Collection */
    private $rows;
    private $from;
    private $to;
    private $status;

    public function __construct(Collection $rows, $from, $to, $status)
    {
        $this->rows = $rows;
        $this->from = $from;
        $this->to   = $to;
        $this->status = $status;
    }

    public function headings(): array
    {
        return ['ID', 'Tanggal', 'Pelanggan', 'Total (Rp)', 'Status'];
    }

    public function array(): array
    {
        return $this->rows->map(function ($o) {
            return [
                $o->id,
                optional($o->created_at)->format('Y-m-d H:i'),
                $o->user->name ?? '-',
                (int) $o->total_price,
                $o->status,
            ];
        })->toArray();
    }

    public function columnFormats(): array
    {
        // Kolom D (4) = angka rupiah
        return ['D' => NumberFormat::FORMAT_NUMBER];
    }
}
