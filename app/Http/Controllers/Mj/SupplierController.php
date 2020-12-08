<?php

namespace App\Http\Controllers\Mj;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Response;
use Session;


class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplierlist = DB::table('users')
        ->selectRaw('users.id as suppid,fullname,suppliers_code,phone_number,address')
        ->leftjoin('suppliers','users.id','suppliers.user_id')
        ->where('role_id', 9)
        ->where('users.is_active', 1)
        ->where('users.is_deleted', 0)
        ->get();

        return view('A_supplier.index')
        ->with('supplierlist', $supplierlist)
        ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $supplierlist = DB::table('users')
        ->leftjoin('suppliers','users.id','suppliers.user_id')
        ->where('role_id', 9)
        ->where('users.is_active', 1)
        ->where('users.is_deleted', 0)
        ->get();

        return view('A_supplier.index')
        ->with('supplierlist', $supplierlist)
        ;
    }
    

    public function checksupplier(Request $request)
    {
     
            if(!empty($request->csrf) && $request->csrf==$request->session()->token()){
       // return $request->supplierid;
        if(!empty($request->supplierid)){
            Session::put('po_supplier_id',$request->supplierid);

            $supplierdt = DB::table('users')
            ->leftjoin('suppliers','users.id','suppliers.user_id')
            ->where('users.id', $request->supplierid)
            ->first();
        return response()->json($supplierdt);

        }

    }
     
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
