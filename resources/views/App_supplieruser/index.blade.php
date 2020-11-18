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
                    
                     <th>PO</th>
                     <th>Date</th>
                     <th>Code</th>
                     <th>Detail</th>  
                     <th>Unit</th> 
                     <th>Order</th>		
                     		  				
          	
                     <th >ผลิต</th>		  				
                     	  				
          
                     <th >Stock</th>	  				

                       
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
      "url": "{{ url('polistforcheckdata') }}",
      "type": "GET",
      "data":{ csrf: "{{ csrf_token() }}"}
      
      },
      
      
             columns: [
     
                { data: 'ponumber', name: 'ponumber' },
                { data: 'po_date', name: 'po_date' },
    { data: 'poitems_productscode', name: 'poitems_productscode' },
              { data: 'poitems_productsname', name: 'poitems_productsname' },
              { data: 'poitems_unit', name: 'poitems_unit' },
              { data: 'poitems_qty', name: 'poitems_qty' },

              { data: 'sup_make', name: 'sup_make' },
              { data: 'sup_stock', name: 'sup_stock' },


       


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