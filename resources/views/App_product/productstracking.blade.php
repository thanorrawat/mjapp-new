@extends('layout-theme-gradient-able.app2') 
@section('title', 'Product Tracking')
@section('content')
<table class="table table-bordered">
    <thead>
        <th>Date</th>
        <th>ทำรายการ</th>
        <th>จำนวน</th>
        <th>เอกสาร</th>
        <th>คลังพร้อมขาย</th>
        <th>คลัง Order</th>
        <th>คลังจอง</th>
        <th>รายการ S.O.</th>
    </thead>
    <tbody>
@foreach ( $tracking as $track)
<tr>
    <td>{{ $track->created_at  }}</td>
    <td>{{ $track->comment }}</td>
    <td>{{ $track->product_qty  }}</td>
    <td>{{ $track->ref_no }}</td>
  
    <td>@if($track->stocktype_1==1) {{ $track->product_qty  }} @elseif($track->stocktype_1==2)-{{ $track->product_qty  }}@endif</td>
    <td>@if($track->stocktype_2==1) {{ $track->product_qty  }} @elseif($track->stocktype_2==2)-{{ $track->product_qty  }}@endif</td>
    <td>@if($track->stocktype_3==1) {{ $track->product_qty  }} @elseif($track->stocktype_3==2)-{{ $track->product_qty  }}@endif</td>
    <td>@if($track->stocktype_4==1) {{ $track->product_qty  }} @elseif($track->stocktype_4==2)-{{ $track->product_qty  }}@endif</td>

</tr>
@endforeach
        
    </tbody>
</table>
@endsection