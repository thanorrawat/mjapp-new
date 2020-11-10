@extends('Admin_lte.app') 
@section('title',$pagetille)

@section('pagecss')
<link rel="stylesheet" href="{{ asset('AdminLTE-3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('AdminLTE-3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<style>


  .table thead th {
    border-width: 1px;
    vertical-align: middle;
    border-bottom: 2px solid #dee2e6;
    text-align: center;
  
}
</style>
@endsection

@section('content')
<div class="tab-content card-block">

      <div class="table-responsive">

        <table class="table table-bordered" id="willorder">
          <thead>
         
          <th>CODE</th>
          <th>NAME</th>
          <th>UNIT</th> 
@foreach ( $montharr as  $month)
<th>{{ $month }}</th> 
@endforeach
          <th>TOTAL</th>	
          <th>AVERAGE MONTH
          </th>	
          <th>AVERAGE DAYS
          </th>					
          <th>DELIVERY DAYS
          </th>	
          <th>SAFETY DAYS
          </th>		
          <th>MIN</th>	
          <th>MAX X2</th>
          <th>OVER MIN
          </th>	
          <th>STOCK</th>
          <th>PO</th>	
          <th>SO</th>	
          <th>DIFF</th>	
          <th>MIN ORDER
          </th>		
          <th>3 DAYS SALES
          </th>	
          <th>ORDER</th>								

          </thead>
      </table>



         
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


<!-- DataTables -->
<script src="{{ asset('AdminLTE-3/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('AdminLTE-3/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('AdminLTE-3/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('AdminLTE-3/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

{{-- #order-data-table --}}

<script>

$('#willorder').DataTable({
  processing: true,
    serverSide: true,
    "ajax":{
    "url": "{{ url("purchase/will_order_data") }}",
    "type": "GET",
    "data":{ csrf: "{{ csrf_token() }}",ordertype : "booking"}
    
    },
 columns: [
                { data: 'willor_productcode', name: 'willor_productcode' },
                { data: 'willor_productname', name: 'willor_productname' },
                { data: 'willor_unit', name: 'willor_unit' },
                { data: 'willor_qtym01', name: 'willor_qtym01' },
                { data: 'willor_qtym02', name: 'willor_qtym02' },
                { data: 'willor_qtym03', name: 'willor_qtym03' },
                { data: 'willor_qtym04', name: 'willor_qtym04' },
                { data: 'willor_qtym05', name: 'willor_qtym05' },
                { data: 'willor_qtym06', name: 'willor_qtym06' },
                { data: 'willor_qtym07', name: 'willor_qtym07' },
                { data: 'willor_qtym08', name: 'willor_qtym08' },
                { data: 'willor_qtym09', name: 'willor_qtym09' },
                { data: 'willor_qtym10', name: 'willor_qtym10' },
                { data: 'willor_qtym11', name: 'willor_qtym11' },
                { data: 'willor_qtym12', name: 'willor_qtym12' },
                { data: 'willor_qtytotal', name: 'willor_qtytotal' },
                { data: 'willor_average_month', name: 'willor_average_month' },
                { data: 'willor_average_day', name: 'willor_average_day' },
                { data: 'willor_delivery_day', name: 'willor_delivery_day' },
                { data: 'willor_safety_day', name: 'willor_safety_day' },
                { data: 'willor_min', name: 'willor_min' },
                { data: 'willor_max2', name: 'willor_max2' },
                { data: 'willor_overmin', name: 'willor_overmin' },
                { data: 'willor_stock', name: 'willor_stock' },
                { data: 'willor_po', name: 'willor_po' },
                { data: 'willor_so', name: 'willor_so' },
                { data: 'willor_diff', name: 'willor_diff' },
                { data: 'willor_minorder', name: 'willor_minorder' },
                { data: 'willor_3daysales', name: 'willor_3daysales' },
                { data: 'willor_order', name: 'willor_order' }
               
    
            ]
            ,
            "order": [[ 0, 'desc' ]]
            ,
            dom: 'Blfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'print'
            ]
    ,"columnDefs": [{ targets: 'no-sort', orderable: false }]
    
    
        });
    

</script>

@endsection