@extends('Admin_lte.app') 
@section('title',$pagetille)

@section('pagecss')

<link rel="stylesheet" href="{{ asset('AdminLTE-3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('AdminLTE-3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('AdminLTE-3/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{ asset('AdminLTE-3/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

@endsection

@section('content')


<div class="container">

  <div class="row clearfix">
    <div class="col-md-12">
<table style="width: 100%" class="mb-3">
  <tr>
    <td style="width: 150px">ผู้จัดจำหน่าย</td>
    <td>
<select class="form-control select2" name="supplierlist" id="supplierlist" required>
  <option value="">Supplier</option>

  @foreach ( $supplierlist  as $supplier )
  <option 
  @if(!empty(Session::get('po_supplier_id')) && Session::get('po_supplier_id')==$supplier->suppid)
  selected  @endif
  value="{{ $supplier->suppid }}">{{ $supplier->suppliers_code }} - {{ $supplier->fullname }}</option>
  @endforeach
</select>

     
     
    </td>
    <td style="width: 150px">เลขที่ใบสั่งซื้อ</td>
    <td>{{ Session::get('newponumber') }}</td>
  </tr>
  <tr>
    <td></td>
    <td   id="supp_name"></td>
 
    <td>วันที่</td>
    <td>{{ date("d/m/Y") }}</td>
  </tr>
  <tr>
    <td></td>
    <td   id="supp_address"></td>
 

    <td>วันที่รับของ</td>
    <td></td>
  </tr>
  <tr>
    <td  >โทร.</td>
    <td id="supp_tel"></td>
    <td>เครดิต</td>
    <td id="supp_credit"></td>
  </tr>
  <tr>
    <td  >หมายเหตุ</td>
    <td></td>
    <td>ขนส่งโดย</td>
    <td></td>
  </tr>


  
</table>
    </div></div>
  <div class="row clearfix">
    <div class="col-md-12">
      <table class="table table-bordered table-hover" id="purchaseadd">
        <thead>
          <tr>
            <th class="text-center"> No.</th>
            <th class="text-center"> รหัสสินค้า/รายละเอียด </th>
            <th class="text-center"> จำนวน </th>
            <th class="text-center"> หน่วย </th>
            <th class="text-center"> หน่วยละ </th>
            <th class="text-center"> จำนวนเงิน </th>
          </tr>
        </thead>
        <tbody>
<?php $num=1; 


?>

    

  @foreach ( $checklist as $key=>$listrow )
      
 

          <tr id='addr_{{  $listrow }}'>
            <td>{{ $num }}</td>
            <td>{{  $checklistarr[$listrow]['code']   }} - {{ $checklistarr[$listrow]['name'] }}
            

 <input type="hidden" class="willitem" 
              data-willid="{{ $listrow }}"
              data-code="{{ $checklistarr[$listrow]['code'] }}"
              data-name="{{ $checklistarr[$listrow]['name'] }}"
              >
</td>
            <td>
              
    
              
              <input id="qty_{{  $listrow }}" type="number" data-willid="{{  $listrow }}" name='qty[]' placeholder='Enter Qty' class="form-control qty text-right qty_{{ $num }}" value="@if(!empty($poitemarr[$listrow]['qty'])){{$poitemarr[$listrow]['qty']}}@else{{$checklistarr[$listrow]['qty']}}@endif" step="0" min="0"/>
              
            </td><td class="unit_name">{{ $checklistarr[$listrow]['unit_name'] }}</td>
            <td>

       

                 <?php 
                 
                 if(!empty($poitemarr[$listrow]['price'])){
                  $costrow = $poitemarr[$listrow]['price'];

                 }else if(!empty($checklistarr[$listrow]['cost'])){

$costrow = $checklistarr[$listrow]['cost'];
              } else{
$costrow = 0;
              }?> 
