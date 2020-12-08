<?php

namespace App\Http\Controllers\Mj;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PurchasePo ;
use App\Models\PurchasePoItems ;
use Auth;
use Yajra\Datatables\Datatables;
class SupplierAdminController extends Controller
{

    public function polistforcheck()
    {
$polist=PurchasePoItems::selectRaw('purchase_po_items.id AS id,po_date,ponumber,poitems_productscode,poitems_productsname,poitems_unit,poitems_qty,sup_make,sup_stock')
->leftjoin('purchase_pos','purchase_po_items.item_po_id','purchase_pos.id')
->where('supplier_id',Auth::id())
->where('item_status','2')
->get();
return Datatables::of($polist)
->editColumn('sup_make', function ($polist) {
    return  '<input type="number" id="sup_make-'.$polist->id.'" class="from-control text-right sup_make" data-itemid="'.$polist->id.'" value="'.$polist->sup_make.'">';


})

->editColumn('sup_stock', function ($polist) {
    return  '<input type="number" id="sup_stock-'.$polist->id.'" class="from-control text-right sup_stock" data-itemid="'.$polist->id.'" value="'.$polist->sup_stock.'">';


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
        return view('A_supplier.index')
        ->with('supplierlist', $supplierlist)
        ;
    }



}
