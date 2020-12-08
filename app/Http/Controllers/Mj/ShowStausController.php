<?php

namespace App\Http\Controllers\Mj;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StatusName;
class ShowStausController extends Controller
{
    
    
    public function index()
    {


        $statusname = StatusName::get();
            return view('A_vue.showstatus')
        ->with('statusname', $statusname)
          ;
    }

}
