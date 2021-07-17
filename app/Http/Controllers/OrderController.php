<?php

namespace App\Http\Controllers;
use App\Customer;
use App\CartDetails;
use App\Cart;
use App\Product;
use App\Models\MjStoreProductsTracking;
use App\Models\MjOrderDetails;
use App\Models\MjOrderProducts;
use Auth;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use PDF;
use App\User;
use App\Models\Timeline;
use File;
class OrderController extends Controller
{
   
   
    public function index()
    {
      
        $customers = Customer::where('is_active', 1)->get();
        $cartDetails = CartDetails::where('createby_id', Auth::user()->id)->first();
        
return view('App_sale.order',['customers' => $customers,'cartDetails'=>$cartDetails]);
    }

    public function index2()
    {
      
        $customers = Customer::where('is_active', 1)->get();
        $cartDetails = CartDetails::where('createby_id', Auth::user()->id)->first();

           
return view('App_sale.order2',['customers' => $customers,'cartDetails'=>$cartDetails]);
    }

    public function carttoorder(Request $request)
    {
        $cartDetailsold = CartDetails::where('createby_id', Auth::user()->id)->first();
            
                // if(is_numeric($request->customer_id)==false){

                //     $addcustomer = new Customer;
                    
                //     $addcustomer->customer_group_id= '1';
                //     $addcustomer->name = $cartDetailsold->customer_name;
                //     $addcustomer->phone_number = '-';
                //     $addcustomer->address = '-';
                //     $addcustomer->city = '-';
                //     $addcustomer->save();
                //     $addcustomer->id;
                //   $customer_id=$addcustomer->id;

                // }else{


                    $customer_id =  $cartDetailsold->customer_id;  
              //  }
                $newordernumber="0";
                $newordernumberfull="0";
                $newbookingnumber ="0";
                if($request->sendordertype==1){ // สร้าง Order
                   
                $beforeordername = date('ym');
                    $lastornumber= MjOrderDetails::where('ordernumber','like', $beforeordername.'%')->orderBy('ordernumber', 'desc')->first();
                    if(!empty($lastornumber->ordernumber)){
                    $oldnumber = substr($lastornumber->ordernumber, -4);
                    $newnumber=$oldnumber+1;
                    }else{
                        $newnumber=1;
                    }
                     $newordernumber = $beforeordername.sprintf("%04d",$newnumber);
                 $newordernumberfull = 'OD'.$newordernumber;
                 $newstatus = 1;
                }elseif($request->sendordertype==2){ // สร้าง ใบจอง


                            //สร้าง booking number
            $beforebookingname = 'BK'.date('ym');
            $lastbookingnumber= MjOrderDetails::where('bookingnumber','like', $beforebookingname.'%')->orderBy('bookingnumber', 'desc')->first();
           if(!empty($lastbookingnumber->bookingnumber)){
           $oldnumber = substr($lastbookingnumber->bookingnumber, -4);
           $newnumber=$oldnumber+1;
           }else{
               $newnumber=1;
           }
           $newbookingnumber = $beforebookingname.sprintf("%04d",$newnumber);
           $newstatus = 2;
                }
      






        $MjOrderDetails = new MjOrderDetails;
        $MjOrderDetails->customer_id = $cartDetailsold->customer_id;
        $MjOrderDetails->customer_name =  $cartDetailsold->customer_name;
        $MjOrderDetails->deliverydate =  $cartDetailsold->deliverydate;
        $MjOrderDetails->ordertype = $cartDetailsold->ordertype;
        $MjOrderDetails->createby_name = $cartDetailsold->createby_name;
        $MjOrderDetails->createby_id = Auth::user()->id;
        $MjOrderDetails->remark = $cartDetailsold->remark;
        $MjOrderDetails->ordernumber = $newordernumber;
        $MjOrderDetails->ordernumberfull = $newordernumberfull;
        $MjOrderDetails->bookingnumber = $newbookingnumber;
        $MjOrderDetails->doctype  = $cartDetailsold->doctype;
        $MjOrderDetails->order_status  = $newstatus;

        $MjOrderDetails->save();
       $orderid =  $MjOrderDetails->id;


        //listproduct

        $cartproducts = Cart::where('orderesaleid', Auth::user()->id)->get();
// print_r($cartproducts);
// exit();
        foreach($cartproducts as $cartproduct)
        {
$pid =  $cartproduct->product_id;
//addto order
$qtynew=$request->qty[$pid];

$MjOrderProducts= new MjOrderProducts;

$MjOrderProducts->order_id= $orderid;
$MjOrderProducts->product_id=$cartproduct->product_id;
$MjOrderProducts->productscode= $cartproduct->productscode;
$MjOrderProducts->qty= $qtynew;
$MjOrderProducts->amount= $cartproduct->amount;
$MjOrderProducts->stocknow= $cartproduct->stocknow;
$MjOrderProducts->pr= $cartproduct->pr;
$MjOrderProducts->remarkrow= $cartproduct->remarkrow;



$MjOrderProducts->save();


$cartDetailsdel = CartDetails::where('createby_id', Auth::user()->id)->delete();
$cartproductsdel = Cart::where('orderesaleid', Auth::user()->id)->delete();



////----------บันทึกข้อมูลการทำ Order
createtimeline($orderid,$request->sendordertype,$orderid,$request->remark,$request->sendordertype); //createtimeline($orderid,$doc_type,$doc_id,$message)





        }


      return redirect('order/'.$MjOrderDetails->id);
    }


