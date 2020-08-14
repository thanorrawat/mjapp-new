 
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
   
          <!-- order-card end -->
          <!-- statustic and process start -->
          
      
          <!-- statustic and process end -->
          <!-- tabs card start -->
          <div class="col-sm-12">
              <div class="card tabs-card">
                <div class="card-header">
                    <h5>รายการ Order</h5>
                </div>  <div class="card-body">
                  <div class="card-block p-0">
          
                                    <div class="tab-content card-block">
                          <div class="tab-pane active" id="home3" role="tabpanel">

                              <div class="table-responsive">

                                <table class="table" id="order-data-table">
                                    <thead>
                                        <th>Order No.</th>
                                        <th>ลูกค้า</th>
                                        <th>Due Date</th>
                                        <th>ทำรายการเมื่อ</th>
                                        <th>ผู้ทำรายการ</th>
                                        <th>สถานะ</th>
                                        <th>เอกสาร</th>
                                        <th>Action</th>
                                    </thead>
                                </table>




                                 
                              </div>
                              </div>
                              </div>
                              </div>
                            </div>
      </div></div>

      <div class="col-sm-12">
        <div class="card tabs-card">
          <div class="card-header">
              <h5>รายการ ใบจอง</h5>
          </div>
          <div class="card-body">
            <div class="card-block p-0">
    
                              <div class="tab-content card-block">
                    <div class="tab-pane active" id="home3" role="tabpanel">

                        <div class="table-responsive">

                          <table class="table" id="booking-data-table">
                              <thead>
                                  <th>Order No.</th>
                                  <th>ลูกค้า</th>
                                  <th>Due Date</th>
                                  <th>ทำรายการเมื่อ</th>
                                  <th>ผู้ทำรายการ</th>
                                  <th>สถานะ</th>
                                  <th>เอกสาร</th>
                                  <th>Action</th>
                              </thead>
                          </table>




                           
                        </div>
                        </div>
                        </div>
                        </div>
                      </div>
</div></div>
  
      <div id="product-details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 id="exampleModalLabel" class="modal-title"><?php echo e(trans('Order Details')); ?></h5>
              <div class="text-right">

                <button id="print-btn" type="button" class="btn btn-outline-info btn-sm ml-3"><i class="dripicons-print"></i> <?php echo e(trans('file.Print')); ?></button>
                <a href="" id="pdf-btn" target="_blank" type="button" class="btn btn-outline-info btn-sm ml-3"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF</a>
                
              </div>
              <button type="button" id="close-btn" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body table-responsive" >
                <div id="product-detailsprint">


                </div>
    
            </div>
          </div>
        </div>
    </div>
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


<?php echo $__env->make("App_dashboard.js_block_order", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make("App_dashboard.js_block_booking", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


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