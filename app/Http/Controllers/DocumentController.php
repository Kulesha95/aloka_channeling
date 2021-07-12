<?php

namespace App\Http\Controllers;

use App\Constants\Expenses;
use App\Constants\Incomes;
use App\Constants\Prescriptions;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Expense;
use App\Models\GoodReceive;
use App\Models\Income;
use App\Models\Item;
use App\Models\Prescription;
use App\Models\PurchaseOrder;
use App\Models\PurchaseReturn;
use App\Models\SalesReturn;
use App\Models\Schedule;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class DocumentController extends Controller
{

    private $marginTop = 50;
    private $marginBottom = 20;

    public function getDocument(Request $request, $type, $id, $action)
    {
        switch ($type) {
            case 'channelingPayments':
                $pdf = $this->getChannelingPayments($id);
                break;
            case 'channelingPaymentInvoice':
                $pdf = $this->getChannelingPaymentInvoice($id);
                break;
            case 'prescription':
                $pdf = $this->getPrescription($id);
                break;
            case 'pharmacyPaymentInvoice':
                $pdf = $this->getPharmacyPaymentInvoice($id);
                break;
            case 'purchaseOrder':
                $pdf = $this->getPurchaseOrder($id);
                break;
            case 'goodReceive':
                $pdf = $this->getGoodReceive($id);
                break;
            case 'salesReturn':
                $pdf = $this->getSalesReturn($id);
                break;
            case 'purchaseOrderVsGoodReceives':
                $pdf = $this->getPurchaseOrderVsGoodReceives($id);
                break;
            case 'purchaseReturn':
                $pdf = $this->getPurchaseReturn($id);
                break;
            case 'supplierPayments':
                $pdf = $this->getSupplierPayments($id);
                break;
            case 'doctorPaymentsHistory':
                $pdf = $this->getDoctorPaymentsHistory($id);
                break;
            case 'doctorPaymentVoucher':
                $pdf = $this->getDoctorPaymentVoucher($id);
                break;
            case 'profitAndLossReport':
                $pdf = $this->getProfitAndLossReport($request);
                break;
            case 'deficitItemsReport':
                $pdf = $this->getDeficitItemsReport();
                break;
            default:
                return;
                break;
        }
        if ($action == 'download') {
            return $pdf['document']->download($pdf['name']);
        } else {
            return $pdf['document']->stream();
        }
    }

    public function getChannelingPayments($id)
    {
        $appointment = Appointment::findOrFail($id);
        $header = View::make('documents.header');
        $footer = View::make('documents.footer');
        $pdf = SnappyPdf::loadView('documents.channelingPayments', ['appointment' => $appointment])
            ->setOption('header-html', $header)->setOption('margin-top', $this->marginTop)
            ->setOption('footer-html', $footer)->setOption('margin-bottom',  $this->marginBottom);
        return ["document" => $pdf, "name" => $appointment->appointment_number . "_Channeling_Payments.pdf"];
    }

    public function getChannelingPaymentInvoice($id)
    {
        $appointment = Appointment::findOrFail($id);
        $header = View::make('documents.header');
        $footer = View::make('documents.footer');
        $pdf = SnappyPdf::loadView('documents.channelingPaymentInvoice', ['appointment' => $appointment])
            ->setOption('header-html', $header)->setOption('margin-top', $this->marginTop)
            ->setOption('footer-html', $footer)->setOption('margin-bottom',  $this->marginBottom);
        return ["document" => $pdf, "name" => $appointment->appointment_number . "_Channeling_Payment_Invoice.pdf"];
    }

    public function getPrescription($id)
    {
        $prescription = Prescription::findOrFail($id);
        $header = View::make('documents.header');
        $footer = View::make('documents.footer');
        $pdf = SnappyPdf::loadView('documents.prescription', ['prescription' => $prescription])
            ->setOption('header-html', $header)->setOption('margin-top', $this->marginTop)
            ->setOption('footer-html', $footer)->setOption('margin-bottom',  $this->marginBottom);
        return ["document" => $pdf, "name" => $prescription->prescription_number . "_Prescription.pdf"];
    }

    public function getPharmacyPaymentInvoice($id)
    {
        $prescription = Prescription::findOrFail($id);
        $header = View::make('documents.header');
        $footer = View::make('documents.footer');
        $pdf = SnappyPdf::loadView('documents.pharmacyPaymentInvoice', ['prescription' => $prescription])
            ->setOption('header-html', $header)->setOption('margin-top', $this->marginTop)
            ->setOption('footer-html', $footer)->setOption('margin-bottom',  $this->marginBottom);
        return ["document" => $pdf, "name" => $prescription->prescription_number . "_Pharmacy_Payment_Invoice.pdf"];
    }

    public function getPurchaseOrder($id)
    {
        $purchaseOrder = PurchaseOrder::findOrFail($id);
        $header = View::make('documents.header');
        $footer = View::make('documents.footer');
        $pdf = SnappyPdf::loadView('documents.purchaseOrder', ['purchaseOrder' => $purchaseOrder])
            ->setOption('header-html', $header)->setOption('margin-top', $this->marginTop)
            ->setOption('footer-html', $footer)->setOption('margin-bottom',  $this->marginBottom);
        return ["document" => $pdf, "name" => $purchaseOrder->purchase_order_number . "_Purchase_Order.pdf"];
    }

    public function getGoodReceive($id)
    {
        $goodReceive = GoodReceive::findOrFail($id);
        $header = View::make('documents.header');
        $footer = View::make('documents.footer');
        $pdf = SnappyPdf::loadView('documents.goodReceive', ['goodReceive' => $goodReceive])
            ->setOption('header-html', $header)->setOption('margin-top', $this->marginTop)
            ->setOption('footer-html', $footer)->setOption('margin-bottom',  $this->marginBottom);
        return ["document" => $pdf, "name" => $goodReceive->good_receive_number . "_Good_Receive.pdf"];
    }

    public function getSalesReturn($id)
    {
        $salesReturn = SalesReturn::findOrFail($id);
        $header = View::make('documents.header');
        $footer = View::make('documents.footer');
        $pdf = SnappyPdf::loadView('documents.salesReturn', ['salesReturn' => $salesReturn])
            ->setOption('header-html', $header)->setOption('margin-top', $this->marginTop)
            ->setOption('footer-html', $footer)->setOption('margin-bottom',  $this->marginBottom);
        return ["document" => $pdf, "name" => $salesReturn->sales_return_number . "_Sales_Return.pdf"];
    }

    public function getPurchaseOrderVsGoodReceives($id)
    {
        $purchaseOrder = PurchaseOrder::findOrFail($id);
        $goodReceiveItems = $purchaseOrder->batches->groupBy('item_id')->mapWithKeys(function ($goodReceiveItemCollection) {
            return [$goodReceiveItemCollection->first()->item_id => $goodReceiveItemCollection->sum('purchase_quantity')];
        });
        $header = View::make('documents.header');
        $footer = View::make('documents.footer');
        $pdf = SnappyPdf::loadView('documents.purchaseOrderVsGoodReceives', [
            'purchaseOrder' => $purchaseOrder,
            'goodReceiveItems' => $goodReceiveItems
        ])
            ->setOption('header-html', $header)->setOption('margin-top', $this->marginTop)
            ->setOption('footer-html', $footer)->setOption('margin-bottom',  $this->marginBottom);
        return ["document" => $pdf, "name" => $purchaseOrder->purchase_order_number . "_Purchase_Order_Vs_Good_Receives.pdf"];
    }

    public function getPurchaseReturn($id)
    {
        $purchaseReturn = PurchaseReturn::findOrFail($id);
        $header = View::make('documents.header');
        $footer = View::make('documents.footer');
        $pdf = SnappyPdf::loadView('documents.purchaseReturn', ['purchaseReturn' => $purchaseReturn])
            ->setOption('header-html', $header)->setOption('margin-top', $this->marginTop)
            ->setOption('footer-html', $footer)->setOption('margin-bottom',  $this->marginBottom);
        return ["document" => $pdf, "name" => $purchaseReturn->purchase_return_number . "_Purchase_Return.pdf"];
    }

    public function getSupplierPayments($id)
    {
        $goodReceive = GoodReceive::findOrFail($id);
        $header = View::make('documents.header');
        $footer = View::make('documents.footer');
        $pdf = SnappyPdf::loadView('documents.supplierPayments', ['goodReceive' => $goodReceive])
            ->setOption('header-html', $header)->setOption('margin-top', $this->marginTop)
            ->setOption('footer-html', $footer)->setOption('margin-bottom',  $this->marginBottom);
        return ["document" => $pdf, "name" => $goodReceive->good_receive_number . "_Supplier_Payments.pdf"];
    }

    public function getDoctorPaymentsHistory($id)
    {
        $schedule = Schedule::findOrFail($id);
        $header = View::make('documents.header');
        $footer = View::make('documents.footer');
        $pdf = SnappyPdf::loadView('documents.doctorPaymentsHistory', ['schedule' => $schedule])
            ->setOption('header-html', $header)->setOption('margin-top', $this->marginTop)
            ->setOption('footer-html', $footer)->setOption('margin-bottom',  $this->marginBottom);
        return ["document" => $pdf, "name" => $schedule->schedule_number . "_Doctor_Payments_History.pdf"];
    }

    public function getDoctorPaymentVoucher($id)
    {
        $expense = Expense::findOrFail($id);
        $header = View::make('documents.header');
        $footer = View::make('documents.footer');
        $pdf = SnappyPdf::loadView('documents.doctorPaymentVoucher', ['expense' => $expense])
            ->setOption('header-html', $header)->setOption('margin-top', $this->marginTop)
            ->setOption('footer-html', $footer)->setOption('margin-bottom',  $this->marginBottom);
        return ["document" => $pdf, "name" => $expense->expense_number . "_Doctor_Payment_Voucher.pdf"];
    }

    public function getProfitAndLossReport($request)
    {
        $fromDate = $request->get('fromDate');
        $toDate = $request->get('toDate');
        $expenses = Expense::where('date', '>=', $fromDate)->where('date', '<=', $toDate)->get();
        $incomes = Income::where('date', '>=', $fromDate)->where('date', '<=', $toDate)->get();
        $channelingIncome = $incomes->where('incomeable_type', Incomes::CHANNELING_PAYMENT)->sum('amount');
        $externalPrescriptionIncome = $incomes->where('incomeable_type', Incomes::PHARMACY_PAYMENT)
            ->filter(function ($income) {
                return $income->incomeable->type == Prescriptions::EXTERNAL_MEDICAL_PRESCRIPTION;
            })->sum('amount');
        $internalPrescriptionIncome = $incomes->where('incomeable_type', Incomes::PHARMACY_PAYMENT)
            ->filter(function ($income) {
                return $income->incomeable->type == Prescriptions::INTERNAL_MEDICAL_PRESCRIPTION;
            })->sum('amount');
        $supplierPayments = $expenses->where('expenseable_type', Expenses::GOOD_RECEIVE)->sum('amount');
        $doctorPayments = $expenses->where('expenseable_type', Expenses::SCHEDULE_PAYMENT)->sum('amount');
        $totalIncomes = $incomes->sum('amount');
        $totalExpenses = $expenses->sum('amount');
        $totalProfit = $totalIncomes - $totalExpenses;
        $header = View::make('documents.header');
        $footer = View::make('documents.footer');
        $pdf = SnappyPdf::loadView('documents.profitAndLossReport', [
            'channelingIncome' => $channelingIncome,
            'externalPrescriptionIncome' => $externalPrescriptionIncome,
            'internalPrescriptionIncome' => $internalPrescriptionIncome,
            'supplierPayments' => $supplierPayments,
            'doctorPayments' => $doctorPayments,
            'totalIncome' => $totalIncomes,
            'totalExpense' => $totalExpenses,
            'totalProfit' => $totalProfit,
            "fromDate" => $fromDate,
            "toDate" => $toDate
        ])
            ->setOption('header-html', $header)->setOption('margin-top', $this->marginTop)
            ->setOption('footer-html', $footer)->setOption('margin-bottom',  $this->marginBottom);
        return ["document" => $pdf, "name" => "Profit_And_Loss_Report.pdf"];
    }

    public function getDeficitItemsReport()
    {
        $deficitItems = Item::all()->filter(function ($item) {
            return $item->stock <= $item->reorder_level;
        });
        $header = View::make('documents.header');
        $footer = View::make('documents.footer');
        $pdf = SnappyPdf::loadView('documents.deficitItemsReport', ['deficitItems' => $deficitItems])
            ->setOption('header-html', $header)->setOption('margin-top', $this->marginTop)
            ->setOption('footer-html', $footer)->setOption('margin-bottom',  $this->marginBottom);
        return ["document" => $pdf, "name" => "Deficit_Items_Report.pdf"];
    }
}