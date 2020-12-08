@extends('layout-theme-gradient-able.app2') 
@if(!empty($orderid))

@if(!empty($cartDetails->bookingnumber))
@section('title',trans('Booking Number').' : '.$cartDetails->bookingnumber)
@section('titlenoblock',trans('Booking Number').' : '.$cartDetails->bookingnumber)
@else
@section('title','Order Number : '.$cartDetails->ordernumberfull)
@section('titlenoblock','Order Number : '.$cartDetails->ordernumberfull)
@endif
@else
@section('title',__('file.Create Order/Booking'))
@section('titlenoblock',__('file.Create Order/Booking'))
@endif
@section('pagecss')
<link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet"> 
<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"> 
<link href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.bootstrap4.min.css" rel="stylesheet"> 
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<link href="{{ asset("assets/pickadate.js-3.6.2/lib/themes/default.css")}}" rel="stylesheet" />
<link href="{{ asset("assets/pickadate.js-3.6.2/lib/themes/default.date.css")}}" rel="stylesheet" />
@endsection
@section('contentnoblock')
<section>
  @if(empty($orderid) || $cartDetails->order_status < 1 )
<div class="row">

    <div class="col-md-12">
        <div class="card" id="card-selectproduct">
            <div class="card-header">
                <h4>{{ __('file.Select Product') }}</h4>
                {{-- <div class="card-header-right">
                  <ul class="list-unstyled card-option">
                      <li><i class="fa fa-chevron-left"></i></li>
                      <li><i class="fa fa-window-maximize full-card"></i></li>
                      <li><i class="fa fa-minus minimize-card"></i></li>
                      <li><i class="fa fa-refresh reload-card"></i></li>
                      <li><i class="fa fa-times close-card"></i></li>
                  </ul>
              </div> --}}
              <div class="card-header-right">
                <button class="btn bg-c-yellow btn-sm fa minimize-card fa-minus" type="button"> ย่อ/ขยาย</button>
      
            </div>
            </div>
            <div class="card-block">
                @include("App_sale.order_selecttable")
 </div>
        </div>
    </div>
  </div>
@endif


        <div class="card">
            <div class="card-header">
                <h4>{{ __('file.Details') }}</h4>
                <div class="card-header-right">
          <?php
          if(!empty($cartDetails->order_status)){
            $statusdt= DB::table('status_names')
      ->where('st_id', $cartDetails->order_status)
    ->select(['*'])
    ->first();
                }
            ?>
   @if(!empty($statusdt->statusname))


<span style="background-color:{{ $statusdt->color }}" class="label ">Status : {{ $statusdt->statusname }}</span>
   @endif
                </div>
            </div>
            <div class="card-block">
              @if(!empty($orderid))
<form action="{{ url('edit_order') }}" method="post" id="cartdetailsform">
  <input type="hidden" name="order_id" value="{{ $orderid }}">
 
@else
<form action="{{ url('create_order') }}" method="post" id="cartdetailsform">
              @endif
              <input type="hidden" name="customer_name" id="customer_name" value="@if(!empty($cartDetails->customer_name)){{ $cartDetails->customer_name }}@endif">
  @csrf

  @if(!empty($orderid))
  <div class="form-group row" style="display: none">
    @else
    <div class="form-group row">
      @endif
    <label class="col-md-2">ประเภทเอกสาร</label>

  <div class="col-md-2">
    <input type="radio" name="sendordertype" id="sendordertype_1" @if(!empty($cartDetails->doctype) && $cartDetails->doctype==1) checked @endif value="1" required> Order 
  </div><div class="col-md-2">  
    <input type="radio" name="sendordertype" id="sendordertype_2" @if((!empty($cartDetails->doctype) && $cartDetails->doctype==2)||!empty($cartDetails->bookingnumber)) checked @endif  value="2" required> ใบจอง
  
  </div>
</div>


    <div id="detailsforminput"></div>

   <div id="cartlist">


   </div>
   <div class="form-group row">
     <label class="col-md-2">{{ __('file.Remark') }}</label>
     <div class="col-md-10">
<textarea class="form-control" name="remark" id="remark"rows="10">{{ $cartDetails->remark or '' }}</textarea>

     </div>
   </div>
  
    @if(!empty($orderid) )
    @if($cartDetails->order_status <= 1 || $cartDetails->order_status ==2  )
