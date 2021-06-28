<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchPurchaseReturnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batch_purchase_return', function (Blueprint $table) {
            $table->bigInteger('batch_id');
            $table->bigInteger('purchase_return_id');
            $table->double('quantity', 10, 2);
            $table->double('price', 10, 2);
            $table->text('reason');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('batch_purchase_return');
    }
}