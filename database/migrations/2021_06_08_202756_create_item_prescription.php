<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemPrescriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generic_name_prescription', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('prescription_id');
            $table->bigInteger('generic_name_id');
            $table->bigInteger('dosage_unit_id');
            $table->double('dosage', 10, 2);
            $table->integer('duration');
            $table->integer('duration_type');
            $table->string('directions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('generic_name_prescription');
    }
}