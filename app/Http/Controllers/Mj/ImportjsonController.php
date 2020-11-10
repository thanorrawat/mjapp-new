<?php
namespace App\Http\Controllers\Mj;
use App\Product;
use App\Category;
use App\Unit;
use App\Models\Selling;
use App\Models\Stock;
use App\Models\Selling3days;
use App\Models\Willorder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImportjsonController extends Controller
{
    public function selling(Request $request)
    {
        if(!empty($request->json)){
            $filejson = "importdata/jsondata/".$request->json;
          
          $handle = fopen($filejson, "rb");
          $result = stream_get_contents($handle);
          fclose($handle);
     $data = json_decode($result, true);
   



if(!empty($request->updateselling)){
//updateข้อมูลการขาย
$updateselling = $request->updateselling;

switch ($updateselling) {
    case 1:
    $sellingyear = '2019';
    $sellingmonth = '09';
      break;
      case 2:
        $sellingyear = '2019';
        $sellingmonth = '10';
          break;
          case 3:
            $sellingyear = '2019';
            $sellingmonth = '11';
            case 4:
                $sellingyear = '2019';
                $sellingmonth = '12';
                  break;
case 5:
$sellingyear = '2020';
$sellingmonth = '01';
break;
case 6:
    $sellingyear = '2020';
    $sellingmonth = '02';
    break;
    case 7:
        $sellingyear = '2020';
        $sellingmonth = '03';
        break;
        case 8:
            $sellingyear = '2020';
            $sellingmonth = '04';
            break;
            case 9:
                $sellingyear = '2020';
                $sellingmonth = '05';
                break;
                case 10:
                    $sellingyear = '2020';
                    $sellingmonth = '06';
                    break;
                    case 11:
                        $sellingyear = '2020';
                        $sellingmonth = '07';
                        break;
                        case 12:
                            $sellingyear = '2020';
                            $sellingmonth = '08';
                            break;
    default:
    case 12:
        $sellingyear = '2020';
        $sellingmonth = '08';
        break;
  }

 echo  $sellingyear ;
  echo $sellingmonth ;
  $sellvalarr=4+$updateselling;
  foreach ( $data  as $dt)
  {
    
      if(!empty($dt[2])&&$dt[0]!="รหัสสินค้า"){//ถ้ามีรหัสสินค้า เพิ่มหรือupdate สินค้า

    echo $dt[1];
    echo "/";

    echo $dt[$sellvalarr];
    echo "<br>";

    

    $Sellingaddorupdate = Selling::updateOrCreate(
        ['seliing_year' => $sellingyear,'seliing_month' => $sellingmonth,'product_code'=>$dt[1]],
        ['selling_qty' => $dt[$sellvalarr]]
    );
 

      }

  }
  if($updateselling<12){
    echo '<script type="text/javascript">

    window.location.replace("?json='.$request->json.'&updateselling='.($updateselling+1).'");
    
    </script>';
  }


}else{


    $categoryname = '';
    $categoryid = '';
    $categoryaddcheck=0;
    foreach ( $data  as $dt)
    {

        //updateข้อมูลสินค้า
        if (strpos($dt[0], 'หมวดสินค้า') !== false) {
            $catnamearr =explode(" : ", $dt[0]);
            $s=explode("(",$catnamearr[1]);
            $categoryname = trim($s[0]);
            $categoryaddcheck=0;
        }
         if(!empty($dt[2])&&$dt[0]!="รหัสสินค้า"){
             $categoryaddcheck=$categoryaddcheck+1;
            $pcat=explode("-",$dt[1]);
         if($pcat[0]==="0"){
            $categorycode=$pcat[1];
         }else{
            $categorycode=$pcat[0];
         }
    echo $dt[1];
    echo "/";
    echo  $categoryname ;
    echo "/";
    echo  $categorycode ;
    echo "/";
    echo   $dt[2];
    echo "/";
    echo   $categoryaddcheck;
   
         }
         if ($categoryaddcheck==1 && !empty($categorycode)) {  
             //ค้นหา id หมวดหรือสร้างใหม่
             $Categoryfirst = Category::firstOrCreate(
                ['code' => $categorycode],
                ['name' => $categoryname,'is_active'=>1]
            );
            $categoryid = $Categoryfirst->id;
echo 'addcat';
        }



         if(!empty($dt[2])&&$dt[0]!="รหัสสินค้า"){//ถ้ามีรหัสสินค้า เพิ่มหรือupdate สินค้า

     //ค้นหา id unit
     $unitfirst = Unit::firstOrCreate(
        ['unit_name' => $dt[3]],
        ['is_active'=>1]
    );
    $unitid = $unitfirst->id;

    $Productaddorupdate = Product::updateOrCreate(
        ['code' => $dt[4]],
        ['name' => $dt[2],'category_code'=> $categorycode  ,'unit_name' => $dt[3],'category_id'=>$categoryid ,'unit_id'=>$unitid]
    );
    echo 'addproduct';

}
echo "<br>";   


echo '<script type="text/javascript">

window.location.replace("?json='.$request->json.'&updateselling=1");

</script>';

     }
    }





    //  return response()->json([
    //     'data' => $data
    
    //     ]);
  
           }
 

    }



    public function stock(Request $request)
    {
        if(!empty($request->json)){
            $filejson = "importdata/jsondata/".$request->json;
          
          $handle = fopen($filejson, "rb");
          $result = stream_get_contents($handle);
          fclose($handle);
     $data = json_decode($result, true);
     foreach ( $data  as $dt)
     {
         if(empty($dt[0]) && !empty($dt[1])){
            echo $dt[1];
            echo "/";
            echo $dt[2];
            echo "/";
            echo $dt[3];
            echo "/";
            echo $dt[4];
            echo "/";
            echo $dt[5];
            echo "<br>";
if(!empty($dt[3])){
$stockqty = $dt[3];
}else{
$stockqty = 0;
}

if(!empty($dt[4])){
    $stockwrc = $dt[4];
    }else{
        $stockwrc = 0;
    }

    if(!empty($dt[5])){
        $stockwdl = $dt[5];
        }else{
            $stockwdl = 0;
        }
if(!empty($dt[2])){
            $importstock = Stock::updateOrCreate(
                ['stock_productcode' => $dt[2]],
                ['stock_qty' => $stockqty,'stock_w_recieve' => $stockwrc,'stock_w_delivery' => $stockwdl]
            );

        }
         }

     }
    //  return response()->json([
    //       'data' => $data
        
    //       ]);

        }   
    
    }


    public function selling3(Request $request)
    {
        if(!empty($request->json)){
            $filejson = "importdata/jsondata/".$request->json;
          
          $handle = fopen($filejson, "rb");
          $result = stream_get_contents($handle);
          fclose($handle);
     $data = json_decode($result, true);
     if(count($data)>0){
        Selling3days::truncate();
     $num=1;
     foreach ( $data  as $dt)
     {
         if( (!empty($dt[3]) || !empty($dt[4])) && ($dt[4]!='หน่วยนับ')){
            echo $num;
            echo "/";
            echo $dt[1];
        
            echo "/";
            echo $dt[3];
        
            echo "<br>";

if(!empty($dt[1])){
  
    $selling3dayadd = new Selling3days;
    $selling3dayadd->sell3_productcode = $dt[1];
    $selling3dayadd->sell3_qty = $dt[3];
    $selling3dayadd->save();

        }
        $num++;
         }

     }
        }

        }   
    
    }


    public function deliverydays(Request $request)
    {
        if(!empty($request->json)){
            $filejson = "importdata/jsondata/".$request->json;
          
          $handle = fopen($filejson, "rb");
          $result = stream_get_contents($handle);
          fclose($handle);
     $data = json_decode($result, true);
     if(count($data)>0){
     
     $num=1;
     foreach ( $data  as $dt)
     {
         if( !empty($dt[19])  && $dt[19]!='DELIVERY' && $dt[19]!='DAYS'){
            echo $num; 
            echo "/";
            echo $dt[0]; 
            echo "/";
            echo $dt[1]; 
            echo "/";
            echo $dt[2];  
            echo "/";
            echo $dt[3]; 
            echo "/";
            echo $dt[19];
        
            echo "/";
            echo $dt[20];
        
            echo "<br>";
if(!empty($dt[20])){
$safety_days=$dt[20];
}else{
$safety_days=0;

}

$productupdate = Product::where('code',$dt[1])->first();
if(!empty($productupdate->id)){
    $productupdate->delivery_days = $dt[19];
    $productupdate->safety_days = $safety_days;
    $productupdate->save();

}

        $num++;
         }

     }
        }

        }   
    
    }


    public function willorder(Request $request)
    {
        if(!empty($request->json)){
            $filejson = "importdata/jsondata/".$request->json;
          
          $handle = fopen($filejson, "rb");
          $result = stream_get_contents($handle);
          fclose($handle);
     $data = json_decode($result, true);
     if(count($data)>0){
     
     $num=1;

     foreach ( $data  as $dt)
     {
       if(!empty($dt[1]) && $dt[0]!="NO"){
       for($i=0;$i<count($dt);$i++){
        echo $dt[$i];
        echo "/";
       }
       echo "<br>";

       $importwilorder = Willorder::updateOrCreate(
        ['willor_productcode' => $dt[1],'start_yearmonth' => '2019-09','start_yearmonth' => '2020-08'],
        ['willor_productname' => $dt[2],'willor_unit' => $dt[3],
        'willor_qtym01' => $dt[4],
        'willor_qtym02' => $dt[5],
        'willor_qtym03' => $dt[6],
        'willor_qtym04' => $dt[7],
        'willor_qtym05' => $dt[8],
        'willor_qtym06' => $dt[9],
        'willor_qtym07' => $dt[10],
        'willor_qtym08' => $dt[11],
        'willor_qtym09' => $dt[12],
        'willor_qtym10' => $dt[13],
        'willor_qtym11' => $dt[14],
        'willor_qtym12' => $dt[15],
        'willor_qtytotal' => $dt[16],
        'willor_average_month' => $dt[17],
        'willor_average_day' => $dt[18],
        'willor_delivery_day' => $dt[19],
        'willor_safety_day' => $dt[20],
        'willor_min' => $dt[21],
        'willor_max2' => $dt[22],
        'willor_overmin' => $dt[23],
        'willor_stock' => $dt[24],
        'willor_po' => $dt[25],
        'willor_so' => $dt[26],
        'willor_diff' => $dt[27],
        'willor_minorder' => $dt[28],
        'willor_3daysales' => $dt[29],
        'willor_order' => $dt[30]    									
        
        ]
    );

      }
     }
        }

        }   
    
    }
}
