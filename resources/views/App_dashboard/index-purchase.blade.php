@extends('Admin_lte.app') 
@section('title',  $pagetille)
@section('pagecss')
 <!-- Ionicons -->
 <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

<link rel="stylesheet" href="{{ asset('AdminLTE-3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('AdminLTE-3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endsection
@section('contentnoblock')
<div class="row">
  <div class="col-lg-12">
      <div class="card">
        
        <div class="card-header">
          <h3  class="card-title">สินค้าที่ต้องจัดซื้อ</h3>

          <div class="card-tools"> <div class="float-right btn btn-warning ml-1">

            <i class="fas fa-shopping-cart"></i> <span id="showitemspurchase">0</span> {{ __('file.Items') }} 
          </div><a target="_blank" class="btn btn-info float-right" href="{{ url('purchase/will_order') }}">Will Order </a>
          </div>
        </div>

          <div class="card-body">
           
         
               
              <div class="table-responsive">
                  <table class="table  table-bordered" id="willpurchaselist">
                      <thead>
                          <tr>
                            <th><input @if(!empty(Session::get('allcheck')) && Session::get('allcheck')=="y") checked @endif type="checkbox" name="" id="checkallpurchase"></th>
                          <th>#</th>
                              <th>สินค้า</th>
                                                     
                               <th>Max2</th>
                               <th>Stock</th>
                               <th>PO</th>
                               <th>SO</th>
                               <th>Diff</th>
                               <th>Order</th>
                             
                          </tr>
                      </thead>
                      <tbody>

                      </tbody>
                  </table>
              </div>
              <div class="text-center">  <a href="{{ url('purchase/create') }}" class="waves-effect waves-light mt-3 btn btn-lg btn-info accent-4 mb-3"> <i class="mdi mdi-file-document"></i>จัดทำใบสั่งซื้อ</a></div>
          
              <div class="result"></div>
          </div>
      </div>
  </div>
</div>
@if(empty($pocreate))
{{-- Order--}}
<div class="row">
        <div class="col-md-12">
        <div class="card">
          <div class="card-header border-transparent">
            <h3 class="card-title"> ORDER จากฝ่ายขาย </h3>

          
          </div>
          <!-- /.card-header -->
          <div class="card-body ">
            <div class="table-responsive">
     

                          <table class="table" id="order-data-table">
                              <thead>
                                  <th>Order No.</th>
                                  <th>ลูกค้า</th>
                                  <th>Due Date</th>
                                  <th>ทำรายการเมื่อ</th>
                                  <th>ผู้ทำรายการ</th>
                                  <th>สถานะ</th>
                                  <th>เอกสาร</th>
                                  <th>Action</th>
                              </thead>
                          </table>




                           
                        </div>
         
            <!-- /.table-responsive -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer text-center">
            <a style="    width: 100%;" href="{{ url('order-list') }}" class="uppercase"> {{ __('file.View All') }} </a>
          </div>
          <!-- /.card-footer -->
        </div>
      </div>
    </div>





    <div class="row">
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header border-0">
            <h3 class="card-title">สินค้าขายดี 20 อันดับ หมวด PU</h3>
    
          </div>
          <div class="card-body p-1">
            <table class="table table-striped table-valign-middle datatable">
              <thead>
              <tr>
                <th>Product</th>
                <th>Sales</th>
                <th>Unit</th>
                <th>More</th>
              </tr>
              </thead>
              <tbody>
                @foreach ( $selling3 as $sell3 )
                    
              
              <tr>
                <td>
    @if(!empty($sell3->image))  
          <img src="{{ url('public/images/product/',$sell3->image) }}" alt="{{ $sell3->name }}" class="img-circle img-size-32 mr-2">
        @else
        <img src="{{ url('public/images/product/zummXD2dvAtI.png') }}" alt="{{ $sell3->name }}" class="img-circle img-size-32 mr-2">
        @endif
                <strong>  {{ $sell3->product_code }}</strong>   -  {{ $sell3->name }}
                </td>
            
                <td class="text-right">
                  {{-- <small class="text-success mr-1">
                    <i class="fas fa-arrow-up"></i>
                    12%
                  </small> --}}
                  {{ number_format($sell3->selling_qty) }}
                </td>
                <td>
                  {{ $sell3->unit_name }}
                </td>
                <td>
                  <a href="#" class="text-muted">
                    <i class="fas fa-search"></i>
                  </a>
                </td>
              </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>

{{-- PU --}}
{{-- BK --}}
  <!-- /.card -->

  <div class="card">
    <div class="card-header border-0">
      <h3 class="card-title">สินค้าขายดี 20 อันดับ หมวด BK</h3>

    </div>
    <div class="card-body p-1">
      <table class="table table-striped table-valign-middle datatable">
        <thead>
        <tr>
          <th>Product</th>
          <th>Sales</th>
          <th>Unit</th>
          <th>More</th>
        </tr>
        </thead>
        <tbody>
          @foreach ( $selling2 as $sell2 )
              
        
        <tr>
          <td>
