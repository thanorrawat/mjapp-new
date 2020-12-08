<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Keygen;
use App\Brand;
use App\Category;
use App\Unit;
use App\Tax;
use App\Warehouse;
use App\Supplier;
use App\Product;
use App\Product_Warehouse;
use App\Product_Supplier;
use Auth;
use DNS1D;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;
use DB;
use File;
use App\Variant;
use App\ProductVariant;
use Yajra\Datatables\Datatables;
use App\Models\MjStoreProductsTracking;

class ProductController extends Controller
{
    public function index()
    {
        $role = Role::find(Auth::user()->role_id);
        if($role->hasPermissionTo('products-index')){            
            $permissions = Role::findByName($role->name)->permissions;
            foreach ($permissions as $permission)
                $all_permission[] = $permission->name;
            if(empty($all_permission))
                $all_permission[] = 'dummy text';
            return view('App_product.index', compact('all_permission'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }




    public function productData(Request $request)
    {

      if($_GET['csrf']==csrf_token()) {
        $products = DB::table('products')
        ->leftjoin('categories', 'products.category_id', '=', 'categories.id')
        ->leftjoin('brands', 'products.brand_id', '=', 'brands.id')
      ->where('products.is_active', true)
        ->select(['*','products.image AS image','products.id AS id','products.name AS name'
        ,'products.code AS code'
        ,'categories.name AS category'
        ,'products.product_details AS details'
        ,'categories.cate_type AS cate_type'

        
        
        ]);

        return Datatables::of($products)
        ->addColumn('action', function ($products) {
            $products_id =  $products->id;
            
            $actioncol= ' <a href="'.route('products.edit', ['id' => $products_id]).'" class="btn btn-out btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i> Edit</a>'.\Form::open(["route" => ["products.destroy", $products->id], "method" => "DELETE","class"=>"d-inline"]).' <button type="submit" class="btn btn btn-out btn-sm btn-danger" onclick="return confirm(\''.trans("file.confirm delete").'\');"><i class="fa fa-trash"></i> '.trans("file.delete").'</button> '.\Form::close();


           return  $actioncol;

        })

        ->addColumn('select', function ($products) {
$selectcol= '<button class="add-to-cart  btn btn-out  btn-warning" id="add-to-cart_'.$products->id.'" type="button" data-productid="'.$products->id.'" data-code="'.$products->code.'" data-price="'.$products->price.'" data-stock="'.$products->qty.'" data-addqty="1"><i class="fa fa-shopping-basket" aria-hidden="true"></i></button>';
return  $selectcol;

        })

        
        ->addColumn('selecteditorder', function ($products) {
            $selectcol= '<button class="add-to-order  btn btn-out  btn-warning" id="add-to-order_'.$products->id.'" type="button" data-productid="'.$products->id.'" data-code="'.$products->code.'" data-price="'.$products->price.'" data-stock="'.$products->qty.'" data-addqty="1"><i class="fa fa-shopping-basket" aria-hidden="true"></i></button>';
            return  $selectcol;
            
                    })

        ->addColumn('namenew', function ($products) {
             
          
return  $products->name.'<br><strong>CODE : </strong>'.$products->code.'<br><strong>Type : </strong>'.$products->cate_type;
        })

        ->addColumn('detailsnew', function ($products) {
                       
            return  $products->product_details.'<br><strong>Type : </strong>'.$products->cate_type;
                    })
      ->addColumn('orderqty', function ($products) {
        return  '<input min="1" class="text-right addorderqty" data-product="'.$products->id.'" style="width:50px" type="number" name="qty_'.$products->id.'" id="qty_'.$products->id.'" value="1">';
                                })
                        

        ->editColumn('image', function ($products) {
            $product_image = explode(",", $products->image);
              $product_image = htmlspecialchars($product_image[0]);
         if(empty($product_image)){
            $product_image="zummXD2dvAtI.png";
         }
           return '<a data-toggle="modal" data-target="#product-details" href="#" data-productid="'.$products->id.'"  class="productpopup"><img src="'.url('public/images/product', $product_image).'"  width="80" >';
            
        })

        ->editColumn('name', function ($products) {

           return '<a target="_blank"  href="'.url("products/".$products->id."/edit").'" >'.$products->name.'</a>';
            
        })
        ->editColumn('code', function ($products) {

            return '<a target="_blank"  href="'.url("productstracking/".$products->id).'" >'.$products->code.'</a>';
             
         })
 

       



      
        ->escapeColumns([]) /// ทำให้แสดง html ในตาราง
        ->make();
      }
    }
    
    
    public function create()
    {
        $role = Role::firstOrCreate(['id' => Auth::user()->role_id]);
        if ($role->hasPermissionTo('products-add')){
            $lims_product_list = Product::where([ ['is_active', true], ['type', 'standard'] ])->get();
            $lims_brand_list = Brand::where('is_active', true)->get();
            $lims_category_list = Category::where('is_active', true)->get();
            $lims_unit_list = Unit::where('is_active', true)->get();
            $lims_tax_list = Tax::where('is_active', true)->get();
            $titlepage = trans('file.add_product');
            return view('App_product.create',compact('lims_product_list', 'lims_brand_list', 'lims_category_list', 'lims_unit_list', 'lims_tax_list' ,'titlepage'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }


    public function store(Request $request)
      {


        $this->validate($request, [
                        'code' => [
                            'max:255',
                                Rule::unique('products')->where(function ($query) {
                                return $query->where('is_active', 1);
                            }),
                        ],
                        'name' => [
                            'max:255',
                                Rule::unique('products')->where(function ($query) {
                                return $query->where('is_active', 1);
                            }),
                        ]
                    ]);
                    $data = $request->except('image', 'file');
                    if($data['type'] == 'combo'){
                        $data['product_list'] = implode(",", $data['product_id']);
                        $data['qty_list'] = implode(",", $data['product_qty']);
                        $data['price_list'] = implode(",", $data['unit_price']);
                        $data['cost'] = $data['unit_id'] = $data['purchase_unit_id'] = $data['sale_unit_id'] = 0;
                    }
                    $data['cost'] =0;
                    $data['price'] =1;
                    $data['purchase_unit_id'] = $data['sale_unit_id'] = $data['unit_id'] ;
                    $data['product_details'] = str_replace('"', '@', $data['product_details']);
                   $category = Category::find($data['category_id']);
                    $data['category_code']= $category->code;
                    $data['is_active'] = true;
$images = $request->image;
        $image_names = [];
        if($images) {            
            foreach ($images as $key => $image) {
               $imageName = $image->getClientOriginalName();
                $image->move('public/images/product', $imageName);
                $image_names[] = $imageName;
            }
            $data['image'] = implode(",", $image_names);
        }
        else {
            $data['image'] = 'zummXD2dvAtI.png';
        }

       $lims_product_data = Product::create($data);


\Session::flash('create_message', 'Product created successfully');
$role = Role::find(Auth::user()->role_id);
if($role->hasPermissionTo('products-index')){            
    $permissions = Role::findByName($role->name)->permissions;
    foreach ($permissions as $permission)
        $all_permission[] = $permission->name;
    if(empty($all_permission))
        $all_permission[] = 'dummy text';
    return view('App_product.index', compact('all_permission'));
    }
    
}


    
    public function edit($id)
    {
        $role = Role::firstOrCreate(['id' => Auth::user()->role_id]);
        if ($role->hasPermissionTo('products-edit')) {
            $lims_product_list = Product::where([ ['is_active', true], ['type', 'standard'] ])->get();
            $lims_brand_list = Brand::where('is_active', true)->get();
            $lims_category_list = Category::where('is_active', true)->get();
            $lims_unit_list = Unit::where('is_active', true)->get();
            $lims_tax_list = Tax::where('is_active', true)->get();
            $lims_product_data = Product::where('id', $id)->first();
            $lims_product_variant_data = $lims_product_data->variant()->orderBy('position')->get();
            //return dd($lims_product_variant_data);
           // print_r($lims_product_data);
           $titlepage =  __('file.edit')." ".__('file.product')." : ".$lims_product_data->name;
           

           if(!empty($lims_product_data->image)){
            $imagearr =  explode(",", $lims_product_data->image);
        }else{
            $imagearr=[];
        }

            return view('App_product.create',compact('lims_product_list', 'lims_brand_list', 'lims_category_list', 'lims_unit_list', 'lims_tax_list', 'lims_product_data', 'lims_product_variant_data','titlepage','imagearr'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }



    public function updateProduct(Request $request)
    {
        $data = $request->except('image', 'file');
        $lims_product_data = Product::findOrFail($request->input('id'));
      
/*
        $this->validate($request, [
            'name' => [
                'max:255',
                Rule::unique('products')->ignore($request->id)->where(function ($query) {
                    return $query->where('is_active', 1);
                }),
            ],

            'code' => [
                'max:255',
                Rule::unique('products')->ignore($request->id)->where(function ($query) {
                    return $query->where('is_active', 1);
                }),
            ]
        ]);
*/
        if($data['type'] == 'combo') {
            $data['product_list'] = implode(",", $data['product_id']);
            $data['qty_list'] = implode(",", $data['product_qty']);
            $data['price_list'] = implode(",", $data['unit_price']);
            $data['cost'] = $data['unit_id'] = $data['purchase_unit_id'] = $data['sale_unit_id'] = 0;
        }
        $data = $request->except('image');


        $oldimage = $lims_product_data->image;
        if(!empty($request->imagesdelete) && !empty($lims_product_data->image)){ //เลือกลบรูป
$oldimagearr = explode(",",$lims_product_data->image);
$imgdel = $request->imagesdelete;
for($i=0;$i<count($imgdel);$i++){
            $key = array_search($imgdel[$i], $oldimagearr);
            $destinationPath = './images/product/';
            File::delete($destinationPath.$imgdel[$i]);
            if($key !== FALSE) unset($oldimagearr[$key]);

}
$oldimage = implode(",", $oldimagearr);
if(empty($oldimage)){
    $oldimage = 'zummXD2dvAtI.png';
}
        }
                
        
        $images = $request->image;
        $image_names = [];
        if($images) {            
            foreach ($images as $key => $image) {
                $imageName = $image->getClientOriginalName();
                $image->move('public/images/product', $imageName);
                $image_names[] = $imageName;
            }
            if(!empty($oldimage) && $oldimage!= 'zummXD2dvAtI.png') {
                $data['image'] = $oldimage.','.implode(",", $image_names);
            }
            else{
                $data['image'] = implode(",", $image_names);
            }
        }
        else {
            $data['image'] = $oldimage;
        }
        $lims_product_data->update($data);
     //   \Session::flash('edit_message', 'Product updated successfully');
        return redirect()->back()->with('edit_message', 'Product updated successfully');

    }







    public function generateCode()
    {
        $id = Keygen::numeric(8)->generate();
        return $id;
    }

    public function search(Request $request)
    {
        $product_code = explode(" ", $request['data']);
        $lims_product_data = Product::where('code', $product_code[0])->first();

        $product[] = $lims_product_data->name;
        $product[] = $lims_product_data->code;
        $product[] = $lims_product_data->qty;
        $product[] = $lims_product_data->price;
        $product[] = $lims_product_data->id;
        return $product;
    }

    public function saleUnit($id)
    {
        $unit = Unit::where("base_unit", $id)->orWhere('id', $id)->pluck('unit_name','id');
        return json_encode($unit);
    }

    public function getData($id)
    {
        $data = Product::select('name', 'code')->where('id', $id)->get();
        return $data[0];
    }

    public function productWarehouseData($id)
    {
        $warehouse = [];
        $qty = [];
        $warehouse_name = [];
        $variant_name = [];
        $variant_qty = [];
        $product_warehouse = [];
        $product_variant_warehouse = [];
        $lims_product_data = Product::select('id', 'is_variant')->find($id);
        if($lims_product_data->is_variant) {
            $lims_product_variant_warehouse_data = Product_Warehouse::where('product_id', $lims_product_data->id)->orderBy('warehouse_id')->get();
            $lims_product_warehouse_data = Product_Warehouse::select('warehouse_id', DB::raw('sum(qty) as qty'))->where('product_id', $id)->groupBy('warehouse_id')->get();
            foreach ($lims_product_variant_warehouse_data as $key => $product_variant_warehouse_data) {
                $lims_warehouse_data = Warehouse::find($product_variant_warehouse_data->warehouse_id);
                $lims_variant_data = Variant::find($product_variant_warehouse_data->variant_id);
                $warehouse_name[] = $lims_warehouse_data->name;
                $variant_name[] = $lims_variant_data->name;
                $variant_qty[] = $product_variant_warehouse_data->qty;
                
            }
        }
        else{
            $lims_product_warehouse_data = Product_Warehouse::where('product_id', $id)->get();
        }
        foreach ($lims_product_warehouse_data as $key => $product_warehouse_data) {
            $lims_warehouse_data = Warehouse::find($product_warehouse_data->warehouse_id);
            $warehouse[] = $lims_warehouse_data->name;
            $qty[] = $product_warehouse_data->qty;
        }

        $product_warehouse = [$warehouse, $qty];
        $product_variant_warehouse = [$warehouse_name, $variant_name, $variant_qty];
        return ['product_warehouse' => $product_warehouse, 'product_variant_warehouse' => $product_variant_warehouse];
    }

    public function printBarcode()
    {
        $lims_product_list = Product::where('is_active', true)->get();
        return view('App_product.print_barcode', compact('lims_product_list'));
    }

    public function limsProductSearch(Request $request)
    {
        $todayDate = date('Y-m-d');
        $product_code = explode(" ", $request['data']);

        $lims_product_data = Product::where('code', $product_code[0])->first();
        $product[] = $lims_product_data->name;
        $product[] = $lims_product_data->code;
        $product[] = $lims_product_data->price;

        $product[] = DNS1D::getBarcodePNG($lims_product_data->code, $lims_product_data->barcode_symbology);
        $product[] = $lims_product_data->promotion_price;
        return $product;
    }

    /*public function getBarcode()
    {
        return DNS1D::getBarcodePNG('72782608', 'C128');
    }*/

    public function importProduct(Request $request)
    {   
        //get file
        $upload=$request->file('file');
        $ext = pathinfo($upload->getClientOriginalName(), PATHINFO_EXTENSION);
        if($ext != 'csv')
            return redirect()->back()->with('message', 'Please upload a CSV file');

        $filePath=$upload->getRealPath();
        //open and read
        $file=fopen($filePath, 'r');
        $header= fgetcsv($file);
        $escapedHeader=[];
        //validate
        foreach ($header as $key => $value) {
            $lheader=strtolower($value);
            $escapedItem=preg_replace('/[^a-z]/', '', $lheader);
            array_push($escapedHeader, $escapedItem);
        }
        //looping through other columns
        while($columns=fgetcsv($file))
        {
            foreach ($columns as $key => $value) {
                $value=preg_replace('/\D/','',$value);
            }
           $data= array_combine($escapedHeader, $columns);
           
           if($data['brand'] != 'N/A' && $data['brand'] != ''){
                $lims_brand_data = Brand::firstOrCreate(['title' => $data['brand'], 'is_active' => true]);
                $brand_id = $lims_brand_data->id;
           }
            else
                $brand_id = null;

            //    $lims_category_data = Category::firstOrCreate(['code' => $data['category'], 'is_active' => true]);
                        $lims_category_data =  Category::where('code', $data['category'])->first();
           $lims_unit_data = Unit::where('unit_code', $data['unitcode'])->first();

           //$product = Product::firstOrNew([ 'name'=>$data['name'], 'is_active'=>true ]);
           $product = Product::firstOrNew([ 'code'=>$data['code'], 'is_active'=>true ]);
            if($data['image'])
                $product->image = $data['image'];
            else
                $product->image = 'zummXD2dvAtI.png';
           $product->name = $data['name'];
           $product->code = $data['code'];
           $product->type = strtolower($data['type']);
           $product->barcode_symbology = 'C128';
           $product->brand_id = $brand_id;
          
if(!empty($lims_category_data->id)){
    $product->category_id = $lims_category_data->id;
}else{
    $product->category_id = "1";
    
}
          
$product->category_code = $data['category'];
$product->unit_id = $lims_unit_data->id;
           $product->purchase_unit_id = $lims_unit_data->id;
           $product->sale_unit_id = $lims_unit_data->id;
           $product->cost = $data['cost'];
           $product->price = $data['price'];
           $product->tax_method = 1;
           $product->qty = 0;
           $product->product_details = $data['productdetails'];
           $product->is_active = true;
           $product->save();
         }
         return redirect('products')->with('import_message', 'Product imported successfully');
    }

    public function deleteBySelection(Request $request)
    {
        $product_id = $request['productIdArray'];
        foreach ($product_id as $id) {
            $lims_product_data = Product::findOrFail($id);
            $lims_product_data->is_active = false;
            $lims_product_data->save();
        }
        return 'Product deleted successfully!';
    }

    public function destroy($id)
    {
        $lims_product_data = Product::findOrFail($id);
        $lims_product_data->is_active = false;
        if($lims_product_data->image != 'zummXD2dvAtI.png') {
            $images = explode(",", $lims_product_data->image);
            foreach ($images as $key => $image) {
                unlink('public/images/product/'.$image);
            }
        }
        $lims_product_data->save();
        return redirect('products')->with('message', 'Product deleted successfully');
    }

///new function

 

public function details($id)
{

    // get the user
    $product = Product::findOrFail($id);

    if(!empty($product->image)){
        $imagearr =  explode(",", $product->image);
    }
    return view('App_product.details')
    ->with('product', $product)
    ->with('images', $imagearr)
    ;

}


public function producttracking($id)
    {

        $products = Product::find($id);
        $tracking = MjStoreProductsTracking::where('product_id', $id)->get();
        return view('App_product.productstracking')
        ->with('products', $products)
        ->with('tracking', $tracking)
        
        ;
    }


}
