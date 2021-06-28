<?php

namespace App\Jobs;

use App\Http\Controllers\DocumentController;
use App\Models\PurchaseOrder;
use App\Notifications\PurchaseOrderCreated;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendPurchaseOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $purchaseOrderId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($purchaseOrderId)
    {
        $this->purchaseOrderId = $purchaseOrderId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $purchaseOrder = PurchaseOrder::find($this->purchaseOrderId);
        $documentController = new DocumentController();
        $pdf = $documentController->getPurchaseOrder($purchaseOrder->id)['document'];
        $purchaseOrder->supplier->notify(new PurchaseOrderCreated($this->purchaseOrderId, $pdf->output()));
    }
}