<div class="row">

  <div class="col-md-12 text-center"><button type="submit" id="ordersubmit" class="btn btn-primary">แก้ไข</button>

    {{-- <h4 class="col-md-12"> ยืนยัน Order</h4>
<div class="col-md-4"><input type="radio" name="sendordertype" id="sendordertype_1" checked value="1" required> Order </div>
<div class="col-md-4"><input type="radio" name="sendordertype" id="sendordertype_2" value="2" required> ขออนุมัติจองสินค้า</div>
<div class="col-md-4"><input type="radio" name="sendordertype" id="sendordertype_3"  value="3" required> ขออนุมัติ SO</div> --}}

  <input type="hidden" name="sendordertype" value="<?php if(!empty($cartDetails->bookingnumber)){ echo '2';}else{ echo '1';} ?>">
  <button type="button" id="sendorderbutton"  class="btn btn-warning">ส่ง Order</button></div>
<input type="checkbox" name="confirm" value="1" id="checkconfirm" style="display: none" >

@endif


  
  @else
  <div class="text-center">


  <button type="submit" class="btn btn-primary" id="formsubmit">สร้าง order</button>
</div>
@endif



  </form>

  <div>


  </div>
            </div>
        </div>
   
      </div>
@if(!empty($cartDetails->order_status) )
    <div class="card">
      <div class="card-header">
          <h5>Timeline : </h5>
      </div>
      <div class="card-block p-0">
      <div class="container">
          <div class="row">
              <div class="col-md-10" id="timelineblock">
              
              </div>
          </div>
      </div>
  </div>
  </div>

@endif



   
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
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="text/javascript" src="{{ asset("assets/pickadate.js-3.6.2/lib/picker.js")}}"></script>
<script type="text/javascript" src="{{ asset("assets/pickadate.js-3.6.2/lib/picker.date.js")}}"></script>
@if(app()->getLocale()=='th')
<script type="text/javascript" src="{{ asset("assets/pickadate.js-3.6.2/lib/translations/th_TH.js")}}"></script>
@endif

@if(!empty($cartDetails->ordernumber) || !empty($cartDetails->bookingnumber) )
<script> 

  $.get( "{{ url('order_timeline') }}/{{ $cartDetails->id }}", function( data ) {
    $('#timelineblock').html(data);
});

</script>
@endif

<script>
function loaddetailsform(){
 let doctype =  $('input[type=radio][name=sendordertype]:checked').val();

 if(doctype==1){
  $("#formsubmit").text('สร้าง Order');
  $("#sendorderbutton").text('ส่ง Order เพื่อขออนุมัติ');
  
 }else if(doctype==2){
  $("#formsubmit").text('สร้างใบจอง');
  $("#sendorderbutton").text('ส่ง ใบจอง เพื่อขออนุมัติ');

 }
 $.get( "{{ url('order_input') }}/{{ $orderid??0 }}", { doctype:doctype  } )
  .done(function( data ) {
    $('#detailsforminput').html(data).then(

      $('.datepicker').pickadate({
      format: 'd/mm/yyyy',
    })

    );
  });

}

loaddetailsform();
$('input[type=radio][name=sendordertype]').change(function() {
  loaddetailsform();
});

$('#selectcustomer').select2();
  $( document ).ready(function() {

@if(!empty($orderid))
$( "#card-selectproduct .minimize-card" ).trigger( "click" );
@endif
});
$('#product-data-table').DataTable({
processing: true,
serverSide: true,
      //  ajax: '{{ url("products/product-data?csrf=".csrf_token()) }}',
        "ajax":{

"url": "{{ url("products/product-data") }}",
//"dataType": "json",
"type": "GET",
"data":{ csrf: "{{ csrf_token() }}"}

},
        columns: [
           // { data: 'id', name: 'products.id' },
            { data: 'image', name: 'products.image' },
            { data: 'code', name: 'products.code' },
            { data: 'name', name: 'products.name' },

            { data: 'category', name: 'categories.name' },
            { data: 'detailsnew', name: 'products.product_details' },
            { data: 'qty', name: 'products.qty' },
            { data: 'orderqty', name: 'orderqty' },
            @if(!empty($orderid))
            { data: 'selecteditorder', name: 'selecteditorder' }
            @else
            { data: 'select', name: 'select' }

          @endif
        ]
        ,
        dom: 'Blfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'print'
        ]
,"columnDefs": [{ targets: 'no-sort', orderable: false }]
,columnDefs: [
    {
        targets: 5,
        className: 'dt-body-center'
    }
  ]

    });
    $(document).on("click", ".productpopup", function(){
  
        let productid = $(this).attr( "data-productid" );
         
//alert("productid")
      //  $('#product-details .modal-body').html(productid)
      $('#product-details .modal-body').load('{{ url("products/details") }}/'+productid);       

    });
    $("#print-btn").on("click", function(){
          var divToPrint=document.getElementById('product-details');
          var newWin=window.open('','Print-Window');
          newWin.document.open();
          newWin.document.write('<link rel="stylesheet" href="<?php echo asset('public/vendor/bootstrap/css/bootstrap.min.css') ?>" type="text/css"><style type="text/css">@media print {.modal-dialog { max-width: 1000px;} }</style><body onload="window.print()">'+divToPrint.innerHTML+'</body>');
          newWin.document.close();
          setTimeout(function(){newWin.close();},10);
    });
    
