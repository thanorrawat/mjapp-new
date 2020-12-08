<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class DatatablesController extends Controller
{
    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        return view('datatables.index');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {
        $users = DB::table('users')->select(['id', 'name', 'email', 'created_at', 'updated_at']);
     
        return datatables()->of($users)
        ->escapeColumns([]) /// ทำให้แสดง html ในตาราง
        ->make(true);
    }

    public function index()
    {
        $users = DB::table('users')->get();

        print_r($users);
    }
}