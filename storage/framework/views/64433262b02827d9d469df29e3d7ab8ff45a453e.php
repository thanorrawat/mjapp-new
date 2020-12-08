 
<?php $__env->startSection('title',  __('file.dashboard')); ?>
<?php $__env->startSection('pagecss'); ?>
 <!-- Ionicons -->
 <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

<link rel="stylesheet" href="<?php echo e(asset('AdminLTE-3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('AdminLTE-3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentnoblock'); ?>

<div class="row">
    <div class="col-md-12 col-lg-6">
<div class="brand-text float-left ">
    <h3><?php echo e(trans('file.welcome')); ?> คุณ <span><?php echo e(Auth::user()->fullname); ?></span> </h3>  

</div>
</div>
</div>
    <div class="row">
          <!-- order-card start -->
          <div class="col-md-6 col-xl-3">
                       <div class="small-box bg-info">
                <div class="inner">
                  <h3><?php echo e($countorder); ?></h3>
  
                  <p>New Orders</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
          </div>
         
          <div class="col-md-6 col-xl-3">

            <div class="small-box bg-success">
                <div class="inner">
                  <h3><?php echo e($countbooking); ?></h3>
  
                  <p>จำนวนใบจอง</p>
                </div>
                <div class="icon">
                    <i class="fas fa-book"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>


  
          </div>
          <div class="col-md-6 col-xl-3">

            <div class="small-box bg-danger">
                <div class="inner">
                  <h3><?php echo e($countso); ?></h3>
  
                  <p>Sale Order</p>
                </div>
                <div class="icon">
                  <i class="fas fa-chart-pie"></i>
                </div>
                <a href="#" class="small-box-footer">
                  More info <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>


          </div>

    <div class="col-md-6 col-xl-3">

        <div class="small-box bg-primary">
            <div class="inner">
              <h3><?php echo e(number_format($countpd)); ?></h3>

              <p>รายการสินค้า</p>
            </div>
            <div class="icon">
              <i class="fas fa-boxes"></i>
            </div>
            <a href="#" class="small-box-footer">
              More info <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div> 
  
        <div class="col-md-6">
        <div class="card">
          <div class="card-header border-transparent">
            <h3 class="card-title"><?php echo e(__('file.Order Wait for approval')); ?> </h3>


            
          </div>
          <!-- /.card-header -->
          <div class="card-body p-1">
            <div class="table-responsive">
              <table class="table m-0" id="ordernotapprove">
                <thead>
                <tr>
           <th>Order No.</th>
           <th>ลูกค้า</th>
           <th>Due Date</th>
           <th>Due Date</th>
           <th>สถานะ</th>
           <th>Action</th>
                </tr>
                </thead>
                <tbody>
    
                </tbody>
              </table>
            </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer text-center">
            <a style="    width: 100%;" href="<?php echo e(url('order-list')); ?>" class="uppercase"> <?php echo e(__('file.View All')); ?> </a>
          </div>
          <!-- /.card-footer -->
        </div>
      </div>
  

      <div class="col-md-6">
        <div class="card">
          <div class="card-header border-transparent">
            <h3 class="card-title"><?php echo e(__('file.Booking Wait for approval')); ?> </h3>


            
          </div>
          <!-- /.card-header -->
          <div class="card-body p-1">
            <div class="table-responsive">
              <table class="table m-0" id="bookingnotapprove">
                <thead>
                <tr>
           <th>Order No.</th>
           <th>ลูกค้า</th>
           <th>Due Date</th>
           <th>Due Date</th>
           <th>สถานะ</th>
           <th>Action</th>
                </tr>
                </thead>
                <tbody>
    
                </tbody>
              </table>
            </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer text-center">
            <a style="    width: 100%;"  href="<?php echo e(url('booking-list')); ?>" class="uppercase"> <?php echo e(__('file.View All')); ?> </a>
          </div>
          <!-- /.card-footer -->
        </div>
      </div>
    </div>
      
          <!-- statustic and process end -->
          <!-- tabs card start -->
          

      
  
      <div id="product-details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 id="exampleModalLabel" class="modal-title"><?php echo e(trans('Order Details')); ?></h5>
              <div class="text-right">

                <button id="print-btn" type="button" class="btn btn-outline-info btn-sm ml-3"><i class="dripicons-print"></i> <?php echo e(trans('file.Print')); ?></button>
                <a href="" id="pdf-btn" target="_blank" type="button" class="btn btn-outline-info btn-sm ml-3"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF</a>
                
              </div>
              <button type="button" id="close-btn" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
            </div>
            <div class="modal-body table-responsive" >
                <div id="product-detailsprint">


                </div>
    
            </div>
          </div>
        </div>
        <memo-price baseurl="<?php echo e(url('/')); ?>"  userfullname="<?php echo e(Auth::user()->fullname); ?>" userid="<?php echo e(Auth::user()->id); ?>" csrf="<?php echo e(csrf_token()); ?>" role_id="<?php echo e(Auth::user()->role_id); ?>" homepage="1"></memo-price>