    public function edit_order(Request $request)
    {

        if(!empty($request->deliverydate)){
            $deliverydatearray = explode("/",$request->deliverydate);
            $deliverydate = $deliverydatearray[2]."-".$deliverydatearray[1]."-".$deliverydatearray[0];
                }else{
                    $deliverydate= date("Y-m-d");
                }
//update order details
        $MjOrderDetailsupdate = MjOrderDetails::find($request->order_id);
        $MjOrderDetailsupdate->customer_id =  $request->selectcustomer;
        $MjOrderDetailsupdate->customer_name =  $request->customer_name;
        $MjOrderDetailsupdate->deliverydate =  $deliverydate;
        $MjOrderDetailsupdate->ordertype = $request->ordertype;
        $MjOrderDetailsupdate->createby_name = $request->usercreate;
        $MjOrderDetailsupdate->remark = $request->remark;
       
        if(!empty($request->confirm) ){
            $MjOrderDetailsupdate->token=$tokenorder= Str::random(70);

            if($request->sendordertype==2){$newstatus ='21'; }else{$newstatus ='11'; }
            $MjOrderDetailsupdate->order_status = $newstatus;

        }
        $MjOrderDetailsupdate->save();
        $orderdt= MjOrderDetails::find($request->order_id);
        if(!empty($request->productid)){

           $products =  $request->productid;


           if(!empty($request->confirm)){ //ถ้ามีการส่ง เอกสารเพื่อขออนุมัติ
           
           $ref_typeid = $orderdt->doctype; // ประเภท 1= Order, 2=booking ,3=so
           $timelinestatus = 11; //ส่ง Order
           if($ref_typeid==1){
            $ordernumberfull = $orderdt->ordernumberfull; //Order number,bookingnumber ,so number
        }elseif($ref_typeid==2){ //เปลี่ยนเป็นประเภทใบจอง
            //สร้าง booking number
        //     $beforebookingname = date('ym');
        //     $lastbookingnumber= MjOrderDetails::where('bookingnumber','like', $beforebookingname.'%')->orderBy('bookingnumber', 'desc')->first();
        //    if(!empty($lastbookingnumber->bookingnumber)){
        //    $oldnumber = substr($lastbookingnumber->bookingnumber, -4);
        //    $newnumber=$oldnumber+1;
        //    }else{
        //        $newnumber=1;
        //    }
        //    $newbookingnumber = 'BK'.$beforebookingname.sprintf("%04d",$newnumber);
        // /// บันทึก booking nummber

        // $MjOrderDetailsupdate = MjOrderDetails::find($request->order_id);
        // $MjOrderDetailsupdate->bookingnumber = $newbookingnumber;
        // $MjOrderDetailsupdate->save();
        
        $ordernumberfull = $orderdt->bookingnumber; //Order number,bookingnumber ,so number
        $timelinestatus = 21; //ส่ง ใบจอง
        
        }
    }


           foreach($products as $product)
           {
   $pid =  $product;
   //edit products
   $qtynew=$request->qty[$pid];
   $MjOrderProducts= MjOrderProducts::where('product_id',$pid)
   ->where('order_id',$request->order_id)
   ->update(['order_id' => $request->order_id, 'qty'=>$qtynew]);
//   $MjOrderProducts->stocknow= $cartproduct->stocknow;



     //confirmorder

     if(!empty($request->confirm) && !empty($tokenorder)){
//function Tracking()
$productscode = $request->productscode[$pid]; 
$order_id = $request->order_id; //Orderid
$sendordertype=$orderdt->doctype;

trackingadd($pid,$productscode,$qtynew,$ref_typeid,$order_id,$ordernumberfull,$timelinestatus);



    }



           }   

        }


        if(!empty($request->confirm)){
   //แจ้งเตือนทาง line



if($sendordertype==1){

$sMessage = "มีการส่งรายการ Order สินค้า เลขที่ : ".$orderdt->ordernumberfull."  ท่านสามารถตรวจสอบและดำเนินการทำรายการต่อได้ที่ ".url('order',$request->order_id);
lineNotifysend(1,$sMessage ,'');
$orderid = $request->order_id;

////----------บันทึกTimeline

createtimeline($request->order_id,1,$request->order_id,$request->remark,11); //createtimeline($orderid,$doc_type,$doc_id,$message)

}elseif($sendordertype==2){

    $sMessage = "มีการส่ง ใบจองสินค้า เลขที่ : ".$orderdt->bookingnumber."  เพื่อขออนุมัติ ท่านสามารถตรวจสอบและดำเนินการทำรายการต่อได้ที่ ".url('order',$request->order_id);
    lineNotifysend(1,$sMessage ,'');
    // บันทึก Time line
    $message = "ส่งใบจองสินค้าเลขที่ : ".$orderdt->bookingnumber." เพื่อขออนุมัตการทำรายการต่อ";
    createtimeline($request->order_id,2,$request->order_id,$message,21); //createtimeline($orderid,$doc_type,$doc_id,$message,$timelinestatus)

}

        }
      return redirect('order/'.$request->order_id);
    }



