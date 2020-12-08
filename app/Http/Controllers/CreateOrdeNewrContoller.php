<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use DB;
use App\Customer;
use Session;
use Response;
use App\Models\MjStoreProductsTracking;
use App\Models\MjOrderDetails;
use App\Models\MjOrderProducts;
use Auth;
class CreateOrdeNewrContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function addorder(Request $request)
    {

if(!empty($request->selectcustomer) && !empty($request->sendordertype)){

        $customer_id =  $request->selectcustomer;  
          $newordernumber="0";
          $newordernumberfull="0";
          $newbookingnumber ="0";
          if($request->sendordertype==1){ // สร้าง Order
             
          $beforeordername = date('ym');
              $lastornumber= MjOrderDetails::where('ordernumber','like', $beforeordername.'%')->orderBy('ordernumber', 'desc')->first();
              if(!empty($lastornumber->ordernumber)){
              $oldnumber = substr($lastornumber->ordernumber, -4);
              $newnumber=$oldnumber+1;
              }else{
                  $newnumber=1;
              }
               $newordernumber = $beforeordername.sprintf("%04d",$newnumber);
           $newordernumberfull = 'OD'.$newordernumber;
           $newstatus = 1;
          }elseif($request->sendordertype==2){ // สร้าง ใบจอง


                      //สร้าง booking number
      $beforebookingname = date('ym');
      $lastbookingnumber= MjOrderDetails::where('bookingnumber','like', $beforebookingname.'%')->orderBy('bookingnumber', 'desc')->first();
     if(!empty($lastbookingnumber->bookingnumber)){
     $oldnumber = substr($lastbookingnumber->bookingnumber, -4);
     $newnumber=$oldnumber+1;
     }else{
         $newnumber=1;
     }
     $newbookingnumber = 'BK'.$beforebookingname.sprintf("%04d",$newnumber);
     $newstatus = 2;
          }



     $customerdt = Customer::where('id', $customer_id)->first();
     $customer_name = $customerdt->name;


        $MjOrderDetails = new MjOrderDetails;
        $MjOrderDetails->customer_id = $customer_id;
        $MjOrderDetails->customer_name =   $customer_name;
        $MjOrderDetails->deliverydate =  $request->selectdate;
        $MjOrderDetails->ordertype = $request->sendordertype;
        $MjOrderDetails->createby_name = $request->userfullname;
        $MjOrderDetails->createby_id = $request->userId;

        $MjOrderDetails->ordernumber = $newordernumber;
        $MjOrderDetails->ordernumberfull = $newordernumberfull;
        $MjOrderDetails->bookingnumber = $newbookingnumber;
        $MjOrderDetails->doctype  = $request->ordertype;
        $MjOrderDetails->order_status  = $newstatus;

        $MjOrderDetails->save();

    }




        return $MjOrderDetails;
    
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
