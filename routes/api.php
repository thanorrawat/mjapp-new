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

//แปล
//Route::group(['middleware' => 'auth'], function() {
Route::get('LanguageTraslate','Api\LanguageTraslate@index');

Route::resource('orderproducts','Api\OrderProducts');
//Route::resource('orderproducts-search/','Api\OrderProducts');
Route::get('orderproducts-search','Api\OrderProducts@search');
Route::get('orderdt/{id}','Api\OrderProducts@orderdt');

Route::get('order_customerlist','Api\OrderProducts@customerlist');
Route::post('order_create','Api\OrderProducts@addorder');
Route::get('checkstock/{id}','Api\OrderProducts@checkstock');
Route::get('categorynamelist','Api\OrderProducts@categoryname');
Route::post('order_checkprice','Mj\MemoPriceController@checkpriceorder');
Route::get('checklastprice/{id}','Api\OrderProducts@checklastprice');



//order
Route::post('addproducttoorder','Api\OrderProducts@addproducttoorder'); //เพิ่มสินค้าใน Order
Route::get('showproductinorder/{id}','Api\OrderProducts@showproductinorder'); //แสดงรายการสินค้า จาก orderid
Route::get('showproductcancel/{id}','Api\OrderProducts@showproductcancel'); //แสดงรายการสินค้าที่ถูกยกเลิก
Route::get('showordertotalamount/{id}','Api\OrderProducts@showordertotalamount'); //แสดงรายการสินค้า จาก orderid

Route::post('removeproducttoorder','Api\OrderProducts@removeproducttoorder'); //ลบสินค้าจาก Order
Route::post('cancleproducttoorder','Api\OrderProducts@cancleproducttoorder'); //ยกเลิกสินค้าจาก Order
Route::post('readdcancleproducttoorder','Api\OrderProducts@readdcancleproducttoorder'); //เพิ่มสินค้าที่ถูกยกเลิกกลับ Order

Route::post('editqtyproducttoorder','Api\OrderProducts@editqtyorder'); //แก้ไขจำนวนสินค้าจาก Order

//SO
Route::post('createso','Api\Socontroller@create'); //เพิ่มสินค้าใน Order
Route::get('checksoinorder/{id}','Api\Socontroller@listinorder'); //แสดงรายการสินค้า จาก orderid



//products
Route::get('products_list','Api\ProductsController@index');

//Customer
Route::get('customer_list','express\exCustomerController@customerData');

//checkmemoprice
Route::post('meoprice_checkprice','Mj\MemoPriceController@memocheckprice');
Route::post('meoprice_add','Mj\MemoPriceController@addmemoprice');
Route::get('memoprice_list','Mj\MemoPriceController@datatable');
Route::post('user_list','Mj\MemoPriceController@userlist');

Route::post('memoprice_view','Mj\MemoPriceController@viewmemo');
Route::post('memoprice_approve','Mj\MemoPriceController@approve');



//notify
Route::post('notify/ordersendmanager','Api\sendnotifyController@ordersendmanager'); 



//});




