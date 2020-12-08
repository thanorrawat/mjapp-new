<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use Illuminate\Support\Facades\Mail;
 
use Illuminate\Support\Facades\Auth;
use App\Models\MjStoreProductsTracking;
use App\Models\MjOrderDetails;
use App\Models\MjOrderProducts;
use App\Models\SaleHistory;
use App\Category;
use Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Mail\OrderApprove;
use App\User;


class sendnotifyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "test";
    }


    public function ordersendmanager(Request $request)
    {

    if(!empty($request->confirm)){
        $doctype = $request->doctype;
// บันทึกข้อมูลและสร้าง Token
if($doctype==2){$newstatus ='21'; }else{$newstatus ='11'; }

$MjOrderDetailsupdate = MjOrderDetails::find($request->order_id);
$MjOrderDetailsupdate->remark = $request->remark;
$MjOrderDetailsupdate->token=$tokenorder= Str::random(70);
$MjOrderDetailsupdate->order_status = $newstatus;
$MjOrderDetailsupdate->save();



        //แจ้งเตือนทาง line
   
     if($doctype==1){
        if(url('/')!='http://localhost/mj-app_onweb'){ ///ถ้าไม่ใช่ localhost
     $sMessage = "มีการส่งรายการ Order สินค้า เลขที่ : ".$request->ordernumberfull."  ท่านสามารถตรวจสอบและดำเนินการทำรายการต่อได้ที่ ".url('order/'.$request->ordernumberfull.'/edit');
     lineNotifysend(2,$sMessage ,'');
     $orderid = $request->order_id;
        }
     ////----------บันทึกTimeline
     
     $pdfFilePath= createtimeline($request->order_id,1,$request->order_id,$request->remark,11); //createtimeline($orderid,$doc_type,$doc_id,$message)
     

$mailtdata_subject = "Order สินค้า เลขที่ : ".$request->ordernumberfull;
$mailtdata_message = "มีการทำรายการส่ง Order สินค้า เลขที่ : ".$request->ordernumberfull." เพื่อขออนุมัติ ตามเอกสารแนบ  ท่านสามารถตรวจสอบและดำเนินการทำรายการต่อได้ที่ ".url('order/'.$request->ordernumberfull.'/edit');
$mailtdata_pdfname = $request->ordernumberfull.".pdf";

    }elseif($doctype==2){
        if(url('/')!='http://localhost/mj-app_onweb'){ ///ถ้าไม่ใช่ localhost
         $sMessage = "มีการทำรายการส่ง ใบจองสินค้า เลขที่ : ".$request->bookingnumber."  เพื่อขออนุมัติ ท่านสามารถตรวจสอบและดำเนินการทำรายการต่อได้ที่ ".url('order/'.$request->bookingnumber.'/edit');
         lineNotifysend(2,$sMessage ,'');
        }
         // บันทึก Time line
         $message1 = "ส่งใบจองสินค้าเลขที่ : ".$request->bookingnumber." เพื่อขออนุมัตการทำรายการต่อ";
         $pdfFilePath= createtimeline($request->order_id,2,$request->order_id,$message1,21); //createtimeline($orderid,$doc_type,$doc_id,$message,$timelinestatus)

$mailtdata_subject = "ใบจองสินค้า เลขที่ : ".$request->bookingnumber;
$mailtdata_message = "มีการทำรายการส่งใบจองสินค้าเลขที่ : ".$request->bookingnumber." เพื่อขออนุมัติ ตามเอกสารแนบ ท่านสามารถตรวจสอบและดำเนินการทำรายการต่อได้ที่ ".url('order/'.$request->bookingnumber.'/edit');
$mailtdata_pdfname = $request->bookingnumber.".pdf";  
     }

$mailuserto = User::where('id',$request->userid)
->orWhere('role_id', '2')
->get();




foreach($mailuserto as $userlist){

    

     $to_name = $userlist->fullname;
     $to_email = $userlist->email;

     $to_massege = "เรียนคุณ ".$to_name." ".$mailtdata_message;
     $data = array('name'=>$to_name, "body" => $to_massege );
     Mail::send('emails.mail', $data, function($message) use ($to_name, $to_email,$mailtdata_subject,$pdfFilePath,$mailtdata_pdfname) {
     $message->to($to_email, $to_name)
     ->subject($mailtdata_subject)
     ->attach($pdfFilePath, [
        'as' => $mailtdata_pdfname,
        'mime' => 'application/pdf',
    ]);
     $message->from('no-reply@mjfapp.com','MJ ERP Application');
     });


    }
//    // $order= (object)[]; 
//    $order=[];
//     $order['pdffile']= $pdfFilePath; 
//     $order['message']= $sMessage ; 

//     foreach (['nutin@gmail.com', 'thanorrawat@gmail.com'] as $recipient) {
//         Mail::to($recipient)->send(new OrderApprove($order));
//     }


     $alertstatus = (object)[]; 
     $alertstatus->icon ="success";
     $alertstatus->title ="ส่งเอกสารเพื่อขออนุมัติแล้ว";
     $alertstatus->text =$mailtdata_subject." ถูกส่งเพื่อขออนุมัติแล้ว";

             }

             $orderdetrails = MjOrderDetails::where('id',$request->order_id)
             ->first();

             return response()->json(    [
                'alertstatus' => $alertstatus,
                   'orderdt' => $orderdetrails,
           
                ]);

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
