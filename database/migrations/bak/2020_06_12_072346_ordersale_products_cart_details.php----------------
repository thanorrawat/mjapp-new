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
    	Schema::create('ordersale_products_cart_details', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
    
            $table->integer('customer_id');
            $table->string('customer_name',150);
            $table->date('deliverydate');
            $table->integer('ordertype');
            $table->string('createby_name',150);
            $table->integer('createby_id');
        });
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
