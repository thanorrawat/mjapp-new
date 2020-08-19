<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemoPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memo_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mmp_reson');
            $table->integer('mmp_when');
            $table->date('mmp_datestart');
            $table->date('mmp_dateend');
            $table->string('mmp_customer',20);
            $table->integer('mmp_typeprice');
            $table->text('mmp_remark');
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
        Schema::dropIfExists('memo_prices');
    }
}