@if(!empty($sell2->image))  
    <img src="{{ url('public/images/product/',$sell2->image) }}" alt="{{ $sell2->name }}" class="img-circle img-size-32 mr-2">
  @else
  <img src="{{ url('public/images/product/zummXD2dvAtI.png') }}" alt="{{ $sell2->name }}" class="img-circle img-size-32 mr-2">
  @endif
          <strong>  {{ $sell2->product_code }}</strong>   -  {{ $sell2->name }}
          </td>
      
          <td class="text-right">
            {{-- <small class="text-success mr-1">
              <i class="fas fa-arrow-up"></i>
              12%
            </small> --}}
            {{ number_format($sell2->selling_qty) }}
          </td>
          <td>
            {{ $sell2->unit_name }}
          </td>
          <td>
            <a href="#" class="text-muted">
              <i class="fas fa-search"></i>
            </a>
          </td>
        </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <!-- /.card -->
  {{-- BK --}}
  {{-- CP --}}
  <!-- /.card -->

  <div class="card">
    <div class="card-header border-0">
      <h3 class="card-title"> <i class="fas fa-chart-line"></i> สินค้าขายดี 20 อันดับ หมวด CP</h3>

    </div>
    <div class="card-body p-1">
      <table class="table table-striped table-valign-middle datatable">
        <thead>
        <tr>
          <th>Product</th>
          <th>Sales</th>
          <th>Unit</th>
          <th>More</th>
        </tr>
        </thead>
        <tbody>
          @foreach ( $selling1 as $sell1 )
              
        
        <tr>
          <td>
@if(!empty($sell1->image))  
    <img src="{{ url('public/images/product/',$sell1->image) }}" alt="{{ $sell1->name }}" class="img-circle img-size-32 mr-2">
  @else
  <img src="{{ url('public/images/product/zummXD2dvAtI.png') }}" alt="{{ $sell1->name }}" class="img-circle img-size-32 mr-2">
  @endif
          <strong>  {{ $sell1->product_code }}</strong>   -  {{ $sell1->name }}
          </td>
      
          <td class="text-right">
            {{-- <small class="text-success mr-1">
              <i class="fas fa-arrow-up"></i>
              12%
            </small> --}}
            {{ number_format($sell1->selling_qty) }}
          </td>
          <td>
            {{ $sell1->unit_name }}
          </td>
          <td>
            <a href="#" class="text-muted">
              <i class="fas fa-search"></i>
            </a>
          </td>
        </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <!-- /.card -->

  {{-- CP --}}
  {{-- หมวดอื่น --}}
    <!-- /.card -->

    <div class="card">
      <div class="card-header border-0">
        <h3 class="card-title">สินค้าขายดี 20 อันดับ หมวดอื่น</h3>

      </div>
      <div class="card-body p-1">
        <table class="table table-striped table-valign-middle datatable">
          <thead>
          <tr>
            <th>Product</th>
            <th>Sales</th>
            <th>Unit</th>
            <th>More</th>
          </tr>
          </thead>
          <tbody>
            @foreach ( $selling4 as $sell4 )
                
          
          <tr>
            <td>
@if(!empty($sell4->image))  
      <img src="{{ url('public/images/product/',$sell4->image) }}" alt="{{ $sell4->name }}" class="img-circle img-size-32 mr-2">
    @else
    <img src="{{ url('public/images/product/zummXD2dvAtI.png') }}" alt="{{ $sell4->name }}" class="img-circle img-size-32 mr-2">
    @endif
            <strong>  {{ $sell4->product_code }}</strong>   -  {{ $sell4->name }}
            </td>
        
            <td class="text-right">
              {{-- <small class="text-success mr-1">
                <i class="fas fa-arrow-up"></i>
                12%
              </small> --}}
              {{ number_format($sell4->selling_qty) }}
            </td>
            <td>
              {{ $sell4->unit_name }}
            </td>
            <td>
              <a href="#" class="text-muted">
                <i class="fas fa-search"></i>
              </a>
            </td>
          </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <!-- /.card -->
  {{-- หมวดอื่น --}}
      </div>

      <div class="col-lg-6">
{{--Stock Status --}}
<div class="card card-hover">
  <div class="card-body">
 
      <div class="row mt-5">
        <!-- column -->
        <div class="col-lg-7">
    
          <canvas id="donutChart" style="height:300px; min-height:300px"></canvas>
        </div>
        <!-- column -->
        <div class="col-lg-5">
            <h1 class="display-6 mb-0 font-medium">Stock Status</h1>
            <span>สถานะ Stock สินค้า</span>
            <ul class="list-style-none">
                <li class="mt-3"><i class="fas fa-circle mr-1 font-12" style="color: #00a65a"></i> สถานะปรกติ <span id="st1val" class="float-right">45%</span></li>
                <li class="mt-3"><i class="fas fa-circle mr-1  font-12" style="color: #f39c12"></i> สินค้า Over Stock <span id="st2val" class="float-right">14%</span></li>
                <li class="mt-3"><i class="fas fa-circle mr-1   font-12" style="color: #F9E304"></i> สินค้าต่ำกว่า Min <span id="st3val" class="float-right">25%</span></li>
                <li class="mt-3"><i class="fas fa-circle mr-1   font-12" style="color: #FF3333"></i> สินค้าหมด <span id="st4val" class="float-right">17%</span></li>
            </ul>
        </div>
    </div>
      <!-- column -->
      
  </div>
