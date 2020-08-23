@extends('Admin_lte.app') 
@if (!empty($pagetille))
@section('title',$pagetille)
@elseif ($pagetype=="add")
@section('title',  'จัดทำ Order/ใบจอง')
@elseif ($pagetype=="edit")
@section('title',  'ทำรายการ'.$doctypename." เลขที่ ".$docnumber)
@endif  
@section('titlenoblock',  'จัดทำ Order/ใบจอง')


@section('pagecss')
   <!-- iCheck for checkboxes and radio inputs -->
   <link rel="stylesheet" href="{{ asset('AdminLTE-3/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
       <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('AdminLTE-3/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{ asset('AdminLTE-3/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-3/plugins/daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.3.45/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
    
@endsection

@section('contentnoblock')

<div id="app">
  @if ($pagetype=="add")
<order-selectcustomer baseurl="{{ $baseurl }}"  userfullname="{{  Auth::user()->fullname }}" userid="{{  Auth::user()->id }}"></order-selectcustomer>
@elseif ($pagetype=="edit")
<product-search baseurl="{{ $baseurl }}"  orderid="{{ $orderid }}"  showsearchtype="{{ $searchtype }}"  userfullname="{{  Auth::user()->fullname }}" userid="{{  Auth::user()->id }}" ></product-search>
@elseif ($pagetype=="memo_changprice")
<memo-price baseurl="{{ $baseurl }}"  userfullname="{{  Auth::user()->fullname }}" userid="{{  Auth::user()->id }}" csrf="{{ csrf_token() }}" role_id="{{ Auth::user()->role_id }}"></memo-price>
@endif   
</div>

@endsection

@section('pagejs')
<script src="{{ asset('AdminLTE-3/plugins/moment/moment.min.js')}}"></script>
<!-- Select2 -->
<script src="{{ asset('AdminLTE-3/plugins/select2/js/select2.full.min.js')}}"></script>

<!-- date-range-picker -->
<script src="{{ asset('AdminLTE-3/plugins/daterangepicker/daterangepicker.js')}}"></script>


@if (session('status'))
@if(session('statustype')=='success')
@php Alert::success(session('statustitle'), session('status')); @endphp
@elseif(session('statustype')=='error')
@php Alert::error(session('statustitle'), session('status')); @endphp
@endif
@endif

@if ($pagetype=="add" || $pagetype=="edit" )
<script>
  $('body').addClass('sidebar-mini sidebar-collapse');
       //Date range picker
     


</script>
@endif  
@endsection