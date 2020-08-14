<?php date_default_timezone_set("Asia/Bangkok");
use App\Models\MjOrderDetails;
use App\Models\MjOrderProducts;
use App\Models\Timeline;
use App\User;
use App\Product;
use App\Models\MjStoreProductsTracking;

function formatDateThai($strDate)
{
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strHour= date("H",strtotime($strDate));
    $strMinute= date("i",strtotime($strDate));
    $strSeconds= date("s",strtotime($strDate));
    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear $strHour:$strMinute";
}

function lineNotifysend($group,$sMessage,$imageFile)
{


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set("Asia/Bangkok");
if($group ==1){ //Admin
    $sToken = "HFt3CMh1tmnQ4BKxXpmTXZMWaIJXUk0F6KXlzKyaI2C";
}elseif($group ==2){ //Manager
    $sToken = "8vQBtdwD8Q2pyjYHK8OpndeejuNAoGcgEdKzdaKcAjk";
}else{
    $sToken = "HFt3CMh1tmnQ4BKxXpmTXZMWaIJXUk0F6KXlzKyaI2C";
}


$chOne = curl_init();
curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt( $chOne, CURLOPT_POST, 1);
// curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage."&stickerPackageId=".$stickerPkg."&stickerId=".$stickerId."&imageThumbnail=".$imageFile."&imageFullsize=".$imageFile);
if(!empty($imageFile)){
    curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage."&imageThumbnail=".$imageFile."&imageFullsize=".$imageFile);
}else{
    curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage);
}


$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec( $chOne );

//Result error
if(curl_error($chOne))
{
return 'error:' . curl_error($chOne);
}
else {
    $result_ = json_decode($result, true);
return "status : ".$result_['status']; echo "message : ". $result_['message'];
}
curl_close( $chOne );


}

if(!function_exists('hello')) {
    function hello() {
      return "Hello Helper";
    }
  }


  function createtimeline($orderid,$doc_type,$doc_id,$message,$timelinestatus)
  {

  ////----------บันทึกข้อมูลการทำ Order

//สร้างโฟลเดอร์เก็บ PDF
$folder ='documents/orders/'.$orderid;
$path = public_path().'/'.$folder;
File::makeDirectory($path, $mode = 0777, true, true);

//สร้าง PDF

$orderdt = MjOrderDetails::where('id',$orderid)->first();
$MjOrderProducts= MjOrderProducts::where('order_id',$orderid)
->leftjoin('products', 'mj_order_products.product_id', '=', 'products.id')
->select(['*','mj_order_products.qty AS orderqty'])
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


$pdffilename = date("YmdHis").$orderdt->token.".pdf";
$pdfFilePath = $path."/".$pdffilename;

    // $pdf = PDF::loadView('App_sale.order_view', $data, [], [
    //     'title' => $orderdt->ordernumberfull
    //   ])->save($pdfFilePath);
if($timelinestatus!=1 &&  $timelinestatus!=2){ // เริ่มต้นสร้าง ORDER


if(!empty($orderdt->bookingnumber)){

    $pdf = PDF::loadView('App_sale.booking_view', $data, [], [
        'title' => $orderdt->bookingnumber,
        'custom_font_dir' => base_path('public/fonts/'), // don't forget the trailing slash!
        'custom_font_data' => [
            'sarabun' => [
                'R'  => 'thsarabunnew-webfont.ttf',    // regular font
                'B'  => 'thsarabunnew_bold-webfont.ttf',       // optional: bold font
                'I'  => 'thsarabunnew_italic-webfont.ttf',     // optional: italic font
                'BI' => 'thsarabunnew_bolditalic-webfont.ttf' // optional: bold-italic font
            ]],
        'default_font'=>'sarabun'
      ])->save($pdfFilePath);

}else{

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
      ])->save($pdfFilePath);

}

}
     


//สร้าง time line

$data = array();
$data['doc_type'] =$doc_type;
$data['doc_id'] =$doc_id;
$data['timelinedate'] = date('Y-m-d H:i:s');

///remark
$remark['message'] = $message;
$remark['pdf'] = $pdffilename;

