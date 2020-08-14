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

Route::post('addproducttoorder','Api\OrderProducts@addproducttoorder'); //เพิ่มสินค้าใน Order
Route::get('showproductinorder/{id}','Api\OrderProducts@showproductinorder'); //แสดงรายการสินค้า จาก orderid

Route::post('removeproducttoorder','Api\OrderProducts@removeproducttoorder'); //ลบสินค้าจาก Order
Route::post('editqtyproducttoorder','Api\OrderProducts@editqtyorder'); //แก้ไขจำนวนสินค้าจาก Order


//notify
Route::post('notify/ordersendmanager','Api\sendnotifyController@ordersendmanager'); 







