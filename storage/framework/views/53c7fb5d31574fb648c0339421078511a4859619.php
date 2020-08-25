<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <meta name="user-id" content="<?php echo e(Auth::user()->id); ?>">
  <title><?php echo $__env->yieldContent('title'); ?> : <?php echo e($general_setting->site_title); ?></title>
  <link rel="icon" type="image/png" href="<?php echo e(url('public/logo', $general_setting->site_logo)); ?>" />
  <link rel="stylesheet" href="<?php echo e(asset('node_modules/buefy/dist/buefy.min.css')); ?>"">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo e(asset('AdminLTE-3/plugins/fontawesome-free/css/all.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('AdminLTE-3/plugins/font-awesome/css/font-awesome.min.css')); ?>">

  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo e(asset('AdminLTE-3/dist/css/adminlte.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('AdminLTE-3/dist/css/custom.css')); ?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css2?family=Sarabun&display=swap" rel="stylesheet">

<style>
 body, .h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6{
  font-family: 'Sarabun', sans-serif;
  }
</style>
  <?php echo $__env->yieldContent('pagecss'); ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <?php echo $__env->make("Admin_lte.topnav", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
   <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php echo $__env->make("Admin_lte.sidebar", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php echo $__env->yieldContent('title'); ?></h1>
          </div><!-- /.col -->
      
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="main-content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">

            <?php echo $__env->yieldContent('contentnoblock'); ?>

            <?php if (! empty(trim($__env->yieldContent('content')))): ?>
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>

                <p class="card-text">
                  Some quick example text to build on the card title and make up the bulk of the card's
                  content.
                </p>

                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
              </div>
            </div>
            <?php endif; ?>


          </div>

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">

    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; <?php echo e(date('Y')); ?> MJ Fablic.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?php echo e(asset('AdminLTE-3/plugins/jquery/jquery.min.js')); ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo e(asset('AdminLTE-3/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo e(asset('AdminLTE-3/dist/js/adminlte.min.js')); ?>"></script>

<script>
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
<?php echo $__env->make('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->yieldContent('pagejs'); ?>
<script src="<?php echo e(url('public/js/app.js')); ?>"></script>
</body>
</html>

