@extends('Admin_lte.app') 

@if(!empty($cartDetails->bookingnumber))
@section('title',trans('file.Booking Number').' : '.$cartDetails->bookingnumber)
@section('titlenoblock',trans('file.Booking Number').' : '.$cartDetails->bookingnumber)
@else
@section('title','Order Number : '.$cartDetails->ordernumberfull)
@section('titlenoblock','Order Number : '.$cartDetails->ordernumberfull)
@endif
@section('pagecss')

<link rel="stylesheet" href="{{ asset('assets/css/signature-pad.css') }}">

@endsection
@section('contentnoblock')
<section>
@if(((Auth::user()->role_id!=2&&Auth::user()->role_id==7)  && ($cartDetails->order_status==11|| $cartDetails->order_status==21) ) )
  <div  class="alert alert-primary text-center" role="alert">

    <h4><i class="fas fa-info-circle"></i></h4>
 <h4>อยู่ระหว่างการรอนุมัติจาก ผู้จัดการ</h4>
 </div>
@endif
<div class="row">
     <div class="col-md-12">
        <div class="card" id="card-selectproduct">
            <div class="card-body" >
              <div class="text-right">
                <?php
                if(!empty($cartDetails->order_status)){
                  $statusdt= DB::table('status_names')
            ->where('st_id', $cartDetails->order_status)
          ->select(['*'])
          ->first();
                      }
                  ?>
         @if(!empty($statusdt->statusname))
      
      
      <span style="background-color:{{ $statusdt->color }}" class="btn btn-primary ">Status : {{ $statusdt->statusname }}</span>
         @endif
                <button id="print-btn" type="button" class="btn btn-outline-info btn-sm ml-3"><i class="dripicons-print"></i> {{trans('file.Print')}}</button>
                <a href="{{ url("order_pdf",$cartDetails->token) }}" id="pdf-btn" target="_blank" type="button" class="btn btn-outline-info btn-sm ml-3"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF</a>
                
              </div>
              <div id="app">
         @if(($cartDetails->order_status==11|| $cartDetails->order_status==21))       
<edit-order baseurl="{{ $baseurl }}" role_id="{{ Auth::user()->role_id }}"  orderurl="{{ url('order_view', $cartDetails->token) }}" orderid="{{ $orderdt->id }}" userfullname="{{  Auth::user()->fullname }}" userid="{{  Auth::user()->id }}"></edit-order>

@else
<edit-order-so baseurl="{{ $baseurl }}" role_id="{{ Auth::user()->role_id }}"  orderurl="{{ url('order_view', $cartDetails->token) }}" orderid="{{ $orderdt->id }}" userfullname="{{  Auth::user()->fullname }}" userid="{{  Auth::user()->id }}"></edit-order-so>
 @endif
</div>
              {{-- <div class="table-responsive" id="orderdt"></div> --}}

@if(
(Auth::user()->role_id==6 && ($cartDetails->order_status==12|| $cartDetails->order_status==22) ) //admin รับ ORDER /ใบจอง
||
((Auth::user()->role_id==1 || Auth::user()->role_id==2||Auth::user()->role_id==7)  && ($cartDetails->order_status==11|| $cartDetails->order_status==21) ) //Manager อนุมัติใบจอง
)
          <form action="{{ url('confirmform') }}" method="post">
            <div class="text-center">
              <hr>
              <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o" aria-hidden="true"></i> @if($cartDetails->order_status==21) อนุมัติใบจอง  @elseif($cartDetails->order_status==11) อนุมัติ Order @elseif($cartDetails->order_status==22) รับใบจอง @elseif($cartDetails->order_status==12) รับOrder @endif</button>
              <br>
              <br>

