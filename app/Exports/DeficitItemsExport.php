<?php

namespace App\Exports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DeficitItemsExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Item::all()->filter(function ($item) {
            return $item->stock <= $item->reorder_level;
        });
    }

    public function map($item): array
    {
        return [
            $item->generic_name_text,
            $item->brand_name,
            $item->reorder_level . " " . $item->unit,
            $item->stock . " " . $item->unit,
        ];
    }

    public function headings(): array
    {
        return [
            __('app.fields.genericName'),
            __('app.fields.brandName'),
            __('app.fields.reorderLevel'),
            __('app.fields.stockQuantity'),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]]
        ];
    }
}