<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrdersaleProductsCart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordersale_products_cart', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('orderesaleid');
            $table->integer('productscode');
            $table->integer('qty');
            $table->decimal('amount', 5, 2);
            $table->integer('stocknow');
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
        Schema::dropIfExists('ordersale_products_cart');
    }
}