<h4>@if($cartDetails->order_status==21) Click เพื่ออนุมัติใบจอง  @elseif($cartDetails->order_status==11) Click เพื่ออนุมัติ Order @elseif($cartDetails->order_status==22) Click เพื่อรับ ใบจอง @elseif($cartDetails->order_status==12) Click เพื่อรับ Order @endif </h4>
              

              <div style="" id="signimgbox">
                <img  style="width:500px" src="{{ Auth::user()->sign  }}" alt="" id="signimg" >
             <br> 
             <br> 
             <button type="button" class="btn btn-warning btn-sm" id="editsign">เพิ่ม / แก้ไข ลายเซ็น</button>
              </div>

              <div id="signature-pad_box" style="">



          
                <div id="signature-pad" class="signature-pad">
                  <div class="signature-pad--body">
                    <canvas width="664" height="126" style="touch-action: none;"></canvas>
                  </div>
                  <div class="signature-pad--footer">
                    <div class="description">Sign above</div>
              
                    <div class="signature-pad--actions">
                      <div>
                        <button type="button" class="button clear" data-action="clear">Clear</button>
                        <button style="display:none" type="button" class="button" data-action="change-color">Change color</button>
                        <button type="button" class="button" data-action="undo">Undo</button>
              
                      </div>
                      <div style="display:none">
                        <button type="button" class="button save" data-action="save-png">Save as PNG</button>
                        <button type="button" class="button save" data-action="save-jpg">Save as JPG</button>
                        <button type="button" class="button save" data-action="save-svg">Save as SVG</button>
                      </div>
                      <button type="button" class="btn btn-sm btn-warning" id="cancleeditsign">ยกเลิกการแก้ไข</button>
                    </div>
                  </div>
                </div>
                <br>
                
              </div>
            
            </div>
        <div class="text-center">{{ucfirst(Auth::user()->fullname)}}
        <br>
        <?php   $permissionname= DB::table('roles')
                                       ->where('id', Auth::user()->role_id)
                                       ->first();?>
       ( {{ $permissionname->name_thai }} ) 
      </div>    
      <input type="hidden" name="signinput" id="signinput" value="{{ Auth::user()->sign ?? ''}}">
      <input type="hidden" name="old_signinput" id="old_signinput" value="{{ Auth::user()->sign ?? ''}}">
      <input type="hidden" name="orderid" id="orderid" value="{{ $cartDetails->id ?? ''}}">
      <input type="hidden" name="nowstatus" id="nowstatus" value="{{ $cartDetails->order_status}}">
      @csrf
      
          </form>
          @endif
                   <div>

              </div>

 </div>
        </div>
    </div>
  </div>
  @if(
    (Auth::user()->role_id!=6 && ($cartDetails->order_status==12 || $cartDetails->order_status==22) ) //admin รับ ORDER /ใบจอง
    ||
    ((Auth::user()->role_id!=2||Auth::user()->role_id==7)  && ($cartDetails->order_status==11|| $cartDetails->order_status==21) ) //Manager อนุมัติใบจอง
    )
  <div class="col-md-12 ">
    <div class="info-box bg-gradient-warning p-2">
    
<div class="w-100 text-center"> <h2><i class="fas fa-hourglass-half"></i></h2>

<h2> {{ __('file.In_progress') }}</h2>
@if(
  (Auth::user()->role_id!=6 && ($cartDetails->order_status==12 || $cartDetails->order_status==22) ) //admin รับ ORDER /ใบจอง
  )
( {{ __('file.Waiting_to_continue_by_Admin') }} )
@elseif(
  ((Auth::user()->role_id!=2||Auth::user()->role_id==7)  && ($cartDetails->order_status==11|| $cartDetails->order_status==21) ) //Manager อนุมัติใบจอง
  )
  ( {{ __('file.Waiting_for_Approve_by_Manager') }} )
  @endif
</div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.card -->
  </div>
  @endif
  <div class="card">
    <div class="card-header">
        <h5>Timeline : </h5>
    </div>
    <div class="card-body ">
    <div class="container">
        <div class="row">
            <div class="col-md-10" id="timelineblock">
            
            </div>
        </div>
    </div>
</div>
</div>
</section>
<div id="product-details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title">{{trans('Product Details')}}</h5>
          <button id="print-btn" type="button" class="btn btn-default btn-sm ml-3"><i class="dripicons-print"></i> {{trans('file.Print')}}</button>
          <button type="button" id="close-btn" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
        </div>
        <div class="modal-body">
         
        </div>
      </div>
    </div>
</div>
@endsection
@section('pagejs')
<!-- JS, Popper.js, and jQuery -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
 
<script> 
  // let orderurl = '{{ url('order_view', $cartDetails->token) }}';
  // $("#orderdt").load(orderurl)

  $.get( "{{ url('order_timeline') }}/{{ $cartDetails->id }}", function( data ) {
    $('#timelineblock').html(data);
});

</script>


@if(
(Auth::user()->role_id==6 && ($cartDetails->order_status==12|| $cartDetails->order_status==22) ) //admin รับ ORDER /ใบจอง

||
((Auth::user()->role_id==2||Auth::user()->role_id==7)  && ($cartDetails->order_status==11|| $cartDetails->order_status==21) ) //Manager อนุมัติใบจอง
)
<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
 <script src="{{ asset('assets/js/signature-pad/signature-pad-app.js') }}"></script>
  
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script>

  $("#editsign").click(function() {
  $("#signature-pad_box").show();
  $("#signimgbox").hide();
  $("#signinput").val("");
});
$("#cancleeditsign").click(function() {
  let oldsign = $("#old_signinput").val();
$("#signature-pad_box").hide();
$("#signimgbox").show();
$("#signimg").attr("src",oldsign);
$("#signinput").val(oldsign);
signaturePad.clear();
});

@if(!empty(Auth::user()->sign))
$("#signature-pad_box").hide();
@else
$("#signimgbox").hide();
@endif


clearButton.addEventListener("click", function (event) {
  $("#signinput").val("");
});
</script> 
@endif 


<script>
  $("#print-btn").on("click", function(){
            var divToPrint=document.getElementById('orderdt');
            var newWin=window.open('','Print-Window');
            newWin.document.open();
            newWin.document.write('<link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" type="text/css"><style type="text/css">.modal-header{ display: none;},.modal-content{border: none;}@media  print {.modal-dialog { max-width: 1000px;}}</style><body onload="window.print()">'+divToPrint.innerHTML+'</body>');
            newWin.document.close();
            setTimeout(function(){newWin.close();},10);
      });
  </script>
@endsection