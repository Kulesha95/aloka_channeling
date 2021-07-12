<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DeficitItemsExport;
use App\Exports\ExpenseExport;
use App\Exports\IncomeExport;
use App\Exports\StockExport;
use Illuminate\Http\Request;

class ExportController extends Controller
{

    public function exportDocument(Request $request, $type, $id, $format)
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
            case 'incomeReport':
                return Excel::download(
                    new IncomeExport($request->get('fromDate'), $request->get('toDate')),
                    'Income_Report_' . str_replace(" ", "_", now()->toDateTimeString())
                        . ($format == 'csv' ? '.csv' : '.xlsx'),
                );
                break;
            case 'expenseReport':
                return Excel::download(
                    new ExpenseExport($request->get('fromDate'), $request->get('toDate')),
                    'Expense_Report_' . str_replace(" ", "_", now()->toDateTimeString())
                        . ($format == 'csv' ? '.csv' : '.xlsx'),
                );
                break;
            default:
                return;
                break;
        }
    }
}