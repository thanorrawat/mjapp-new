@extends('Admin_lte.app') 
@section('title',  __('file.dashboard'))
@section('pagecss')
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{ asset('AdminLTE-3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('AdminLTE-3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endsection
@section('contentnoblock')
  <div class="row">
    <div class="col-md-12 col-lg-6">
      <div class="brand-text float-left ">
          <h3>{{trans('file.welcome')}} คุณ <span>{{Auth::user()->fullname}}</span> </h3>  
      </div>
    </div>
  </div>
  <div class="row" >

@for($i=1;$i<=4;$i++)
  <?php
    if($i==1){
      $ordrblocktitle = 'New Order';
    }else if($i==2){
      $ordrblocktitle = 'ส่งคลังตรวจสอบ';
    }else if($i==3){
      $ordrblocktitle = 'ออกใบสั่งขาย';
    }else if($i==4){
      $ordrblocktitle = 'ส่งแผนกจัดซื้อ';
    }
    ?>

    {{-- Order --}}
    <div class="col-md-6">
      
      <div class="card">
        <div class="card-header border-transparent">
          <h3 class="card-title">{{ $ordrblocktitle }}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-2">
          @for($j=1;$j<=2;$j++)
            <?php
            if($j==1){
              $odername = 'order';
              $odertypenumber = __('file.Order');
            } else if($j==2){
              $odername = 'booking';
              $odertypenumber = __('file.Booking');
            }
            ?>
            <h4>{{ $odertypenumber }} </h4>
              <div class="table-responsive">
                <table class="table m-0" id="{{ $odername }}-{{ $i }}">
                  <thead>
                    <tr>
                      <th>Select</th>
                      <th>Order No.</th>
                      <th>ลูกค้า</th>
                      <th>Due Date</th>
                      <th>Due Date</th>
                      <th>สถานะ</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->

              @if($i==1)
              <div class="color-palette-set">
                <div class="bg-info color-palette p-2">
                  <span>เลือกรายการเพื่อส่ง คลังสินค้า</span>
                  <button data-type="{{ $odername }}" data-number="{{ $i }}" type="button" class="btn btn-warning btn-sm selectall-button" id="selectall-{{ $odername }}-{{ $i }}"><i class="fa fa-check" aria-hidden="true"></i> เลือกทั้งหมด </button>
                </div>
                <div class="bg-info disabled color-palette p-2" id="show-{{ $odername }}_{{ $i }}">
                  
                </div>
                <div class="p-1 text-right">   
                <?php
                if( Session::get('print2store-'.$odername.'_'.$i)  && Session::get('print2store-'.$odername.'_'.$i) == 2){
                  $checksubmit1 = "";
                }else{
                  $checksubmit1 = "checked";
                }

                if(Session::get('send2store-'.$odername.'_'.$i) && Session::get('send2store-'.$odername.'_'.$i) == 2 ){
                  $checksubmit2 = "";
                } else {
                  $checksubmit2 = "checked";
                }

                ?> 
                  <input {{ $checksubmit1 }} type="checkbox" name="print2store" id="print2store-{{ $odername }}_{{ $i }}" data-ordertypenumber="{{ $odername }}_{{ $i }}" value="1"> พิมพ์เอกสาร
                  <input {{ $checksubmit2 }} type="checkbox" name="send2store" id="send2store-{{ $odername }}_{{ $i }}" data-ordertypenumber="{{ $odername }}_{{ $i }}"  value="1"> ส่งเอกสารไปยัง Store เพื่อตรวจสอบ
                  <button data-ordertypenumber="{{ $odername }}_{{ $i }}"   class="btn btn-primary submit_order submit-{{ $odername }}_{{ $i }}">{{ __('submit') }}</button>  
                </div>
              </div>
              <hr>
          @endif
          @endfor


        </div>
      </div>
    </div>
    @endfor

  </div>

  {{-- Modal Order popup  --}}
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

@endsection
@section('pagejs')
  {{-- <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script> --}}


  <!-- DataTables -->
  <script src="{{ asset('AdminLTE-3/plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{ asset('AdminLTE-3/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{ asset('AdminLTE-3/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
  <script src="{{ asset('AdminLTE-3/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

  {{-- #order-data-table --}}

  <script>


@for($i=1;$i<=4;$i++)
  @for($j=1;$j<=2;$j++)
  

  <?php
  if($j==1){
    $odername = 'order';
    $odernumber = 'ordernumberfull';
  } else if($j==2){
    $odername = 'booking';
    $odernumber = 'bookingnumber';
  }
  ?>
    $('#{{ $odername }}-{{ $i }}').DataTable({
      processing: true,
      serverSide: true,
      "ajax":{
        "url": "{{ url("orderdata") }}",
        "type": "GET",
        "data":{ csrf: "{{ csrf_token() }}",ordertype : "{{ $odername }}",approved : {{ $i }}}
      },
      columns: [
        { data: 'checkbox', name: 'checkbox' },
        { data: '{{ $odernumber }}', name: '{{ $odernumber }}' },
        { data: 'customer_name', name: 'customer_name' },
        { data: 'deliverydate', name: 'deliverydate' },
        { data: 'createby_name', name: 'createby_name' },
        { data: 'statusname', name: 'statusname' },
        { data: 'action3', name: 'action3' }

        
      ],
      "order": [[ 1, 'desc' ]]
    });
    var sessionRecStart = '{{ $odername }}_{{ $i}}';
    showSelect(sessionRecStart);
  @endfor
@endfor


function showSelect(sessionRec) {
  $.post('{{ url('checkSelectShow')}}',   // url
  { sess: sessionRec ,csrf: "{{ csrf_token() }}" })
  .done(function( data ) {
      $('#show-'+sessionRec).html(data);
  });
}


function selectAllOrder(ordertype,approved) {
    $.ajax({
      method: "GET",
      url: "{{ url("orderdata") }}",
      data: { csrf: "{{ csrf_token() }}",ordertype : ordertype ,approved : approved ,selectall:1 }
    })
      .done(function( msg ) {
        var sessionRec = ordertype+'_'+approved
        showSelect(sessionRec);
        $(".checkselect-"+sessionRec).prop("checked", true);
      });
}




$(document).on("click", ".selectall-button", function(){
  var ordertype = $(this).attr('data-type');
  var approved = $(this).attr('data-number');
  selectAllOrder(ordertype,approved); 
});


$(document).on("click", ".checkselect", function(){
  var thisorder = $(this).val();
  var sessionRec = $(this).attr('data-checksession');
  var ordertoken = $(this).attr('data-token');

  if($(this).is(':checked')){
   // alert(sessionRec)

    $.post('{{ url('checkSelectOrder')}}',   // url
      { sess: sessionRec ,thisorder : thisorder , rec :1 ,ordertoken : ordertoken ,csrf: "{{ csrf_token() }}" }
      , function(result){
        showSelect(sessionRec);
      });

  } else{
    $.post('{{ url('checkSelectOrder')}}',   // url
    { sess: sessionRec ,thisorder : thisorder , rec :2 ,csrf: "{{ csrf_token() }}" }
    , function(result){
      showSelect(sessionRec);
    });
    
  }

});

/// ปุ่ม submit 

$(document).on("click", ".submit_order", function(){
  var ordertypenumber  =  $(this).attr('data-ordertypenumber');

  if($("#print2store-"+ordertypenumber).is(":checked"))
  {
    var print2store = 1;
    window.open('{{ url("print2Store") }}/'+ordertypenumber+'/{{ csrf_token() }}');
  } else{
    var print2store = 2;
  }

  if($("#send2store-"+ordertypenumber).is(":checked")){
    var send2store = 1;
  } else{
    var send2store = 2;

  }


  $.post('{{ url('checkSelectSubmit')}}',   // url
  { 
    csrf: "{{ csrf_token() }}" ,
    ordertypenumber : ordertypenumber,
    print2store : print2store,
    send2store : send2store 
  })
  .done(function( data ) {
     // $('#show-'+ordertypenumber).html(data);
  });
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
  <script>
    $("#print-btn").on("click", function(){
      var divToPrint=document.getElementById('product-details');
      var newWin=window.open('','Print-Window');
      newWin.document.open();
      newWin.document.write('<link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" type="text/css"><style type="text/css">.modal-header{ display: none;},.modal-content{border: none;}@media  print {.modal-dialog { max-width: 1000px;}}</style><body onload="window.print()">'+divToPrint.innerHTML+'</body>');
      newWin.document.close();
      setTimeout(function(){newWin.close();},10);
    });
  </script>

@endsection