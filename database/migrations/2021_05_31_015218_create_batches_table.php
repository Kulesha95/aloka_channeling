<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batches', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('item_id');
            $table->bigInteger('good_receive_id');
            $table->double('good_receive_quantity', 10, 2);
            $table->double('stock_quantity', 10, 2);
            $table->double('sold_quantity', 10, 2);
            $table->double('damaged_quantity', 10, 2);
            $table->double('returned_quantity', 10, 2);
            $table->double('expired_quantity', 10, 2);
            $table->double('dispose_quantity', 10, 2);
            $table->double('purchase_quantity', 10, 2);
            $table->double('purchase_price', 10, 2);
            $table->double('price', 10, 2);
            $table->date('expire_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('batches');
    }
}