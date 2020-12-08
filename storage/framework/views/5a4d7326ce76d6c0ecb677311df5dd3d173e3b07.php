 
<?php $__env->startSection('title',__('file.Purchase Order')); ?>
<?php $__env->startSection('pagecss'); ?>
<link rel="stylesheet" href="<?php echo e(asset('AdminLTE-3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('AdminLTE-3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="table-responsive">
<table class="table  table-bordered" id="purchaselist">
<thead><tr>
  <th></th>
  <th></th>

<th colspan="2" class="text-center">Status</th>
 	
			

</tr>
<tr>
  <th  class="text-center">PO NO.</th>
<th  class="text-center">ชื่อ Supplier</th>
  <th  class="text-center">VIEW</th>
  <th  class="text-center">finish</th>
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
      "url": "<?php echo e(url('polistforcheckdata')); ?>",
      "type": "GET",
      "data":{ csrf: "<?php echo e(csrf_token()); ?>"}
      },
      columns: [
{ data: 'ponumber', name: 'ponumber' },
{ data: 'supplier_name', name: 'supplier_name' },
{ data: 'po_view', name: 'po_view' },
{ data: 'po_status', name: 'po_status' },

],columnDefs: [
      { className: "text-center", "targets": [2,3] },
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