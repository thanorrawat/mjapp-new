 
<?php $__env->startSection('title',$podt->ponumber); ?>
<?php $__env->startSection('pagecss'); ?>
<link rel="stylesheet" href="<?php echo e(asset('AdminLTE-3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('AdminLTE-3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<form  method="post" action="<?php echo e(url('supplier/purchase-update')); ?>">
<div class="table-responsive">
<?php echo csrf_field(); ?>
<div class="text-right">
<?php if($podt->po_status==21): ?>
<span class="btn btn-warning"><i  class="fas fa-tasks"></i> <?php echo e(__('file.postatus_'.$podt->po_status)); ?></span>
<?php elseif($podt->po_status==3): ?>
<span class="btn btn-success"><i class="fas fa-clipboard-check"></i> <?php echo e(__('file.postatus_'.$podt->po_status)); ?></span>
</div>
<?php endif; ?>
<table class="table  table-bordered" id="purchaselist">
<thead><tr>
<th>NO.</th>
<th>CODE</th>
<th>Detail</th>
<th>QTY</th>
<th>Unit</th>
<th>Produce</th>
<th>Stock</th>
<th>Shipment NO.</th>
<th>About load</th>
  			<th>#</th>					

</tr>
</thead>
<tbody>
  <?php $__currentLoopData = $poitems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    
 
  <tr>
<td class="text-center"><?php echo $key+1; ?></td>
<td><?php echo e($value->poitems_productscode); ?></td>
<td><?php echo e($value->poitems_productsname); ?></td>
<td class="text-right"><?php echo e($value->poitems_qty); ?></td>
<td class="text-center"><?php echo e($value->poitems_unit); ?></td>
<td><input name="produce[]" id="produce_<?php echo e($value->id); ?>" class="text-right form-control" type="number" value="<?php echo e($value->sup_make); ?>"></td>
<td><input name="stock[]" id="stock_<?php echo e($value->id); ?>" class="text-right form-control" type="number"  value="<?php echo e($value->sup_stock); ?>"></td>
<td><input data-poitemid="<?php echo e($value->id); ?>" name="shipment[]" id="shipment_<?php echo e($value->id); ?>" class="form-control shipmentno" type="text"  value="<?php echo e($value->sup_shipmentno); ?>"></td>
<td><input name="aboutload[]" id="aboutload_<?php echo e($value->id); ?>" class="form-control" type="text" value="<?php echo e($value->sup_aboutload); ?>"></td>
<td><span  id="finish_<?php echo e($value->id); ?>">
<?php if($value->item_status>=3): ?>
<i class="far fa-check-circle"></i>
<?php endif; ?>
</span>
  <input type="hidden" name="poitem_id[]" value="<?php echo e($value->id); ?>">
  <input type="hidden" id="itemstatus_<?php echo e($value->id); ?>"  name="poitem_status[]" value="<?php echo e($value->item_status); ?>">

</td>


  </tr>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
</table>
</div>
<div class="text-center mt-2"> 
  <input type="hidden" name="po_id" value="<?php echo e($podt->id); ?>">
  
  <button type="submit" class="btn btn-primary">Submit</button></div>
</form>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('pagejs'); ?>
<!-- DataTables -->
<script src="<?php echo e(asset('AdminLTE-3/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('AdminLTE-3/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('AdminLTE-3/plugins/datatables-responsive/js/dataTables.responsive.min.js')); ?>"></script>
<script src="<?php echo e(asset('AdminLTE-3/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('AdminLTE-3/plugins/datatables-buttons/js/buttons.html5.js')); ?>"></script>
<script src="<?php echo e(asset('AdminLTE-3/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')); ?>"></script>
<script>


$('body').on('change keyUp blur', '.shipmentno', function () { 
   var itemis=  $(this).attr('data-poitemid');
   var shipmentno =  $(this).val();
var itemstatus =$("#itemstatus_"+itemis).val();
   if(shipmentno.length>2){
    $("#finish_"+itemis).html('<i class="far fa-check-circle"></i>');
    console.log(itemstatus);
if(itemstatus==2){
  $("#itemstatus_"+itemis).val(3);
}

   }else{
$("#finish_"+itemis).html('');
$("#itemstatus_"+itemis).val(2);
   }

    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin_lte.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>