<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('so_products', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('so_name',12);
            $table->integer('order_pdid');
            $table->integer('product_id');
            $table->string('product_code',20);
            $table->string('product_name',150);
            $table->decimal('price', 8, 2);
            $table->decimal('qty', 8, 2);
            $table->decimal('discount', 8, 2);
            $table->decimal('amount', 8, 2);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('so_products');
    }
}