    public function orderdetails($id)
    {
        $customers = Customer::where('is_active', 1)->get();
        $cartDetails = MjOrderDetails::where('id',$id)->first();
     
       $orderid= $cartDetails->id;
      if(!empty($cartDetails->token)){
       //lineNotifysend(1,'ทดสอบส่งแจ้งเตือน','https://www.mindphp.com/images/knowledge/Security/Alert.jpg');
            return view('App_sale.order_confirm',['customers' => $customers,'cartDetails'=>$cartDetails,'orderid'=>$orderid]);

        }else{
            return view('App_sale.order',['customers' => $customers,'cartDetails'=>$cartDetails,'orderid'=>$orderid]);

        }

    }

    public function orderinput($id)
    {
        $customers = Customer::where('is_active', 1)->get();

        if(!empty($id)){
            $cartDetails = MjOrderDetails::where('id',$id)->first();
        }else{
            $cartDetails = CartDetails::where('createby_id', Auth::user()->id)->first();

        }
      return view('App_sale.order_forminput',['customers' => $customers,'cartDetails'=>$cartDetails,'orderid'=>$cartDetails->id]);
    }

    public function orderedit($id)
    {
return view('App_sale.order_cartlist',['orderid' => $id]);
    }

    public function test()
    {

        return view('App_product.productstracking')
        ->with('productid', 1);
/*
$beforeordername = date('ym');
 $lastornumber= MjOrderDetails::where('ordernumber','like', $beforeordername.'%')->orderBy('ordernumber', 'desc')->first();
if(!empty($lastornumber->ordernumber)){
$oldnumber = substr($lastornumber->ordernumber, -4);
$newnumber=$oldnumber+1;
}else{
    $newnumber=1;
}
 $newordernumber = $beforeordername.sprintf("%04d",$newnumber);
 $newordernumberfull = 'OD'.$newordernumber;
*/
    }



