<script>
$('#product-data-table').DataTable({
processing: true,
serverSide: true,
      //  ajax: '{{ url("products/product-data?csrf=".csrf_token()) }}',
        "ajax":{

"url": "{{ url("products/product-data") }}",
"type": "GET",
"data":{ csrf: "{{ csrf_token() }}"}

},
        columns: [

            { data: 'image', name: 'products.image' },
            { data: 'code', name: 'products.code' },
            { data: 'name', name: 'products.name' },

            { data: 'category', name: 'categories.name' },
            { data: 'detailsnew', name: 'products.product_details' },
            { data: 'qty', name: 'products.qty' },
            { data: 'orderqty', name: 'orderqty' },
  
            { data: 'select', name: 'select' }

        ]
        // ,
        // dom: 'Blfrtip',
        // buttons: [
        //     'copy', 'csv', 'excel', 'print'
        // ]
,"columnDefs": [{ targets: 'no-sort', orderable: false }]
,columnDefs: [
    {
        targets: 5,
        className: 'dt-body-center'
    }
  ]

    });

    $(document).on("click", ".productpopup", function(){
  
  let productid = $(this).attr( "data-productid" );
  $('#print-btn').attr('data-type','product') ;  
$('#product-details .modal-body').load('{{ url("products/details") }}/'+productid);       
$('.modal-title').text('{{trans('Product Details')}}');  
});
    </script>