 

<?php $__env->startSection('title',  'Show Status'); ?>
 
<?php $__env->startSection('titlenoblock',  'Show Status'); ?>


<?php $__env->startSection('pagecss'); ?>
   <!-- iCheck for checkboxes and radio inputs -->
   <link rel="stylesheet" href="<?php echo e(asset('AdminLTE-3/plugins/icheck-bootstrap/icheck-bootstrap.min.css')); ?>">
       <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo e(asset('AdminLTE-3/plugins/select2/css/select2.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('AdminLTE-3/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')); ?>">
    <!-- daterange picker -->
    <link rel="stylesheet" href="<?php echo e(asset('AdminLTE-3/plugins/daterangepicker/daterangepicker.css')); ?>">
    
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<table class="table table-bordered">
<thead>

  <th>id</th>
  <th> st_id</th>
  <th>  type</th>
  <th>  statusname</th>
  <th>  color</th>
  <th> icon</th>
  <th> timeline_remark</th>

   
</thead>
<tbody>
<?php $__currentLoopData = $statusname; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $statusnamerow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
<td><?php echo e($statusnamerow->id); ?></td>
<td><?php echo e($statusnamerow->st_id); ?></td>
<td><?php echo e($statusnamerow->type); ?></td>
<td><?php echo e($statusnamerow->statusname); ?></td>
<td> <button class="btn" style="background-color:<?php echo e($statusnamerow->color); ?> "><i class="fa fa-<?php echo e($statusnamerow->icon); ?>"></i> <?php echo e($statusnamerow->statusname); ?></button></td>
<td> <i class="fa fa-<?php echo e($statusnamerow->icon); ?>"></i></td>
<td><?php echo e($statusnamerow->timeline_remark); ?></td>

</tr>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</tbody>
</table>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pagejs'); ?>
<script src="<?php echo e(asset('AdminLTE-3/plugins/moment/moment.min.js')); ?>"></script>
<!-- Select2 -->
<script src="<?php echo e(asset('AdminLTE-3/plugins/select2/js/select2.full.min.js')); ?>"></script>

<!-- date-range-picker -->
<script src="<?php echo e(asset('AdminLTE-3/plugins/daterangepicker/daterangepicker.js')); ?>"></script>


<?php if(session('status')): ?>
<?php if(session('statustype')=='success'): ?>
<?php Alert::success(session('statustitle'), session('status')); ?>
<?php elseif(session('statustype')=='error'): ?>
<?php Alert::error(session('statustitle'), session('status')); ?>
<?php endif; ?>
<?php endif; ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin_lte.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>