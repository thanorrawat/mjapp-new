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
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>@yield('title') : {{$general_setting->site_title}}</title>
    <!-- HTML5 Shim and Respond.js IE9 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" href="{{url('public/logo', $general_setting->site_logo)}}" />
    <!-- Google font--><link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300&display=swap" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/bootstrap/css/bootstrap.min.css") }}">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/icon/themify-icons/themify-icons.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/icon/font-awesome/css/font-awesome.min.css") }}">

    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/icon/icofont/css/icofont.css") }}">


    
    <!-- Bootstrap CSS-->
    
    <link rel="stylesheet" href="<?php echo asset('public/vendor/bootstrap-toggle/css/bootstrap-toggle.min.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('public/vendor/bootstrap/css/bootstrap-datepicker.min.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('public/vendor/jquery-timepicker/jquery.timepicker.min.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('public/vendor/bootstrap/css/awesome-bootstrap-checkbox.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('public/vendor/bootstrap/css/bootstrap-select.min.css') ?>" type="text/css">
    
    <!-- Drip icon font-->
    <link rel="stylesheet" href="<?php echo asset('public/vendor/dripicons/webfont.css') ?>" type="text/css">
    {{-- <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:400,500,700"> --}}
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
    <!-- jQuery Circle-->
    <link rel="stylesheet" href="<?php echo asset('public/css/grasp_mobile_progress_circle-1.0.0.min.css') ?>" type="text/css">

    <!-- virtual keybord stylesheet-->
    <link rel="stylesheet" href="<?php echo asset('public/vendor/keyboard/css/keyboard.css') ?>" type="text/css">
    <!-- date range stylesheet-->
    <link rel="stylesheet" href="<?php echo asset('public/vendor/daterange/css/daterangepicker.min.css') ?>" type="text/css">
    <!-- table sorter stylesheet-->
    <link rel="stylesheet" type="text/css" href="<?php echo asset('public/vendor/datatable/dataTables.bootstrap4.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.1.6/css/fixedHeader.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">


    <link rel="stylesheet" href="<?php echo asset('public/css/dropzone.css') ?>">

   
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->

        <script type="text/javascript" src="<?php echo asset('public/vendor/jquery/jquery.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo asset('public/vendor/jquery/jquery-ui.min.js') ?>"></script>
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
        <script type="text/javascript" src="<?php echo asset('public/vendor/datatable/buttons.bootstrap4.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo asset('public/vendor/datatable/buttons.colVis.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo asset('public/vendor/datatable/buttons.html5.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo asset('public/vendor/datatable/buttons.print.min.js') ?>"></script>
    
        <script type="text/javascript" src="<?php echo asset('public/vendor/datatable/sum().js') ?>"></script>
        <script type="text/javascript" src="<?php echo asset('public/vendor/datatable/dataTables.checkboxes.min.js') ?>"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script> 
       

        <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/style.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/jquery.mCustomScrollbar.css") }}">
        @yield('pagecss')
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/custom.css") }}">

    
</head>

<body>

        <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="loader-track">
            <div class="loader-bar"></div>
        </div>
    </div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            @include("layout-theme-gradient-able.topnav")

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    @include("layout-theme-gradient-able.sidebar")  
                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">

                            <div class="main-body">
                                <div class="page-wrapper">
								
                                    @hasSection('content')
{{-- content --}}
                                    <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3>@yield('title')</h3>
                                                    </div>
                                                    <div class="card-block">
                                                        @yield('content')
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
{{-- //content --}}
                                    @endif
 {{-- contentnoblock --}}
                                    @yield('contentnoblock')
 {{-- contentnoblock --}}

                                </div>
                            </div>
                            <div id="styleSelector">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Warning Section Starts -->
    <!-- Older IE warning message -->
<!--[if lt IE 9]>
<div class="ie-warning">
    <h1>Warning!!</h1>
    <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers
        to access this website.</p>
    <div class="iew-container">
        <ul class="iew-download">
            <li>
                <a href="http://www.google.com/chrome/">
                    <img src="{{ asset("assets/images/browser/chrome.png") }}" alt="Chrome">
                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <img src="{{ asset("assets/images/browser/firefox.png") }}" alt="Firefox">
                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <img src="{{ asset("assets/images/browser/opera.png") }}" alt="Opera">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <img src="{{ asset("assets/images/browser/safari.png") }}" alt="Safari">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <img src="{{ asset("assets/images/browser/ie.png") }}" alt="">
                    <div>IE (9 & above)</div>
                </a>
            </li>
        </ul>
    </div>
    <p>Sorry for the inconvenience!</p>
</div>
<![endif]-->
<!-- Warning Section Ends -->

<!-- Custom js -->

<script type="text/javascript" src="{{ asset("assets/js/script.js") }}"></script>
<script src="{{ asset("assets/js/pcoded.min.js") }}"></script>
<script src="{{ asset("assets/js/vartical-demo.js") }}"></script>

<script type="text/javascript">
    //   if ($(window).outerWidth() > 1199) {
    //       $('nav.side-navbar').removeClass('shrink');
    //   }

    //   function myFunction() {
    //       setTimeout(showPage, 150);
    //   }
    //   function showPage() {
    //     document.getElementById("loader").style.display = "none";
    //     document.getElementById("content").style.display = "block";
    //   }

    //   $("div.alert").delay(3000).slideUp(750);

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
/*
    //   $('.selectpicker').selectpicker({
    //       style: 'btn-link',
    //   });
    </script>

@yield('pagejs')
</body>

</html>
