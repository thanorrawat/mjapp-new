@extends('Admin_lte.app') 

@section('title',  'Show Status')
 
@section('titlenoblock',  'Show Status')


@section('pagecss')
   <!-- iCheck for checkboxes and radio inputs -->
   <link rel="stylesheet" href="{{ asset('AdminLTE-3/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
       <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('AdminLTE-3/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{ asset('AdminLTE-3/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-3/plugins/daterangepicker/daterangepicker.css')}}">
    {{-- <link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.3.45/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"> --}}
    
@endsection

@section('content')

<table class="table table-bordered">
<thead>

  <th>id</th>
  <th> st_id</th>
  <th>  type</th>
  <th>  statusname</th>
  <th>  color</th>
  <th> icon</th>
  <th> timeline_remark</th>

   
</thead>
<tbody>
@foreach($statusname as $statusnamerow)
<tr>
<td>{{ $statusnamerow->id  }}</td>
<td>{{ $statusnamerow->st_id  }}</td>
<td>{{ $statusnamerow->type  }}</td>
<td>{{ $statusnamerow->statusname  }}</td>
<td> <button class="btn" style="background-color:{{ $statusnamerow->color  }} "><i class="fa fa-{{ $statusnamerow->icon }}"></i> {{ $statusnamerow->statusname  }}</button></td>
<td> <i class="fa fa-{{ $statusnamerow->icon }}"></i></td>
<td>{{ $statusnamerow->timeline_remark  }}</td>

</tr>

@endforeach

</tbody>
</table>
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


@endsection