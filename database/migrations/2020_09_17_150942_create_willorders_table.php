<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWillordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('willorders', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('willor_productcode',20);
            $table->string('willor_productname',191);
            $table->string('willor_unit',12);
            $table->decimal('willor_qtym01', 8, 0);
            $table->decimal('willor_qtym02', 8, 0);
            $table->decimal('willor_qtym03', 8, 0);
            $table->decimal('willor_qtym04', 8, 0);
            $table->decimal('willor_qtym05', 8, 0);
            $table->decimal('willor_qtym06', 8, 0);
            $table->decimal('willor_qtym07', 8, 0);
            $table->decimal('willor_qtym08', 8, 0);
            $table->decimal('willor_qtym09', 8, 0);
            $table->decimal('willor_qtym10', 8, 0);
            $table->decimal('willor_qtym11', 8, 0);
            $table->decimal('willor_qtym12', 8, 0);
            $table->decimal('willor_qtytotal', 8, 0);
            $table->decimal('willor_average_month', 8, 4);
            $table->decimal('willor_average_day', 8, 0);
            $table->string('willor_delivery_day',10);
            $table->string('willor_safety_day',3);
            $table->string('willor_min',8);
            $table->string('willor_max2',8);
            $table->string('willor_overmin',8);
            $table->string('willor_stock',8);
            $table->string('willor_po',8);
            $table->string('willor_so',8);
            $table->string('willor_diff',8);
            $table->string('willor_minorder',8);
            $table->string('willor_3daysales',8);
            $table->string('willor_order',8);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('willorders');
    }
}