</div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('pagejs'); ?>



<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>


<!-- DataTables -->
<script src="<?php echo e(asset('AdminLTE-3/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('AdminLTE-3/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('AdminLTE-3/plugins/datatables-responsive/js/dataTables.responsive.min.js')); ?>"></script>
<script src="<?php echo e(asset('AdminLTE-3/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')); ?>"></script>



<script>
  $('#ordernotapprove').DataTable({
  processing: true,
  serverSide: true,
  "ajax":{
  "url": "<?php echo e(url("orderdata")); ?>",
  "type": "GET",
  "data":{ csrf: "<?php echo e(csrf_token()); ?>",ordertype : "order",approved : 1}
  
  },
  
  
         columns: [
          { data: 'ordernumberfull', name: 'ordernumberfull' },
              { data: 'customer_name', name: 'customer_name' },
              { data: 'deliverydate', name: 'deliverydate' },
              { data: 'createby_name', name: 'createby_name' },
              { data: 'statusname', name: 'statusname' },
              { data: 'action3', name: 'action3' }
  
          ]
          ,
          "order": [[ 0, 'desc' ]]


      });
////-
$('#bookingnotapprove').DataTable({
  processing: true,
  serverSide: true,
  "ajax":{
  "url": "<?php echo e(url("orderdata")); ?>",
  "type": "GET",
  "data":{ csrf: "<?php echo e(csrf_token()); ?>",ordertype : "booking",approved : 1}
  
  },
  
  
         columns: [
          { data: 'bookingnumber', name: 'bookingnumber' },

              { data: 'customer_name', name: 'customer_name' },
              { data: 'deliverydate', name: 'deliverydate' },
              { data: 'createby_name', name: 'createby_name' },
              { data: 'statusname', name: 'statusname' },
              { data: 'action3', name: 'action3' }
  
          ]
          ,
          "order": [[ 0, 'desc' ]]


      });
      ////-
  
     $(document).on("click", ".orderpopup", function(){
      $('#print-btn').attr('data-type','order') ;  
    let token= $(this).attr( "data-token" );
    let ordernumber = $(this).attr( "data-ordernumber" );
  
  $('#product-details .modal-body').load('<?php echo e(url("order_view")); ?>/'+token);       
  $('#product-details .modal-title').text(ordernumber);   
  
  $('#pdf-btn').attr('href','<?php echo e(url("order_pdf")); ?>/'+token);   

     
  
  });
  </script>




<script>
$("#print-btn").on("click", function(){
          var divToPrint=document.getElementById('product-details');
          var newWin=window.open('','Print-Window');
          newWin.document.open();
          newWin.document.write('<link rel="stylesheet" href="<?php echo e(asset('assets/css/custom.css')); ?>" type="text/css"><style type="text/css">.modal-header{ display: none;},.modal-content{border: none;}@media    print {.modal-dialog { max-width: 1000px;}}</style><body onload="window.print()">'+divToPrint.innerHTML+'</body>');
          newWin.document.close();
          setTimeout(function(){newWin.close();},10);
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin_lte.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>