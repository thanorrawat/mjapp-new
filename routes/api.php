<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::resource('orderproducts','Api\OrderProducts');
//Route::resource('orderproducts-search/','Api\OrderProducts');
Route::get('orderproducts-search','Api\OrderProducts@search');
Route::get('orderdt/{id}','Api\OrderProducts@orderdt');

Route::get('order_customerlist','Api\OrderProducts@customerlist');
Route::post('order_create','Api\OrderProducts@addorder');
Route::get('checkstock/{id}','Api\OrderProducts@checkstock');
Route::get('categorynamelist','Api\OrderProducts@categoryname');
Route::post('order_checkprice','Mj\MemoPriceController@checkpriceorder');



Route::post('addproducttoorder','Api\OrderProducts@addproducttoorder'); //เพิ่มสินค้าใน Order
Route::get('showproductinorder/{id}','Api\OrderProducts@showproductinorder'); //แสดงรายการสินค้า จาก orderid

Route::post('removeproducttoorder','Api\OrderProducts@removeproducttoorder'); //ลบสินค้าจาก Order
Route::post('editqtyproducttoorder','Api\OrderProducts@editqtyorder'); //แก้ไขจำนวนสินค้าจาก Order


//products
Route::get('products_list','Api\ProductsController@index');

//Customer
Route::get('customer_list','Api\CustomerController@index');

//checkmemoprice
Route::post('meoprice_checkprice','Mj\MemoPriceController@memocheckprice');
Route::post('meoprice_add','Mj\MemoPriceController@addmemoprice');
Route::get('memoprice_list','Mj\MemoPriceController@datatable');
Route::post('user_list','Mj\MemoPriceController@userlist');

Route::post('memoprice_view','Mj\MemoPriceController@viewmemo');
Route::post('memoprice_approve','Mj\MemoPriceController@approve');



//notify
Route::post('notify/ordersendmanager','Api\sendnotifyController@ordersendmanager'); 







