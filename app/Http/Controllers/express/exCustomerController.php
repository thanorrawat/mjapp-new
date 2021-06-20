<?php

namespace App\Http\Controllers\express;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\express\customerModel;
class exCustomerController extends Controller
{
    public function customerData(Request $request)
    {
            $list = customerModel::on('report')
            ->get();

            return Datatables::of($list)

            ->addColumn('cusnam_new', function ($list) {
                return $list->prenam.' '.$list->cusnam; 
            })

            ->editColumn('addr01', function ($list) {
                return $list->addr01.' '.$list->addr02.' '.$list->addr03.' '.$list->zipcod; 
            })

            ->editColumn('telnum', function ($list) {
                if($list->telnum && $list->contact){
                    return $list->telnum.' / '.$list->contact; 
                } else{
                    return $list->telnum.''.$list->contact;  
                }

            })
            ->escapeColumns([]) /// ทำให้แสดง html ในตาราง
            ->make();
    }

    public function customerDataMemo(Request $request)
    {
        return customerModel::on('report')
        ->select('cuscod','cusnam')
        ->get();
    }
}
