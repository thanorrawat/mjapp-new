<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePriceSpecificsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_specifics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('prroductcode', 25);
            $table->string('memonumber', 18);
            $table->integer('custype');
            $table->string('cuscode', 20)->nullable();
            $table->integer('pricetime');
            $table->string('pricedaterange', 28)->nullable();
            $table->date('pricedatestart')->nullable();
            $table->date('pricedateend')->nullable();
            $table->decimal('pricevalue', 8, 2);
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
        Schema::dropIfExists('price_specifics');
    }
}
