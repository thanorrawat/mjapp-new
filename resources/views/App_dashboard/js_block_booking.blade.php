<script>
    $('#booking-data-table').DataTable({
    processing: true,
    serverSide: true,
    "ajax":{
    "url": "{{ url("orderdata") }}",
    "type": "GET",
    "data":{ csrf: "{{ csrf_token() }}",ordertype : "booking"}
    
    },
    
    
           columns: [
                { data: 'bookingnumber', name: 'bookingnumber' },
                { data: 'customer_name', name: 'customer_name' },
                { data: 'deliverydate', name: 'deliverydate' },
                { data: 'ordecreate', name: 'ordecreate' },
                { data: 'createby_name', name: 'createby_name' },
                { data: 'statusname', name: 'statusname' },
                 { data: 'action', name: 'action' },
                 { data: 'action2', name: 'action2' }
    
            ]
            ,
            "order": [[ 0, 'desc' ]]
            ,
            dom: 'Blfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'print'
            ]
    ,"columnDefs": [{ targets: 'no-sort', orderable: false }]
    ,columnDefs: [
        {
            targets: 5,
            className: 'dt-body-center'
        }
      ]
    
        });
    
       $(document).on("click", ".orderpopup", function(){
        $('#print-btn').attr('data-type','order') ;  
      let token= $(this).attr( "data-token" );
      let ordernumber = $(this).attr( "data-ordernumber" );
    
    $('#product-details .modal-body').load('{{ url("order_view") }}/'+token);       
    $('#product-details .modal-title').text(ordernumber);   
    
    $('#pdf-btn').attr('href','{{ url("order_pdf") }}/'+token);   

       
    
    });
    </script>