@extends('Admin_lte.app') 
@if($pagetype == 'order')
@section('title',__('file.Order List'))
@else
@section('title',__('file.Booking List'))
@endif

@section('pagecss')
<link rel="stylesheet" type="text/css" href="<?php echo asset('public/vendor/datatable/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo asset('public/vendor/datatable/buttons.bootstrap4.min.css') ?>">
@endsection

@section('content')
<div class="tab-content card-block">
  <div class="tab-pane active" id="home3" role="tabpanel">

      <div class="table-responsive">
        @if($pagetype == 'order')
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
        @elseif($pagetype == 'booking')
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
@endif



         
      </div>
      </div>
      </div>


      <div id="product-details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 id="exampleModalLabel" class="modal-title">{{trans('Order Details')}}</h5>
              <div class="text-right">

                <button id="print-btn" type="button" class="btn btn-outline-info btn-sm ml-3"><i class="dripicons-print"></i> {{trans('file.Print')}}</button>
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

{{-- #order-data-table --}}
@if($pagetype == 'order')
@include("App_dashboard.js_block_order")
@elseif($pagetype == 'booking')
@include("App_dashboard.js_block_booking")
@endif

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