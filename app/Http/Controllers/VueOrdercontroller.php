<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use DB;
use App\Customer;
use Session;
use Response;
use App\Models\MjStoreProductsTracking;
use App\Models\MjOrderDetails;
use App\Models\MjOrderProducts;
use Auth;
Use Alert;
use App\Models\SaleHistory;
use App\express\customerModel;
class VueOrdercontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       
            return view('A_vue.order_create')
            ->with('pagetype', 'add')
            ->with('baseurl', url('/'))
            ;
    }

    public function orderlist()
    {
             return view('A_vue.order_list')
            ->with('pagetype', 'order')
            ;
    }
    public function bookinglist()
    {
             return view('A_vue.order_list')
            ->with('pagetype', 'booking')

            ;
    }



    public function addorder(Request $request)
    {

if(!empty($request->selectcustomer) && !empty($request->doctype)){

        $customer_id =  $request->selectcustomer;  
        $newordernumber="0";
        $newordernumberfull="0";
        $newbookingnumber ="0";
        if($request->doctype==1){ // สร้าง Order

            $beforeordername = date('ym');
                $lastornumber= MjOrderDetails::where('ordernumber','like', $beforeordername.'%')->orderBy('id', 'desc')->first();
                if(!empty($lastornumber->ordernumber)){
                    $oldnumber = substr($lastornumber->ordernumber, -4);
                    $newnumber=$oldnumber+1;
                }else{
                    $newnumber=1;
                }
                $newordernumber = $beforeordername.sprintf("%04d",$newnumber);
                $docnumber =  $newordernumberfull = 'OD'.$newordernumber;
                $newstatus = 1;

        }elseif($request->doctype==2){ // สร้าง ใบจอง
                      //สร้าง booking number
            $beforebookingname = "BK".date('ym');
            $lastbookingnumber= MjOrderDetails::where('bookingnumber','like', $beforebookingname.'%')->orderBy('id', 'desc')->first();
            if(!empty($lastbookingnumber->bookingnumber)){
            $oldnumber = substr($lastbookingnumber->bookingnumber, -4);
            $newnumber=$oldnumber+1;
            }else{
                $newnumber=1;
            }
            $docnumber =   $newbookingnumber = $beforebookingname.sprintf("%04d",$newnumber);
            $newstatus = 2;
        }



        $customerdt = customerModel::on('report')
        ->where('indexrow', $customer_id)
        ->first();
        if($customerdt->prenam){
            $customer_name = $customerdt->prenam.''.$customerdt->cusnam;
        }else{
            $customer_name = $customerdt->cusnam;
        }


        $MjOrderDetails = new MjOrderDetails;
        $MjOrderDetails->customer_id = $customer_id;
        $MjOrderDetails->customer_name =   $customer_name;
        $MjOrderDetails->deliverydate =  $request->selectdate;
        $MjOrderDetails->ordertype = $request->ordertype;
        $MjOrderDetails->createby_name = $request->userfullname;
        $MjOrderDetails->createby_id = Auth::user()->id;

        $MjOrderDetails->ordernumber = $newordernumber;
        $MjOrderDetails->ordernumberfull = $newordernumberfull;
        $MjOrderDetails->bookingnumber = $newbookingnumber;
        $MjOrderDetails->doctype  = $request->doctype;
        $MjOrderDetails->order_status  = $newstatus;

        $MjOrderDetails->save();

        if($request->doctype==1){
            $doctypename = "Order";
        }
        if($request->doctype==2){
            $doctypename = "ใบจอง";
        }
        
    }
    
    if(!empty($MjOrderDetails->id)){

        $message = "Create New Order/Booking";
        createtimeline($MjOrderDetails->id,$request->doctype,$MjOrderDetails->id,$message,$newstatus); //createtimeline($orderid,$doc_type,$doc_id,$message,$timelinestatus)


        return redirect('order/'.$docnumber.'/edit')
        ->with('status', 'บันทึกข้อมูล '.$doctypename.' เลขที่ '.$docnumber.' กรุณาเลือกสินค้า และทำรายการต่อ')
        ->with('statustitle', 'สำเร็จ')
        ->with('statustype', 'success');

    }else{
      return redirect('create_order')
        ->with('status', 'บันทึกข้อมูลไม่สำเร็จ กรุณาลองใหม่อีกครั้ง หรือติดต่อผู้ดูแลระบบ')
        ->with('statustitle', 'เกิดข้อผิดพลาด')
        ->with('statustype', 'error');
    

    }

}



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        $doctype='';
        $docnumber=$id;
        $orderid ='';
        $orderdt= MjOrderDetails::where('ordernumberfull', '=', $id)
        ->orwhere('bookingnumber', '=', $id)
        ->orderBy('id', 'desc')
        ->first();


        if(!empty($orderdt->doctype)){
            $orderid = $orderdt->id;
            if($orderdt->doctype==1){
                $doctypename = "Order";
            } else if($orderdt->doctype==2){
                $doctypename = "ใบจอง";
            }
        }

        if(!empty($orderdt->token)){
        //lineNotifysend(1,'ทดสอบส่งแจ้งเตือน','https://www.mindphp.com/images/knowledge/Security/Alert.jpg');
            return view('A_vue.order_confirm',['customers' => $orderdt->customer_id,'cartDetails'=>$orderdt
                ,'orderid'=>$orderdt->id
                ,'baseurl'=>url('/')
                ,'orderdt'=> $orderdt
            ]);
        }else{
            // return view('App_sale.order',['customers' => $customers,'cartDetails'=>$cartDetails,'orderid'=>$orderid]);

            $customerdt = customerModel::on('report')
            ->where('indexrow', $orderdt->customer_id)
            ->first();
            $customercode  = $customerdt->cuscod;
            if(!empty($customercode)){
                $salehistorycount = SaleHistory::where('customer_code',$customercode)
                ->count();
                if($salehistorycount>0){
                    $searchtype = 1 ; ///หน้า search แสดงสินค้าตามประวัติขาย
                }else{
                    $searchtype = 2 ; ///หน้า search แสดงสินค้าทั้งหมด  
                }

            }else{
            $searchtype = 2 ; ///หน้า search แสดงสินค้าทั้งหมด
            }


            return view('A_vue.order_create')
            ->with('pagetype', 'edit')
            ->with('baseurl', url('/'))
            ->with('orderdt', $orderdt)
            ->with('doctypename', $doctypename)
            ->with('docnumber', $docnumber)
            ->with('orderid', $orderid)
            ->with('searchtype', $searchtype)
            ;

        }
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
