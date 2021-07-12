<?php

namespace App\Exports;

use App\Models\Expense;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExpenseExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithStyles
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
        return Expense::where('date', '>=', $this->fromDate)->where('date', '<=', $this->toDate)->get();
    }

    public function map($expense): array
    {
        return [
            $expense->voucher_number,
            $expense->reason,
            $expense->date,
            $expense->time_text,
            $expense->amount_text,
        ];
    }

    public function headings(): array
    {
        return [
            __('app.fields.voucherNumber'),
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