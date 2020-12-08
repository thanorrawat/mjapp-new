<?php

namespace App\Http\Controllers\Mj;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PurchasePo ;
use App\Models\PurchasePoItems ;
use App\Models\Shipmentdt;
use Auth;
use Yajra\Datatables\Datatables;
class SupplierAdminController extends Controller
{

    public function polistforcheck()
    {
$polist=PurchasePo::select('*')
->where('supplier_id',Auth::id())
->where('po_status','>=','2')

->get();
return Datatables::of($polist)
->editColumn('sup_make', function ($polist) {
    return  '<input type="number" id="sup_make-'.$polist->id.'" class="from-control text-right sup_make" data-itemid="'.$polist->id.'" value="'.$polist->sup_make.'">';


})

->editColumn('sup_stock', function ($polist) {
    return  '<input type="number" id="sup_stock-'.$polist->id.'" class="from-control text-right sup_stock" data-itemid="'.$polist->id.'" value="'.$polist->sup_stock.'">';


})

->addColumn('po_view', function ($polist) {
    return  '<a href="'.url('supplier/purchase/'.$polist->id.'/edit').'"><i class="fas fa-edit"></i></a>';


})

->editColumn('po_status', function ($polist) {
    if($polist->po_status==21){
        return   '<span class="badge badge-warning"><i  class="fas fa-tasks"></i> '.__('file.postatus_'.$polist->po_status).'</span>';
    }elseif($polist->po_status==3){
        return   '<span class="badge badge-success"><i class="fas fa-clipboard-check"></i> '.__('file.postatus_'.$polist->po_status).'</span>';

    }



})

->escapeColumns([]) /// ทำให้แสดง html ในตาราง
->make();

    }




    

    public function polistupdate(Request $request)
    {


        if(!empty($request->itemid)){

            $posend = PurchasePoItems::find($request->itemid);
            $posend->sup_make=$request->make;
            $posend->sup_stock=$request->stock;
            $posend->save();
 

         
      
        }


    }


    

    public function purchaseorder(Request $request)

    {
        return view('App_supplier.po')
         ;
    }

    public function purchaseorderedit($id)
    {
        $podt=PurchasePo::select('*')
        ->where('id',$id)
        ->first();
        if(!empty($podt->supplier_id) && $podt->supplier_id==Auth::id()){

            $poitems = PurchasePoItems::where('item_po_id',$id)
            ->get();
            return view('App_supplier.po-edit')
        ->with('podt', $podt)
        ->with('poitems', $poitems )

            ;
        }else{
            return redirect('/');
        }
        

    }


    public function updatepo(Request $request){

        if(!empty($request->poitem_id)){

            $itemsid = $request->poitem_id;
            $poitem_statusarr =[];
            for($i=0;$i<count($itemsid);$i++){
$thisid = $itemsid[$i];
$produce = $request->produce[$i];
$stock= $request->stock[$i];
$shipment= $request->shipment[$i];
$aboutload= $request->aboutload[$i];
$poitem_status= $request->poitem_status[$i];

$updateitem = PurchasePoItems::find($thisid);
$updateitem->sup_make=$produce;
$updateitem->sup_stock=$stock;
$updateitem->sup_shipmentno=$shipment;
$updateitem->sup_aboutload=$aboutload;
$updateitem->item_status=$poitem_status;
$updateitem->save();
$poitem_statusarr[]=$poitem_status;

            }

            if (in_array("3", $poitem_statusarr) && !in_array("2", $poitem_statusarr)) {
$postatus = 3;//finish ครบทุกรายการ
            }elseif (in_array("3", $poitem_statusarr) && in_array("2", $poitem_statusarr)) {
                $postatus = 21;//finish บางรายการ

            }else{
                $postatus = 2;//ยังไม่มีรายการครบ

            }
            $updatepostatus= PurchasePo::find($request->po_id);
            $updatepostatus->po_status=$postatus;
            $updatepostatus->save();


        return redirect('supplier/purchase/'.$request->po_id.'/edit')->with('status', 'Purchase updated!');


          //  return $updateitem;
        }else{

            return redirect('supplier/purchase/'.$request->po_id.'/edit')->with('status', 'Purchase updated!');

        }
       
      
    }


    public function shipmentlist()
    {
         $shipmentlist = PurchasePoItems::select('*')
        ->leftJoin('purchase_pos','purchase_pos.id','purchase_po_items.item_po_id') 
        ->leftJoin('shipmentdts','purchase_po_items.sup_shipmentno','shipmentdts.shipmentno') 
        
        ->where('supplier_id',Auth::id())
        ->whereNotNull('sup_shipmentno')
        ->groupBy('sup_shipmentno')
        ->get();
        return Datatables::of($shipmentlist)
        ->editColumn('total_box', function ($shipmentlist) {

            if(!empty($shipmentlist->total_box)){
                return number_format($shipmentlist->total_box)  ;
            }else{
               return "0" ; 
            }
                 
        })

        ->editColumn('total_weight', function ($shipmentlist) {

            if(!empty($shipmentlist->total_weight)){
                return number_format($shipmentlist->total_weight,2)  ;
            }else{
               return "0.00" ; 
            }
                 
        })

        ->editColumn('total_usedarea', function ($shipmentlist) {

            if(!empty($shipmentlist->total_usedarea)){
                return number_format($shipmentlist->total_usedarea,4)  ;
            }else{
               return "0.0000" ; 
            }
                 
        })


        ->addColumn('view', function ($shipmentlist) {

            return  '<a href="'.url('supplier/shipment/'.$shipmentlist->sup_shipmentno.'/edit').'"><i class="fas fa-edit"></i></a>';
                 
        })
        ->addIndexColumn()
        ->escapeColumns([]) /// ทำให้แสดง html ในตาราง
        ->make();


    }


    public function shipmentedit($id)
    {
     
$shipmentlist = PurchasePoItems::select('*')
        ->where('sup_shipmentno',$id)
        ->get();


        $supcheck = PurchasePoItems::select('supplier_id')
        ->leftJoin('purchase_pos','purchase_pos.id','purchase_po_items.item_po_id') 
        ->where('sup_shipmentno',$id)
        ->first();

     if(!empty($supcheck->supplier_id) && $supcheck->supplier_id==Auth::id()){
           
        
            $shipmentdt= Shipmentdt::firstOrCreate(
                ['shipmentno' => $id]
        
            );
    
            return view('App_supplier.shipmentedit')
        ->with('shipmentdt', $shipmentdt)
        ->with('shipmentlist', $shipmentlist );
        }else{
            return redirect('/');
        }
        

    }


    public function updateshipment(Request $request){

    }

}
