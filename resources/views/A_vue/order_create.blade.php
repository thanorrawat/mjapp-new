@extends('Admin_lte.app') 
@if ($pagetype=="add")
@section('title',  'จัดทำ Order/ใบจอง')
@elseif ($pagetype=="edit")
@section('title',  'ทำรายการ'.$doctypename." เลขที่ ".$docnumber)
@endif  
@section('titlenoblock',  'จัดทำ Order/ใบจอง')


@section('pagecss')
   <!-- iCheck for checkboxes and radio inputs -->
   <link rel="stylesheet" href="{{ asset('AdminLTE-3/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
     <!-- Select2 -->
 
@endsection

@section('contentnoblock')

<div id="app">
  @if ($pagetype=="add")
<order-selectcustomer baseurl="{{ $baseurl }}"  userfullname="{{  Auth::user()->fullname }}" userid="{{  Auth::user()->id }}"></order-selectcustomer>
@elseif ($pagetype=="edit")
<product-search baseurl="{{ $baseurl }}"  orderid="{{ $orderid }}"  showsearchtype="{{ $searchtype }}"  userfullname="{{  Auth::user()->fullname }}" userid="{{  Auth::user()->id }}" ></product-search>
@endif   
</div>

@endsection

@section('pagejs')

@if (session('status'))
@if(session('statustype')=='success')
@php Alert::success(session('statustitle'), session('status')); @endphp
@elseif(session('statustype')=='error')
@php Alert::error(session('statustitle'), session('status')); @endphp
@endif
@endif

<script>
  $('body').addClass('sidebar-mini sidebar-collapse');
</script>

@endsection