//check stock



    @if(!empty($orderid)) //เพิ่มสินค้าใน order
    @if($cartDetails->order_status < 1 )
    $('body').on('click', '.add-to-order', function () { //เพิ่มสินค้าลงตะกร้า

let code = $(this).attr("data-code");
let productid= $(this).attr("data-productid");
let price = $(this).attr("data-price");
let stock = $(this).attr("data-stock");
let orderqty = $(this).attr("data-addqty"); 
@if(!empty($orderid))
let orderid = {{ $orderid }};
@else
let orderid = 0;
@endif
      $.ajax({
  method: "POST",
  url: "{{ url('addtoorder') }}",
  data: { productscode: code, price: price, stocknow:stock,orderqty:orderqty,productid:productid,orderid: orderid }
})
  .done(function(data) {
    $('#cartlist').load('{{ url("orderlistedit",$cartDetails->id)  }}');
      if(data['alert'] !=null){
        $.toast({
    heading: 'Success',
    text: data['alert'],
    icon: 'success',
    loader: true, 
    position: 'bottom-right',
      // Change it to false to disable loader
      bgColor: '#9EC600'  // To change the background
})

      }

      if(data['alertfalse'] !=null){
        $.toast({
    heading: 'Alert',
    text: data['alertfalse'],
    icon: 'warning',
    loader: true, 
      // Change it to false to disable loader
    bgColor: '#FF1356',
    position: 'bottom-right',
    textColor: 'white'
})

      }


//$('#product-data-table > tbody > tr:nth-child(4) > td.dt-body-center').text("test")


  });

 



});

@endif
@endif






function cartlist(){
  @if(!empty($orderid))
  $('#cartlist').load('{{ url("orderlistedit",$cartDetails->id)  }}');
  @else
    $('#cartlist').load('{{ url("order_cartlist/")  }}');
  @endif


}

cartlist()
    $('body').on('click', '.add-to-cart,.add-to-order', function () { //เพิ่มสินค้าลงตะกร้า
        cartlist()
    });



    $('body').on('click', '.delete-from-cart', function () { //ลบสินค้าจากตะกร้า
  var confirm1 = confirm('ยืนยันการลบ รายการนี้?');
  if (confirm1) {
  
    let code = $(this).attr("data-code");
@if(!empty($orderid))
let orderid = '{{ $orderid }}';
let orderfullnumber = '{{ $cartDetails->ordernumberfull }}';
@else
let orderid = 0;
let orderfullnumber = 0;

@endif


      $.ajax({
  method: "POST",
  @if(!empty($orderid))
  url: "{{ url('delete_product_order') }}",
  @else
  url: "{{ url('delete_product_cart') }}",
  @endif
  data: { productscodedelete: code,orderid:orderid,orderfullnumber:orderfullnumber }
})
  .done(function(data) {
    @if(empty($orderid))
      $("#topcart").load("{{ url("viewcart") }}");
      @endif
      if(data['alert'] !=null){
        $.toast({
    heading: 'Deleted',
    text: data['alert'],
    icon: 'warning',
    loader: true, 
    position: 'bottom-right',
      // Change it to false to disable loader
      bgColor: '#d71578'  // To change the background
})

      }

      cartlist()
  });



  } else {
   
    $.toast({
    heading: 'ยกเลิก',
    text: 'รายการสินค้ายังไม่ถูกลบ',
    icon: 'info',
    loader: true, 
    position: 'bottom-right',
      // Change it to false to disable loader
      bgColor: '#ffc107'  // To change the background
})




  }
});


