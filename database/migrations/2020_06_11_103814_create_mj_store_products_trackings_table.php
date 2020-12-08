<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMjStoreProductsTrackingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mj_store_products_trackings', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('product_id');
            $table->string('product_code')->nuallable();
            $table->double('product_qty');
            $table->integer('type')->comment('id ประเภทการย้าย 1=เข้า-2=ออก'); 
            $table->integer('ref_typeid')->comment('id ประเภทเอกสารอ้างอิง 1=store transfer,9 = ตัวอย่างสำหรับทดสอบ'); 
            $table->integer('ref_id')->comment('id เอกสารอ้างอิง')->nuallable(); 
            $table->string('ref_no')->comment('เลขที่ เอกสารอ้างอิง')->nuallable(); 
            $table->integer('user')->comment('id ผู้ทำรายการ'); 
            $table->string('user_name')->comment('ชื่อผู้ทำรายการ')->nuallable(); 


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mj_store_products_trackings');
    }
}
