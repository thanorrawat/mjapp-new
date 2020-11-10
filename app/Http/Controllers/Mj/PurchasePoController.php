<?php

namespace App\Http\Controllers\Mj;
use Session;
use Cookie;
use DB;
use App\Models\Willorder;
use App\Models\Stock;
use Illuminate\Http\Request;

use App\Sale;
use App\Returns;
use App\ReturnPurchase;
use App\Purchase;
use App\Expense;
use App\Payroll;
use App\Quotation;
use App\Payment;
use App\Account;
use App\Product_Sale;
use App\Roles;
use App\Models\PurchasePo ;
use App\Models\PurchasePoItems ;

use Auth;
use App\Models\MjOrderDetails;
use App\Models\MjOrderProducts;
use App\Product;
use App\Models\Selling;
use Yajra\Datatables\Datatables;

use App\Http\Controllers\Controller;
class PurchasePoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if( !empty(Session::get('allcheckjson')) ){ /// ถ้ามีการเลือกใบสั่งซื้อ
            $checklist =unserialize(Session::get('allcheckjson'));
            // if(!empty(Session::get('checklistarrdt')) ){  ///ถ้ามีรายละเอียดสินค้าในใบสั่งซื้อแล้ว

            //     $checklistarr =unserialize(Session::get('checklistarrdt')); 
         

            // }else{

            /// ค้นหารายละเอียดสินค้าท่ี่สั่งซื้อและเก็บไว้ใน session รูปแบบ Array
            $allcheckarr =unserialize(Session::get('allcheckjson'));
            $checklistdt=Willorder::selectRaw('willorders.id AS id,willor_productcode,willor_stock,willor_po,willor_so,willor_diff,willor_order,name,cost,unit_name')
            ->leftjoin('products','willorders.willor_productcode','products.code')
            ->whereIn('willorders.id', $allcheckarr)
            ->get();
            $checklistarr=[];
            foreach($checklistdt as $checklistrow ){
                $rowwillorderid= $checklistrow->id;
                $checklistarr[$rowwillorderid]['code'] = $checklistrow->willor_productcode;
                $checklistarr[$rowwillorderid]['name'] = $checklistrow->name;
                $checklistarr[$rowwillorderid]['qty'] = $checklistrow->willor_order;
                $checklistarr[$rowwillorderid]['cost'] = $checklistrow->cost;
                $checklistarr[$rowwillorderid]['unit_name'] = $checklistrow->unit_name;

                
     
            }

            $checklistarrdt =  serialize($checklistarr);
            Session::put('checklistarrdt',$checklistarrdt);

        
       // }
            
                   } else {
                    $checklist =[];
                    $checklistarr =[];
           }
          
         $supplierlist = DB::table('users')
        ->selectRaw('users.id as suppid,fullname,credit,suppliers_code')
         ->leftjoin('suppliers','users.id','suppliers.user_id')
         ->where('role_id', 9)
         ->where('users.is_active', 1)
         ->where('users.is_deleted', 0)
         ->get();


         $newponumber=  Session::get('ponumbernew');

      // print_r($checklistdt);
      if(!empty(Session::get('poitem'))){
        $poitemarr =Session::get('poitem'); 
    }else{
        $poitemarr =[];
    }
        return view('A_purchase.po_add')
        ->with('pagetille', 'Create Purchase Order')
        ->with('checklist', $checklist)
        ->with('checklistarr', $checklistarr)
        ->with('supplierlist', $supplierlist)
        ->with('newponumber', $newponumber)
        ->with('poitemarr', $poitemarr)
        

        
        ;
    
}


