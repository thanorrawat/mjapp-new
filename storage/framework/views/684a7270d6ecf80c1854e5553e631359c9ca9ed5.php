 
<?php $__env->startSection('title','Shipment '.$shipmentdt->shipmentno); ?>
<?php $__env->startSection('pagecss'); ?>
<link rel="stylesheet" href="<?php echo e(asset('AdminLTE-3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('AdminLTE-3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<form  method="post" action="<?php echo e(url('supplier/shipment-update')); ?>">
<div class="table-responsive">
<?php echo csrf_field(); ?>
								
<table class="table  table-bordered" id="purchaselist">
  <thead><tr>
  <th>Total</th>
  <th class="text-right"><?php echo e(number_format($shipmentdt->total_box)); ?></th>
  <th></th>
  <th class="text-right"><?php echo e(number_format($shipmentdt->total_weight,2)); ?></th>
  <th></th>
  <th class="text-right"><?php echo e(number_format($shipmentdt->total_usedarea,4)); ?></th>
  <th>	</th>
  <th></th>
  <th class="text-right"><?php echo e(number_format($shipmentdt->total_amount,2)); ?></th>
          <th></th>					
          <th></th>					
  
  </tr>

  <tr>
    <th>Code</th>
    <th style="white-space: nowrap;">จำนวนกล่องบรรจุ</th>
    <th style="white-space: nowrap;">น้ำหนัก</th>
    <th style="white-space: nowrap;">น้ำหนักรวม</th>
    <th style="white-space: nowrap;">พื้นที่ที่ใช้</th>
    <th style="white-space: nowrap;">พื้นที่ที่ใช้รวม</th>
    <th style="white-space: nowrap;">ราคาต่อชิ้น	</th>
    <th style="white-space: nowrap;">ปริมาณ</th>
    <th style="white-space: nowrap;">ราคารวม</th>
            <th style="white-space: nowrap;">Supplier</th>					
            <th style="white-space: nowrap;">Ref.PO</th>					
    
    </tr>

    <tr>
    
      <th style="white-space: nowrap;">中国编号</th>
      <th style="white-space: nowrap;">CRT</th>
      <th style="white-space: nowrap;">公斤</th>
      <th style="white-space: nowrap;">总公斤</th>
      <th style="white-space: nowrap;">立方米</th>
      <th style="white-space: nowrap;">总立方米	</th>
      <th style="white-space: nowrap;">单价</th>
      <th style="white-space: nowrap;">数量</th>
              <th style="white-space: nowrap;">金额</th>					
              <th style="white-space: nowrap;">公司/电话</th>					
              <th style="white-space: nowrap;">Ref.PO</th>					
      
      </tr>




    									

  </thead>
<tbody>
<?php $__currentLoopData = $shipmentlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  

<tr>
<td style="white-space: nowrap;"><?php echo e($value->poitems_productscode); ?></td>
<td class="text-right"><input type="number" name="shipitem_box[]" class="text-right form-control"><?php echo e($value->shipitem_box); ?></td>
<td class="text-right"><input type="number" name="shipitem_weight[]" class="text-right form-control"><?php echo e($value->shipitem_weight); ?></td>
<td class="text-right"><input type="number" name="shipitem_totalweight[]" class="text-right form-control"><?php echo e($value->shipitem_totalweight); ?></td>
<td class="text-right"><input type="number" name="shipitem_area[]" class="text-right form-control"><?php echo e($value->shipitem_area); ?></td>
<td class="text-right"><input type="number" name="shipitem_totalarea[]" class="text-right form-control"><?php echo e($value->shipitem_totalarea); ?></td>
<td class="text-right"><input type="number" name="shipitem_price[]" class="text-right form-control"><?php echo e($value->shipitem_price); ?></td>
<td class="text-right"><input type="number" name="shipitem_qty[]" class="text-right form-control"><?php echo e($value->shipitem_qty); ?></td>
<td class="text-right"><input type="number" name="shipitem_totalprice[]" class="text-right form-control"><?php echo e($value->shipitem_totalprice); ?></td>
<td class="text-right"><input type="text" name="shipitem_supplier[] " class="form-control"><?php echo e($value->shipitem_supplier); ?></td>
<td class="text-right"><input type="text" name="shipitem_shipitem_po[]" class="form-control" ><?php echo e($value->shipitem_po); ?></td>



</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
</table>
</div>
<div class="text-center mt-2"> 
  <input type="hidden" name="po_id" value="<?php echo e($shipmentdt->id); ?>">
  
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