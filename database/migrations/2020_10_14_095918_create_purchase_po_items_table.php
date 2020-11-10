<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasePoItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_po_items', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('poitems_productscode',20);
            $table->string('poitems_productsname',50);
            $table->integer('poitems_qty');
            $table->string('poitems_unit',10);
            $table->decimal('poitems_price', 8, 2);
            $table->decimal('poitems_amount', 8, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_po_items');
    }
}
