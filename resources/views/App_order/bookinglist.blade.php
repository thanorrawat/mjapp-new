@extends('layout-theme-gradient-able.app2') 
@section('title',  "รายการ Order")
@section('pagecss')
<link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet"> 
<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"> 
<link href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.bootstrap4.min.css" rel="stylesheet"> 

@endsection
@section('content')
<section>


                        <div class="table-responsive">

                          <table class="table" id="booking-data-table">
                            <thead>
                                <th>No.</th>
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
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>

@include("App_dashboard.js_block_booking")

@endsection