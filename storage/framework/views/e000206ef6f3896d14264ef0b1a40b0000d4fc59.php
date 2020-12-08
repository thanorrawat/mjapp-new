 
<?php $__env->startSection('title',  __('file.dashboard')); ?>
<?php $__env->startSection('pagecss'); ?>

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
                      
                      <h2 class="text-right"><i class="ti-shopping-cart f-left"></i><span>486</span></h2>
                      <p class="m-b-0">สำเร็จแล้ว<span class="f-right">351</span></p>
                      
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
                                  <table class="table">
                                      <tr>
                                        
                                          <th>Order No.</th>
                                          <th>ลูกค้า</th>
                                          <th>ทำรายการเมื่อ</th>
                                          <th>Due Date</th>
                                          <th>สถานะ</th>
                                          <th>เอกสาร</th>
                                      </tr>
                                      <tr>
                                    
                                          <td>ODR002344</td>
                                          <td>John Deo</td>
                                          <td>05-05-2020</td>
                                          <td>25-05-2020</td>

                                          <td><span class="label label-danger">Faild</span></td>
                                          <td>#7234486</td>
                                      </tr>
                                      <tr>
                                        
                                          <td>ODR002653</td>
                                          <td>Eugine Turner</td>
                                          <td>04-05-2020</td>
                                          <td>25-05-2020</td>
                                          <td><span class="label label-success">Delivered</span></td>
                                          <td>#7234417</td>
                                      </tr>
                                      <tr>
                                    
                                          <td>ODR002156</td>
                                          <td>Jacqueline Howell</td>
                                          <td>03-05-2020</td>
                                          <td>25-05-2020</td>

                                          <td><span class="label label-warning">Pending</span></td>
                                          <td>#7234454</td>
                                      </tr>
                                  </table>
                              </div>
                              <div class="text-center">
                                  <button class="btn btn-outline-primary btn-round btn-sm">Load More</button>
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
                                          <td><img src="assets/images/product/prod3.jpg" alt="prod img" class="img-fluid"></td>
                                          <td>ODR002653</td>
                                          <td>Eugine Turner</td>
                                          <td>04-01-2017</td>
                                          <td><span class="label label-success">Delivered</span></td>
                                          <td>#7234417</td>
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
          <!-- tabs card end -->

          <!-- social statustic start -->
          
          
          
          <!-- social statustic end -->

          <!-- users visite and profile start -->
          
          
          <!-- users visite and profile end -->

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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout-theme-gradient-able.app2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>