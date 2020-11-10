<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('so_details', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('order_id');
            $table->string('order_name',12);
            $table->integer('customer_id');
            $table->string('customer_code',20);
            $table->string('customer_name',150);
            $table->text('customer_adress');
            $table->string('customer_tel',50);
            $table->string('customer_fax',50);
            $table->date('order_date');
            $table->date('order_deliverydate');
            $table->string('credit_day',5);
            $table->string('credit_condition',100);
            $table->decimal('so_amount', 8, 2);
            $table->decimal('so_disper', 3, 2);
            $table->decimal('so_discount', 8, 2);
            $table->decimal('so_amountafterdis', 8, 2);
            $table->decimal('so_vat7', 8, 2);
            $table->decimal('so_toatalamount', 8, 2);
            $table->text('so_remark');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('so_details');
    }
}
