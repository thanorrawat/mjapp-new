<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrdersaleProductsCartDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $table->increments('id');
        $table->timestamps();

        $table->integer('customer_id',10);
        $table->string('customer_name',150);
        $table->date('deliverydate');
        $table->integer('ordertype',1);
        $table->string('createby_name',150);
        $table->integer('createby_id',10);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
