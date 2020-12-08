<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipmentdtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipmentdts', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('shipmentno');
            $table->integer('total_box');
            $table->decimal('total_weight', 8, 2);
            $table->decimal('total_usedarea', 8, 4);
            $table->decimal('total_amount', 8, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipmentdts');
    }
}
