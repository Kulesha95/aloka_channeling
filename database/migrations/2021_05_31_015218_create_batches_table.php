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
            $table->double('reserved_quantity', 10, 2);
            $table->double('sold_quantity', 10, 2);
            $table->double('returnable_quantity', 10, 2);
            $table->double('returned_quantity', 10, 2);
            $table->double('dispose_quantity', 10, 2);
            $table->double('purchase_quantity', 10, 2);
            $table->double('purchase_price', 10, 2);
            $table->double('price', 10, 2);
            $table->double('discount_amount', 10, 2)->nullable()->default(0);
            $table->string('discount_type', 10, 2)->nullable()->default('Fixed');
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