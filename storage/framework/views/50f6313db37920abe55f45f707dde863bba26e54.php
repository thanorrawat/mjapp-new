 
<?php if($pagetype=="add"): ?>
<?php $__env->startSection('title',  'จัดทำ Order/ใบจอง'); ?>
<?php elseif($pagetype=="edit"): ?>
<?php $__env->startSection('title',  'ทำรายการ'.$doctypename." เลขที่ ".$docnumber); ?>
<?php endif; ?>  
<?php $__env->startSection('titlenoblock',  'จัดทำ Order/ใบจอง'); ?>


<?php $__env->startSection('pagecss'); ?>
   <!-- iCheck for checkboxes and radio inputs -->
   <link rel="stylesheet" href="<?php echo e(asset('AdminLTE-3/plugins/icheck-bootstrap/icheck-bootstrap.min.css')); ?>">
     <!-- Select2 -->
 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentnoblock'); ?>

<div id="app">
  <?php if($pagetype=="add"): ?>
<order-selectcustomer baseurl="<?php echo e($baseurl); ?>"  userfullname="<?php echo e(Auth::user()->fullname); ?>" userid="<?php echo e(Auth::user()->id); ?>"></order-selectcustomer>
<?php elseif($pagetype=="edit"): ?>
<product-search baseurl="<?php echo e($baseurl); ?>"  orderid="<?php echo e($orderid); ?>"  showsearchtype="<?php echo e($searchtype); ?>"  userfullname="<?php echo e(Auth::user()->fullname); ?>" userid="<?php echo e(Auth::user()->id); ?>" ></product-search>
<?php endif; ?>   
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pagejs'); ?>

<?php if(session('status')): ?>
<?php if(session('statustype')=='success'): ?>
<?php Alert::success(session('statustitle'), session('status')); ?>
<?php elseif(session('statustype')=='error'): ?>
<?php Alert::error(session('statustitle'), session('status')); ?>
<?php endif; ?>
<?php endif; ?>

<script>
  $('body').addClass('sidebar-mini sidebar-collapse');
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin_lte.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>