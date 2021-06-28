<?php

namespace App\Console\Commands;

use App\Models\Batch;
use Illuminate\Console\Command;

class ClearExpiredItems extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expired:transfer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Transfer expired items into returnable stock';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $batches = Batch::where('expire_date', '<=', now()->toDateString())
            ->where('stock_quantity', '>', 0)->get();
        foreach ($batches as  $batch) {
            $batch->update([
                'returnable_quantity' => $batch->returnable_quantity + $batch->stock_quantity,
                'stock_quantity' => 0
            ]);
        }
    }
}