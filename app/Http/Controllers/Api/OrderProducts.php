<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use DB;
use App\Customer;
use Session;
use Response;
use App\Models\MjStoreProductsTracking;
use App\Models\MjOrderDetails;
use App\Models\MjOrderProducts;
use App\Models\SaleHistory;
use App\Category;

use Auth;
class OrderProducts extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::limit(10)->get();
        return response()->json($products);
    }

    public function search(Request $request)
    {


       
        $customercode =  $request->customer;


        $salehistory = SaleHistory::where('customer_code',$customercode)
        ->groupBy('productcode_code')
        ->selectRaw('productcode_code,SUM(qty_sale) as sumsale')
        ->orderBy('sumsale','desc')
        ->get();
    
        $historylist_code=[];
        $historylist_sumsale=[];
    
        foreach ($salehistory as $salehist) {
            $pdcode = $historylist_code[]= TRIM($salehist->productcode_code);
            $historylist_sumsale[$pdcode]= TRIM($salehist->sumsale);
        }
        $historylist_codeconvert = implode("','",$historylist_code);

$limitnumber=10;
        if(!empty($request->page)){
$offset = ($request->page-1)*$limitnumber;
        }else{
            $offset =0;          
        }

        $search=  $request->searchtext;
        if(!empty($search)){

            $searcharr= explode(" ", TRIM($search));
            $searchhilight[] = $searcharr[0];
            $wheresearch = "(( name LIKE '%".trim($searcharr[0])."%' ";
            $wherecode = "code LIKE '%".trim($searcharr[0])."%' ";
            $wheredt= "product_details LIKE '%".trim($searcharr[0])."%' ";

            if(count($searcharr)>1){

                for($i=1;$i<count($searcharr);$i++){
                    if(!empty($searcharr[$i])){
                        $searchhilight[] = $searcharr[$i];
                        $wheresearch .= "AND name LIKE '%".trim($searcharr[$i])."%' ";
            $wheredt.= "AND product_details LIKE '%".trim($searcharr[$i])."%' ";


                    }

                }

            }
            $wheresearch .= ") OR ($wherecode) OR ($wheredt))";
            if(!empty($request->relate)){
                $wheresearch .= " AND qty > 0 AND id <> '".$request->relate."'";
            }

if($request->showsearchtype==1){
  
    
   
    $products = Product::whereRaw($wheresearch)
    ->offset($offset)
    ->limit($limitnumber)
    ->whereIn('code', $historylist_code)
   ->orderByRaw("FIELD(code,'".$historylist_codeconvert."')")
    ->get();
    

//print_r($historylist_codeconvert);

$productsall = Product::whereRaw($wheresearch)
->whereIn('code', $historylist_code)
->count();    
// $categoryall =[];
// $categoryall = DB::table('products')
// ->groupBy('category_code')
// ->select('category_code')
// ->get();  

        }elseif($request->showsearchtype==2){


            $salehistory=[];
 $products = Product::whereRaw($wheresearch)
->offset($offset)
->limit($limitnumber)
->get();

$productsall = Product::whereRaw($wheresearch)
->count();    
// $categoryall =[];
// //->whereRaw($request->$wheresearch)
// $categoryall = DB::table('products')
// ->groupBy('category_code')
// ->select('category_code')
// ->get();  



        }

        }else{
            if($request->showsearchtype==1){


       


            $products = Product::limit($limitnumber)
            ->offset($offset)
            ->whereIn('code', $historylist_code)
   ->orderByRaw("FIELD(code,'".$historylist_codeconvert."')")

            ->get();

            



            $productsall = Product::whereIn('code', $historylist_code)->count();  
            $searchhilight[] = '';
            $categoryall = DB::table('products')
->groupBy('category_code')
->select('category_code')
->get();  


        }else if($request->showsearchtype==2){


            $salehistory=[];

            $products = Product::limit($limitnumber)
            ->offset($offset)
            ->get();

            $productsall = Product::count();  
            $searchhilight[] = '';

// $categoryall = DB::table('products')
// ->groupBy('category_code')
// ->select('category_code')
// ->get();  
       

        }
  




//return response()->json($categories);
    }
   
    // $categorcodearr=[];
    // foreach ($categoryall as $categoryrow) {
    //     $categorcodearr[] = $categoryrow->category_code;
    //   }
    //   $categories = DB::table('categories')->whereIn('code',$categorcodearr)->get();
      if($request->showsearchtype==1){
  $productsCount = count($salehistory);
      }else{
        $productsCount = count($products);       
      }
  $allpage =  ceil($productsall/$limitnumber) ;



  return response()->json(['salehistory'=>$salehistory,'products' => $products, 'search' => $search,'productscount'=>$productsCount,'productsall'=>$productsall,'searchhilight'=>$searchhilight,'allpage'=>$allpage,'offset'=>$offset,'historylist_sumsale'=>$historylist_sumsale,'historylist_code'=>$historylist_code]); //'grouped'=>$categories,'categoryselect'=>$categorcodearr,
    }




    

    public function customerlist(Request $request)
    {
     
        $customerlist= Customer::select(DB::raw('id,name AS text '))
        ->where('is_active','1')
        ->orderBy('name','ASC')
        ->get();

        return response()->json(['customerlist' => $customerlist]);
    
    }

    public function orderdt($id)
    {
        $orderdetrails = MjOrderDetails::where('id',$id)
        ->first();
        if($orderdetrails->doctype==1){
            $doctypename = "Order";
        }
        if($orderdetrails->doctype==2){
            $doctypename = "ใบจอง";
        }

        $customer = Customer::where('id',$orderdetrails->customer_id)
        ->first();

        return response()->json(
            [
                'orderdt' => $orderdetrails,
                'doctypename'=>$doctypename,
                'customer'=>$customer
                ]
        );
    }

    
    
    public function checkstock (Request $request,$id)
    {
        $stocklist=[];
   
        $showstockbyproduct = MjStoreProductsTracking::where('product_code',$id)
        ->selectRaw('SUM(stocktype_1) as sumstock1,SUM(stocktype_2) as sumstock2,SUM(stocktype_3) as sumstock3,SUM(stocktype_4) as sumstock4')
        ->groupBy('product_code')
        ->first();

        $stocklist['sumstock1'] =  $showstockbyproduct->sumstock1;
        $stocklist['sumstock2'] =  $showstockbyproduct->sumstock2;
        $stocklist['sumstock3'] =  $showstockbyproduct->sumstock3;
        $stocklist['sumstock4'] =  $showstockbyproduct->sumstock4;



        return response()->json(
            [
                'stock_productcode' => $id,
                'stocklist' => $stocklist,
  
                ]
        );
    }
    


    public function categoryname()
    {
        $categorynamelist =  Category::get();
        $categorynamelistnew=[];
        foreach($categorynamelist as $categoryname ){
           $thiscatcode =  $categoryname['code'];
           $categorynamelistnew[$thiscatcode] =  $categoryname['name'];
        }

        return response()->json($categorynamelistnew);
    }


    public function addproducttoorder(Request $request)
    {


        if(!empty($request->productid) && !empty($request->orderid) && !empty($request->addqty)  && !empty($request->userfullname) && !empty($request->userid) ){


            //check สินค้าซ้ำ

            $chekpdinorder = MjOrderProducts::where('product_id',$request->productid)
            ->where('order_id', $request->orderid)->count();
if($chekpdinorder>0){
/////ซำ้
$alertstatus = (object)[]; 
$alertstatus->icon ="error";
$alertstatus->title ="สินค้าซ้ำ";
$alertstatus->text ="สินค้ารายการนี้ถูกเลือกไว้แล้ว";
}else{



        //addproduct    
        $MjOrderProducts= new MjOrderProducts;
        $MjOrderProducts->order_id= $request->orderid;
        $MjOrderProducts->product_id=$request->productid;
        $MjOrderProducts->productscode= $request->productscode;
        $MjOrderProducts->qty= $request->addqty;
        $MjOrderProducts->stocknow= $request->stocknow;
        $MjOrderProducts->userid= $request->userid;
        $MjOrderProducts->save();


$orderdetails = $request->orderdetails;
$docfullname ="";
if($request->doctype==1){
    $docfullname = $orderdetails['ordernumberfull'];
    $timelinestatus =  '111' ;//เพิ่มสินค้า
}elseif($request->doctype==2){
    $docfullname = $orderdetails['bookingnumber'];
    $timelinestatus =  '211' ;//เพิ่มสินค้า

}
        //addtracking
       

        trackingadd($request->productid,$request->productscode,$request->addqty,$request->doctype,$request->orderid,$docfullname,$timelinestatus,$request->userid,$request->userfullname);
        //update จำนวน
        updateproductstockforsale($request->productscode,$request->productid);
        $alertstatus = (object)[]; 
        $alertstatus->icon ="success";
        $alertstatus->title ="Completed";
        $alertstatus->text ="เพิ่มสินค้าเรียบร้อย";


}
        }

        //select product ใน order
$productlistinorder = MjOrderProducts::where('order_id',$request->orderid)
->leftjoin('products','mj_order_products.productscode','products.code' )
->selectRaw('productscode,image,name,mj_order_products.qty AS orderqty,remarkrow,products.id as pdid,category_code,product_details,mj_order_products.id as pdorderid,products.qty as stocknow')
->orderBy('pdorderid','asc')
->get();
        //response สถานะ
      $orderid=  $request->orderid;
      $productid=  $request->productid;
        return response()->json(    [
            'alertstatus' => $alertstatus,
            'productlistinorder' => $productlistinorder,
            

            ]);
    }

    public function showproductinorder($id)
    {

    $productlistinorder = MjOrderProducts::where('order_id',$id)
->leftjoin('products','mj_order_products.productscode','products.code' )
->selectRaw('productscode,image,name,mj_order_products.qty AS orderqty,remarkrow,products.id as pdid,category_code,product_details,mj_order_products.id as pdorderid,products.qty as stocknow')
->orderBy('pdorderid','asc')
->get();

return response()->json($productlistinorder);
    }


    public function removeproducttoorder(Request $request)
    {
if(!empty($request->orderproductid)){


      $deleteproductid =   DB::table('mj_order_products')->where('id', '=',$request->orderproductid)->delete();


      
      if($deleteproductid){
   

        $MjStoreProductsTracking='';
$orderdetails = $request->orderdetails;
$docfullname ="";
if($request->doctype==1){
    $docfullname = $orderdetails['ordernumberfull'];
    $timelinestatus =  '112' ;//ลบสินค้า
}elseif($request->doctype==2){
    $docfullname = $orderdetails['bookingnumber'];
    $timelinestatus =  '212' ;//ลบสินค้า

}

        trackingadd($request->productid,$request->productscode,$request->addqty,$request->doctype,$request->orderid,$docfullname,$timelinestatus,$request->userid,$request->userfullname);
        //update จำนวน
        updateproductstockforsale($request->productscode,$request->productid);


        $alertstatus = (object)[]; 
        $alertstatus->icon ="success";
        $alertstatus->title ="Completed";
        $alertstatus->text ="ลบสินค้าเรียบร้อย";
      }else{
        $alertstatus = (object)[]; 
    $alertstatus->icon ="error";
    $alertstatus->title ="ไม่สำเร็จ";
    $alertstatus->text ="เกิดข้อผิดพลาดกรุณาลองอีกครั้งหรือติดต่อผู้ดูแลระบบ ";      
      }

}else{
    $alertstatus = (object)[]; 
    $alertstatus->icon ="error";
    $alertstatus->title ="ไม่สำเร็จ";
    $alertstatus->text ="เกิดข้อผิดพลาดกรุณาลองอีกครั้งหรือติดต่อผู้ดูแลระบบ ";
}

$productlistinorder = MjOrderProducts::where('order_id',$request->orderid)
->leftjoin('products','mj_order_products.productscode','products.code' )
->selectRaw('productscode,image,name,mj_order_products.qty AS orderqty,remarkrow,products.id as pdid,category_code,product_details,mj_order_products.id as pdorderid,products.qty as stocknow')
->orderBy('pdorderid','asc')
->get();

return response()->json(    [
    'alertstatus' => $alertstatus,
    'productlistinorder' => $productlistinorder,
'request'=>$request->orderproductid

    ]);
    }   
    
    public function editqtyorder(Request $request)
    {


        if(!empty($request->orderproductid) && !empty($request->productid) && !empty($request->orderid) && !empty($request->addqty)  && !empty($request->diffqty) && !empty($request->userfullname) && !empty($request->userid) ){



                    //edit    
        $MjOrderProducts= MjOrderProducts::where('id',$request->orderproductid)
        ->first()
        ;
$MjOrderProducts->qty= $request->addqty;
        $MjOrderProducts->stocknow= $request->stocknow;
        $MjOrderProducts->userid= $request->userid;
        $MjOrderProducts->save();


$orderdetails = $request->orderdetails;
$docfullname ="";
            if($request->doctype==1){
                $docfullname = $orderdetails['ordernumberfull'];
                $timelinestatus =  '113' ;//แก้ไขจำนวนสินค้า
            }elseif($request->doctype==2){
                $docfullname = $orderdetails['bookingnumber'];
                $timelinestatus =  '213' ;//แก้ไขจำนวนสินค้า
            
            }
                    //addtracking
                    
                    trackingadd($request->productid,$request->productscode,$request->diffqty,$request->doctype,$request->orderid,$docfullname,$timelinestatus,$request->userid,$request->userfullname);
                    //update จำนวน
                    updateproductstockforsale($request->productscode,$request->productid);
                    $alertstatus = (object)[]; 
                    $alertstatus->icon ="success";
                    $alertstatus->title ="Completed";
                    $alertstatus->text ="แกไขสินค้าเรียบร้อย";



        }else{

            $alertstatus = (object)[]; 
            $alertstatus->icon ="error";
            $alertstatus->title ="ไม่สำเร็จ";
            $alertstatus->text ="เกิดข้อผิดพลาดกรุณาลองอีกครั้งหรือติดต่อผู้ดูแลระบบ ";  

        }
        $productlistinorder = MjOrderProducts::where('order_id',$request->orderid)
        ->leftjoin('products','mj_order_products.productscode','products.code' )
        ->selectRaw('productscode,image,name,mj_order_products.qty AS orderqty,remarkrow,products.id as pdid,category_code,product_details,mj_order_products.id as pdorderid,products.qty as stocknow')
        ->orderBy('pdorderid','asc')
        ->get();
        
        return response()->json(    [
            'alertstatus' => $alertstatus,
            'productlistinorder' => $productlistinorder,
        'request'=>$request->orderproductid
        
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
