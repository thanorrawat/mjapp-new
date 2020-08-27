<?php

namespace App\Http\Controllers\Mj;
use App\Product;
use App\Customer;
use App\User;
use App\Models\MemoPrice;
use App\Models\PriceSpecific;
use Yajra\Datatables\Datatables;



use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemoPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('A_vue.order_create')
        ->with('pagetype', 'memo_changprice')
        ->with('baseurl', url('/'))
        ->with('pagetille', 'Memo ขอปรับราคา')
        ;
    }


    public function memocheckprice(Request $request)
    {
        $productprcienow='';
      if(!empty($request->productcode) && $request->customertype==1 && !empty($request->pricetype)  ){

$productprcie = Product::where('code',$request->productcode)
->select('name','code','price_a','price_b','price_c','price_d')
->first();  

if($request->pricetype=="A"){
    $productprcienow = $productprcie->price_a;
}else
if($request->pricetype=="B"){
    $productprcienow = $productprcie->price_b;
}else
if($request->pricetype=="C"){
    $productprcienow = $productprcie->price_c;
}else
if($request->pricetype=="D"){
    $productprcienow = $productprcie->price_d;
}

return response()->json([
    'pricename' => "Standard ".$request->pricetype,
    'pricenow' => $productprcienow,
]);


      }elseif(!empty($request->productcode)  && $request->customertype==2 && !empty($request->customercode)  ){

        $productprcie = Product::where('code',$request->productcode)
        ->select('name','code','price_a','price_b','price_c','price_d')
        ->first();  
        /// ราคาตาม group
        $cpricegroup  = Customer::where('customercode',$request->customercode)
        ->select('price_group')
        ->first();  
$pricegroup = $cpricegroup->price_group;

if($pricegroup =="A"){
    $productprcienow = $productprcie->price_a;
}else
if($pricegroup =="B"){
    $productprcienow = $productprcie->price_b;
}else
if($pricegroup =="C"){
    $productprcienow = $productprcie->price_c;
}else
if($pricegroup =="D"){
    $productprcienow = $productprcie->price_d;
}


        return response()->json([
        'pricename' => "Customer : ".$request->customercode.' ( Standard '.$pricegroup.' )',
        'pricenow' => $productprcienow,
        ]); 
      }else{
        return response()->json([
        'pricename' => "ข้อมูลไม่ครบ",
        'pricenow' =>'',
        ]);
      }
        
        

    }

    public function addmemoprice(Request $request)
    {

        $memonumber ='' ;
        $mmp_datestart ='';
        $mmp_dateend ='';
        $mmp_customer='';
        if(!empty($request->productcode) && !empty($request->reson) && !empty($request->when) && !empty($request->price_now)   && !empty($request->price_new)    ){

            if($request->when =='3' && !empty($request->daterange)){

                $rangedate = $request->daterange;
$datearr = explode(' - ', $rangedate);
$datestart =  $datearr[0];
$dateend=  $datearr[1];

$datestartarr = explode('/', $datestart);
$dateendarr = explode('/', $dateend);

                $mmp_datestart =$datestartarr[2].'-'.$datestartarr[1].'-'.$datestartarr[0];
                $mmp_dateend =$dateendarr[2].'-'.$dateendarr[1].'-'.$dateendarr[0];   
            }

            if($request->customertype=='2' && !empty($request->customercode)){
                $mmp_customer=$request->customercode;
            }

//ประเภทของราคาที่จะเปลี่ยนเมื่ออนุมัติ
if($request->customertype=='2'){
$typeprice = 'SPC';
}else{
  $typeprice =   $request->typeprice;
}


        //addproduct    
        $newmemoprice= new MemoPrice;
        $newmemoprice->mmp_productcode= $request->productcode;
        $newmemoprice->mmp_reson=$request->reson;
        $newmemoprice->mmp_when=$request->when;
        $newmemoprice->mmp_daterange=$request->daterange;
        $newmemoprice->mmp_datestart=$mmp_datestart;
        $newmemoprice->mmp_dateend=$mmp_dateend;
        $newmemoprice->mmp_customertype=$request->customertype;
        $newmemoprice->mmp_customer=$mmp_customer;
        $newmemoprice->mmp_typeprice=$typeprice;
        $newmemoprice->mmp_remark=$request->remark;
        $newmemoprice->price_now=$request->price_now;
        $newmemoprice->price_new=$request->price_new;
        $newmemoprice->created_by=$request->userid;

        
        $newmemoprice->status=1;
    
    $newmemoprice->save();
$memoid =  $newmemoprice->id;
$memonumber = "MEMO".date('Ym').sprintf("%05d", $memoid);
               //edit    
               $addmemonumber= MemoPrice::where('id',$memoid)
               ->first()
               ;
$addmemonumber->memonumber= $memonumber;
$addmemonumber->save();



       $alertstatus = (object)[]; 
       $alertstatus->icon ="success";
       $alertstatus->title ="บันทึกสำเร็จ";
       $alertstatus->text ="ท่านได้ทำการสร้าง Memo เพื่อขออนุมัติเปลี่ยนแปลงราคา สินค้า รหัส ".$request->productcode." เป็นราคา ".$request->price_new." บาท เรียบร้อยแล้ว" ;

       $sMessage ="มีการทำ Memo เพื่อขออนุมัติ การเปลี่ยนแปลงราคา สินค้า รหัส ".$request->productcode." เป็นราคา ".$request->price_new." บาท ท่าานสามารถตรวจสอบและอนุมัติ/ไม่่อนุมัติ ได้ที่ ".url('memo-changprice');

       lineNotifysend(1,$sMessage,'');
       lineNotifysend(2,$sMessage,'');

        }else{

            $alertstatus = (object)[]; 
            $alertstatus->icon ="error";
            $alertstatus->title ="เกิดข้อผิดพลาด";
            $alertstatus->text ="บันทึกรายการไม่สำเร็จกรุณาตรวจสอบข้อมูล ก่อนทำการบันทึกอีกครั้ง";

        }
        return response()->json(    [
            'alertstatus' => $alertstatus,
            'memonumber' => $memonumber,
            

            ]);


    }

    public function datatable()
    {
        $memolist= MemoPrice::leftJoin('users','memo_prices.created_by','users.id')
        ->selectRaw('memo_prices.*,users.fullname')

        ->orderBy('updated_at','desc')
        ->orderBy('id','desc')
        ->get();

        // return Datatables::of($memolist)
        // ->escapeColumns([]) /// ทำให้แสดง html ในตาราง
        // ->make();
        return response()->json($memolist);
        
    }

    public function userlist()
    {
        $userlist= User::select('id','fullname','role_id')
        ->get();
        return response()->json($userlist);
        
    }



    public function viewmemo(Request $request)
    {
        $memolist= MemoPrice::where('id',$request->id)
        ->first();
        return response()->json($memolist);
    }


    public function approve(Request $request)
    {
      
        $memodt= MemoPrice::where('id',$request->memoid)
        ->first();
        if($request->statustype==2){ //ถ้าอนุมัติ

if($memodt->mmp_customertype==2 || $memodt->mmp_when!=1  ){ /// ถ้าระบุลูกค้า หรือ ระบุเวลา/ครั้งเดียว
//เพิ่มเป็นราคา specific

$addspecificprice = new PriceSpecific;
$addspecificprice->productcode=$memodt->mmp_productcode;
$addspecificprice->memonumber=$memodt->memonumber;
$addspecificprice->custype=$memodt->mmp_customertype;
$addspecificprice->cuscode=$memodt->mmp_customer;
$addspecificprice->typeprice=$memodt->mmp_typeprice;
$addspecificprice->remark=$memodt->mmp_remark;
$addspecificprice->pricetime=$memodt->mmp_when;
$addspecificprice->pricedaterange=$memodt->mmp_daterange;
$addspecificprice->pricedatestart=$memodt->mmp_datestart;
$addspecificprice->pricedateend=$memodt->mmp_dateend;
$addspecificprice->pricevalue=$memodt->price_new;
$addspecificprice->save();

    

}else{ // เปลี่ยนราคาถาวร

    $productchange= Product::where('code',$memodt->mmp_productcode)
    ->first();

    if($memodt->mmp_typeprice=="A"){
        $productchange->price_a=$memodt->price_new;
    }else if($memodt->mmp_typeprice=="B"){
        $productchange->price_b=$memodt->price_new;
    }else if($memodt->mmp_typeprice=="C"){
        $productchange->price_c=$memodt->price_new;
    }else if($memodt->mmp_typeprice=="D"){
        $productchange->price_d=$memodt->price_new;
    }
 
    $productchange->save();


}





            $alertstatus = (object)[]; 
            $alertstatus->icon ="success";
            $alertstatus->title ='"อนุมัติ" ';
            $alertstatus->text ='ท่านได้ทำการ "อนุมัติ" รายการ Memo ขอแก้ไขราคา '.$memodt->memonumber.' เรียบร้อยแล้ว';

        }else{

            $alertstatus = (object)[]; 
            $alertstatus->icon ="info";
            $alertstatus->title ='"ไม่อนุมัติ"';
            $alertstatus->text ='ท่านได้ทำการ "ไม่อนุมัติ" รายการ Memo ขอแก้ไขราคา '.$memodt->memonumber.' เรียบร้อยแล้ว';
    
        }


        $memodt->status= $request->statustype;
        $memodt->approve_by= $request->approve_by;
        $memodt->save();
    

     
        return response()->json(    [
            'alertstatus' => $alertstatus,
            'memodt' => $memodt,
            

            ]);

    }


    
    public function checkpriceorder(Request $request)
    {
        $priceorder = '';
        $cuscode='';
        $daterange='';
        $typeprice = '';
        $once_time ='';
        $pricetime='';
        $memonumber='';
        ///check ราคา special
/// 1. ตามรหัสลูกค้า +  ช่วงเวลา
        $productprice= PriceSpecific::where('productcode',$request->productcode)
        ->where('custype','2')
        ->where('cuscode',$request->cuscode)
        ->where('pricetime','3')
        ->whereDate('pricedatestart', '<=', date('Y-m-d'))
        ->whereDate('pricedateend', '>=', date('Y-m-d'))
        ->orderBy('id','desc')
        ->first();

    

        if(!empty($productprice->pricevalue)){
$priceorder = $productprice->pricevalue;
$cuscode = $productprice->cuscode;
$daterange= $productprice->pricedaterange;
$typeprice = $productprice->typeprice;
$pricetime = $productprice->pricetime;
$memonumber =$productprice->memonumber;
        }else{
/// 2. ช่วงเวลา + ประเภททราคา
$productprice= PriceSpecific::where('productcode',$request->productcode)

->where('typeprice',$request->typeprice)
->where('pricetime','3')
->whereDate('pricedatestart', '<=', date('Y-m-d'))
->whereDate('pricedateend', '>=', date('Y-m-d'))
->orderBy('id','desc')
->first();

if(!empty($productprice->pricevalue)){
    $priceorder = $productprice->pricevalue;
    $daterange= $productprice->pricedaterange;
    $typeprice = $productprice->typeprice;
    $pricetime = $productprice->pricetime;
    $memonumber =$productprice->memonumber;
            }else{

/// 3. เฉพาะครั้งนี้ + ลูกค้า
$productprice= PriceSpecific::where('productcode',$request->productcode)
->where('custype','2')
->where('cuscode',$request->cuscode)
->where('pricetime','2')
->where('once_time','1')
->orderBy('id','desc')
->first();
if(!empty($productprice->pricevalue)){

    $priceorder = $productprice->pricevalue;
    $once_time = $productprice->once_time;
    $typeprice = $productprice->typeprice;
$cuscode = $productprice->cuscode;
$pricetime = $productprice->pricetime;
$memonumber =$productprice->memonumber;
            }else{

/// 4. เฉพาะครั้งนี้ + ประเภททราคา
$productprice= PriceSpecific::where('productcode',$request->productcode)

->where('typeprice',$request->typeprice)
->where('pricetime','2')
->where('once_time','1')
->orderBy('id','desc')

->first();
if(!empty($productprice->pricevalue)){
    $priceorder = $productprice->pricevalue;
    $once_time = $productprice->once_time;
    $typeprice = $productprice->typeprice;
    $pricetime = $productprice->pricetime;
    $memonumber =$productprice->memonumber;

            }else{



                /// 4. ราคาเฉพาะลูกค้านี้ เปลี่ยนตลอด
$productprice= PriceSpecific::where('productcode',$request->productcode)
->where('custype','2')
->where('cuscode',$request->cuscode)
->where('pricetime','1')
->orderBy('id','desc')
->first();
if(!empty($productprice->pricevalue)){
    $priceorder = $productprice->pricevalue;
    $cuscode = $productprice->cuscode;
    $pricetime = $productprice->pricetime;
    $pricetime = $productprice->pricetime;
    $memonumber =$productprice->memonumber;

            }else{



/// 6. ประเภททราคา


$productprice = Product::where('code',$request->productcode)
->select('name','code','price_a','price_b','price_c','price_d')
->first();  

if($request->typeprice=="A"){
    $priceorder =  $productprice->price_a;
    
}else if($request->typeprice=="B"){
    $priceorder =  $productprice->price_b;
}else if($request->typeprice=="C"){
    $priceorder =  $productprice->price_c;
}else if($request->typeprice=="D"){
    $priceorder =  $productprice->price_d;
}

$typeprice = $request->typeprice;
 }

            }
            }
        }

        }
        


return response()->json(    [
    'cuscode' =>  $cuscode,
    'productcode' => $request->productcode,
    'priceorder' => $priceorder,
    'typeprice' => $typeprice,
    'daterange' => $daterange,
    'once_time' => $once_time,
    'pricetime' => $pricetime,
    'memonumber' => $memonumber,
    

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
