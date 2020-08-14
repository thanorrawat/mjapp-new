@extends('layout-theme-gradient-able.app2') 
@section('title',  __('file.dashboard'))
@section('pagecss')
<link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet"> 
<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"> 
<link href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.bootstrap4.min.css" rel="stylesheet"> 
@endsection
@section('contentnoblock')
<div class="row">
    <div class="col-md-12 col-lg-6">
<div class="brand-text float-left ">
    <h3>{{trans('file.welcome')}} คุณ <span>{{Auth::user()->fullname}}</span> </h3>  

</div>
</div>
</div>
    <div class="row">
          <!-- order-card start -->
          <div class="col-md-6 col-xl-3">
              <div class="card bg-c-blue order-card">
                  <div class="card-block">
                      <h6 class="m-b-20">จำนวน Order</h6>
                      {{-- Orders Received --}}
                      <h2 class="text-right"><i class="ti-shopping-cart f-left"></i><span>{{ $countorder }}</span></h2>
                      <p class="m-b-0">สำเร็จแล้ว<span class="f-right">0</span></p>
                      {{-- Completed Orders --}}
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
                      {{-- Revenue --}}
                      <h2 class="text-right"><i class="ti-reload f-left"></i><span>฿42,562</span></h2>
                      <p class="m-b-0">เดือนนี้<span class="f-right">฿5,032</span></p>
                  </div>
              </div>
          </div>
          <div class="col-md-6 col-xl-3">
              <div class="card bg-c-pink order-card">
                  <div class="card-block">
                      <h6 class="m-b-20">กำไร</h6>
                      {{-- Total Profit --}}
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
                              {{-- <div class="text-center">
                                  <button class="btn btn-outline-primary btn-round btn-sm">Load More</button>
                              </div> --}}
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
                              {{-- <div class="text-center">
                                  <button class="btn btn-outline-primary btn-round btn-sm">Load More</button>
                              </div> --}}
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
          {{-- <div class="col-md-12 col-lg-4">
              <div class="card">
                  <div class="card-block text-center">
                      <i class="fa fa-envelope-open text-c-blue d-block f-40"></i>
                      <h4 class="m-t-20"><span class="text-c-blue">8.62k</span> Subscribers</h4>
                      <p class="m-b-20">Your main list is growing</p>
                      <button class="btn btn-primary btn-sm btn-round">Manage List</button>
                  </div>
              </div>
          </div> --}}
          {{-- <div class="col-md-6 col-lg-4">
              <div class="card">
                  <div class="card-block text-center">
                      <i class="fa fa-twitter text-c-green d-block f-40"></i>
                      <h4 class="m-t-20"><span class="text-c-blgreenue">+40</span> Followers</h4>
                      <p class="m-b-20">Your main list is growing</p>
                      <button class="btn btn-success btn-sm btn-round">Check them out</button>
                  </div>
              </div>
          </div> --}}
          {{-- <div class="col-md-6 col-lg-4">
              <div class="card">
                  <div class="card-block text-center">
                      <i class="fa fa-puzzle-piece text-c-pink d-block f-40"></i>
                      <h4 class="m-t-20">Business Plan</h4>
                      <p class="m-b-20">This is your current active plan</p>
                      <button class="btn btn-danger btn-sm btn-round">Upgrade to VIP</button>
                  </div>
              </div>
          </div> --}}
          <!-- social statustic end -->

          <!-- users visite and profile start -->
          {{-- <div class="col-md-4">
              <div class="card user-card">
                  <div class="card-header">
                      <h5>Profile</h5>
                  </div>
                  <div class="card-block">
                      <div class="usre-image">
                          <img src="assets/images/avatar-4.jpg" class="img-radius" alt="User-Profile-Image">
                      </div>
                      <h6 class="f-w-600 m-t-25 m-b-10">Alessa Robert</h6>
                      <p class="text-muted">Active | Male | Born 23.05.1992</p>
                      <hr/>
                      <p class="text-muted m-t-15">Activity Level: 87%</p>
                      <ul class="list-unstyled activity-leval">
                          <li class="active"></li>
                          <li class="active"></li>
                          <li class="active"></li>
                          <li></li>
                          <li></li>
                      </ul>
                      <div class="bg-c-blue counter-block m-t-10 p-20">
                          <div class="row">
                              <div class="col-4">
                                  <i class="ti-comments"></i>
                                  <p>1256</p>
                              </div>
                              <div class="col-4">
                                  <i class="ti-user"></i>
                                  <p>8562</p>
                              </div>
                              <div class="col-4">
                                  <i class="ti-bag"></i>
                                  <p>189</p>
                              </div>
                          </div>
                      </div>
                      <p class="m-t-15 text-muted">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                      <hr/>
                      <div class="row justify-content-center user-social-link">
                          <div class="col-auto"><a href="#!"><i class="fa fa-facebook text-facebook"></i></a></div>
                          <div class="col-auto"><a href="#!"><i class="fa fa-twitter text-twitter"></i></a></div>
                          <div class="col-auto"><a href="#!"><i class="fa fa-dribbble text-dribbble"></i></a></div>
                      </div>
                  </div>
              </div>
          </div> --}}
          {{-- <div class="col-md-8">
              <div class="card">
                  <div class="card-header">
                      <h5>Activity Feed</h5>
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
                      <ul class="feed-blog">
                          <li class="active-feed">
                              <div class="feed-user-img">
                                  <img src="assets/images/avatar-3.jpg" class="img-radius " alt="User-Profile-Image">
                              </div>
                              <h6><span class="label label-danger">File</span> Eddie uploaded new files: <small class="text-muted">2 hours ago</small></h6>
                              <p class="m-b-15 m-t-15">hii <b> @everone</b> Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                              <div class="row">
                                  <div class="col-auto text-center">
                                      <img src="assets/images/blog/blog-r-1.jpg" alt="img" class="img-fluid img-100">
                                      <h6 class="m-t-15 m-b-0">Old Scooter</h6>
                                      <p class="text-muted m-b-0"><small>PNG-100KB</small></p>
                                  </div>
                                  <div class="col-auto text-center">
                                      <img src="assets/images/blog/blog-r-2.jpg" alt="img" class="img-fluid img-100">
                                      <h6 class="m-t-15 m-b-0">Wall Art</h6>
                                      <p class="text-muted m-b-0"><small>PNG-150KB</small></p>
                                  </div>
                                  <div class="col-auto text-center">
                                      <img src="assets/images/blog/blog-r-3.jpg" alt="img" class="img-fluid img-100">
                                      <h6 class="m-t-15 m-b-0">Microphone</h6>
                                      <p class="text-muted m-b-0"><small>PNG-150KB</small></p>
                                  </div>
                              </div>
                          </li>
                          <li class="diactive-feed">
                              <div class="feed-user-img">
                                  <img src="assets/images/avatar-4.jpg" class="img-radius " alt="User-Profile-Image">
                              </div>
                              <h6><span class="label label-success">Task</span>Sarah marked the Pending Review: <span class="text-c-green"> Trash Can Icon Design</span><small class="text-muted">2 hours ago</small></h6>
                          </li>
                          <li class="diactive-feed">
                              <div class="feed-user-img">
                                  <img src="assets/images/avatar-2.jpg" class="img-radius " alt="User-Profile-Image">
                              </div>
                              <h6><span class="label label-primary">comment</span> abc posted a task:  <span class="text-c-green">Design a new Homepage</span>  <small class="text-muted">6 hours ago</small></h6>
                              <p class="m-b-15 m-t-15"hii <b> @everone</b> Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                          </li>
                          <li class="active-feed">
                              <div class="feed-user-img">
                                  <img src="assets/images/avatar-3.jpg" class="img-radius " alt="User-Profile-Image">
                              </div>
                              <h6><span class="label label-warning">Task</span>Sarah marked : <span class="text-c-green"> do Icon Design</span><small class="text-muted">10 hours ago</small></h6>
                          </li>
                      </ul>
                  </div>
              </div>
          </div> --}}
          <!-- users visite and profile end -->


          <div id="product-details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
            <div role="document" class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 id="exampleModalLabel" class="modal-title">{{trans('Order Details')}}</h5>
                  <div class="text-right">

                    <button id="print-btn" type="button" class="btn btn-outline-info btn-sm ml-3"><i class="dripicons-print"></i> {{trans('file.Print')}}</button>
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
  

@endsection
@section('pagejs')
<!-- am chart -->
<script src="assets/pages/widget/amchart/amcharts.min.js"></script>
<script src="assets/pages/widget/amchart/serial.min.js"></script>
<!-- Chart js -->
<script type="text/javascript" src="assets/js/chart.js/Chart.js"></script>
<!-- Todo js -->
<script type="text/javascript " src="assets/pages/todo/todo.js "></script>
<!-- Custom js -->
<script type="text/javascript" src="assets/pages/dashboard/custom-dashboard.min.js"></script>
{{-- ORDER Table --}}



<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>

{{-- #order-data-table --}}
@include("App_dashboard.js_block_order")

<script>
    $("#print-btn").on("click", function(){
              var divToPrint=document.getElementById('product-details');
              var newWin=window.open('','Print-Window');
              newWin.document.open();
              newWin.document.write('<link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" type="text/css"><style type="text/css">.modal-header{ display: none;},.modal-content{border: none;}@media  print {.modal-dialog { max-width: 1000px;}}</style><body onload="window.print()">'+divToPrint.innerHTML+'</body>');
              newWin.document.close();
              setTimeout(function(){newWin.close();},10);
        });
    </script>

@endsection