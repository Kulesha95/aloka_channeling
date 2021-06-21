<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Prescription;
use App\Models\PurchaseOrder;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Support\Facades\View;

class DocumentController extends Controller
{

    private $marginTop = 50;
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
        $appointment = Appointment::find($id);
        $header = View::make('documents.header');
        $footer = View::make('documents.footer');
        $pdf = SnappyPdf::loadView('documents.channelingPayments', ['appointment' => $appointment])
            ->setOption('header-html', $header)->setOption('margin-top', $this->marginTop)
            ->setOption('footer-html', $footer)->setOption('margin-bottom',  $this->marginBottom);
        return ["document" => $pdf, "name" => $appointment->appointment_number . "_Channeling_Payments.pdf"];
    }

    public function getChannelingPaymentInvoice($id)
    {
        $appointment = Appointment::find($id);
        $header = View::make('documents.header');
        $footer = View::make('documents.footer');
        $pdf = SnappyPdf::loadView('documents.channelingPaymentInvoice', ['appointment' => $appointment])
            ->setOption('header-html', $header)->setOption('margin-top', $this->marginTop)
            ->setOption('footer-html', $footer)->setOption('margin-bottom',  $this->marginBottom);
        return ["document" => $pdf, "name" => $appointment->appointment_number . "_Channeling_Payment_Invoice.pdf"];
    }

    public function getPrescription($id)
    {
        $prescription = Prescription::find($id);
        $header = View::make('documents.header');
        $footer = View::make('documents.footer');
        $pdf = SnappyPdf::loadView('documents.prescription', ['prescription' => $prescription])
            ->setOption('header-html', $header)->setOption('margin-top', $this->marginTop)
            ->setOption('footer-html', $footer)->setOption('margin-bottom',  $this->marginBottom);
        return ["document" => $pdf, "name" => $prescription->prescription_number . "_Prescription.pdf"];
    }

    public function getPharmacyPaymentInvoice($id)
    {
        $prescription = Prescription::find($id);
        $header = View::make('documents.header');
        $footer = View::make('documents.footer');
        $pdf = SnappyPdf::loadView('documents.pharmacyPaymentInvoice', ['prescription' => $prescription])
            ->setOption('header-html', $header)->setOption('margin-top', $this->marginTop)
            ->setOption('footer-html', $footer)->setOption('margin-bottom',  $this->marginBottom);
        return ["document" => $pdf, "name" => $prescription->prescription_number . "_Pharmacy_Payment_Invoice.pdf"];
    }

    public function getPurchaseOrder($id)
    {
        $purchaseOrder = PurchaseOrder::find($id);
        $header = View::make('documents.header');
        $footer = View::make('documents.footer');
        $pdf = SnappyPdf::loadView('documents.purchaseOrder', ['purchaseOrder' => $purchaseOrder])
            ->setOption('header-html', $header)->setOption('margin-top', $this->marginTop)
            ->setOption('footer-html', $footer)->setOption('margin-bottom',  $this->marginBottom);
        return ["document" => $pdf, "name" => $purchaseOrder->purchase_order_number . "_Purchase_Order.pdf"];
    }
}