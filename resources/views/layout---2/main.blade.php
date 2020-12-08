<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" href="{{url('public/logo', $general_setting->site_logo)}}" />
    <title>{{$general_setting->site_title}}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="<?php echo asset('public/vendor/bootstrap/css/bootstrap.min.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('public/vendor/bootstrap-toggle/css/bootstrap-toggle.min.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('public/vendor/bootstrap/css/bootstrap-datepicker.min.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('public/vendor/jquery-timepicker/jquery.timepicker.min.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('public/vendor/bootstrap/css/awesome-bootstrap-checkbox.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('public/vendor/bootstrap/css/bootstrap-select.min.css') ?>" type="text/css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="<?php echo asset('public/vendor/font-awesome/css/font-awesome.min.css') ?>" type="text/css">
    <!-- Drip icon font-->
    <link rel="stylesheet" href="<?php echo asset('public/vendor/dripicons/webfont.css') ?>" type="text/css">
    {{-- <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:400,500,700"> --}}
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
    <!-- jQuery Circle-->
    <link rel="stylesheet" href="<?php echo asset('public/css/grasp_mobile_progress_circle-1.0.0.min.css') ?>" type="text/css">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet" href="<?php echo asset('public/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css') ?>" type="text/css">
    <!-- virtual keybord stylesheet-->
    <link rel="stylesheet" href="<?php echo asset('public/vendor/keyboard/css/keyboard.css') ?>" type="text/css">
    <!-- date range stylesheet-->
    <link rel="stylesheet" href="<?php echo asset('public/vendor/daterange/css/daterangepicker.min.css') ?>" type="text/css">
    <!-- table sorter stylesheet-->
    <link rel="stylesheet" type="text/css" href="<?php echo asset('public/vendor/datatable/dataTables.bootstrap4.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.1.6/css/fixedHeader.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo asset('public/css/style.default.css') ?>" id="theme-stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('public/css/dropzone.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('public/css/style.css') ?>">
    <link href="https://blackrockdigital.github.io/startbootstrap-sb-admin-2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://blackrockdigital.github.io/startbootstrap-sb-admin-2/css/sb-admin-2.min.css">

    
   
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->

    <script type="text/javascript" src="<?php echo asset('public/vendor/jquery/jquery.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('public/vendor/jquery/jquery-ui.min.js') ?>"></script>

    <link rel="stylesheet" href="<?php echo asset('assets/css/custom-'.$general_setting->theme) ?>" type="text/css" id="custom-style">
 </head>
  
  <body onload="myFunction()">
    <div id="loader"></div>
    <?php
                $role = DB::table('roles')->find(Auth::user()->role_id);
                $index_permission = DB::table('permissions')->where('name', 'products-index')->first();
                $index_permission_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $index_permission->id],
                    ['role_id', $role->id]
                ])->first();

                $print_barcode = DB::table('permissions')->where('name', 'print_barcode')->first();
                      $print_barcode_active = DB::table('role_has_permissions')->where([
                          ['permission_id', $print_barcode->id],
                          ['role_id', $role->id]
                      ])->first();

                  $stock_count = DB::table('permissions')->where('name', 'stock_count')->first();
                      $stock_count_active = DB::table('role_has_permissions')->where([
                          ['permission_id', $stock_count->id],
                          ['role_id', $role->id]
                      ])->first();

                    $adjustment = DB::table('permissions')->where('name', 'adjustment')->first();
                    $adjustment_active = DB::table('role_has_permissions')->where([
                        ['permission_id', $adjustment->id],
                        ['role_id', $role->id]
                    ])->first();
              ?>
               <?php

$warehouse_permission = DB::table('permissions')->where('name', 'warehouse')->first();
$warehouse_permission_active = DB::table('role_has_permissions')->where([
            ['permission_id', $warehouse_permission->id],
            ['role_id', $role->id]
        ])->first();

$customer_group_permission = DB::table('permissions')->where('name', 'customer_group')->first();
$customer_group_permission_active = DB::table('role_has_permissions')->where([
            ['permission_id', $customer_group_permission->id],
            ['role_id', $role->id]
        ])->first();