    public function addtoorder(Request $request){

       

        if(!empty($request->productscode)){

          $data = array();
          $data['orderpd_salesid'] =Auth::user()->id;
          $data['productscode'] =$request->productscode;
          $data['product_id'] =$request->productid;
          $data['order_id'] =$request->orderid;
          if(!empty($request->orderqty)){
              $data['qty'] =$request->orderqty;
          }else{
              $data['qty'] =1;
          }
          
          $data['amount'] =$request->price;
          $data['stocknow'] =$request->stocknow;
//นับจำนวนสินค้า Code นี้ในorder
$count = MjOrderProducts::where('productscode', $data['productscode'])
->where('order_id', $data['order_id'])
->count();

if($count>0){ //ถ้ามีรายการแล้ว
    if($data['qty']>1){
  $cart  =   MjOrderProducts::updateOrCreate(['productscode' => $request->productscode,'order_id' => $data['order_id']],
  $data);  
    }
  \Session::flash('create_message', trans('file.Product is has in Order'));
  $return['view']  = view('layout-theme-gradient-able.cart');
  $return['alertfalse']  = trans('file.Product is has in Order');
  return $return;

  //return view('layout-theme-gradient-able.cart');
}else{ //ถ้ายังไม่มีรายการ เพิ่มเข้าไป
  $cart  =   MjOrderProducts::updateOrCreate(['productscode' => $request->productscode,'order_id' => $data['order_id']],
  $data);  

  \Session::flash('create_message', trans('file.Product Add To Order successfully'));
 // return Response::json($cart);      
 $return['view']  = view('layout-theme-gradient-able.cart');
$return['alert']  = trans('file.Product Add To Order successfully');

return $return;

}}        
}


      
public function destroy(Request $request){

    //รายละเอียดสินค้าที่ลบ
    $productdeletedt = MjOrderProducts::where('productscode', $request->productscodedelete)
    ->where('order_id', $request->orderid)
    ->first();

//ลบสินค้าใน Order
    $deletedRows = MjOrderProducts::destroy($productdeletedt->id);

    if($deletedRows){



    $return['alert']  = trans('file.product')." ".trans('file.Code')." : ".$request->productscodedelete." ".trans('file.has Deleted');
    }else{
        $return['alert']  = trans('file.product')." ".trans('file.Code')." : ".$request->productscodedelete." ".trans('file.Not Deleted'); 
    }
    return $return;
    }


    public function checkstockorder(Request $request){

        $Product = Product::find($request->productid);
        $return['stock']  = $Product->qty;

if($return['stock']<=0){
$stocksale = 0;
}else{
$stocksale =$return['stock'];
}

if($request->orderqty>$stocksale){

  $addpr =  $return['pr'] = $request->orderqty - $stocksale;

}else{
    $addpr =  $return['pr'] = '0';
}

if(!empty($request->orderid)){

    $MjOrderProducts= MjOrderProducts::where('product_id',$request->productid)
    ->where('order_id',$request->orderid)
    ->update([ 'qty'=>$request->orderqty,'pr'=>$addpr] );

}else{
    $cartProducts=Cart::where('product_id',$request->productid)
->where('orderesaleid', Auth::user()->id)
->update([ 'qty'=>$request->orderqty,'pr'=>$addpr ]);

}

   

        return $return;
    }

    public function remarkcartupdate(Request $request){
    
if(!empty($request->orderid)){

    $MjOrderProducts= MjOrderProducts::where('product_id',$request->productid)
    ->where('order_id',$request->orderid)
    ->update([ 'remarkrow'=>$request->thisremark]);

}else{
    $cartProducts=Cart::where('product_id',$request->productid)
->where('orderesaleid', Auth::user()->id)
->update([ 'remarkrow'=>$request->thisremark]);

}

    }


    
    public function orderview($token)
    {
        $orderdt = MjOrderDetails::where('token',$token)->first();
        
        $MjOrderProducts= MjOrderProducts::where('order_id',$orderdt->id)
        ->leftjoin('products', 'mj_order_products.product_id', '=', 'products.id')
        ->select(['*','mj_order_products.qty AS orderqty','mj_order_products.price AS orderprice'])
        ->where('canclepd','<>','1')
        ->get();

        if(!empty($orderdt->user_sign2)){ //ถ้ามีการรับ order
            $user_sign2 = User::where('id',$orderdt->user_sign2)->first(); 
        }else{
            $user_sign2 =array();
        }
        if(!empty($orderdt->user_sign3)){ //ถ้ามีการอนุมัติ order
            $user_sign3 = User::where('id',$orderdt->user_sign3)->first(); 
        }else{
            $user_sign3 =array();
        }


        if(!empty($orderdt->bookingnumber) ){
            return view('App_sale.booking_view')
            ->with('orderdt', $orderdt)
            ->with('products', $MjOrderProducts)
            ->with('user_sign2', $user_sign2)
            ->with('user_sign3', $user_sign3)
            ->with('sumqty', $MjOrderProducts->sum('orderqty'))
            ->with('sumamount', $MjOrderProducts->sum('amount'))
            ;
        }else{
            return view('App_sale.order_view')
            ->with('orderdt', $orderdt)
            ->with('products', $MjOrderProducts)
            ->with('user_sign2', $user_sign2)
            ->with('user_sign3', $user_sign3)
            ->with('sumqty', $MjOrderProducts->sum('orderqty'))
            ->with('sumamount', $MjOrderProducts->sum('amount'))
            ;
        }
    

   
    }



