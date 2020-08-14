<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMjOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mj_order_details', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('customer_id');
            $table->string('customer_name',150)->nuallable();;
            $table->date('deliverydate')->nuallable();;
            $table->integer('ordertype');
            $table->string('createby_name',150)->nuallable();;
            $table->integer('createby_id');
            $table->text('remark');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mj_order_details');
    }
}
