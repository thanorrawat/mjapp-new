 
<?php $__env->startSection('title',__('file.Purchase')); ?>
<?php $__env->startSection('pagecss'); ?>
<link rel="stylesheet" href="<?php echo e(asset('AdminLTE-3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('AdminLTE-3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>">

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
      <div class="table-responsive">
        
            <table class="table  table-bordered" id="purchaselist">
                <thead>
                    <tr>
                    
                     <th>PO</th>
                     <th>Date</th>
                     <th>Code</th>
                     <th>Detail</th>  
                     <th>Unit</th> 
                     <th>Order</th>		
                     		  				
          	
                     <th >ผลิต</th>		  				
                     	  				
          
                     <th >Stock</th>	  				

                       
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
                { data: 'po_date', name: 'po_date' },
    { data: 'poitems_productscode', name: 'poitems_productscode' },
              { data: 'poitems_productsname', name: 'poitems_productsname' },
              { data: 'poitems_unit', name: 'poitems_unit' },
              { data: 'poitems_qty', name: 'poitems_qty' },

              { data: 'sup_make', name: 'sup_make' },
              { data: 'sup_stock', name: 'sup_stock' },


       


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