    public  function generate_pdf($token) {
      
        $orderdt = MjOrderDetails::where('token',$token)->first();
        if(!empty($orderdt->id)){
            $MjOrderProducts= MjOrderProducts::where('order_id',$orderdt->id)
            ->leftjoin('products', 'mj_order_products.product_id', '=', 'products.id')
            ->select(['*','mj_order_products.qty AS orderqty'])
            ->where('canclepd','<>','1')
            ->get();

            if(!empty($orderdt->user_sign2)){ //ถ้ามีการรับ order
                $user_sign2 = User::where('id',$orderdt->user_sign2)->first(); 
            }else{
                $user_sign2 =array();
            }
            if(!empty($orderdt->user_sign3)){ //ถ้ามีการอนุมัติ order
                $user_sign3 = User::where('id',$orderdt->user_sign3)->first(); 
            }else{
                $user_sign3 =array();
            }
    


            $data['orderdt']=$orderdt;
            $data['products']=$MjOrderProducts;
            $data['user_sign2']=$user_sign2;
            $data['user_sign3']=$user_sign3;

            if(!empty($orderdt->bookingnumber)){ //ถ้าเป็นใบจอง
                $pdffile = $orderdt->bookingnumber.".pdf";

                $pdf = PDF::loadView('App_sale.booking_view', $data, [], [
                    'title' => $orderdt->ordernumberfull,
                    'custom_font_dir' => base_path('public/fonts/'), // don't forget the trailing slash!
                    'custom_font_data' => [
                        'sarabun' => [
                            'R'  => 'thsarabunnew-webfont.ttf',    // regular font
                            'B'  => 'thsarabunnew_bold-webfont.ttf',       // optional: bold font
                            'I'  => 'thsarabunnew_italic-webfont.ttf',     // optional: italic font
                            'BI' => 'thsarabunnew_bolditalic-webfont.ttf' // optional: bold-italic font
                        ]],
                    'default_font'=>'sarabun'
                  ]);


            }else{

            
            $pdffile = $orderdt->ordernumberfull.".pdf";

                $pdf = PDF::loadView('App_sale.order_view', $data, [], [
                    'title' => $orderdt->ordernumberfull,
                    'custom_font_dir' => base_path('public/fonts/'), // don't forget the trailing slash!
                    'custom_font_data' => [
                        'sarabun' => [
                            'R'  => 'thsarabunnew-webfont.ttf',    // regular font
                            'B'  => 'thsarabunnew_bold-webfont.ttf',       // optional: bold font
                            'I'  => 'thsarabunnew_italic-webfont.ttf',     // optional: italic font
                            'BI' => 'thsarabunnew_bolditalic-webfont.ttf' // optional: bold-italic font
                        ]],
                    'default_font'=>'sarabun'
                  ]);

                        }


                return $pdf->stream($pdffile);
        }else{
            return "URL ไม่ถูกต้อง";
        }
      
      
    }

