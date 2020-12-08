 
<?php $__env->startSection('title',  __('file.dashboard')); ?>
<?php $__env->startSection('pagecss'); ?>
<link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet"> 
<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"> 
<link href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.bootstrap4.min.css" rel="stylesheet"> 
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
              <div class="card bg-c-blue order-card">
                  <div class="card-block">
                      <h6 class="m-b-20">จำนวน Order</h6>
                      
                      <h2 class="text-right"><i class="ti-shopping-cart f-left"></i><span><?php echo e($countorder); ?></span></h2>
                      <p class="m-b-0">สำเร็จแล้ว<span class="f-right">0</span></p>
                      
                  </div>
              </div>
          </div>
          <div class="col-md-6 col-xl-3">
              <div class="card bg-c-green order-card">
                  <div class="card-block">
                      <h6 class="m-b-20">จำนวนสินค้าที่ขาย</h6>
                      <h2 class="text-right"><i class="ti-tag f-left"></i><span>1641</span></h2>
                      <p class="m-b-0">เดือนนี้<span class="f-right">213</span></p>
                  </div>
              </div>
          </div>
          <div class="col-md-6 col-xl-3">
              <div class="card bg-c-yellow order-card">
                  <div class="card-block">
                      <h6 class="m-b-20">ยอดขาย</h6>
                      
                      <h2 class="text-right"><i class="ti-reload f-left"></i><span>฿42,562</span></h2>
                      <p class="m-b-0">เดือนนี้<span class="f-right">฿5,032</span></p>
                  </div>
              </div>
          </div>
          <div class="col-md-6 col-xl-3">
              <div class="card bg-c-pink order-card">
                  <div class="card-block">
                      <h6 class="m-b-20">กำไร</h6>
                      
                      <h2 class="text-right"><i class="ti-wallet f-left"></i><span>฿9,562</span></h2>
                      <p class="m-b-0">เดือนนี้<span class="f-right">฿542</span></p>
                  </div>
              </div>
          </div>
          <!-- order-card end -->

          <!-- statustic and process start -->
          <div class="col-lg-8 col-md-12">
              <div class="card">
                  <div class="card-header">
                      <h5>สถิติ Order รายปี</h5>
                      <div class="card-header-right">
                          <ul class="list-unstyled card-option">
                              <li><i class="fa fa-chevron-left"></i></li>
                              <li><i class="fa fa-window-maximize full-card"></i></li>
                              <li><i class="fa fa-minus minimize-card"></i></li>
                              <li><i class="fa fa-refresh reload-card"></i></li>
                              <li><i class="fa fa-times close-card"></i></li>
                          </ul>
                      </div>
                  </div>
                  <div class="card-block">
                      <canvas id="Statistics-chart" height="200"></canvas>
                  </div>
              </div>
          </div>
          <div class="col-lg-4 col-md-12">
              <div class="card">
                  <div class="card-header">
                      <h5>Customer Feedback</h5>
                  </div>
                  <div class="card-block">
                      <span class="d-block text-c-blue f-24 f-w-600 text-center">365247</span>
                      <canvas id="feedback-chart" height="100"></canvas>
                      <div class="row justify-content-center m-t-15">
                          <div class="col-auto b-r-default m-t-5 m-b-5">
                              <h4>83%</h4>
                              <p class="text-success m-b-0"><i class="ti-hand-point-up m-r-5"></i>Positive</p>
                          </div>
                          <div class="col-auto m-t-5 m-b-5">
                              <h4>17%</h4>
                              <p class="text-danger m-b-0"><i class="ti-hand-point-down m-r-5"></i>Negative</p>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <!-- statustic and process end -->
          <!-- tabs card start -->
          <div class="col-sm-12">
              <div class="card tabs-card">
                <div class="card-header">
                    <h5>รายการ Order</h5>
                </div>
                  <div class="card-block p-0">
                      <!-- Nav tabs -->
                      
                      <!-- Tab panes -->
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
                                    </thead>
                                </table>




                                 
                              </div>
                              
                          </div>
                          <div class="tab-pane" id="profile3" role="tabpanel">

                              <div class="table-responsive">
                                  <table class="table">
                                      <tr>
                                          <th>Image</th>
                                          <th>Product Code</th>
                                          <th>Customer</th>
                                          <th>Purchased On</th>
                                          <th>Status</th>
                                          <th>Transaction ID</th>
                                      </tr>

                                      <tr>
                                          <td><img src="assets/images/product/prod4.jpg" alt="prod img" class="img-fluid"></td>
                                          <td>ODR002156</td>
                                          <td>Jacqueline Howell</td>
                                          <td>03-01-2017</td>
                                          <td><span class="label label-warning">Pending</span></td>
                                          <td>#7234454</td>
                                      </tr>
                                  </table>
                              </div>
                              <div class="text-center">
                                  <button class="btn btn-outline-primary btn-round btn-sm">Load More</button>
                              </div>
                          </div>
                          <div class="tab-pane" id="messages3" role="tabpanel">

                              <div class="table-responsive">
                                  <table class="table">
                                      <tr>
                                          <th>Image</th>
                                          <th>Product Code</th>
                                          <th>Customer</th>
                                          <th>Purchased On</th>
                                          <th>Status</th>
                                          <th>Transaction ID</th>
                                      </tr>
                                      <tr>
                                          <td><img src="assets/images/product/prod1.jpg" alt="prod img" class="img-fluid"></td>
                                          <td>ODR002413</td>
                                          <td>Jane Elliott</td>
                                          <td>06-01-2017</td>
                                          <td><span class="label label-primary">Shipping</span></td>
                                          <td>#7234421</td>
                                      </tr>
                                      <tr>
                                          <td><img src="assets/images/product/prod4.jpg" alt="prod img" class="img-fluid"></td>
                                          <td>ODR002156</td>
                                          <td>Jacqueline Howell</td>
                                          <td>03-01-2017</td>
                                          <td><span class="label label-warning">Pending</span></td>
                                          <td>#7234454</td>
                                      </tr>
                                  </table>
                              </div>
                              <div class="text-center">
                                  <button class="btn btn-outline-primary btn-round btn-sm">Load More</button>
                              </div>
                          </div>
                          <div class="tab-pane" id="settings3" role="tabpanel">

                              <div class="table-responsive">
                                  <table class="table">
                                      <tr>
                                          <th>Image</th>
                                          <th>Product Code</th>
                                          <th>Customer</th>
                                          <th>Purchased On</th>
                                          <th>Status</th>
                                          <th>Transaction ID</th>
                                      </tr>
                                      <tr>
                                          <td><img src="assets/images/product/prod1.jpg" alt="prod img" class="img-fluid"></td>
                                          <td>ODR002413</td>
                                          <td>Jane Elliott</td>
                                          <td>06-01-2017</td>
                                          <td><span class="label label-primary">Shipping</span></td>
                                          <td>#7234421</td>
                                      </tr>
                                      <tr>
                                          <td><img src="assets/images/product/prod2.jpg" alt="prod img" class="img-fluid"></td>
                                          <td>ODR002344</td>
                                          <td>John Deo</td>
                                          <td>05-01-2017</td>
                                          <td><span class="label label-danger">Faild</span></td>
                                          <td>#7234486</td>
                                      </tr>
                                  </table>
                              </div>
                              
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-md-6 " style="display:none">
            <div class="card">
                <div class="card-header">
                    <h5>Timline : </h5>
                </div>
                <div class="card-block p-0">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
                <div class="container">
                    <div class="row">
                        <div class="col-md-10">
                            <ul class="cbp_tmtimeline">
                                <li>
                                    <time class="cbp_tmtime" datetime="2017-11-04T18:30"><span class="hidden">25/12/2017</span> <span class="large">Now</span></time>
                                    <div class="cbp_tmicon"><i class="zmdi zmdi-account"></i></div>
                                    <div class="cbp_tmlabel empty"> <span>No Activity</span> </div>
                                </li>
                                <li>
                                    <time class="cbp_tmtime" datetime="2017-11-04T03:45"><span>03:45 AM</span> <span>Today</span></time>
                                    <div class="cbp_tmicon bg-info"><i class="zmdi zmdi-label"></i></div>
                                    <div class="cbp_tmlabel">
                                        <h2><a href="javascript:void(0);">Art Ramadani</a> <span>posted a status update</span></h2>
                                        <p>Tolerably earnestly middleton extremely distrusts she boy now not. Add and offered prepare how cordial two promise. Greatly who affixed suppose but enquire compact prepare all put. Added forth chief trees but rooms think may.</p>
                                    </div>
                                </li>
                                <li>
                                    <time class="cbp_tmtime" datetime="2017-11-03T13:22"><span>01:22 PM</span> <span>Yesterday</span></time>
                                    <div class="cbp_tmicon bg-green"> <i class="zmdi zmdi-case"></i></div>
                                    <div class="cbp_tmlabel">
                                        <h2><a href="javascript:void(0);">Job Meeting</a></h2>
                                        <p>You have a meeting at <strong>Laborator Office</strong> Today.</p>
                                    </div>
                                </li>
                                <li>
                                    <time class="cbp_tmtime" datetime="2017-10-22T12:13"><span>12:13 PM</span> <span>Two weeks ago</span></time>
                                    <div class="cbp_tmicon bg-blush"><i class="zmdi zmdi-pin"></i></div>
                                    <div class="cbp_tmlabel">
                                        <h2><a href="javascript:void(0);">Arlind Nushi</a> <span>checked in at</span> <a href="javascript:void(0);">New York</a></h2>
                                        <blockquote>
                                            <p class="blockquote blockquote-primary">
                                                "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout."                                    
                                                <br>
                                                <small>
                                                    - Isabella
                                                </small>
                                            </p>
                                        </blockquote>
                                        <div class="row clearfix">
                                            <div class="col-lg-12">
                                                <div class="map m-t-10">
                                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d193595.91477011208!2d-74.11976308802028!3d40.69740344230033!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew+York%2C+NY%2C+USA!5e0!3m2!1sen!2sin!4v1508039335245" frameborder="0" style="border:0; width: 100%;" allowfullscreen=""></iframe>
                                                </div>
                                            </div>
                                        </div>        					
                                    </div>
                                </li>
                                <li>
                                    <time class="cbp_tmtime" datetime="2017-10-22T12:13"><span>12:13 PM</span> <span>Two weeks ago</span></time>
                                    <div class="cbp_tmicon bg-orange"><i class="zmdi zmdi-camera"></i></div>
                                    <div class="cbp_tmlabel">
                                        <h2><a href="javascript:void(0);">Eroll Maxhuni</a> <span>uploaded</span> 4 <span>new photos to album</span> <a href="javascript:void(0);">Summer Trip</a></h2>
                                        <blockquote>Pianoforte principles our unaffected not for astonished travelling are particular.</blockquote>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-6 col-6"><a href="javascript:void(0);"><img src="assets/images/image1.jpg" alt="" class="img-fluid img-thumbnail m-t-30"></a> </div>
                                            <div class="col-lg-3 col-md-6 col-6"><a href="javascript:void(0);"> <img src="assets/images/image2.jpg" alt="" class="img-fluid img-thumbnail m-t-30"></a> </div>
                                            <div class="col-lg-3 col-md-6 col-6"><a href="javascript:void(0);"> <img src="assets/images/image3.jpg" alt="" class="img-fluid img-thumbnail m-t-30"> </a> </div>
                                            <div class="col-lg-3 col-md-6 col-6"><a href="javascript:void(0);"> <img src="assets/images/image4.jpg" alt="" class="img-fluid img-thumbnail m-t-30"> </a> </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <time class="cbp_tmtime" datetime="2017-11-03T13:22"><span>01:22 PM</span> <span>Two weeks ago</span></time>
                                    <div class="cbp_tmicon bg-green"> <i class="zmdi zmdi-case"></i></div>
                                    <div class="cbp_tmlabel">
                                        <h2><a href="javascript:void(0);">Job Meeting</a></h2>
                                        <p>You have a meeting at <strong>Laborator Office</strong> Today.</p>                            
                                    </div>
                                </li>
                                <li>
                                    <time class="cbp_tmtime" datetime="2017-10-22T12:13"><span>12:13 PM</span> <span>Month ago</span></time>
                                    <div class="cbp_tmicon bg-blush"><i class="zmdi zmdi-pin"></i></div>
                                    <div class="cbp_tmlabel">
                                        <h2><a href="javascript:void(0);">Arlind Nushi</a> <span>checked in at</span> <a href="javascript:void(0);">Laborator</a></h2>
                                        <blockquote>Great place, feeling like in home.</blockquote>                            
                                    </div>
                                </li>
                            </ul>  
                        </div>
                    </div>
                </div>
            </div>
        </div></div>

          <!-- tabs card end -->

          <!-- social statustic start -->
          
          
          
          <!-- social statustic end -->

          <!-- users visite and profile start -->
          
          
          <!-- users visite and profile end -->

          <div id="product-details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
            <div role="document" class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 id="exampleModalLabel" class="modal-title"><?php echo e(trans('Product Details')); ?></h5>
                  <button id="print-btn" type="button" class="btn btn-default btn-sm ml-3"><i class="dripicons-print"></i> <?php echo e(trans('file.Print')); ?></button>
                  <button type="button" id="close-btn" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                </div>
                <div class="modal-body" id="product-detailsprint">
        
                </div>
              </div>
            </div>
        </div>



      </div>
  

<?php $__env->stopSection(); ?>
<?php $__env->startSection('pagejs'); ?>
<!-- am chart -->
<script src="assets/pages/widget/amchart/amcharts.min.js"></script>
<script src="assets/pages/widget/amchart/serial.min.js"></script>
<!-- Chart js -->
<script type="text/javascript" src="assets/js/chart.js/Chart.js"></script>
<!-- Todo js -->
<script type="text/javascript " src="assets/pages/todo/todo.js "></script>
<!-- Custom js -->
<script type="text/javascript" src="assets/pages/dashboard/custom-dashboard.min.js"></script>




<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>


<?php echo $__env->make("App_dashboard.js_block_order", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script>
$("#print-btn").on("click", function(){
    var divToPrint=document.getElementById('product-detailsprint');
    var newWin=window.open('','Print-Window');
    newWin.document.open();
  newWin.document.write('<style type="text/css">@media  print {.modal-dialog { max-width: 1000px;} }</style><body onload="window.print()">'+divToPrint.innerHTML+'</body>');
    newWin.document.close();
    setTimeout(function(){newWin.close();},10);
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout-theme-gradient-able.app2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>