public function gennewponumber()
    {

       // if(empty(Session::get('ponumbernew')) ){

            $poyear = date("Y")+543;
            $poyearshort=substr($poyear, 2 ,3);
        $ponumberbefore = "PO".$poyearshort.date("m");
            $lastpo = DB::table('purchase_pos')
            ->orderBy('id','desc')
            ->first();
        if(!empty($lastpo->ponumber)){
            if ( strstr( $lastpo->ponumber, $ponumberbefore ) ) {
                $oldnumber = substr($lastpo->ponumber, 6 ,8);
                $newnumber = $oldnumber+1;
                $newponumber =$ponumberbefore.sprintf("%03d",$newnumber);
            }else{
                $newponumber =$ponumberbefore."001";
        
            }
        
        
        }else{
        
            $newponumber =$ponumberbefore."001";
        }
            
        
      //  }
        Session::put('newponumber',$newponumber);
    }


    public function numbertotext($number)
    {
        function m2t($number){

            $number = number_format($number, 2, '.', '');
          
            $numberx = $number;
          
            $txtnum1 = array('ศูนย์','หนึ่ง','สอง','สาม','สี่','ห้า','หก','เจ็ด','แปด','เก้า','สิบ');
          
            $txtnum2 = array('','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน');
          
            $number = str_replace(",","",$number);
          
            $number = str_replace(" ","",$number);
          
            $number = str_replace("บาท","",$number);
          
            $number = explode(".",$number);
          
            if(sizeof($number)>2){
          
            return 'ทศนิยมหลายตัวนะจ๊ะ';
          
            exit;
          
            }
          
            $strlen = strlen($number[0]);
          
            $convert = '';
          
            for($i=0;$i<$strlen;$i++){
          
                $n = substr($number[0], $i,1);
          
                if($n!=0){
          
                    if($i==($strlen-1) AND $n==1){ $convert .= 'เอ็ด'; }
          
                    elseif($i==($strlen-2) AND $n==2){  $convert .= 'ยี่'; }
          
                    elseif($i==($strlen-2) AND $n==1){ $convert .= ''; }
          
                    else{ $convert .= $txtnum1[$n]; }
          
                    $convert .= $txtnum2[$strlen-$i-1];
          
                }
          
            }
          
          
          
            $convert .= 'บาท';
          
            if($number[1]=='0' OR $number[1]=='00' OR
          
            $number[1]==''){
          
            $convert .= 'ถ้วน';
          
            }else{
          
            $strlen = strlen($number[1]);
          
            for($i=0;$i<$strlen;$i++){
          
            $n = substr($number[1], $i,1);
          
                if($n!=0){
          
                if($i==($strlen-1) AND $n==1){$convert
          
                .= 'เอ็ด';}
          
                elseif($i==($strlen-2) AND
          
                $n==2){$convert .= 'ยี่';}
          
                elseif($i==($strlen-2) AND
          
                $n==1){$convert .= '';}
          
                else{ $convert .= $txtnum1[$n];}
          
                $convert .= $txtnum2[$strlen-$i-1];
          
                }
          
            }
          
            $convert .= 'สตางค์';
          
            }
          
            //แก้ต่ำกว่า 1 บาท ให้แสดงคำว่าศูนย์ แก้ ศูนย์บาท
          
            if($numberx < 1)
          
            {
          
                $convert = "ศูนย์" .  $convert;
          
            }
          
          
          
            //แก้เอ็ดสตางค์
          
            $len = strlen($numberx);
          
            $lendot1 = $len - 2;
          
            $lendot2 = $len - 1;
          
            if(($numberx[$lendot1] == 0) && ($numberx[$lendot2] == 1))
          
            {
          
                $convert = substr($convert,0,-10);
          
                $convert = $convert . "หนึ่งสตางค์";
          
            }
          
          
          
            //แก้เอ็ดบาท สำหรับค่า 1-1.99
          
            if($numberx >= 1)
          
            {
          
                if($numberx < 2)
          
                {
          
                    $convert = substr($convert,4);
          
                    $convert = "หนึ่ง" .  $convert;
          
                }
          
            }
          
            return $convert;
          
            }

            return m2t($number);
          
    }

    
    public function updateprchaserow(Request $request)

    {
       
        if(!empty($request->willorderid)){

            $checklistarr =unserialize(Session::get('checklistarrdt')); 
            $checklistarr[$request->willorderid]['po_qty'] =  $request->qty;
            $checklistarr[$request->willorderid]['po_cost'] =  $request->price;
            $checklistarr[$request->willorderid]['po_total'] =  $request->qty*$request->price;
           
            $checklistarrdt =  serialize($checklistarr);
            Session::put('checklistarrdt',$checklistarrdt);
//return $checklistarrdt ;



        if(!empty(Session::get('poitem'))){
            $poitemarr =Session::get('poitem'); 
        }else{
            $poitemarr=[];
        }
        

        $poitemarr[$request->willorderid]['qty'] = $request->qty;
        $poitemarr[$request->willorderid]['price'] = $request->price;
        $poitemarr[$request->willorderid]['total'] =  $request->qty*$request->price;

Session::put('poitem',$poitemarr );

        }
    }

    public function updatepurchasesession(Request $request)

    {


    Session::put('podiscount',$request->discount);
    return Session::get('podiscount');


    }
    

    public function polist()
    {
        return view('A_purchase.list');
    }


    

    public function updatesessionpoitems(Request $request)

    {
        if(!empty(Session::get('poitem'))){
            $poitemarr =unserialize(Session::get('poitem')); 
        }else{
            $poitemarr=[];
        }
        
        $poitemarr[$request->willid]['willid'] = $request->willid;
        $poitemarr[$request->willid]['code'] = $request->code;
        $poitemarr[$request->willid]['name'] = $request->name;
        $poitemarr[$request->willid]['qty'] = $request->qty;
        $poitemarr[$request->willid]['price'] = $request->price;
        $poitemarr[$request->willid]['total'] = $request->total;

        $poitemarrse =  serialize($poitemarr);

        Session::put('poitem',$poitemarr );


        return $poitemarr;

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $seliing_year ='2020';
        $seliing_month ='08';
                   $selling1 =  Selling::where('product_code','like','0-CP-%')
                   ->leftjoin('products','sellings.product_code','products.code')
                   ->where('seliing_year',$seliing_year)
                   ->where('seliing_month',$seliing_month)
                   ->orderBy('selling_qty','desc')
                   ->limit(20)
                    ->get();
        
                    $selling2 =  Selling::where('product_code','like','0-BK-%')
                    ->leftjoin('products','sellings.product_code','products.code')
                    ->where('seliing_year',$seliing_year)
                    ->where('seliing_month',$seliing_month)
                    ->orderBy('selling_qty','desc')
                    ->limit(20)
                     ->get();
        
        
                     $selling3 =  Selling::where('product_code','like','0-PU-%')
                     ->leftjoin('products','sellings.product_code','products.code')
                     ->where('seliing_year',$seliing_year)
                     ->where('seliing_month',$seliing_month)
                     ->orderBy('selling_qty','desc')
                     ->limit(20)
                      ->get();
        
                      $selling4 =  Selling::whereRaw("product_code NOT LIKE '0-CP-%' AND product_code NOT LIKE '0-BK-%' AND product_code NOT LIKE '0-PU-%' ")
                      ->leftjoin('products','sellings.product_code','products.code')
                      ->where('seliing_year',$seliing_year)
                      ->where('seliing_month',$seliing_month)
                      ->orderBy('selling_qty','desc')
                      ->limit(20)
                       ->get();
         
        
        
                    //   $willorder =  Willorder::leftjoin('products','willorders.willor_productcode','products.code')
                    //  ->where('willor_order','>','0')
                    //   ->orderBy('willor_order','desc')
                    //    ->get();
        
        
                      
        
        
        
                    return view('App_dashboard.index-purchase')
                    ->with('selling1', $selling1)
                    ->with('selling2', $selling2)
                    ->with('selling3', $selling3)
                    ->with('selling4', $selling4)
                    ->with('pocreate', 1)
            ->with('pagetille',  __('file.Add Purchase'))

                    ;
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
       $supplier_id=  $request->supplier_id;
        if(!empty($supplier_id)){
            $supplierdt = DB::table('users')
            ->selectRaw('*')
             ->leftjoin('suppliers','users.id','suppliers.user_id')
             ->where('role_id', 9)
             ->where('users.is_active', 1)
             ->where('users.is_deleted', 0)
             ->where('users.id', $supplier_id)
             ->first();





             $poyear = date("Y")+543;
             $poyearshort=substr($poyear, 2 ,3);
         $ponumberbefore = "PO".$poyearshort.date("m");
             $lastpo = DB::table('purchase_pos')
             ->orderBy('id','desc')
             ->first();
         if(!empty($lastpo->ponumber)){
             if ( strstr( $lastpo->ponumber, $ponumberbefore ) ) {
                 $oldnumber = substr($lastpo->ponumber, 6 ,8);
                 $newnumber = $oldnumber+1;
                 $newponumber =$ponumberbefore.sprintf("%03d",$newnumber);
             }else{
                 $newponumber =$ponumberbefore."001";
         
             }
         
         
         }else{
         
             $newponumber =$ponumberbefore."001";
         }
            
         


         $adddata = new PurchasePo;
         $adddata->ponumber = $newponumber;
         $adddata->supplier_id = $supplier_id;
         $adddata->supplier_code = $supplierdt->suppliers_code;
         $adddata->supplier_name = $supplierdt->name;
         $adddata->supplier_address =  $supplierdt->address;
         $adddata->supplier_phone = $supplierdt->phone_number;
         $adddata->supplier_credit = $supplierdt->credit;
         $adddata->po_items= $request->po_items;
         $adddata->po_total = $request->po_total;
         $adddata->po_discount = $request->po_discount;
         $adddata->po_afterdiscount = $request->po_afterdiscount;
         $adddata->po_vat = $request->po_vat;
         $adddata->po_grand_total = $request->po_grand_total;
         $adddata->po_date= NOW();
         $adddata->created_at = NOW();
         $adddata->user_id = Auth::id();
         $adddata->save();
     




if(!empty($adddata->id)){
return $adddata->id;
}
            
        }else{
           
            
            return $request;
        }

 



    }

    public function storeitems(Request $request)
    {
if(!empty($request->purchaseid)){

    $adddataitem = new PurchasePoItems;
    $adddataitem->created_at=NOW();
    $adddataitem->item_po_id=$request->purchaseid;
    $adddataitem->poitems_productscode=$request->code;
    $adddataitem->poitems_productsname=$request->name;
    $adddataitem->poitems_qty=$request->qty;
    $adddataitem->poitems_unit=$request->unit_name;
     
    $adddataitem->poitems_price=$request->price;
    $adddataitem->poitems_amount=$request->price;
    $adddataitem->save();


    $willupdate = Willorder::find($request->willid);
    $willupdate->willor_order=$willupdate->willor_order-$request->qty;
    $willupdate->save();
    

}
        
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


    public function clearsessionpo(Request $request)
    {
        $blank = '';
        Session::put('allcheckjson',$blank );
        Session::put('checklistarrdt',$blank );
        Session::put('poitem',$blank );
        Session::put('newponumber',$blank );
        Session::put('checklistarrdt',$blank );
        Session::put('podiscount',$blank );

        $request->session()->forget('allcheckjson');
        $request->session()->forget('checklistarrdt');
        $request->session()->forget('poitem');
        $request->session()->forget('newponumber');
        $request->session()->forget('checklistarrdt');
        $request->session()->forget('podiscount');
    }





    
    public function purchaselistdata(Request $request)
    {


      if($_GET['csrf']==csrf_token()) {
         $allcheckarr=[];
        $purchaselist=PurchasePo::select('*')->orderBy('id','desc')->get();
  return Datatables::of($purchaselist)
   ->addColumn('supplierdt', function ($purchaselist) {
return $purchaselist->supplier_name; })
->addColumn('view', function ($purchaselist) {
    return "<a href='".url('purchase/view')."/".$purchaselist->id."'>view</a>"; })
->escapeColumns([]) /// ทำให้แสดง html ในตาราง
->make();
      }
    }
}
