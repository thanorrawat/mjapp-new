 
<?php $__env->startSection('title','Shipment List'); ?>
<?php $__env->startSection('pagecss'); ?>
<link rel="stylesheet" href="<?php echo e(asset('AdminLTE-3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('AdminLTE-3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="table-responsive">
<table class="table  table-bordered" id="purchaselist">
<thead>
  
<tr>

  <th  class="text-center">NO.</th>
  <th  class="text-center">Shipment NO.</th>
<th  class="text-center">จำนวนกล่องบรรจุ</th>
  <th  class="text-center">น้ำหนักรวม</th>
  <th  class="text-center">พื้นที่ที่ใช้รวม  </th>
  <th  class="text-center">ราคารวม  </th>
  <th class="text-center">View</th>
</tr>
</thead>
<tbody>
</tbody>
</table>
</div>
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
        $('#purchaselist').DataTable({
      processing: true,
      serverSide: true,
      "ajax":{
      "url": "<?php echo e(url('supplier/shipmentlistdata')); ?>",
      "type": "GET",
      "data":{ csrf: "<?php echo e(csrf_token()); ?>"}
      },
      columns: [
        {data: 'DT_RowIndex', name: 'id'},

{ data: 'sup_shipmentno', name: 'sup_shipmentno' },
{ data: 'total_box', name: 'total_box' },
{ data: 'total_weight', name: 'total_weight' },
{ data: 'total_usedarea', name: 'total_usedarea' },
{ data: 'total_amount', name: 'total_amount' },
{ data: 'view', name: 'view' },


],columnDefs: [
      { className: "text-center", "targets": [0,6] },
      { className: "text-right", "targets": [2,3,4,5] }
    ]
,"aaSorting": [0,'desc']
          });
$('body').on('change keyUp blur', '.sup_make,.sup_stock', function () { 
   var itemid =  $(this).attr('data-itemid');
   var stock =  $("#sup_stock-"+itemid).val();
   var make =  $("#sup_make-"+itemid).val();
   $.post( "<?php echo e(url('polistupdate')); ?>", {  csrf: "<?php echo e(csrf_token()); ?>",itemid :itemid,stock:stock,make:make})
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin_lte.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>