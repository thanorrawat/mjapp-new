<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SoDetails;
use App\Models\SoProducts;

use App\Models\MjOrderDetails;
use App\Models\MjOrderProducts;
class SoController extends Controller
{


 

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
 
    public function soview($token)
    {
        $orderdt = MjOrderDetails::where('token',$token)->first();
        
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


        if(!empty($orderdt->bookingnumber) ){
            return view('App_sale.booking_view')
            ->with('orderdt', $orderdt)
            ->with('products', $MjOrderProducts)
            ->with('user_sign2', $user_sign2)
            ->with('user_sign3', $user_sign3)
            ;
        }else{
            return view('App_sale.order_view')
            ->with('orderdt', $orderdt)
            ->with('products', $MjOrderProducts)
            ->with('user_sign2', $user_sign2)
            ->with('user_sign3', $user_sign3)
            ;
        }
    

   
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $beforesoname = 'SO'.date('ym');
        $lastsonumber= SoDetails::where('sofullname','like', $beforesoname.'%')->orderBy('id', 'desc')->first();
       if(!empty($lastsonumber->sofullname)){
       $oldnumber = substr($lastsonumber->sofullname, -4);
       $newnumber=$oldnumber+1;
       }else{
           $newnumber=1;
       }
     $newsonumber = $beforesoname.sprintf("%04d",$newnumber);
if($request->ordertype==1){
$order_name =  $request->ordernumberfull;
$statusadd = '311'; 
}else if($request->ordertype==2){
    $order_name =  $request->bookingnumber;
    $statusadd = '321';
    }

     $addsodetails = new SoDetails;
     
     $addsodetails->sofullname = $newsonumber;

     $addsodetails->order_id = $request->order_id;
     $addsodetails->order_name = $order_name;
     $addsodetails->customer_id = $request->customer_id;
     $addsodetails->customer_code = $request->customer_code;
     $addsodetails->customer_name = $request->customer_name;
     $addsodetails->customer_adress = $request->customer_adress;
     $addsodetails->customer_tel = $request->customer_tel;
     $addsodetails->customer_fax= $request->customer_fax;
     $addsodetails->order_date= $request->order_date;
     $addsodetails->order_deliverydate= $request->order_deliverydate;
     $addsodetails->credit_day= $request->credit_day;
     $addsodetails->credit_condition= $request->credit_condition;
     $addsodetails->so_amount= $request->so_amount;
     $addsodetails->so_disper= $request->so_disper;
     $addsodetails->so_discount= $request->so_discount;
     $addsodetails->so_amountafterdis= $request->so_amountafterdis;
     $addsodetails->so_vat7= $request->so_vat7;
     $addsodetails->so_toatalamount= $request->so_toatalamount;
     $addsodetails->so_remark= $request->so_remark;
$addsodetails->save();
    $soid =  $addsodetails->id;


///so products
        $so_listadd =  $request->so_listadd;
        foreach($so_listadd as $sopd ){
$addsoproducts = new SoProducts;
$addsoproducts->so_id  = $soid ;    
$addsoproducts->so_name  = $newsonumber ;    
$addsoproducts->order_pdid  = $sopd['pdorderid'] ;    
$addsoproducts->product_id = $sopd['productid'] ;    
$addsoproducts->product_code = $sopd['productcode'] ;    
$addsoproducts->product_name = $sopd['productname'] ;    	
$addsoproducts->price = $sopd['price'] ;    	
$addsoproducts->qty= $sopd['qty'] ;    	
$addsoproducts->discount= $sopd['rowdiscount'] ;    	
$addsoproducts->amount= $sopd['rowamount'] ;    	
$addsoproducts->save();  	

///แก้ไขรายละเอียด product order

$MjOrderProductsupdate = MjOrderProducts::find($sopd['pdorderid']);
$qtyso = $MjOrderProductsupdate->qtyso = $MjOrderProductsupdate->qtyso+$sopd['qty'];
if($qtyso == $MjOrderProductsupdate->qty){
    $MjOrderProductsupdate->so_done =1;
}
$MjOrderProductsupdate ->save(); 

trackingadd($sopd['productid'],$sopd['productcode'],$sopd['qty'],3,$soid,$newsonumber,$statusadd,$request->userid,$request->userfullname) ;                




        }
    }

    
    public function listinorder($id)
    {
     
        $solist = SoDetails::where('order_id',$id)
        ->get();
        return response()->json($solist);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
