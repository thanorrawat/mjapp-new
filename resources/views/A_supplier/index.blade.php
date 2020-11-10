@extends('Admin_lte.app') 
@section('title',__('file.Supplier'))
@section('pagecss')
@endsection
@section('content')
      <div class="table-responsive">
        <table class="table" id="supplierlist">
          <thead>
              <th>No.</th>
              <th>{{ __('file.Code') }}</th>
              <th>{{ __('file.name') }}</th>
              <th>{{ __('file.Address') }}</th>
              <th>{{ __('file.Phone Number') }}</th>
              <th>{{ __('file.Credit') }}</th>
              
             <th>Action</th>
          </thead>
          <tbody>
            <?php $num=1; ?>
            @foreach ( $supplierlist as  $supplier)   
            <tr>
              <td>{{ $num  }}</td>
              <td>{{  $supplier->suppliers_code}}</td>
              <td>{{  $supplier->fullname}}</td>
              <td>{{  $supplier->phone_number}}</td>
              <td>{{  $supplier->address}}</td>
              
             
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <?php $num++; ?>
            @endforeach
          </tbody>
      </table>
      </div>
@endsection
@section('pagejs')
@endsection