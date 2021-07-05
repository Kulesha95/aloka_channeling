<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batch_movements', function (Blueprint $table) {
            $table->id();
            $table->string('from');
            $table->bigInteger('from_batch');
            $table->double('from_quantity', 10, 2);
            $table->string('to');
            $table->bigInteger('to_batch');
            $table->double('to_quantity', 10, 2);
            $table->date('date');
            $table->time('time');
            $table->string('reason');
            $table->bigInteger('batch_moveable_id');
            $table->string('batch_moveable_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('batch_movements');
    }
}