<input type="number" id="price_{{  $listrow }}" name='price[]' data-willid="{{  $listrow }}"  placeholder='Enter Unit Price' class="form-control price  text-right" value="{{ number_format($costrow,2) }}"  step="0.00" min="0"/>
            
            </td>
            <td>

    

              <input id="total_{{  $listrow }}" type="number" name='total[]' placeholder='0.00' class="form-control total text-right" value=""  readonly/></td>
          </tr>
          <?php $num++; ?>     
          @endforeach

       
        </tbody>
      </table>
    </div>
  </div>
  {{-- <div class="row clearfix">
    <div class="col-md-12">
      <button id="add_row" class="btn btn-default pull-left">Add Row</button>
      <button id='delete_row' class="pull-right btn btn-default">Delete Row</button>
    </div>
  </div> --}}
  <div class="row justify-content-end clearfix"  style="margin-top:20px">
    <div class="pull-right col-md-12 ">
      <table class="table table-bordered table-hover" id="tab_logic_total">
        <tbody>
          <tr>
            <td rowspan="6" style="width: 50%">(<span id="total_amount_text">0</span>)</td>
            <th class="text-center">รวมเป็นเงิน</th>
            <td class="text-center"><input type="number" name='sub_total' placeholder='0.00' class="form-control text-right" id="sub_total" readonly/></td>
          </tr>
          <tr>
            <th class="text-center">หักส่วนลด</th>
            <td class="text-center"><input type="number" name='discount' placeholder='0.00' class="form-control text-right" id="discount" value="{{ Session::get('podiscount') }}" /></td>
          </tr>
          <tr>
            <tr>
              <th class="text-center">จำนวนเงินหลังหักส่วนลด</th>
              <td class="text-center"><input type="number" name='afterdiscount' placeholder='0.00' class="form-control text-right" id="afterdiscount" readonly/></td>
            </tr>
            <tr>
            <th class="text-center">จำนวนภาษีมูลค่าเพิ่ม 7.00%</th>
            <td class="text-center"><div class="input-group mb-2 mb-sm-0">
                <input type="number" class="form-control text-right" id="vat7" placeholder="0" readonly>
             
              </div></td>
          </tr>
      <th class="text-center">จำนวนเงินทั้งสิ้น</th>
            <td class="text-center text-right"><input type="number" name='total_amount' id="total_amount" placeholder='0.00' class="form-control text-right" readonly/></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
<div class="text-center"> <button id="buttonsubmit" type="button" class="btn btn-primary">สร้างใบสั่งซื้อ</button></div>
<div id="show"></div>
<?php // print_r($poitemarr); ?> 
@endsection

@section('pagejs')
<!-- DataTables -->
<script src="{{ asset('AdminLTE-3/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('AdminLTE-3/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('AdminLTE-3/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('AdminLTE-3/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ asset('AdminLTE-3/plugins/datatables-buttons/js/buttons.html5.js')}}"></script>
<script src="{{ asset('AdminLTE-3/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>


<!-- Select2 -->
<script src="{{ asset('AdminLTE-3/plugins/select2/js/select2.full.min.js')}}"></script>

<script>




var countqty = $('.qty').length;
for(var i=0;i<= countqty;i++){
  var willorderid =  $('.qty_'+i).attr( "data-willid" );
  calrow(willorderid);
}

  function calrow(willorderid){

var rowqty =   $('#qty_'+willorderid).val();
var rowprice =   $('#price_'+willorderid).val();
var rowtotal =  (+rowqty)*(+rowprice);
$('#total_'+willorderid).val(rowtotal.toFixed(2));
  }

  function subtotal(){
    var countqty = $('.qty').length;
    var subtotal = 0;
for(var i=0;i<= countqty;i++){
  var willorderid =  $('.qty_'+i).attr( "data-willid" );
  var totalrow =$('#total_'+willorderid).val();
  if(isNaN(totalrow)){
    totalrow =0;
  }
  subtotal = (+subtotal)+(+totalrow);
}
$('#sub_total').val(subtotal);

  }


  function discountall(){
var subtotal = $('#sub_total').val();
var discountpurchase = $('#discount').val();
// alert(subtotal);
 afterdiscount = (+subtotal)-(+discountpurchase);
var vat7 = (+afterdiscount) *(0.07);
var grandtotal = (+afterdiscount)+(+vat7);
 $('#afterdiscount').val(afterdiscount.toFixed(2));
 $('#vat7').val(vat7.toFixed(2));
 $('#total_amount').val(grandtotal.toFixed(2));
 numbertotext()
  }
  function numbertotext(){
   let number =  $('#total_amount').val();
   $.get( "{{ url('numbertotext') }}/"+number )
  .done(function( data ) {

$('#total_amount_text').text(data);
  });

  updatesessionitempo()

   }
   


