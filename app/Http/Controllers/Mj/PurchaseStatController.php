<?php

namespace App\Http\Controllers\Mj;
use App\Models\Willorder;
use App\Models\Stock;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use Session;
use Cookie;
class PurchaseStatController extends Controller
{
    public function willorder()
    {


        


$myDate = date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-01") ) ) . "-12 month" ) );
$montharr= [];
$monthstart = date("m",strtotime($myDate));
for($i=0;$i<12;$i++){
    $thism = $monthstart+$i;
    if($thism>12){
        $montharr[]=$thism-12 ;
    }else{
        $montharr[]=$thism  ;
    }
   
}
        return view('A_purchase.willorder')
        ->with('baseurl', url('/'))
        ->with('pagetille', 'Will Order')
        ->with('myDate', $myDate)
        ->with('montharr', $montharr)

        
        ;
    }



    public function willorderdata(Request $request)
    {


      if($_GET['csrf']==csrf_token()) {
        $willorder=Willorder::get();
  return Datatables::of($willorder)
->escapeColumns([]) /// ทำให้แสดง html ในตาราง
->make();
      }
    }


    public function willorderdata2(Request $request)
    {

      if($_GET['csrf']==csrf_token()) {
         $allcheckarr=[];
        $willorder=Willorder::selectRaw('willorders.id AS id,willor_productcode,willor_stock,willor_po,willor_so,willor_diff,willor_order,name,willor_max2')
        ->leftjoin('products','willorders.willor_productcode','products.code')
        ->where('willor_order','>','0')
        ->get();
  return Datatables::of($willorder)
  ->addColumn('selectbox', function ($orderlist) {
if(!empty(Session::get('allcheckjson'))){
      $allcheckjsonsess=  Session::get('allcheckjson');
$allcheckarr=unserialize($allcheckjsonsess);
      }else{
$allcheckarr=[];
      }
  if (in_array($orderlist->id, $allcheckarr)) {
      $checked ="checked";
  }else{
    $checked =""; 
  }
     return '<input '.$checked.' type="checkbox" class="checkpurechase" name="checkpurechase" value="'.$orderlist->id.'">';
   
})

->editColumn('willor_productcode', function ($orderlist) {
 
       return  $orderlist->willor_productcode.'-'.$orderlist->name;
     
  })
 ->escapeColumns([]) /// ทำให้แสดง html ในตาราง
  ->make();
      }
    }


    public function wrecievedata(Request $request)
    {


      if($_GET['csrf']==csrf_token()) {
        $wrecieve=Stock::leftjoin('products','stocks.stock_productcode','products.code')
        ->where('stock_w_recieve','>','0')
        ->get();
  return Datatables::of($wrecieve)
 ->escapeColumns([]) /// ทำให้แสดง html ในตาราง
  ->make();
      }
    }

       public function stock_status_post(Request $request)
    {
        $data = array();
        $data['statusarr'] = array();
        $data['label'] = array();
        $statusnormal =  Willorder::whereRaw('willor_stock > willor_min AND  willor_stock < willor_max2')->count();
        $data['statusarr'][] =$statusnormal;
        $statusovermax =  Willorder::whereRaw('willor_stock > willor_max2')->count();
        $data['statusarr'][] =$statusovermax;
        $statuslessmin =  Willorder::whereRaw('willor_stock < willor_min AND willor_stock > 0')->count();
        $data['statusarr'][] =$statuslessmin;
        $statusempty =  Willorder::whereRaw('willor_stock < 1')->count();
        $data['statusarr'][] =$statusempty;
 return $data;
    }
    

    public function checkforpurchase(Request $request)
    {
      if($request->csrf==csrf_token()) {  
     // if(empty(Session::get('allcodejson'))){
        $willorderall=Willorder::selectRaw('id,willor_productcode,willor_order')
        ->where('willor_order','>','0')
        ->get();
        $allcheckarr =[];

        if(!empty(Session::get('allcheckvalue'))){
          $allcheckvalue= unserialize(Session::get('allcheckvalue'));
            }else{
              $allcheckvalue= [];
            }
  foreach($willorderall as $purchaseall){
      $allcheckarr[]=$purchaseall->id;

      if(empty($allcheckvalue[$purchaseall->id])){
        $allcheckvalue[$purchaseall->id] = $purchaseall->willor_order;
      }
    }
    $allcheckjson =  serialize($allcheckarr);
    $allcheckvaluejson =  serialize($allcheckvalue);
  Session::put('allcodejson',$allcheckjson);
  Session::put('allcheckvalue',$allcheckvaluejson);
 //}
   // return Session::get('allcheckjson');
if(!empty($request->selectthis)){
 
  if(!empty(Session::get('allcheckjson'))){
$allallcheckarray= unserialize(Session::get('allcheckjson'));
  }else{
    $allallcheckarray= [];
  }
  $key = array_search($request->thisid,$allallcheckarray);
  if($request->selectthis=='n'){
    Session::put('allcheck','n');
    if(!empty($key)){
      unset($allallcheckarray[$key]);
    }
   
  }else if($request->selectthis=='y'){
    if(empty($key)){ 
    array_push($allallcheckarray,$request->thisid);
    }
  }

  $allcheckjson =  serialize($allallcheckarray);
  Session::put('allcheckjson',$allcheckjson);
  //return $request->thisid."=".$allcheckvalue[$request->thisid];

}else
    if(!empty($request->selectall)){
//return $request->selectall;
if($request->selectall=="y"){
  Session::put('allcheckjson',Session::get('allcodejson'));
  Session::put('allcheck','y');
}else{
  Session::put('allcheckjson',serialize([]));
  Session::put('allcheck','n');

}

//return Session::get('allcheckjson');
    }else{
     // return Session::get('allcheckjson');
    }
     } 
    }

    public function show_purchase_items()
    {
     
     if(!empty((Session::get('allcheckjson')))){
      $allcheckarr =unserialize(Session::get('allcheckjson'));
      return count($allcheckarr);
     }else{
      return 0;
     }
    
    }

}