$remarkinput = serialize($remark);
$data['remark'] = $remarkinput;
$timelineupdate = Timeline::updateOrCreate(['order_id' => $orderid,'status' => $timelinestatus],
  $data); 

  return $pdfFilePath;
    }



    function  trackingadd($pid,$productscode,$qtynew,$ref_typeid,$order_id,$ordernumberfull,$sendordertype,$userid,$userfullname){ //บันทึกการย้ายสินค้า

    //tracking
$MjStoreProductsTracking= new MjStoreProductsTracking;

$MjStoreProductsTracking->product_id=$pid;
$MjStoreProductsTracking->product_code=$productscode ;
$MjStoreProductsTracking->product_qty=$qtynew; //จำนวนใน Order
$MjStoreProductsTracking->ref_typeid = $ref_typeid; // ประเภท 2 = Order
$MjStoreProductsTracking->ref_id = $order_id ; //Orderid
$MjStoreProductsTracking->ref_no= $ordernumberfull; //Order number

$MjStoreProductsTracking->user= $userid; // ผู้ทำรายการ
$MjStoreProductsTracking->user_name= $userfullname; //ชื่อขณะทำรายการ

//อ้างอิงตามรหัส status

if($sendordertype==111){  // 1=ย้ายเข้าคลัง order
$MjStoreProductsTracking->stocktype_1= "-".$qtynew;  // Stock พร้อมขายลด
$MjStoreProductsTracking->stocktype_2= $qtynew; //Stock Order เพิ่ม
$MjStoreProductsTracking->comment ='Add Product To Order'; //ลบสินค้าออกจากรายการ Order
}  
elseif($sendordertype==211){  // 2=ย้ายเข้าคลังจอง
    $MjStoreProductsTracking->stocktype_1= "-".$qtynew;  // Stock พร้อมขายลด
    $MjStoreProductsTracking->stocktype_3= $qtynew; //Stock จอง เพิ่ม
    $MjStoreProductsTracking->comment ='Add Product To Booking'; //ลบสินค้าออกจากรายการ Order
    }
    elseif($sendordertype==112){  // 1=ย้ายออกคลัง order
        $MjStoreProductsTracking->stocktype_1= $qtynew;  // Stock พร้อมขายเพิ่ม
        $MjStoreProductsTracking->stocktype_2= "-".$qtynew; //Stock Order ลด
        $MjStoreProductsTracking->comment ='Remove Product From Order'; //ลบสินค้าออกจากรายการ Order
        }  
    elseif($sendordertype==212){  // 2=ย้ายออกคลังจอง
        $MjStoreProductsTracking->stocktype_1= $qtynew;  // Stock พร้อมขายเพิ่ม
        $MjStoreProductsTracking->stocktype_3= "-".$qtynew; //Stock จอง ลด
        $MjStoreProductsTracking->comment ='Remove Product from Booking'; //ลบสินค้าออกจากรายการ Order
        }

        elseif($sendordertype==113){  // 1=ย้ายออกคลัง order
            $stocksalechange = -($qtynew);
            $MjStoreProductsTracking->stocktype_1= $stocksalechange;  // Stock พร้อมขายเพิ่ม
            $MjStoreProductsTracking->stocktype_2= $qtynew; //เปลี่ยนแปลง Stock Order
            $MjStoreProductsTracking->comment ='Edit Qty Product From Order'; //ลบสินค้าออกจากรายการ Order
            }  
        elseif($sendordertype==213){  // 2=ย้ายออกคลังจอง
            $stocksalechange = -($qtynew);
            $MjStoreProductsTracking->stocktype_1= $stocksalechange;  // Stock พร้อมขายเพิ่ม
            $MjStoreProductsTracking->stocktype_3= $qtynew; //Stock จอง ลด
            $MjStoreProductsTracking->comment ='Edit Qty Product from Booking'; //ลบสินค้าออกจากรายการ Order
            }


$MjStoreProductsTracking->save();


// if($sendordertype==1 || $sendordertype==2){ // 1=ย้ายเข้าคลัง order ,2=ย้ายเข้าคลังจอง
// //ลดจำนวนสินค้าพร้อมขาย
// $Product = Product::find($pid);
// $Product->qty = $Product->qty - $qtynew;
// $Product->save();
// }

    }


    function updateproductstockforsale($product_code,$product_id){

        //รวมใน stock
        $showstockbyproduct = MjStoreProductsTracking::where('product_code',$product_code)
        ->selectRaw('SUM(stocktype_1) as sumstock1')
        ->groupBy('product_code')
        ->first();
$stocknow = $showstockbyproduct->sumstock1;
//update ใน products

$Product = Product::find($product_id);
$Product->qty = $stocknow;
$Product->save();


    }

?>