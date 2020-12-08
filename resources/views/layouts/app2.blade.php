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

    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/bootstrap/css/bootstrap.min.css") }}">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/icon/themify-icons/themify-icons.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/icon/font-awesome/css/font-awesome.min.css") }}">
    
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/icon/icofont/css/icofont.css") }}">
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
                                    <div class="alert alert-info" role="alert">
                                       ขณะนี้ท่านกำลังทดสอบระบบด้วยสิทธิ์การใช้งาน : {{ Auth::user()->role_id }}
                                      </div>	
                                    @hasSection('content')
{{-- content --}}
                                    <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3>@yield('title')</h3>
                                               <hr>
                                                   

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

<!-- Required Jquery -->
<script type="text/javascript" src="{{ asset("assets/js/jquery/jquery.min.js")}}"></script>
<script type="text/javascript" src="{{ asset("assets/js/jquery-ui/jquery-ui.min.js")}}"></script>
<script type="text/javascript" src="{{ asset("assets/js/popper.js/popper.min.js")}}"></script>
<script type="text/javascript" src="{{ asset("assets/js/bootstrap/js/bootstrap.min.js")}}"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="{{ asset("assets/js/jquery-slimscroll/jquery.slimscroll.js")}}"></script>
<!-- modernizr js -->
<script type="text/javascript" src="{{ asset("assets/js/modernizr/modernizr.js")}}"></script>
<script type="text/javascript" src="{{ asset("assets/js/modernizr/css-scrollbars.js")}}"></script>

<!-- Custom js -->
<script type="text/javascript" src="{{ asset("assets/js/script.js")}}"></script>
<script src="{{ asset("assets/js/pcoded.min.js")}}"></script>
<script src="{{ asset("assets/js/vartical-demo.js")}}"></script>
<script src="{{ asset("assets/js/jquery.mCustomScrollbar.concat.min.js")}}"></script>


@yield('pagejs')
</body>

</html>