$brand_permission = DB::table('permissions')->where('name', 'brand')->first();
$brand_permission_active = DB::table('role_has_permissions')->where([
            ['permission_id', $brand_permission->id],
            ['role_id', $role->id]
        ])->first();

$unit_permission = DB::table('permissions')->where('name', 'unit')->first();
$unit_permission_active = DB::table('role_has_permissions')->where([
            ['permission_id', $unit_permission->id],
            ['role_id', $role->id]
        ])->first();

$tax_permission = DB::table('permissions')->where('name', 'tax')->first();
$tax_permission_active = DB::table('role_has_permissions')->where([
            ['permission_id', $tax_permission->id],
            ['role_id', $role->id]
        ])->first();

$general_setting_permission = DB::table('permissions')->where('name', 'general_setting')->first();
$general_setting_permission_active = DB::table('role_has_permissions')->where([
            ['permission_id', $general_setting_permission->id],
            ['role_id', $role->id]
        ])->first();

$mail_setting_permission = DB::table('permissions')->where('name', 'mail_setting')->first();
$mail_setting_permission_active = DB::table('role_has_permissions')->where([
    ['permission_id', $mail_setting_permission->id],
    ['role_id', $role->id]
])->first();

$sms_setting_permission = DB::table('permissions')->where('name', 'sms_setting')->first();
$sms_setting_permission_active = DB::table('role_has_permissions')->where([
    ['permission_id', $sms_setting_permission->id],
    ['role_id', $role->id]
])->first();

$create_sms_permission = DB::table('permissions')->where('name', 'create_sms')->first();
$create_sms_permission_active = DB::table('role_has_permissions')->where([
    ['permission_id', $create_sms_permission->id],
    ['role_id', $role->id]
])->first();

$pos_setting_permission = DB::table('permissions')->where('name', 'pos_setting')->first();
$pos_setting_permission_active = DB::table('role_has_permissions')->where([
    ['permission_id', $pos_setting_permission->id],
    ['role_id', $role->id]
])->first();

