 
<?php $__env->startSection('title',__('file.Purchase Order')); ?>
<?php $__env->startSection('pagecss'); ?>
<link rel="stylesheet" href="<?php echo e(asset('AdminLTE-3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('AdminLTE-3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('AdminLTE-3/plugins/sweetalert2/sweetalert2.min.css')); ?>">

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
      <div class="table-responsive">
        
            <table class="table  table-bordered" id="purchaselist">
                <thead>
                    <tr>
                    
                       
                      
                         <th>PO N.O.</th>
                         <th>Supplier</th>
                         <th>Total Items</th>
                         <th>Value</th>
                         <th>Status</th>
                         <th>Note</th>
                       
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>

  
        
      </div>




      <div id="poview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 id="exampleModalLabel" class="modal-title">PO</h5>
              <div class="text-right">
      
                <button id="print-btn" type="button" class="btn btn-outline-info btn-sm ml-3"><i class="dripicons-print"></i> <?php echo e(trans('file.Print')); ?></button>
                
                
              </div>
              <button type="button" id="close-btn" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
            </div>
            <div class="modal-body table-responsive" >
                <div id="product-detailsprint">
      
      
                </div>
      
            </div>
          </div>
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



<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<script>
        $('#purchaselist').DataTable({
      processing: true,
      serverSide: true,
      "ajax":{
      "url": "<?php echo e(url('purchase/polistdata')); ?>",
      "type": "GET",
      "data":{ csrf: "<?php echo e(csrf_token()); ?>"}
      
      },
      
      
             columns: [
     
      
                  { data: 'ponumber', name: 'ponumber' },
                  { data: 'supplierdt', name: 'supplierdt' },
                  { data: 'po_items', name: 'po_items' },
                  { data: 'po_grand_total', name: 'po_grand_total' },
                  { data: 'po_status', name: 'po_status' },
                  { data: 'poremark', name: 'poremark' },

              ]
              ,"aaSorting": [[0,'desc']]
              ,"columnDefs": [{
    className: "text-right",
    "targets": [ 2,3 ]
},{
  className: "text-center",
    "targets": [ 4 ]
}],
          });
    
        





          $(document).on("click", ".popopup", function(){
  
  $('#print-btn').attr('data-type','order') ;  
//let token= $(this).attr( "data-token" );
let ponumber = $(this).attr( "data-ponumber" );

$('#poview .modal-body').load('<?php echo e(url('purchase/po-view')); ?>/'+ponumber);       
$('#poview .modal-title').text(ponumber);   

//$('#pdf-btn').attr('href','https://mjfapp.com/order_pdf/'+token);   

 

});


$(document).on("click", ".sendpotosupplier", function(){
var poid= $(this).attr( "data-poid" ); 

swal({
  title: "Are you sure?",
  text: "ยืนยันการส่ง PO ไปยัง Supplier!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {

    
$('#frompo-'+poid).submit();

    swal("ส่ง PO ไปยัง Supplier เรียบร้อยแล้ว", {
      icon: "success",
    });
  } else {
    swal("PO ยังไม่ถูกส่ง");
  }
});
});




    </script>

<script>
  $("#print-btn").on("click", function(){
            var divToPrint=document.getElementById('poview');
            var newWin=window.open('','Print-Window');
            newWin.document.open();
            newWin.document.write('<link rel="stylesheet" href="https://mjfapp.com/assets/css/print.css" type="text/css"><style type="text/css">.modal-header{ display: none;},.modal-content{border: none;}@media        print {.modal-dialog { max-width: 1000px;}}</style><body onload="window.print()">'+divToPrint.innerHTML+'</body>');
            newWin.document.close();
            setTimeout(function(){newWin.close();},10);
      });
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin_lte.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>