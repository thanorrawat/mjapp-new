@extends('Admin_lte.app') 
@section('title',$podt->ponumber)
@section('pagecss')
<link rel="stylesheet" href="{{ asset('AdminLTE-3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('AdminLTE-3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endsection
@section('content')
<form  method="post" action="{{  url('supplier/purchase-update') }}">
<div class="table-responsive">
@csrf
<div class="text-right">
@if($podt->po_status==21)
<span class="btn btn-warning"><i  class="fas fa-tasks"></i> {{ __('file.postatus_'.$podt->po_status)  }}</span>
@elseif($podt->po_status==3)
<span class="btn btn-success"><i class="fas fa-clipboard-check"></i> {{ __('file.postatus_'.$podt->po_status)  }}</span>
</div>
@endif

Total	973		28128.08		55.1787			972119.375		
<table class="table  table-bordered" id="purchaselist">
<thead><tr>
 
  Code	จำนวนกล่องบรรจุ	น้ำหนัก	น้ำหนักรวม	พื้นที่ที่ใช้	พื้นที่ที่ใช้รวม	ราคาต่อชิ้น	ปริมาณ	ราคารวม	Supplier	Ref.PO
          

</tr>
</thead>
<tbody>
  @foreach($poitems as $key => $value)
    
 
  <tr>
<td class="text-center">{!! $key+1 !!}</td>
<td>{{ $value->poitems_productscode }}</td>
<td>{{ $value->poitems_productsname}}</td>
<td class="text-right">{{ $value->poitems_qty }}</td>
<td class="text-center">{{ $value->poitems_unit }}</td>
<td><input name="produce[]" id="produce_{{ $value->id }}" class="text-right form-control" type="number" value="{{ $value->sup_make }}"></td>
<td><input name="stock[]" id="stock_{{ $value->id }}" class="text-right form-control" type="number"  value="{{ $value->sup_stock }}"></td>
<td><input data-poitemid="{{ $value->id }}" name="shipment[]" id="shipment_{{ $value->id }}" class="form-control shipmentno" type="text"  value="{{ $value->sup_shipmentno }}"></td>
<td><input name="aboutload[]" id="aboutload_{{ $value->id }}" class="form-control" type="text" value="{{ $value->sup_aboutload }}"></td>
<td><span  id="finish_{{ $value->id }}">
@if($value->item_status>=3)
<i class="far fa-check-circle"></i>
@endif
</span>
  <input type="hidden" name="poitem_id[]" value="{{ $value->id }}">
  <input type="hidden" id="itemstatus_{{ $value->id }}"  name="poitem_status[]" value="{{ $value->item_status }}">

</td>


  </tr>
  @endforeach
</tbody>
</table>
</div>
<div class="text-center mt-2"> 
  <input type="hidden" name="po_id" value="{{ $podt->id }}">
  
  <button type="submit" class="btn btn-primary">Submit</button></div>
</form>
</div>
@endsection
@section('pagejs')
<!-- DataTables -->
<script src="{{ asset('AdminLTE-3/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('AdminLTE-3/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('AdminLTE-3/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('AdminLTE-3/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ asset('AdminLTE-3/plugins/datatables-buttons/js/buttons.html5.js')}}"></script>
<script src="{{ asset('AdminLTE-3/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script>


$('body').on('change keyUp blur', '.shipmentno', function () { 
   var itemis=  $(this).attr('data-poitemid');
   var shipmentno =  $(this).val();
var itemstatus =$("#itemstatus_"+itemis).val();
   if(shipmentno.length>2){
    $("#finish_"+itemis).html('<i class="far fa-check-circle"></i>');
    console.log(itemstatus);
if(itemstatus==2){
  $("#itemstatus_"+itemis).val(3);
}

   }else{
$("#finish_"+itemis).html('');
$("#itemstatus_"+itemis).val(2);
   }

    });
</script>
@endsection