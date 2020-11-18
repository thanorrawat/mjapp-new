<?php

namespace App\Http\Controllers\Mj;
use App\Models\PurchasePo ;
use App\Models\PurchasePoItems ;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PurchaseFormController extends Controller
{
    public function formposhow(Request $request, $id)
{

    $podt = PurchasePo::where('ponumber',$id)->first();

$poid = $podt->id;
 $poitems = PurchasePoItems::where('item_po_id',$poid)
 ->get();


    return view('A_purchase.form')
    ->with('ponumber', $id)
    ->with('podt', $podt)
    ->with('poitems',$poitems)
  ;



    }

}
