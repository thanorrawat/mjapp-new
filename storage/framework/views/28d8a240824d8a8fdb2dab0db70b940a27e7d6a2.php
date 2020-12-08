 
<?php $__env->startSection('title',__('file.Supplier')); ?>
<?php $__env->startSection('pagecss'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
      <div class="table-responsive">
        <table class="table" id="supplierlist">
          <thead>
              <th>No.</th>
              <th><?php echo e(__('file.Code')); ?></th>
              <th><?php echo e(__('file.name')); ?></th>
              <th><?php echo e(__('file.Address')); ?></th>
              <th><?php echo e(__('file.Phone Number')); ?></th>
              <th><?php echo e(__('file.Credit')); ?></th>
              
             <th>Action</th>
          </thead>
          <tbody>
            <?php $num=1; ?>
            <?php $__currentLoopData = $supplierlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>   
            <tr>
              <td><?php echo e($num); ?></td>
              <td><?php echo e($supplier->suppliers_code); ?></td>
              <td><?php echo e($supplier->fullname); ?></td>
              <td><?php echo e($supplier->phone_number); ?></td>
              <td><?php echo e($supplier->address); ?></td>
              
             
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <?php $num++; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
      </table>
      </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('pagejs'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin_lte.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>