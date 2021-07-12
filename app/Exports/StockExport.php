<?php

namespace App\Exports;

use App\Models\Batch;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StockExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Batch::all();
    }

    public function map($batch): array
    {
        return [
            $batch->item->generic_name_text,
            $batch->item->brand_name,
            $batch->expire_date,
            $batch->purchase_price_text,
            $batch->price_text,
            $batch->item->reorder_level . " " . $batch->item->unit,
            $batch->stock_quantity . " " . $batch->item->unit,
            $batch->reserved_quantity . " " . $batch->item->unit,
            $batch->returnable_quantity . " " . $batch->item->unit,
        ];
    }

    public function headings(): array
    {
        return [
            __('app.fields.genericName'),
            __('app.fields.brandName'),
            __('app.fields.expireDate'),
            __('app.fields.purchasePrice'),
            __('app.fields.sellingPrice'),
            __('app.fields.reorderLevel'),
            __('app.fields.stockQuantity'),
            __('app.fields.reservedQuantity'),
            __('app.fields.returnableQuantity'),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]]
        ];
    }
}