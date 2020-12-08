<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{trans('file.LogIn')}} : {{$general_setting->site_title}} </title>
    <!-- HTML5 Shim and Respond.js IE9 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" href="{{url('public/logo', $general_setting->site_logo)}}" />
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css2?family=Sarabun&display=swap" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/bootstrap/css/bootstrap.min.css") }}">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/icon/themify-icons/themify-icons.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/icon/font-awesome/css/font-awesome.min.css") }}">
    
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/icon/icofont/css/icofont.css") }}">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/style.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/custom.css") }}">
</head>

<body class="fix-menu">
        <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="loader-track">
            <div class="loader-bar"></div>
        </div>
    </div>
    <!-- Pre-loader end -->

    <section class="login p-fixed d-flex text-center bg-primary common-img-bg">
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->
                    <div class="login-card card-block auth-body mr-auto ml-auto">
                        @if(session()->has('delete_message'))
                        <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('delete_message') }}</div> 
                        @endif
                        @if ($errors->has('name'))
                        <p>
                            <strong>{{ $errors->first('name') }}</strong>
                        </p>
                    @endif
                 
                        <form class="md-float-material" method="POST" action="{{ route('login') }}" >
                            <div class="text-center">
                                <img src="{{url('public/logo', $general_setting->site_logo)}}" alt="logo.png">
                            </div>
                            @if(session()->has('delete_message'))
                            <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('delete_message') }}</div> 
                            @endif
                         
                                @csrf
                            <div class="auth-box">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-left txt-primary">{{trans('file.LogIn')}}</h3>
                                    </div>
                                </div>
                                <hr/>
                                <div class="input-group">
                                    <input name="name" required  type="text" class="form-control" placeholder="{{trans('file.UserName')}}">
                                    <span class="md-line"></span>
                                </div>
                                <div class="input-group">
                                    <input type="password" class="form-control" placeholder="{{trans('file.Password')}}"  name="password" required >
                                    <span class="md-line"></span>
                                </div>
                                <div class="row m-t-25 text-left">
                                    {{-- <div class="col-sm-7 col-xs-12">
                                        <div class="checkbox-fade fade-in-primary">
                                            <a href="{{ route('password.request') }}" class="text-right f-w-600 text-inverse"> {{trans('file.Forgot Password?')}}</a>
                                        </div>
                                    </div> --}}
                                    {{-- <div class="col-sm-5 col-xs-12 forgot-phone text-right">
                                        <a href="{{ route('password.request') }}" class="text-right f-w-600 text-inverse"> {{trans('file.Forgot Password?')}}</a>
                                    </div> --}}
                                </div>
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">{{trans('file.LogIn')}}</button>
                                    </div>
                                </div>
                                {{-- <hr/>
                                <div class="row">
                                    <div class="col-md-10">
                                        <p class="text-inverse text-left m-b-0">Thank you and enjoy our website.</p>
                                        <p class="text-inverse text-left"><b>Your Authentication Team</b></p>
                                    </div>
                                    <div class="col-md-2">
                                        <img src="assets/images/auth/Logo-small-bottom.png" alt="small-logo.png">
                                    </div>
                                </div> --}}

                            </div>
                        </form>
                        <!-- end of form -->
                    </div>
                    <!-- Authentication card end -->
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>
    <!-- Warning Section Starts -->
    <!-- Older IE warning message -->
    <!--[if lt IE 9]>
<div class="ie-warning">
    <h1>Warning!!</h1>
    <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
    <div class="iew-container">
        <ul class="iew-download">
            <li>
                <a href="http://www.google.com/chrome/">
                    <img src="assets/images/browser/chrome.png" alt="Chrome">
                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <img src="assets/images/browser/firefox.png" alt="Firefox">
                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <img src="assets/images/browser/opera.png" alt="Opera">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <img src="assets/images/browser/safari.png" alt="Safari">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <img src="assets/images/browser/ie.png" alt="">
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
    <script type="text/javascript" src="assets/js/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="assets/js/popper.js/popper.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap/js/bootstrap.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="assets/js/jquery-slimscroll/jquery.slimscroll.js"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="assets/js/modernizr/modernizr.js"></script>
    <script type="text/javascript" src="assets/js/modernizr/css-scrollbars.js"></script>
    <script type="text/javascript" src="assets/js/common-pages.js"></script>
</body>

</html>
