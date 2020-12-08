@extends('Admin_lte.app') 
@section('title',__('file.Purchase'))
@section('pagecss')
<link rel="stylesheet" href="{{ asset('AdminLTE-3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('AdminLTE-3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">

@endsection
@section('content')
      <div class="table-responsive">
        
            <table class="table  table-bordered" id="purchaselist">
                <thead>
                    <tr>
                    
                    <th>#</th>
                        <th>วันที่</th>
                                               
                      
                         <th>PO N.O.</th>
                         <th>Supplier</th>
                         <th>รายการสินค้า</th>
                         <th>มูลค่ารวม</th>
                         <th>view</th>
                       
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>

  
        
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
        $('#purchaselist').DataTable({
      processing: true,
      serverSide: true,
      "ajax":{
      "url": "{{ url('purchase/polistdata') }}",
      "type": "GET",
      "data":{ csrf: "{{ csrf_token() }}"}
      
      },
      
      
             columns: [
     
              { data: 'id', name: 'id' },
              { data: 'po_date', name: 'po_date' },
                  { data: 'ponumber', name: 'ponumber' },
                  { data: 'supplierdt', name: 'supplierdt' },
                  { data: 'po_items', name: 'po_items' },
                  { data: 'po_grand_total', name: 'po_grand_total' },
                  { data: 'view', name: 'view' },

              ]
              ,"aaSorting": []
          });
    
        
    </script>
@endsection