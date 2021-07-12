<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DeficitItemsExport;
use App\Exports\StockExport;

class ExportController extends Controller
{

    public function exportDocument($type, $id, $format)
    {
        switch ($type) {
            case 'deficitItemsReport':
                return Excel::download(
                    new DeficitItemsExport,
                    'Deficit_Items_' . str_replace(" ", "_", now()->toDateTimeString())
                        . ($format == 'csv' ? '.csv' : '.xlsx'),
                );
                break;
            case 'stockReport':
                return Excel::download(
                    new StockExport,
                    'Stock_Report_' . str_replace(" ", "_", now()->toDateTimeString())
                        . ($format == 'csv' ? '.csv' : '.xlsx'),
                );
                break;
            default:
                return;
                break;
        }
    }
}