</div>

{{-- Stock Status --}}

{{-- สินค้าค้างรับ --}}

<div class="card">
        
  <div class="card-header">
    <h3  class="card-title">สินค้าค้างรับ</h3>

    <div class="card-tools">
   




    </div>
  </div>

    <div class="card-body">
     
   
         
        <div class="table-responsive">
            <table class="table  table-bordered" id="wrecieve">
                <thead>
                    <tr>

                        <th>สินค้า</th>
<th>จำนวนค้างรับ</th>
                       
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    
    </div>
</div>
{{-- สินค้าค้างรับ --}}
      </div>



    </div>


@endif

</div>
</div>



{{-- ORDER POPUP --}}


<div id="product-details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="exampleModalLabel" class="modal-title">{{trans('Order Details')}}</h5>
        <div class="text-right">

          <button id="print-btn" type="button" class="btn btn-outline-info btn-sm ml-3"><i class="dripicons-print"></i> {{trans('file.Print')}}</button>
          <a href="" id="pdf-btn" target="_blank" type="button" class="btn btn-outline-info btn-sm ml-3"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF</a>
          
        </div>
        <button type="button" id="close-btn" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
      </div>
      <div class="modal-body table-responsive" >
          <div id="product-detailsprint">


          </div>

      </div>
    </div>
  </div>

</div>


{{-- ORDER POPUP --}}

@endsection
@section('pagejs')





<!-- DataTables -->
<script src="{{ asset('AdminLTE-3/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('AdminLTE-3/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('AdminLTE-3/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('AdminLTE-3/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ asset('AdminLTE-3/plugins/datatables-buttons/js/buttons.html5.js')}}"></script>
<script src="{{ asset('AdminLTE-3/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>


<!-- ChartJS -->
<script src="{{ asset('AdminLTE-3/plugins/chart.js/Chart.min.js')}}"></script>

<script>
$("#print-btn").on("click", function(){
          var divToPrint=document.getElementById('product-details');
          var newWin=window.open('','Print-Window');
          newWin.document.open();
          newWin.document.write('<link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" type="text/css"><style type="text/css">.modal-header{ display: none;},.modal-content{border: none;}@media  print {.modal-dialog { max-width: 1000px;}}</style><body onload="window.print()">'+divToPrint.innerHTML+'</body>');
          newWin.document.close();
          setTimeout(function(){newWin.close();},10);
    });
    // $('#willpurchaselist').DataTable({
    //   'columnDefs': [{
    //      'targets': 0,
    //      'searchable': false,
    //      'orderable': false,
    //   }],

    //   dom: 'Blfrtip',
    // buttons: [
    //     'selectAll',
    //     'selectNone'
    // ]
    // });
    

    $('#wrecieve').DataTable({
  processing: true,
  serverSide: true,
  "ajax":{
  "url": "{{ url('purchase/wrecievedata') }}",
  "type": "GET",
  "data":{ csrf: "{{ csrf_token() }}"}
  
  },
  
  
         columns: [
  
              { data: 'stock_productcode', name: 'stock_productcode' },
              { data: 'stock_w_recieve', name: 'stock_w_recieve' },
  
          ]
          ,
          "order": [[ 1, 'desc' ]],
          "pageLength": 5,
      "lengthMenu": [[5,10, 25, 50,100, -1], [5,10, 25, 50,100, "All"]]

      });
    $('#willpurchaselist').DataTable({
  processing: true,
  serverSide: true,
  "ajax":{
  "url": "{{ url('purchase/will_order_data2') }}",
  "type": "GET",
  "data":{ csrf: "{{ csrf_token() }}"}
  
  },
  
  
         columns: [
          { data: 'selectbox', name: 'selectbox' },
          { data: 'id', name: 'id' },
              { data: 'willor_productcode', name: 'willor_productcode' },
              
              { data: 'willor_max2', name: 'willor_max2' },

              { data: 'willor_stock', name: 'willor_stock' },
              { data: 'willor_po', name: 'willor_po' },
              { data: 'willor_so', name: 'willor_so' },
              { data: 'willor_diff', name: 'willor_diff' },
              { data: 'willor_order', name: 'willor_order' }
  
          ]
          ,
          "order": [[ 7, 'desc' ]],
          "columnDefs": [ {
"targets": 0,
"orderable": false
}, {
        targets: 1,
        className: 'text-right'
    }
    , {
        targets: 3,
        className: 'text-right'
    }, {
        targets: 4,
        className: 'text-right'
    }, {
        targets: 5,
        className: 'text-right'
    }, {
        targets: 6,
        className: 'text-right'
    }, {
        targets: 7,
        className: 'text-right'
    }
     ]


      });

    



    $('.datatable').DataTable({
      "pageLength": 5,
      "lengthMenu": [[5,10, 25, 50,100, -1], [5,10, 25, 50,100, "All"]],
      "order": [[ 1, 'desc' ]],
    });

