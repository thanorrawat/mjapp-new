@extends('layout-theme-gradient-able.app2') 
@section('title',  "รายการ Order")
@section('pagecss')
<link rel="stylesheet" type="text/css" href="<?php echo asset('public/vendor/datatable/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo asset('public/vendor/datatable/buttons.bootstrap4.min.css') ?>">

@endsection
@section('content')
<section>


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
</section>


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


@endsection
@section('pagejs')
<script src="{{ asset('public/vendor/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('public/vendor/datatable/dataTables.bootstrap4.min.js')}}"></script>

<script src="{{ asset('public/vendor/datatable/dataTables.buttons.min.js')}}"></script>

<script src="{{ asset('public/vendor/datatable/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ asset('public/vendor/datatable/buttons.colVis.min.js')}}"></script>
<script src="{{ asset('public/vendor/datatable/buttons.html5.min.js')}}"></script>
<script src="{{ asset('public/vendor/datatable/buttons.print.min.js')}}"></script>
<script src="{{ asset('public/vendor/datatable/pdfmake.min.js')}}"></script>

@include("App_dashboard.js_block_order_full")

@endsection