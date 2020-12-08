 
<?php $__env->startSection('title', 'Product Tracking'); ?>
<?php $__env->startSection('content'); ?>
<table class="table table-bordered">
    <thead>
        <th>Date</th>
        <th>ทำรายการ</th>
        <th>จำนวน</th>
        <th>เอกสาร</th>
        <th>คลังพร้อมขาย</th>
        <th>คลัง Order</th>
        <th>คลังจอง</th>
        <th>รายการ S.O.</th>
    </thead>
    <tbody>
<?php $__currentLoopData = $tracking; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $track): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
    <td><?php echo e($track->created_at); ?></td>
    <td><?php echo e($track->comment); ?></td>
    <td><?php echo e($track->product_qty); ?></td>
    <td><?php echo e($track->ref_no); ?></td>
  
    <td><?php echo e($track->stocktype_1); ?></td>
    <td><?php echo e($track->stocktype_2); ?></td>
    <td><?php echo e($track->stocktype_3); ?></td>
    <td><?php echo e($track->stocktype_3); ?></td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
    </tbody>
</table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout-theme-gradient-able.app2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>