</script>

<script>

function showitemspurchase(selectallv){
   $.get( "{{ url('purchase/show_purchase_items') }}")
  .done(function( data ) {

$('#showitemspurchase').text(data);
  });

   }
   

   function genpurchasenumber(){
   $.get( "{{ url('purchase/genpurchasenumber') }}")
   }


function loaddonut(datadn){
    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
      // labels:  [
      //       'สถานะปรกติ', 
      //       'สินค้า Over Stock',
      //       'สินค้าต่ำกว่า Min', 
      //       'สินค้าหมด', 
      //      ],
      datasets: [
        {
          data: datadn,
          backgroundColor : ['#00a65a', '#f39c12', '#F9E304', '#FF3333'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart = new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions      
    })
}

$.post( "{{ url('purchase/stock_status_post') }}")
  .done(function( data ) {
    $('#st1val').text(data['statusarr'][0].toFixed());
    $('#st2val').text(data['statusarr'][1].toFixed());
    $('#st3val').text(data['statusarr'][2].toFixed());
    $('#st4val').text(data['statusarr'][3].toFixed());
  loaddonut(data['statusarr']);

   
  });

  function updateselect(selectallv){
   $.post( "{{ url('purchase/checkselect') }}", {  csrf: "{{ csrf_token() }}",selectall : selectallv})
  .done(function( data ) {

$('.result').text(data);
showitemspurchase();
genpurchasenumber();
  });

   }

  $('body').on('change', '#checkallpurchase', function(){
      // If checkbox is not checked
      if(!this.checked){
        $(".checkpurechase").prop('checked', false);
      let  selectallv = 'n';
      updateselect(selectallv);
      }else{
        $(".checkpurechase").prop('checked', true);
        let  selectallv = 'y';
      updateselect(selectallv);
      }

     
   });

    $('body').on('change', '.checkpurechase', function () { 
  // $('body').on('change click', '.checkpurechase', function(){
   let thisid = $(this).val();


   if ($(this).is(':checked')) {
        var selectthis = 'y';
 
    
      }else{
        var selectthis = 'n';
    
        $("#checkallpurchase").prop('checked', false);
      }
   
      $.post( "{{ url('purchase/checkselect') }}", {  csrf: "{{ csrf_token() }}",selectthis : selectthis,thisid:thisid})
  .done(function( data ) {
$('.result').text(data);
showitemspurchase();
   });
 
   });
   
   showitemspurchase();


</script>




<script>
    $('#order-data-table').DataTable({
    processing: true,
    serverSide: true,
    "ajax":{
    "url": "{{url('orderdata')}}",
    "type": "GET",
    "data":{ csrf: "{{ csrf_token() }}",ordertype : "order",approved:'13'}
    
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
    
       $(document).on("click", ".orderpopup", function(){
  
        $('#print-btn').attr('data-type','order') ;  
      let token= $(this).attr( "data-token" );
      let ordernumber = $(this).attr( "data-ordernumber" );
    
    $('#product-details .modal-body').load('{{ url('order_view') }}/'+token);       
    $('#product-details .modal-title').text(ordernumber);   
    
    $('#pdf-btn').attr('href','{{ url('order_pdf') }}/'+token);   

       
    
    });
    </script>
<script>
  $("#print-btn").on("click", function(){
            var divToPrint=document.getElementById('product-details');
            var newWin=window.open('','Print-Window');
            newWin.document.open();
            newWin.document.write('<link rel="stylesheet" href="{{ url('assets/css/custom.css') }}" type="text/css"><style type="text/css">.modal-header{ display: none;},.modal-content{border: none;}@media    print {.modal-dialog { max-width: 1000px;}}</style><body onload="window.print()">'+divToPrint.innerHTML+'</body>');
            newWin.document.close();
            setTimeout(function(){newWin.close();},10);
      });
  </script>

@endsection