<?php

namespace App\Http\Controllers;
use App\Product;
use App\Models\MjStoreProductsTracking;
use Illuminate\Http\Request;

class MjStoreProductsTrackingController extends Controller
{
  

    public function insertdatsample()
    {

        $products = Product::all();

        foreach ($products as $product) {
        
       echo  $id = $product->id;
       echo " : ";
    echo $qty = rand(1,100);
       echo "<br> ";

    //adqty product
            $lims_product_data = Product::find($id);
            $lims_product_data->qty = $qty;
            $lims_product_data->save();
        
           ///addsampletracking

        //    $ProductsTrackingsample= MjStoreProductsTracking::where('product_id', $id)->first();
        //    $ProductsTrackingsample->save();
        //    $ProductsTrackingsample->save();


        $ProductsTrackingsample= MjStoreProductsTracking::updateOrCreate([
            //Add unique field combo to match here
            //For example, perhaps you only want one entry per user:
            'product_id'   => $id,
        ],[
            'product_code'     => $product->code,
            'product_qty' => $qty,
            'ref_typeid'   => 9,
            'ref_id'       => '0',
            'ref_no'   => 'none',
            'user'    => '1',
            'user_name'    => 'BEST',
            'stocktype_1'=>$qty,
            'comment'=>'ตัวอย่าง Stock',
            
        ]);
        }

    }
}
