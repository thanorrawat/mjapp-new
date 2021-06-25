@extends('Admin_lte.app')  
@section('title',  __('file.product'))
@section('pagecss')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.23/b-1.6.5/b-html5-1.6.5/b-print-1.6.5/fc-3.3.2/fh-3.1.7/r-2.2.7/datatables.min.css"/>

@endsection
@section('content')

@if(session()->has('create_message'))
    <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('create_message') }}</div> 
@endif
@if(session()->has('edit_message'))
    <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('edit_message') }}</div> 
@endif
@if(session()->has('import_message'))
    <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('import_message') }}</div> 
@endif
@if(session()->has('not_permitted'))
    <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div> 
@endif
@if(session()->has('message'))
    <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('message') }}</div> 
@endif

<section>
    {{-- <div class="container-fluid mb-2">
        @if(in_array("products-add", $all_permission))
            <a href="{{route('products.create')}}" class="btn btn-info"><i class="dripicons-plus"></i> {{__('file.add_product')}}</a>
            <a href="#" data-toggle="modal" data-target="#importProduct" class="btn btn-primary"><i class="dripicons-copy"></i> {{__('file.import_product')}}</a>
        @endif
    </div> --}}
    <div class="table-responsive">
        <table id="product-data-table" class="table" style="width: 100%">
            <thead>             
                <th>{{trans('file.Code')}}</th>
                <th>{{trans('file.name')}}</th>
                <th>{{trans('file.Unit')}}</th>
                <th>{{trans('file.category')}}</th>
                <th>Stock 
                    ({{ $stock_sale_name }})
                </th>
                    {{-- <th>{{trans('file.category')}}</th>
                    <th>{{trans('file.Product Details')}}</th>
                    <th class="not-exported">{{trans('file.action')}}</th> --}}
            </thead>
        </table>
    </div>
</section>



<div id="product-details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{trans('Product Details')}}</h5>
                <button id="print-btn" type="button" class="btn btn-default btn-sm ml-3"><i class="dripicons-print"></i> {{trans('file.Print')}}</button>
                <button type="button" id="close-btn" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
        <div class="modal-body">
        </div>
        </div>
    </div>
</div>

<div id="importProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
      <div class="modal-content">
        {!! Form::open(['route' => 'product.import', 'method' => 'post', 'files' => true]) !!}
        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title">Import Product</h5>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
        </div>
        <div class="modal-body">
          {{-- <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
           <p>{{trans('file.The correct column order is')}} (image, name*, code*, type*, brand, category*, unit_code*, cost*, price*, product_details) {{trans('file.and you must follow this')}}.</p>
           <p>{{trans('file.To display Image it must be stored in')}} public/images/product {{trans('file.directory')}}. {{trans('file.Image name must be same as product name')}}</p> --}}
           <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{trans('file.Upload CSV File')}} *</label>
                        {{Form::file('file', array('class' => 'form-control','required'))}}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label> {{trans('file.Sample File')}}</label>
                        <a href="public/sample_file/sample_products_mj.csv" class="btn btn-info btn-block btn-md"><i class="dripicons-download"></i>  {{trans('file.Download')}}</a>
                    </div>
                </div>
           </div>           
            {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
        </div>
        {!! Form::close() !!}
      </div>
    </div>
</div>


@endsection
@section('pagejs')


<!-- DataTables -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.23/b-1.6.5/b-html5-1.6.5/b-print-1.6.5/fc-3.3.2/fh-3.1.7/r-2.2.7/datatables.min.js"></script>

<script>
    $('#product-data-table').DataTable({

        processing: true,
        serverSide: true,
        "ajax":{

            "url": "{{ url("products/product-data") }}",
            "type": "GET",
            "data":{ csrf: "{{ csrf_token() }}"}

        },
        columns: [
            @if($_COOKIE['language']=='th' )

                { data: 'stkcod', name: 'stkcod' },
                { data: 'stkdes', name: 'stkdes' },
                { data: 'unitname', name: 'unitname' },
                { data: 'stcatgory', name: 'stcatgory' },
                { data: 'stock_new', name: 'stock' },
                
            @else
                { data: 'stkcod', name: 'stkcod' },
                { data: 'stkdes2', name: 'stkdes2' },
                { data: 'unitname_en', name: 'unitname_en' },
                { data: 'stcatgory2', name: 'stcatgory2' },
                { data: 'stock_new', name: 'stock' },
            @endif

        ],
        dom: 'Blfrtip',
        buttons: [
            'copy','excel', 'print'
        ],
        "columnDefs": [
            { className: "text-right", "targets": [ 4 ] }
          ]
          ,
        "lengthMenu": [[10, 25, 50,100, -1], [10, 25, 50,100, "All"]]
    });

    $(document).on("click", ".productpopup", function(){
        let productid = $(this).attr( "data-productid" );
        $('#product-details .modal-body').load('{{ url("products/details") }}/'+productid);       

    });

    $("#print-btn").on("click", function(){
        var divToPrint=document.getElementById('product-details');
        var newWin=window.open('','Print-Window');
        newWin.document.open();
        newWin.document.write('<link rel="stylesheet" href="<?php echo asset('public/vendor/bootstrap/css/bootstrap.min.css') ?>" type="text/css"><style type="text/css">@media print {.modal-dialog { max-width: 1000px;} }</style><body onload="window.print()">'+divToPrint.innerHTML+'</body>');
        newWin.document.close();
        setTimeout(function(){newWin.close();},10);
    });
    
</script>
@endsection