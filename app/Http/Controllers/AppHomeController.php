<?php

namespace App\Http\Controllers;

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
use DB;
use Auth;
use App\Models\MjOrderDetails;
use App\Models\MjOrderProducts;
use App\Product;
use App\Models\Selling;
use App\Models\Willorder;


use Yajra\Datatables\Datatables;
class AppHomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
       
        return view('home');
    }

    public function index()
    { 
$userid = Auth::user()->id;
$usertype = Auth::user()->role_id;
$usertypename = DB::table('roles')->where('id', $usertype)->first();
$countpd= Product::where('id', '<>', 0)
->count();
    if($usertype==4){ ///หน้า dashboard Sales

        $countorder = MjOrderDetails::where('createby_id', '=', $userid)
        ->where('bookingnumber', '=', 0)
        ->where('sonumber', '=', 0)
        ->count();
        $orderlist = MjOrderDetails::where('createby_id', '=', $userid)
        ->leftjoin('status_names','mj_order_details.order_status','status_names.st_id')
        ->orderBy('mj_order_details.id', 'desc')
        ->select(['*','mj_order_details.created_at AS ordecreate'])
        ->get();


        $countbooking = MjOrderDetails::where('bookingnumber', '<>', '0')
        ->where('sonumber', '=', 0)
       ->where('createby_id', '=', $userid)
        ->count();

        $countso= MjOrderDetails::where('sonumber', '<>', 0)
        ->count();

       

        $countproducts=DB::table('mj_order_products')
        ->leftjoin('mj_order_details','mj_order_products.order_id','mj_order_details.id')
        ->select(DB::raw('product_id,SUM(mj_order_products.qty) as pdqty,COUNT(product_id) as pdcount') )
        ->where('mj_order_details.sonumber', '=', 0)
       ->where('createby_id', '=', $userid)
        ->groupBy('product_id')
        ->orderByRaw('pdqty DESC')
        ->limit(10)
        ->get();

    //     $countpd =  MjOrderProducts::leftjoin('mj_order_details','mj_order_products.order_id','mj_order_details.id')
    //     ->where('mj_order_details.sonumber', '=', 0)
    //     ->groupBy('product_id')
    //    ->where('createby_id', '=', $userid)
    //     ->select(['product_id'])
    //     ->count();
        
        return view('App_dashboard.index-sales')
        ->with('usertypename', $usertypename->name)
        ->with('countorder', $countorder)
        ->with('orderlist', $orderlist)
        ->with('countbooking', $countbooking )
        ->with('countso', $countso )
        ->with('countproducts', $countproducts )
        ->with('countpd', $countpd  )
        ;
    }elseif($usertype==2 || $usertype==7  ){
            $countorder = MjOrderDetails::where('ordernumber', '<>', '0')
            ->where('sonumber', '=', 0)
            ->count();
    
            $countbooking = MjOrderDetails::where('bookingnumber', '<>', '0')
            ->where('sonumber', '=', 0)
            ->count();
    
            $countso= MjOrderDetails::where('sonumber', '<>', 0)
            ->count();
    
            $countproducts=DB::table('mj_order_products')
            ->leftjoin('mj_order_details','mj_order_products.order_id','mj_order_details.id')
            ->select(DB::raw('product_id,SUM(mj_order_products.qty) as pdqty,COUNT(product_id) as pdcount') )
            ->where('mj_order_details.sonumber', '=', 0)
            ->groupBy('product_id')
            ->orderByRaw('pdqty DESC')
            ->limit(10)
            ->get();
    
    
            $orderlist = MjOrderDetails::leftjoin('status_names','mj_order_details.order_status','status_names.st_id')
            ->orderBy('mj_order_details.id', 'desc')
            ->select(['*','mj_order_details.created_at AS ordecreate'])
            ->get();
    
            
                    return view('App_dashboard.index-manager')
            ->with('usertypename', $usertypename->name)
            ->with('countorder', $countorder)
            ->with('orderlist', $orderlist)
            ->with('countbooking', $countbooking )
            ->with('countso', $countso )
            ->with('countproducts', $countproducts )
            ->with('countpd', $countpd  );
    
        }elseif($usertype==6 ){ //admin
            $countorder = MjOrderDetails::where('ordernumber', '<>', '0')
            ->where('sonumber', '=', 0)
            ->count();
    
            $countbooking = MjOrderDetails::where('bookingnumber', '<>', '0')
            ->where('sonumber', '=', 0)
            ->count();
    
            $countso= MjOrderDetails::where('sonumber', '<>', 0)
            ->count();
    
            $countproducts=DB::table('mj_order_products')
            ->leftjoin('mj_order_details','mj_order_products.order_id','mj_order_details.id')
            ->select(DB::raw('product_id,SUM(mj_order_products.qty) as pdqty,COUNT(product_id) as pdcount') )
            ->where('mj_order_details.sonumber', '=', 0)
            ->groupBy('product_id')
            ->orderByRaw('pdqty DESC')
            ->limit(10)
            ->get();
    
    
            $orderlist = MjOrderDetails::leftjoin('status_names','mj_order_details.order_status','status_names.st_id')
            ->orderBy('mj_order_details.id', 'desc')
            ->select(['*','mj_order_details.created_at AS ordecreate'])
            ->get();
    
            
                    return view('App_dashboard.index-admin')
            ->with('usertypename', $usertypename->name)
            ->with('countorder', $countorder)
            ->with('orderlist', $orderlist)
            ->with('countbooking', $countbooking )
            ->with('countso', $countso )
            ->with('countproducts', $countproducts )
            ->with('countpd', $countpd  );
        }elseif($usertype==5 ){
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
            ->with('pagetille',  __('file.Purchase').' '.__('file.dashboard'))

            
            ;

        }elseif($usertype==9 ){

            return view('App_supplieruser.index');
    }else{

        $countorder = MjOrderDetails::where('ordernumber', '<>', '0')
        ->where('sonumber', '=', 0)
        ->count();

        $countbooking = MjOrderDetails::where('bookingnumber', '<>', '0')
        ->where('sonumber', '=', 0)
        ->count();

        $countso= MjOrderDetails::where('sonumber', '<>', 0)
        ->count();

        $countproducts=DB::table('mj_order_products')
        ->leftjoin('mj_order_details','mj_order_products.order_id','mj_order_details.id')
        ->select(DB::raw('product_id,SUM(mj_order_products.qty) as pdqty,COUNT(product_id) as pdcount') )
        ->where('mj_order_details.sonumber', '=', 0)
        ->groupBy('product_id')
        ->orderByRaw('pdqty DESC')
        ->limit(10)
        ->get();


        $orderlist = MjOrderDetails::leftjoin('status_names','mj_order_details.order_status','status_names.st_id')
        ->orderBy('mj_order_details.id', 'desc')
        ->select(['*','mj_order_details.created_at AS ordecreate'])
        ->get();

        
       // return view('App_dashboard.index')
       return view('App_dashboard.index-sales')
        ->with('usertypename', $usertypename->name)
        ->with('countorder', $countorder)
        ->with('orderlist', $orderlist)
        ->with('countbooking', $countbooking )
        ->with('countso', $countso )
        ->with('countproducts', $countproducts )
        ->with('countpd', $countpd  )

        ;
    
    }
    }


    public function orderData(Request $request)
    {
             
$userid = Auth::user()->id;
$usertype = Auth::user()->role_id;
$usertypename = DB::table('roles')->where('id', $usertype)->first();

      if($_GET['csrf']==csrf_token()) {


        if($usertype==4){        ///ถ้าเป็น Sale
            if($_GET['ordertype']=="order"){
            $orderlist = MjOrderDetails::leftjoin('status_names','mj_order_details.order_status','status_names.st_id')
             ->where('createby_id', '=', $userid)
                ->where('ordernumberfull', '<>', '0')
                ->orderBy('mj_order_details.id', 'desc')
            ->select(['*','mj_order_details.created_at AS ordecreate','mj_order_details.id AS orderid'])
            ->get();

            }elseif($_GET['ordertype']=="booking"){
                $orderlist = MjOrderDetails::leftjoin('status_names','mj_order_details.order_status','status_names.st_id')
                 ->where('createby_id', '=', $userid)
                    ->where('bookingnumber', '<>', '0')
                    ->orderBy('mj_order_details.id', 'desc')
                ->select(['*','mj_order_details.created_at AS ordecreate','mj_order_details.id AS orderid'])
                ->get();
    
                }
            
            
            else{
                $orderlist = MjOrderDetails::leftjoin('status_names','mj_order_details.order_status','status_names.st_id')
                ->where('createby_id', '=', $userid)
                   ->orderBy('mj_order_details.id', 'desc')
               ->select(['*','mj_order_details.created_at AS ordecreate','mj_order_details.id AS orderid'])
               ->get();    
            }



        }else{

            if($_GET['ordertype']=="order"){


                if(!empty($_GET['approved']) && $_GET['approved']=="1"){
// $statuspprovecondition ='=';
// $statuspprove ='11';

$whereraw = "order_status = 11";
}else if(!empty($_GET['approved']) && $_GET['approved']=="2"){
    // $statuspprovecondition ='=';
    //  $statuspprove ='12';

     $whereraw = "order_status = 12 OR  order_status = 13";
    }else if(!empty($_GET['approved'])){

        $whereraw = "order_status = '".$_GET['approved']."'";

                        }else{
// $statuspprovecondition ='>';
//  $statuspprove ='0';
$whereraw = "order_status >0";
                }

 $orderlist = MjOrderDetails::leftjoin('status_names','mj_order_details.order_status','status_names.st_id')
->where('ordernumberfull', '<>', '0') 
->whereRaw($whereraw)

->orderBy('mj_order_details.id', 'desc')
->select(['*','mj_order_details.created_at AS ordecreate','mj_order_details.id AS orderid'])
->get();

}elseif($_GET['ordertype']=="booking"){



    if(!empty($_GET['approved']) && $_GET['approved']=="1"){
        // $statuspprovecondition ='=';
        // $statuspprove ='21';
        $whereraw = "order_status = 21";
        }else if(!empty($_GET['approved']) && $_GET['approved']=="2"){
            // $statuspprovecondition ='=';
            //  $statuspprove ='22';
     $whereraw = "order_status = 22 OR  order_status = 23";
    }else if(!empty($_GET['approved'])){

        $whereraw = "order_status = '".$_GET['approved']."'";

                        }else{
        // $statuspprovecondition ='>';
        //  $statuspprove ='0';
$whereraw = "order_status >0";

                        }
        


    $orderlist = MjOrderDetails::leftjoin('status_names','mj_order_details.order_status','status_names.st_id')
        ->where('bookingnumber', '<>', '0')
        ->whereRaw($whereraw)

        ->orderBy('mj_order_details.id', 'desc')
    ->select(['*','mj_order_details.created_at AS ordecreate','mj_order_details.id AS orderid'])
    ->get();

    }else{

                $orderlist = MjOrderDetails::leftjoin('status_names','mj_order_details.order_status','status_names.st_id')
                ->orderBy('mj_order_details.id', 'desc')
                ->select(['*','mj_order_details.created_at AS ordecreate','mj_order_details.id AS orderid'])
                ->get();
                

            }
            
       
           
        }
         return Datatables::of($orderlist)

        ->addColumn('action', function ($orderlist) {
                       
if(!empty($orderlist->token )){

    if(!empty($orderlist->bookingnumber)){
        $actioncol='
        <button  data-toggle="modal" data-target="#product-details"  data-ordernumber="'.$orderlist->bookingnumber.'"   data-token="'.$orderlist->token.'" class="btn btn-outline-info btn-sm orderpopup"><i class="fa fa-file-text" aria-hidden="true"></i> '.__('file.Booking').'</button>';
         
    }else{
        $actioncol='
        <button  data-toggle="modal" data-target="#product-details"  data-ordernumber="'.$orderlist->ordernumberfull.'"   data-token="'.$orderlist->token.'" class="btn btn-outline-info btn-sm orderpopup"><i class="fa fa-file-text" aria-hidden="true"></i> Order</button>';
         
    }
          


}else{
                $actioncol='';   
            }

           return  $actioncol;

        })

        
 ->addColumn('action2', function ($orderlist) {
    if(!empty($orderlist->bookingnumber)){
     return '<a class="btn btn-warning btn-sm" href="'.url('order/'.$orderlist->bookingnumber.'/edit').'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>';

    }  else{
     return '<a class="btn btn-warning btn-sm"  href="'.url('order/'.$orderlist->ordernumberfull.'/edit').'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>';

    }      


})

        ->addColumn('action3', function ($orderlist) {
               if(!empty($orderlist->bookingnumber)){
                $actioncol='<button  data-toggle="modal" data-target="#product-details"  data-ordernumber="'.$orderlist->bookingnumber.'"   data-token="'.$orderlist->token.'" class="btn btn-outline-info btn-sm orderpopup"><i class="fa fa-file-text" aria-hidden="true"></i> '.__('file.Booking').'</button> ';
        $actioncol.='<a class="btn btn-warning btn-sm" href="'.url('order/'.$orderlist->bookingnumber.'/edit').'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>';
return $actioncol;
               }  else{
                $actioncol='
                <button  data-toggle="modal" data-target="#product-details"  data-ordernumber="'.$orderlist->ordernumberfull.'"   data-token="'.$orderlist->token.'" class="btn btn-outline-info btn-sm orderpopup"><i class="fa fa-file-text" aria-hidden="true"></i> Order</button> ';   
                $actioncol.='<a class="btn btn-warning btn-sm"  href="'.url('order/'.$orderlist->ordernumberfull.'/edit').'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>';
                return $actioncol;

               }      


 })




        ->editColumn('statusname', function ($orderlist) {

            return '<span style="background-color:'.$orderlist->color.'" class="badge statusbutton ">'.$orderlist->statusname.'</span>';
    
        })

        
        ->editColumn('ordernumberfull', function ($orderlist) {

            return '<a target="blank" href="'.url('order/'.$orderlist->ordernumberfull.'/edit').'">'.$orderlist->ordernumberfull.' <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
    
        })
     
        ->escapeColumns([]) /// ทำให้แสดง html ในตาราง
        ->make();
      }
    }



}