$('body').on('change keyup blur', '.addorderqty', function () { //เพิ่มสินค้าลงตะกร้า
        let productid = $(this).attr("data-product");
        let qtyadd = $(this).val();

@if(!empty($orderid))
$("#add-to-order_"+productid).attr("data-addqty",qtyadd);
 @else
$("#add-to-cart_"+productid).attr("data-addqty",qtyadd);
@endif
//console.log(qtyadd);




    });

///update รายละเอียดตะกร้า

function updatecartdt(){
let usercreate = $('#usercreate').val();
let usercreate_id = $('#usercreate_id').val();
let customer_name =$('#select2-selectcustomer-container').text();
let customer_id =$('#selectcustomer').val();
let deliverydate =$('#deliverydate').val();
let ordertype=$('input[name="ordertype"]').val();
let remark = $('#remark').val();
let doctype=  $('input[type=radio][name=sendordertype]:checked').val();
    // console.log(customer_id);
   $('#customer_name').val(customer_name);
      $.ajax({
  method: "POST",
  url: "{{ url('updatecartdetials') }}",
  data: { usercreate: usercreate,usercreate_id:usercreate_id,customer_name:customer_name,customer_id:customer_id,deliverydate:deliverydate,ordertype:ordertype,remark:remark,doctype:doctype}
})
  .done(function(data) {

  });
}
$('body').on('change keyup blur', '#cartdetailsform input,#selectcustomer,#remark,#select2-selectcustomer-container', function () { //เพิ่มสินค้าลงตะกร้า

             updatecartdt()
    }); 

// @if(!empty($cartDetails->customer_name))
// $('#select2-selectcustomer-container').text("{{ $cartDetails->customer_name }}")
// @endif
        
function stockstatuscheck(){
  $( ".stockstatus" ).each(function() {
  let stockst = $(this).attr('data-stockstatus');
if(stockst ==2){
$("#sendordertype_2,#sendordertype_3").prop("disabled", true);
$("#sendordertype_2,#sendordertype_3").parent("div").hide();


return false;
}else{
  $("#sendordertype_1").prop( "checked", true );
  $("#sendordertype_2,#sendordertype_3").prop("disabled", false);
$("#sendordertype_2,#sendordertype_3").parent("div").show();

}

  });

  loaddetailsform();
}

@if(empty($orderid) || $cartDetails->order_status < 1 )
$('body').on('change keyup blur', '.order_qty', function () { //เปลี่ยนจำนวนสินค้า
let productid =$(this).attr("data-productid");
let orderqty =$(this).val();

@if(!empty($orderid))
let orderid = {{ $orderid }};
@else
let orderid = 0;
@endif


$('#loadingDiv').show();
$.ajax({
method: "POST",
url: "{{ url('checkstockorder') }}",
data: { productid:productid,orderqty:orderqty,orderid:orderid }
})
.done(function(data) {
if(data['stock'] != null && data['stock']>=orderqty ){
  $("#stock_"+productid).css("background-color", "rgb(123, 208, 30)");
  $("#stock_"+productid).attr('data-stockstatus','1');
}else{
  $("#stock_"+productid).css("background-color", "rgb(253, 88, 104)");
  $("#stock_"+productid).attr('data-stockstatus','2');
}
$("#stock_"+productid).text(data['stock']);
$("#pr_"+productid).text(data['pr']);
$('#loadingDiv').hide();

});


//stockstatuscheck();



}); 

@endif

$('body').on('change keyup blur', '.remarkrow', function () { //หมายเหตุสินค้า
  let productid =$(this).attr("data-productid");
let thisremark = $(this).val();
  
@if(!empty($orderid))
let orderid = {{ $orderid }};
@else
let orderid = 0;
@endif

$.ajax({
method: "POST",
url: "{{ url('remarkcartupdate') }}",
data: { productid:productid,thisremark:thisremark,orderid:orderid }
})
.done(function(data) {




});
});


//Confirm Order
$("#sendorderbutton").on("click", function(){
  let doctype =  $('input[type=radio][name=sendordertype]:checked').val();

if(doctype==1){
var confirmsend = confirm('ยืนยันการส่ง Order?');
}else if(doctype==2){
  var confirmsend = confirm('ยืนยันการส่งใบจอง?');
}
  if (confirmsend ) {
 $("#checkconfirm").prop( "checked", true ).then
 ($("#ordersubmit").trigger( "click" ));
  }else{
 $("#checkconfirm").prop( "checked", false );

  }
}); 

</script>
@endsection