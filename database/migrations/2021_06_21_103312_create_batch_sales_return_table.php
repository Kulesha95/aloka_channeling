<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchSalesReturnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batch_sales_return', function (Blueprint $table) {
            $table->bigInteger('batch_id');
            $table->bigInteger('sales_return_id');
            $table->double('quantity', 10, 2);
            $table->tinyInteger('reason');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('batch_sales_return');
    }
}