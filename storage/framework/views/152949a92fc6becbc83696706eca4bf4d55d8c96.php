 
<?php $__env->startSection('title','Order Number : '.$cartDetails->ordernumberfull); ?>
<?php $__env->startSection('titlenoblock','Order Number : '.$cartDetails->ordernumberfull); ?>
<?php $__env->startSection('pagecss'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentnoblock'); ?>
<section>
<div class="row">
     <div class="col-md-12">
        <div class="card" id="card-selectproduct">
            <div class="card-block" id="orderdt">

 </div>
        </div>
    </div>
  </div>

   
</section>



<div id="product-details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title"><?php echo e(trans('Product Details')); ?></h5>
          <button id="print-btn" type="button" class="btn btn-default btn-sm ml-3"><i class="dripicons-print"></i> <?php echo e(trans('file.Print')); ?></button>
          <button type="button" id="close-btn" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
        </div>
        <div class="modal-body">
         
        </div>
      </div>
    </div>
</div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('pagejs'); ?>
<script>
  let orderurl = '<?php echo e(url('order_view', $cartDetails->token)); ?>';
  $("#orderdt").load(orderurl)
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout-theme-gradient-able.app2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>