function updatesessionitempo(){

 ///log dt

 $('.willitem').each(function(index, value) {

var willid =$(this).attr('data-willid');
var code=$(this).attr('data-code');
var name =$(this).attr('data-name');
var qty = $('.qty').eq(index).val();
var price = $('.price').eq(index).val();
var total = $('.total').eq(index).val();
console.log(`.willitem${index}: ${willid} : ${code} : ${name} : ${qty} : ${price} : ${total}` );


// //updatesession
// $.post( "{{ url('purchase/updatesessionpoitems') }}", {  csrf: "{{ csrf_token() }}"
// ,index: index
// ,willid : willid
// ,code:code
// ,name:name
// ,qty:qty
// ,price:price
// ,total:total

// })
// .done(function( data ) {

// });

 });

}




   function updateprchaserow(willorderid,qty,price){  

   $.post( "{{ url('purchase/updateprchaserow') }}", {  csrf: "{{ csrf_token() }}",willorderid : willorderid ,qty:qty,price:price})
   .done(function( data ) {
  calrow(willorderid)
  subtotal();
  discountall()
   });
   }



   function updateprchasedt(discount){  
$.post( "{{ url('purchase/updatepurchase') }}", {  csrf: "{{ csrf_token() }}",discount:discount})

}





   function supplierdt(supplierid){  

$.get( "{{ url('purchase/checksupplier') }}", {  csrf: "{{ csrf_token() }}",supplierid:supplierid})
.done(function( data ) {

  $('#supp_name').text(data.fullname);
  $('#supp_address').text(data.address);
  $('#supp_tel').text(data.phone_number);
  $('#supp_credit').text(data.credit);
});
}

$('#supplierlist').on('change keyUp', function () { 
  var supplierid = $(this).val();
  supplierdt(supplierid)
});


$('body').on('change keyUp', '#discount', function () { 
  discountall()
  var discount = $('#discount').val();
  updateprchasedt(discount);
});

$('body').on('change', '.qty,.price', function () { 
  var willorderid =  $( this).attr( "data-willid" );
  //calrow(willorderid);
var qty =   $('#qty_'+willorderid).val();
var price =   $('#price_'+willorderid).val();
  updateprchaserow(willorderid,qty,price)
  
});

$( document ).ready(function() {
  subtotal();
  discountall()
  //$('#purchaseadd').DataTable();
  numbertotext()
  $('.select2').select2();
  var supplierid = $('#supplierlist').val();
  supplierdt(supplierid)
});





////create PO

function createpo(){  


var supplier_id=  $('#supplierlist').val();
var po_total=  $('#sub_total').val();
var po_discount=  $('#discount').val();
var po_afterdiscount=  $('#afterdiscount').val();
var po_vat=  $('#vat7').val();
var po_grand_total=  $('#total_amount').val();

 var po_items =  $('.willitem').length;

  $.post( "{{ url('purchase/creatpo') }}", {  csrf: "{{ csrf_token() }}",

   supplier_id : 	supplier_id,
  po_items: po_items,
   po_total:po_total,
   po_discount: po_discount,
   po_afterdiscount:po_afterdiscount,
   po_vat:po_vat,
   po_grand_total:po_grand_total

})
   .done(function( data ) {
if(data !==null){
  var purchaseid = data;
  $('.willitem').each(function(index, value) {
    var willid =$(this).attr('data-willid');
var code=$(this).attr('data-code');
var name =$(this).attr('data-name');
var qty = $('.qty').eq(index).val();
var price = $('.price').eq(index).val();
var total = $('.total').eq(index).val();
var unit_name =  $('.unit_name').eq(index).val();
$.post( "{{ url('purchase/creatitems') }}", {  csrf: "{{ csrf_token() }}",
purchaseid:purchaseid,
code:code,
name:name,
qty:qty,
price:price,
total:total,
unit_name :unit_name,
willid:willid
})


  })
}
   }).then(function() {

    $.get( "{{ url('clearsessionpo') }}" );

    }).then(function() {
window.location.replace("{{ url('purchases') }}");
}); 
}


  $( "#buttonsubmit" ).click(function() {
   createpo()
  });

</script>

@endsection