    public function confirmform(Request $request){
//บันทึกลายเซ็น
        $signupdate = User::find(Auth::user()->id);
        $signupdate->sign =  $request->signinput;
        $signupdate->save();
       $orderid =  $request->orderid;
$MjOrderDetailsupdate = MjOrderDetails::find($orderid);
if(Auth::user()->role_id==2 || Auth::user()->role_id==7){ //ผู้จัดการ
if($request->nowstatus==21){
   $newstatus =  $MjOrderDetailsupdate->order_status = '22'; //อนุมัติ ใบจอง
   $docname = "ใบจอง";
}else{
    $newstatus = $MjOrderDetailsupdate->order_status = '12'; //อนุมัติ Order
   $docname = "Order";

}
    

    $MjOrderDetailsupdate->user_sign3 = Auth::user()->id;
    if(Auth::user()->role_id==2){
        $position ="MD";
    }
    if(Auth::user()->role_id==2){
        $position ="GM";
    }
}elseif(Auth::user()->role_id==6){ //Sale Admin
    if($request->nowstatus==22){
        $newstatus =   $MjOrderDetailsupdate->order_status = '23'; //รับ ใบจอง
   $docname = "ใบจอง";

    }else{
        $newstatus =  $MjOrderDetailsupdate->order_status = '13'; //รับ Order
   $docname = "Order";

    }
 

    $MjOrderDetailsupdate->user_sign2 = Auth::user()->id;
    $position ="Sale Admin";
}

$MjOrderDetailsupdate->save();


$orderdt = MjOrderDetails::find($orderid);

if(Auth::user()->role_id==2 || Auth::user()->role_id==7){ //ผู้จัดการ
////----------บันทึกTimeline
$message ="อนุมัติโดย ".Auth::user()->fullname." (".$position.")";
createtimeline($orderid,1,$orderid,$message,$newstatus); //createtimeline($orderid,$doc_type,$doc_id,$message)

if(!empty($orderdt->bookingnumber)){
    $sMessage = $docname." เลขที่ : ".$orderdt->bookingnumber."ได้รับการอนุมัติแล้วโดย ".Auth::user()->fullname." (".$position.") ท่านสามารถตรวจสอบและดำเนินการทำรายการต่อ ได้ที่ ".url('order/'.$orderdt->bookingnumber.'/edit');
}else{
    $sMessage = $docname." เลขที่ : ".$orderdt->ordernumberfull."ได้รับการอนุมัติแล้วโดย ".Auth::user()->fullname." (".$position.") ท่านสามารถตรวจสอบและดำเนินการทำรายการต่อ ได้ที่ ".url('order/'.$orderdt->ordernumberfull.'/edit');
}
lineNotifysend(1,$sMessage ,'');
lineNotifysend(2,$sMessage ,'');

}elseif(Auth::user()->role_id==6){ //Sale Admin
////----------บันทึกTimeline
$message ="รับ ".$docname." โดย ".Auth::user()->fullname." (".$position.")";
createtimeline($orderid,1,$orderid,$message,$newstatus); //createtimeline($orderid,$doc_type,$doc_id,$message)

if(!empty($orderdt->bookingnumber)){
    $sMessage = "มีการรับจอง จาก".$docname." เลขที่ : ".$orderdt->bookingnumber."  ท่านสามารถตรวจสอบได้ที่ ".url('order/'.$orderdt->bookingnumber.'/edit');
}else{
    $sMessage = "มีการรับOrder จาก".$docname." เลขที่ : ".$orderdt->ordernumberfull."  ท่านสามารถตรวจสอบได้ที่ ".url('order/'.$orderdt->ordernumberfull.'/edit');
}


lineNotifysend(2,$sMessage ,'');

}





        return redirect()->back();
    }
    
    public function createtimelinefromorder(Request $request){

        $oderlist = MjOrderDetails::get();

        foreach($oderlist as $order)

        {
          $data = array();
          $data['doc_type'] =1;
          $data['doc_id'] =$order->id;
          $data['timelinedate'] =$order->created_at;
 $timelineupdate = Timeline::updateOrCreate(['order_id' => $order->id,'status' => 1],
            $data); 


        }
  
        
            }


            public function ordertimeline($id)
            {
                          $ordertimeline = Timeline::where('order_id', $id)
                ->leftjoin('status_names','timelines.status','status_names.st_id')
                    ->orderBy('timelines.created_at', 'desc')
                ->select(['*'])
                ->get();

                   return view('App_sale.order_timeline')
                  ->with('ordertimeline',  $ordertimeline);

            }


}
