<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasePosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_pos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('ponumber',20);
            $table->integer('supplier_id');
            $table->string('supplier_code',20);
            $table->string('supplier_name',50);
            $table->string('supplier_address',150);
            $table->string('supplier_phone',100);
            $table->string('supplier_credit',100);
            $table->string('supplier_remark',100);
            $table->string('deliverby',100);
            $table->string('po_remark',100);
            $table->integer('po_items');
            $table->decimal('po_total', 8, 2);
            $table->decimal('po_discount', 8, 2);
            $table->decimal('po_afterdiscount', 8, 2);
            $table->decimal('po_vat', 8, 2);
            $table->decimal('po_grand_total', 8, 2);

            $table->date('po_date');
            $table->date('recieve_date')->nullable();

            $table->integer('user_id');
            $table->integer('approve_id');
            $table->integer('po_status');








        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_pos');
    }
}
