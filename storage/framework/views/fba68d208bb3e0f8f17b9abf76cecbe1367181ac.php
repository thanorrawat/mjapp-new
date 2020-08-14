<script>
    $('#order-data-table').DataTable({
    processing: true,
    serverSide: true,
    "ajax":{
    "url": "<?php echo e(url("orderdata")); ?>",
    "type": "GET",
    "data":{ csrf: "<?php echo e(csrf_token()); ?>"}
    
    },
    
    
           columns: [
                { data: 'ordernumberfull', name: 'ordernumberfull' },
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
    
       $(document).on("click", ".productpopup", function(){
       
      let token= $(this).attr( "data-token" );
      let ordernumber = $(this).attr( "data-ordernumber" );
    
    $('#product-details .modal-body').load('<?php echo e(url("order_view")); ?>/'+token);       
    $('#product-details .modal-title').text(ordernumber);       
    
    });
    </script>