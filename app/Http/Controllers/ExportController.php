<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ItemsExport;

class ExportController extends Controller
{

    public function exportDocument($type, $id, $format)
    {
        switch ($type) {
            case 'deficitItemsReport':
                return Excel::download(
                    new ItemsExport,
                    'Deficit_Items_' . str_replace(" ", "_", now()->toDateTimeString())
                        . ($type == 'csv' ? '.csv' : '.xlsx'),
                );
                break;
            default:
                return;
                break;
        }
    }
}