<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <title><?php echo $__env->yieldContent('title'); ?> : <?php echo e($general_setting->site_title); ?></title>
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
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" href="<?php echo e(url('public/logo', $general_setting->site_logo)); ?>" />
    <!-- Google font--><link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300&display=swap" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset("assets/css/bootstrap/css/bootstrap.min.css")); ?>">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset("assets/icon/themify-icons/themify-icons.css")); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset("assets/icon/font-awesome/css/font-awesome.min.css")); ?>">

    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset("assets/icon/icofont/css/icofont.css")); ?>">


    
    <!-- Bootstrap CSS-->
    
    <link rel="stylesheet" href="<?php echo asset('public/vendor/bootstrap-toggle/css/bootstrap-toggle.min.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('public/vendor/bootstrap/css/bootstrap-datepicker.min.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('public/vendor/jquery-timepicker/jquery.timepicker.min.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('public/vendor/bootstrap/css/awesome-bootstrap-checkbox.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('public/vendor/bootstrap/css/bootstrap-select.min.css') ?>" type="text/css">
    
    <!-- Drip icon font-->
    <link rel="stylesheet" href="<?php echo asset('public/vendor/dripicons/webfont.css') ?>" type="text/css">
    
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset("assets/css/bootstrap/css/bootstrap.min.css")); ?>">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset("assets/icon/themify-icons/themify-icons.css")); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset("assets/icon/font-awesome/css/font-awesome.min.css")); ?>">
    
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset("assets/icon/icofont/css/icofont.css")); ?>">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset("assets/css/style.css")); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset("assets/css/jquery.mCustomScrollbar.css")); ?>">
    <link rel="stylesheet" href="<?php echo e(asset("assets/css/jquery.toast.css")); ?>">
        <?php echo $__env->yieldContent('pagecss'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset("assets/css/custom.css")); ?>">

<style>
#loadingDiv{
    position: fixed;
    left: 50%;
    top: 40%;
    width: 100px;
    height: 100px;
    margin-left: -50px;
    z-index: 999999999;

}

.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes  spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>


    
</head>

<body>
    <div id="loadingDiv"> <div class="loader"></div></div>
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

            <?php echo $__env->make("layout-theme-gradient-able.topnav", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <?php echo $__env->make("layout-theme-gradient-able.sidebar", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>  
                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">

           

                            <div class="main-body">

                                <div class="page-wrapper">
                                    
                                    <div class="alert alert-info" role="alert">
                                        <?php     $permissionname= DB::table('roles')
                                       ->where('id', Auth::user()->role_id)
                                        ->select(['name'])
                                        ->first();

                                         ?>
                                        ขณะนี้ท่านกำลังทดสอบระบบด้วยสิทธิ์การใช้งาน : <?php echo e($permissionname->name); ?>

                                       </div>	
                                <?php if (! empty(trim($__env->yieldContent('titlenoblock')))): ?>
                                <h2><?php echo $__env->yieldContent('titlenoblock'); ?></h2>
                                <?php endif; ?>                      
                                    <?php if (! empty(trim($__env->yieldContent('content')))): ?>

                                    <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h1><?php echo $__env->yieldContent('title'); ?></h1>
                                                                                         

                                                    </div>
                                                    <div class="card-block">
                                                        <?php echo $__env->yieldContent('content'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php endif; ?>
 

                                    <?php echo $__env->yieldContent('contentnoblock'); ?>
 

                                
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
                    <img src="<?php echo e(asset("assets/images/browser/chrome.png")); ?>" alt="Chrome">
                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <img src="<?php echo e(asset("assets/images/browser/firefox.png")); ?>" alt="Firefox">
                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <img src="<?php echo e(asset("assets/images/browser/opera.png")); ?>" alt="Opera">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <img src="<?php echo e(asset("assets/images/browser/safari.png")); ?>" alt="Safari">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <img src="<?php echo e(asset("assets/images/browser/ie.png")); ?>" alt="">
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
<script type="text/javascript" src="<?php echo e(asset("assets/js/jquery/jquery.min.js")); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset("assets/js/jquery-ui/jquery-ui.min.js")); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset("assets/js/popper.js/popper.min.js")); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset("assets/js/bootstrap/js/bootstrap.min.js")); ?>"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="<?php echo e(asset("assets/js/jquery-slimscroll/jquery.slimscroll.js")); ?>"></script>
<!-- modernizr js -->
<script type="text/javascript" src="<?php echo e(asset("assets/js/modernizr/modernizr.js")); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset("assets/js/modernizr/css-scrollbars.js")); ?>"></script>

<!-- Custom js -->
<script type="text/javascript" src="<?php echo e(asset("assets/js/script.js")); ?>"></script>
<script src="<?php echo e(asset("assets/js/pcoded.min.js")); ?>"></script>
<script src="<?php echo e(asset("assets/js/vartical-demo.js")); ?>"></script>
<script src="<?php echo e(asset("assets/js/jquery.mCustomScrollbar.concat.min.js")); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset("assets/js/jquery.toast.js")); ?>"></script>
<script>


var SITEURL = '<?php echo e(URL::to('')); ?>';
 $(document).ready( function () {
   $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  });



$('body').on('click', '.add-to-cart', function () { //เพิ่มสินค้าลงตะกร้า

let code = $(this).attr("data-code");
let productid= $(this).attr("data-productid");
let price = $(this).attr("data-price");
let stock = $(this).attr("data-stock");
let orderqty = $(this).attr("data-addqty"); 


      $.ajax({
  method: "POST",
  url: "<?php echo e(url('addcart')); ?>",
  data: { productscode: code, price: price, stocknow:stock,orderqty:orderqty,productid:productid }
})
  .done(function(data) {
      $("#topcart").load("<?php echo e(url("viewcart")); ?>");
      if(data['alert'] !=null){
        $.toast({
    heading: 'Success',
    text: data['alert'],
    icon: 'success',
    loader: true, 
    position: 'bottom-right',
      // Change it to false to disable loader
      bgColor: '#9EC600'  // To change the background
})

      }

      if(data['alertfalse'] !=null){
        $.toast({
    heading: 'Alert',
    text: data['alertfalse'],
    icon: 'warning',
    loader: true, 
      // Change it to false to disable loader
    bgColor: '#FF1356',
    position: 'bottom-right',
    textColor: 'white'
})

      }





  });


});
$( document ).ready(function() {
$('#loadingDiv').hide();
});
    </script>
<?php echo $__env->yieldContent('pagejs'); ?>
</body>

</html>
