<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Expense;
use App\Models\GoodReceive;
use App\Models\Prescription;
use App\Models\PurchaseOrder;
use App\Models\PurchaseReturn;
use App\Models\SalesReturn;
use App\Models\Schedule;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Support\Facades\View;

class DocumentController extends Controller
{

    private $marginTop = 65;
    private $marginBottom = 20;

    public function getDocument($type, $id, $action)
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
}