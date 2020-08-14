<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Response;
use App\Cart;
use App\CartDetails;
use App\Customer;




class CartController extends Controller
{
   
    public function show(){
        return view('layout-theme-gradient-able.cart');
    }

    
    public function addcart(Request $request){
        $CartDetails = CartDetails::firstOrCreate(['createby_id' => Auth::user()->id]);
          if(!empty($request->productscode)){

            $data = array();
            $data['orderesaleid'] =Auth::user()->id;
            $data['productscode'] =$request->productscode;
            $data['product_id'] =$request->productid;
            if(!empty($request->orderqty)){
                $data['qty'] =$request->orderqty;
            }else{
                $data['qty'] =1;
            }
            
            $data['amount'] =$request->price;
            $data['stocknow'] =$request->stocknow;
//นับจำนวนสินค้า Code นี้ในตะกร้า
$count = Cart::where('productscode', $data['productscode'])
->where('orderesaleid', $data['orderesaleid'])
->count();

if($count>0){ //ถ้ามีรายการแล้ว
    if($data['qty']>1){
    $cart  =   Cart::updateOrCreate(['productscode' => $request->productscode,'orderesaleid' => $data['orderesaleid']],
    $data);  }
    \Session::flash('create_message', trans('file.Product is has in Cart'));
    $return['view']  = view('layout-theme-gradient-able.cart');
    $return['alertfalse']  = trans('file.Product is has in Cart');
    return $return;

    //return view('layout-theme-gradient-able.cart');
}else{ //ถ้ายังไม่มีรายการ เพิ่มเข้าไป
    $cart  =   Cart::updateOrCreate(['productscode' => $request->productscode,'orderesaleid' => $data['orderesaleid']],
    $data);  
    \Session::flash('create_message', trans('file.Product Add To Cart successfully'));
   // return Response::json($cart);      
   $return['view']  = view('layout-theme-gradient-able.cart');
 $return['alert']  = trans('file.Product Add To Cart successfully');

 return $return;


 
}




           
            }else{
                return view('layout-theme-gradient-able.cart');

            }

           
      
            
        }
        


public function destroy(Request $request){

$deletedRows = Cart::where('productscode', $request->productscodedelete)
->where('orderesaleid', Auth::user()->id)
->delete();

$return['view']  = view('layout-theme-gradient-able.cart');
$return['alert']  = trans('file.product')." ".trans('file.Code')." : ".$request->productscodedelete." ".trans('file.has Deleted');
return $return;
}

public function updatecartdetials(Request $request){

    if(!empty($request->deliverydate)){
$deliverydatearray = explode("/",$request->deliverydate);
$deliverydate = $deliverydatearray[2]."-".$deliverydatearray[1]."-".$deliverydatearray[0];
    }else{
        $deliverydate= date("Y-m-d");
    }


  $customer_id =  $request->customer_id;  
  $customerdt = Customer::find($customer_id);
$CartDetails =  CartDetails::updateOrCreate([
        'createby_id'   => $request->usercreate_id,
    ],[
        'customer_id'     => $customer_id,
        'customer_name'     => $customerdt->name,
       'deliverydate'     => $deliverydate,
        'ordertype'     => $request->ordertype,
        'createby_name'     => $request->usercreate,
        'remark'     => $request->remark,
        'doctype'=> $request->doctype
 
    ]);



}

}