<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->char('customer_code', 20);
            $table->char('productcode_code', 20);
            $table->char('sale_number', 20);
            $table->integer('qty');
            $table->decimal('costprice', 8, 2);
            $table->decimal('saleprice', 8, 2);
            $table->date('sale_date');
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
        Schema::dropIfExists('sale_histories');
    }
}
