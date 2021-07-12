<?php

namespace App\Exports;

use App\Models\Batch;
use App\Models\Income;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class IncomeExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithStyles
{
    private $fromDate, $toDate;

    public function __construct($fromDate, $toDate)
    {
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Income::where('date', '>=', $this->fromDate)->where('date', '<=', $this->toDate)->get();
    }

    public function map($income): array
    {
        return [
            $income->invoice_number,
            $income->reason,
            $income->date,
            $income->time_text,
            $income->amount_text,
        ];
    }

    public function headings(): array
    {
        return [
            __('app.fields.invoiceNumber'),
            __('app.fields.description'),
            __('app.fields.date'),
            __('app.fields.time'),
            __('app.fields.amount'),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]]
        ];
    }
}