$hrm_setting_permission = DB::table('permissions')->where('name', 'hrm_setting')->first();
$hrm_setting_permission_active = DB::table('role_has_permissions')->where([
    ['permission_id', $hrm_setting_permission->id],
    ['role_id', $role->id]
])->first();
?>
<div id="wrapper">
 <!-- Side Navbar -->
 @include("layout.sidebar2") 
 <!-- End of Sidebar -->
 

    <div id="content-wrapper" class="page d-flex flex-column">
      <!-- navbar-->
  @include("layout.topnav2")
      <!-- expense modal -->
      <div id="expense-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Add Expense')}}</h5>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                </div>
                <div class="modal-body">
                  <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                    {!! Form::open(['route' => 'expenses.store', 'method' => 'post']) !!}
                    <?php 
                      $lims_expense_category_list = DB::table('expense_categories')->where('is_active', true)->get();
                      $lims_warehouse_list = DB::table('warehouses')->where('is_active', true)->get();
                      $lims_account_list = \App\Account::where('is_active', true)->get();
                    
                    ?>
                      <div class="row">
                        <div class="col-md-6 form-group">
                            <label>{{trans('file.Expense Category')}} *</label>
                            <select name="expense_category_id" class="selectpicker form-control" required data-live-search="true" data-live-search-style="begins" title="Select Expense Category...">
                                @foreach($lims_expense_category_list as $expense_category)
                                <option value="{{$expense_category->id}}">{{$expense_category->name . ' (' . $expense_category->code. ')'}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>{{trans('file.Warehouse')}} *</label>
                            <select name="warehouse_id" class="selectpicker form-control" required data-live-search="true" data-live-search-style="begins" title="Select Warehouse...">
                                @foreach($lims_warehouse_list as $warehouse)
                                <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>{{trans('file.Amount')}} *</label>
                            <input type="number" name="amount" step="any" required class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label> {{trans('file.Account')}}</label>
                            <select class="form-control selectpicker" name="account_id">
                            @foreach($lims_account_list as $account)
                                @if($account->is_default)
                                <option selected value="{{$account->id}}">{{$account->name}} [{{$account->account_no}}]</option>
                                @else
                                <option value="{{$account->id}}">{{$account->name}} [{{$account->account_no}}]</option>
                                @endif
                            @endforeach
                            </select>
                        </div>
                      </div>
                      <div class="form-group">
                          <label>{{trans('file.Note')}}</label>
                          <textarea name="note" rows="3" class="form-control"></textarea>
                      </div>
                      <div class="form-group">
                          <button type="submit" class="btn btn-primary">{{trans('file.submit')}}</button>
                      </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
      </div>

      <!-- account modal -->
      <div id="account-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Add Account')}}</h5>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                </div>
                <div class="modal-body">
                  <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                    {!! Form::open(['route' => 'accounts.store', 'method' => 'post']) !!}
                      <div class="form-group">
                          <label>{{trans('file.Account No')}} *</label>
                          <input type="text" name="account_no" required class="form-control">
                      </div>
                      <div class="form-group">
                          <label>{{trans('file.name')}} *</label>
                          <input type="text" name="name" required class="form-control">
                      </div>
                      <div class="form-group">
                          <label>{{trans('file.Initial Balance')}}</label>
                          <input type="number" name="initial_balance" step="any" class="form-control">
                      </div>
                      <div class="form-group">
                          <label>{{trans('file.Note')}}</label>
                          <textarea name="note" rows="3" class="form-control"></textarea>
                      </div>
                      <div class="form-group">
                          <button type="submit" class="btn btn-primary">{{trans('file.submit')}}</button>
                      </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
      </div>

      <!-- account statement modal -->
      <div id="account-statement-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Account Statement')}}</h5>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                </div>
                <div class="modal-body">
                  <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                    {!! Form::open(['route' => 'accounts.statement', 'method' => 'post']) !!}
                      <div class="row">
                        <div class="col-md-6 form-group">
                            <label> {{trans('file.Account')}}</label>
                            <select class="form-control selectpicker" name="account_id">
                            @foreach($lims_account_list as $account)
                                <option value="{{$account->id}}">{{$account->name}} [{{$account->account_no}}]</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label> {{trans('file.Type')}}</label>
                            <select class="form-control selectpicker" name="type">
                                <option value="0">{{trans('file.All')}}</option>
                                <option value="1">{{trans('file.Debit')}}</option>
                                <option value="2">{{trans('file.Credit')}}</option>
                            </select>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>{{trans('file.Choose Your Date')}}</label>
                            <div class="input-group">
                                <input type="text" class="daterangepicker-field form-control" required />
                                <input type="hidden" name="start_date" />
                                <input type="hidden" name="end_date" />
                            </div>
                        </div>
                      </div>
                      <div class="form-group">
                          <button type="submit" class="btn btn-primary">{{trans('file.submit')}}</button>
                      </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
      </div>

      <!-- warehouse modal -->
      <div id="warehouse-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Warehouse Report')}}</h5>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                </div>
                <div class="modal-body">
                  <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                    {!! Form::open(['route' => 'report.warehouse', 'method' => 'post']) !!}
                    <?php 
                      $lims_warehouse_list = DB::table('warehouses')->where('is_active', true)->get();
                    ?>
                      <div class="form-group">
                          <label>{{trans('file.Warehouse')}} *</label>
                          <select name="warehouse_id" class="selectpicker form-control" required data-live-search="true" id="warehouse-id" data-live-search-style="begins" title="Select warehouse...">
                              @foreach($lims_warehouse_list as $warehouse)
                              <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                              @endforeach
                          </select>
                      </div>

                      <input type="hidden" name="start_date" value="1988-04-18" />
                      <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />

                      <div class="form-group">
                          <button type="submit" class="btn btn-primary">{{trans('file.submit')}}</button>
                      </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
      </div>

      <!-- user modal -->
      <div id="user-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="exampleModalLabel" class="modal-title">{{trans('file.User Report')}}</h5>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                </div>
                <div class="modal-body">
                  <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                    {!! Form::open(['route' => 'report.user', 'method' => 'post']) !!}
                    <?php 
                      $lims_user_list = DB::table('users')->where('is_active', true)->get();
                    ?>
                      <div class="form-group">
                          <label>{{trans('file.User')}} *</label>
                          <select name="user_id" class="selectpicker form-control" required data-live-search="true" id="user-id" data-live-search-style="begins" title="Select user...">
                              @foreach($lims_user_list as $user)
                              <option value="{{$user->id}}">{{$user->name . ' (' . $user->phone. ')'}}</option>
                              @endforeach
                          </select>
                      </div>

                      <input type="hidden" name="start_date" value="1988-04-18" />
                      <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />

                      <div class="form-group">
                          <button type="submit" class="btn btn-primary">{{trans('file.submit')}}</button>
                      </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
      </div>

      <!-- customer modal -->
      <div id="customer-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Customer Report')}}</h5>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                </div>
                <div class="modal-body">
                  <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                    {!! Form::open(['route' => 'report.customer', 'method' => 'post']) !!}
                    <?php 
                      $lims_customer_list = DB::table('customers')->where('is_active', true)->get();
                    ?>
                      <div class="form-group">
                          <label>{{trans('file.customer')}} *</label>
                          <select name="customer_id" class="selectpicker form-control" required data-live-search="true" id="customer-id" data-live-search-style="begins" title="Select customer...">
                              @foreach($lims_customer_list as $customer)
                              <option value="{{$customer->id}}">{{$customer->name . ' (' . $customer->phone_number. ')'}}</option>
                              @endforeach
                          </select>
                      </div>

                      <input type="hidden" name="start_date" value="1988-04-18" />
                      <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />

                      <div class="form-group">
                          <button type="submit" class="btn btn-primary">{{trans('file.submit')}}</button>
                      </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
      </div>

      <!-- supplier modal -->
      <div id="supplier-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Supplier Report')}}</h5>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                </div>
                <div class="modal-body">
                  <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                    {!! Form::open(['route' => 'report.supplier', 'method' => 'post']) !!}
                    <?php 
                      $lims_supplier_list = DB::table('suppliers')->where('is_active', true)->get();
                    ?>
                      <div class="form-group">
                          <label>{{trans('file.Supplier')}} *</label>
                          <select name="supplier_id" class="selectpicker form-control" required data-live-search="true" id="supplier-id" data-live-search-style="begins" title="Select Supplier...">
                              @foreach($lims_supplier_list as $supplier)
                              <option value="{{$supplier->id}}">{{$supplier->name . ' (' . $supplier->phone_number. ')'}}</option>
                              @endforeach
                          </select>
                      </div>

                      <input type="hidden" name="start_date" value="1988-04-18" />
                      <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />

                      <div class="form-group">
                          <button type="submit" class="btn btn-primary">{{trans('file.submit')}}</button>
                      </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
      </div>
      
      <div style="display:none" id="content" class="animate-bottom">
          @yield('content')
      </div>

      <footer class="main-footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-12">
              <p>&copy; {{$general_setting->site_title}} | {{trans('file.Developed')}} {{trans('file.By')}} <a href="https://lion-coders.com" class="external">LionCoders</a></p>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>

  <script type="text/javascript" src="<?php echo asset('public/vendor/jquery/bootstrap-datepicker.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('public/vendor/jquery/jquery.timepicker.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('public/vendor/popper.js/umd/popper.min.js') ?>">
  </script>
  <script type="text/javascript" src="<?php echo asset('public/vendor/bootstrap/js/bootstrap.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('public/vendor/bootstrap-toggle/js/bootstrap-toggle.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('public/vendor/bootstrap/js/bootstrap-select.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('public/vendor/keyboard/js/jquery.keyboard.js') ?>"></script>  
  <script type="text/javascript" src="<?php echo asset('public/vendor/keyboard/js/jquery.keyboard.extension-autocomplete.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('public/js/grasp_mobile_progress_circle-1.0.0.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('public/vendor/jquery.cookie/jquery.cookie.js') ?>">
  </script>
  <script type="text/javascript" src="<?php echo asset('public/vendor/chart.js/Chart.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('public/vendor/jquery-validation/jquery.validate.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('public/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js')?>"></script>
  <script type="text/javascript" src="<?php echo asset('public/js/charts-custom.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('public/js/front.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('public/vendor/daterange/js/moment.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('public/vendor/daterange/js/knockout-3.4.2.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('public/vendor/daterange/js/daterangepicker.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('public/vendor/tinymce/js/tinymce/tinymce.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('public/js/dropzone.js') ?>"></script>
  
  <!-- table sorter js-->
  <script type="text/javascript" src="<?php echo asset('public/vendor/datatable/pdfmake.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('public/vendor/datatable/vfs_fonts.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('public/vendor/datatable/jquery.dataTables.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('public/vendor/datatable/dataTables.bootstrap4.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('public/vendor/datatable/dataTables.buttons.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('public/vendor/datatable/buttons.bootstrap4.min.js') ?>">"></script>
  <script type="text/javascript" src="<?php echo asset('public/vendor/datatable/buttons.colVis.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('public/vendor/datatable/buttons.html5.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('public/vendor/datatable/buttons.print.min.js') ?>"></script>

  <script type="text/javascript" src="<?php echo asset('public/vendor/datatable/sum().js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('public/vendor/datatable/dataTables.checkboxes.min.js') ?>"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script> 

  <script src="{{ asset("assets/js/sb-admin-2.min.js") }}"></script>
    @yield('scripts')
    <script type="text/javascript">
      if ($(window).outerWidth() > 1199) {
          $('nav.side-navbar').removeClass('shrink');
      }

      function myFunction() {
          setTimeout(showPage, 150);
      }
      function showPage() {
        document.getElementById("loader").style.display = "none";
        document.getElementById("content").style.display = "block";
      }

      $("div.alert").delay(3000).slideUp(750);

      function confirmDelete() {
          if (confirm("Are you sure want to delete?")) {
              return true;
          }
          return false;
      }
      
      $("a#add-expense").click(function(e){
        e.preventDefault();
        $('#expense-modal').modal();
      });

      $("a#add-account").click(function(e){
        e.preventDefault();
        $('#account-modal').modal();
      });

      $("a#account-statement").click(function(e){
        e.preventDefault();
        $('#account-statement-modal').modal();
      });

      $("a#profitLoss-link").click(function(e){
        e.preventDefault();
        $("#profitLoss-report-form").submit();
      });

      $("a#report-link").click(function(e){
        e.preventDefault();
        $("#product-report-form").submit();
      });

      $("a#purchase-report-link").click(function(e){
        e.preventDefault();
        $("#purchase-report-form").submit();
      });

      $("a#sale-report-link").click(function(e){
        e.preventDefault();
        $("#sale-report-form").submit();
      });

      $("a#payment-report-link").click(function(e){
        e.preventDefault();
        $("#payment-report-form").submit();
      });

      $("a#warehouse-report-link").click(function(e){
        e.preventDefault();
        $('#warehouse-modal').modal();
      });

      $("a#user-report-link").click(function(e){
        e.preventDefault();
        $('#user-modal').modal();
      });

      $("a#customer-report-link").click(function(e){
        e.preventDefault();
        $('#customer-modal').modal();
      });

      $("a#supplier-report-link").click(function(e){
        e.preventDefault();
        $('#supplier-modal').modal();
      });

      $("a#due-report-link").click(function(e){
        e.preventDefault();
        $("#due-report-form").submit();
      });

      $(".daterangepicker-field").daterangepicker({
          callback: function(startDate, endDate, period){
            var start_date = startDate.format('YYYY-MM-DD');
            var end_date = endDate.format('YYYY-MM-DD');
            var title = start_date + ' To ' + end_date;
            $(this).val(title);
            $('#account-statement-modal input[name="start_date"]').val(start_date);
            $('#account-statement-modal input[name="end_date"]').val(end_date);
          }
      });

      $('.selectpicker').selectpicker({
          style: 'btn-link',
      });
    </script>
  </body>
</html>