@extends('Admin_lte.app') 
@section('title','Dashboard')
@section('pagecss')
<link rel="stylesheet" href="{{ asset('AdminLTE-3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('AdminLTE-3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endsection
@section('content')

<h1>Dashboard</h1>

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
        $('#purchaselist').DataTable({
      processing: true,
      serverSide: true,
      "ajax":{
      "url": "{{ url('polistforcheckdata') }}",
      "type": "GET",
      "data":{ csrf: "{{ csrf_token() }}"}
      },
      columns: [
{ data: 'ponumber', name: 'ponumber' },
{ data: 'supplier_name', name: 'supplier_name' },
{ data: 'po_view', name: 'po_view' },
{ data: 'po_status', name: 'po_status' },

],columnDefs: [
      { className: "text-center", "targets": [2,3] },
    ]
,"aaSorting": [0,'desc']
          });
$('body').on('change keyUp blur', '.sup_make,.sup_stock', function () { 
   var itemid =  $(this).attr('data-itemid');
   var stock =  $("#sup_stock-"+itemid).val();
   var make =  $("#sup_make-"+itemid).val();
   $.post( "{{ url('polistupdate') }}", {  csrf: "{{ csrf_token() }}",itemid :itemid,stock:stock,make:make})
    });
</script>
@endsection