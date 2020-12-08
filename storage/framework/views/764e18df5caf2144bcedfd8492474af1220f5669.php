 
<?php $__env->startSection('title',$pagetille); ?>

<?php $__env->startSection('pagecss'); ?>

<link rel="stylesheet" href="<?php echo e(asset('AdminLTE-3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('AdminLTE-3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo e(asset('AdminLTE-3/plugins/select2/css/select2.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('AdminLTE-3/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')); ?>">


  <link rel="stylesheet" href="<?php echo e(asset('AdminLTE-3/pickadate.js-3.6.2/lib/themes/classic.css')); ?>" id="theme_base">
  <link rel="stylesheet" href="<?php echo e(asset('AdminLTE-3/pickadate.js-3.6.2/lib/themes/classic.date.css')); ?>" id="theme_date">
  <link rel="stylesheet" href="<?php echo e(asset('AdminLTE-3/pickadate.js-3.6.2/lib/themes/classic.time.css')); ?>" id="theme_time">

  <style>.datepicker td, .datepicker th {
    width: 2.5rem;
    height: 2.5rem;
    font-size: 0.85rem;
}

.datepicker {
    margin-bottom: 3rem;
}</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<div class="container">

  <div class="row clearfix">
    <div class="col-md-12">
<table   style="width: 100%" class="mb-3">
  <tr>
    <td style="width: 150px">ผู้จัดจำหน่าย</td>
    <td>
<select class="form-control select2" name="supplierlist" id="supplierlist" required>
  <option value="">Supplier</option>

  <?php $__currentLoopData = $supplierlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <option 
  <?php if(!empty(Session::get('po_supplier_id')) && Session::get('po_supplier_id')==$supplier->suppid): ?>
  selected  <?php endif; ?>
  value="<?php echo e($supplier->suppid); ?>"><?php echo e($supplier->suppliers_code); ?> - <?php echo e($supplier->fullname); ?></option>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>

     
     
    </td>
    <td style="width: 10px"></td>
    <td style="width: 150px">เลขที่ใบสั่งซื้อ</td>
    <td><?php echo e(Session::get('newponumber')); ?></td>
  </tr>
  <tr>
    <td></td>
    <td   id="supp_name"></td>
 <td></td>
    <td>วันที่</td>
    <td><?php echo e(date("d/m/Y")); ?></td>
  </tr>
  <tr>
    <td></td>
    <td   id="supp_address"></td>
 
<td></td>
    <td>วันที่รับของ</td>
    <td><input type="text" id="recievedate" class="form-control" value="<?php echo e(Session::get('recievedate')??''); ?>"></td>
  </tr>
  <tr>
    <td  >โทร.</td>
    <td id="supp_tel"></td>
    <td></td>
    <td>เครดิต</td>
    <td id="supp_credit"></td>
  </tr>
  <tr>
    <td  >หมายเหตุ</td>
    <td> <input class="form-control" id="poremark" type="text" value="<?php echo e(Session::get('poremark')??''); ?>""></td>
    <td></td>
    <td>ขนส่งโดย</td>
    <td>
      <select name="shipby" id="shipby" class="form-control">
        <option value="">เลือกการขนส่ง</option>
        <option   <?php if(!empty(Session::get('shipby')) && Session::get('shipby')=="ship"): ?>
          selected  <?php endif; ?> value="ship"><?php echo e(__('file.ship')); ?></option>
        <option <?php if(!empty(Session::get('shipby')) && Session::get('shipby')=="car"): ?>
        selected  <?php endif; ?> value="car"><?php echo e(__('file.car')); ?></option>
        <option <?php if(!empty(Session::get('shipby')) && Session::get('shipby')=="airplane"): ?>
        selected  <?php endif; ?> value="airplane"><?php echo e(__('file.airplane')); ?></option>
      </select></td>
  </tr>


  
</table>
    </div></div>
  <div class="row clearfix">
    <div class="col-md-12">
      <table class="table table-bordered table-hover" id="purchaseadd">
        <thead>
          <tr>
            <th class="text-center"> No.</th>
            <th class="text-center"> รหัสสินค้า/รายละเอียด </th>
            <th class="text-center"> จำนวน </th>
            <th class="text-center"> หน่วย </th>
            <th class="text-center"> หน่วยละ </th>
            <th class="text-center"> จำนวนเงิน </th>
          </tr>
        </thead>
        <tbody>
<?php $num=1; 


?>

    

  <?php $__currentLoopData = $checklist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$listrow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      
 

          <tr id='addr_<?php echo e($listrow); ?>'>
            <td><?php echo e($num); ?></td>
            <td><?php echo e($checklistarr[$listrow]['code']); ?> - <?php echo e($checklistarr[$listrow]['name']); ?>

            

 <input type="hidden" class="willitem" 
              data-willid="<?php echo e($listrow); ?>"
              data-code="<?php echo e($checklistarr[$listrow]['code']); ?>"
              data-name="<?php echo e($checklistarr[$listrow]['name']); ?>"
              >
</td>
            <td>
              
    
              
              <input id="qty_<?php echo e($listrow); ?>" type="number" data-willid="<?php echo e($listrow); ?>" name='qty[]' placeholder='Enter Qty' class="form-control qty text-right qty_<?php echo e($num); ?>" value="<?php if(!empty($poitemarr[$listrow]['qty'])): ?><?php echo e($poitemarr[$listrow]['qty']); ?><?php else: ?><?php echo e($checklistarr[$listrow]['qty']); ?><?php endif; ?>" step="0" min="0"/>
              
            </td><td class="unit_name"><?php echo e($checklistarr[$listrow]['unit_name']); ?></td>
            <td>

       

                 <?php 
                 
                 if(!empty($poitemarr[$listrow]['price'])){
                  $costrow = $poitemarr[$listrow]['price'];

                 }else if(!empty($checklistarr[$listrow]['cost'])){

$costrow = $checklistarr[$listrow]['cost'];
              } else{
$costrow = 0;
              }?> 
<input type="number" id="price_<?php echo e($listrow); ?>" name='price[]' data-willid="<?php echo e($listrow); ?>"  placeholder='Enter Unit Price' class="form-control price  text-right" value="<?php echo e(number_format($costrow,2)); ?>"  step="0.00" min="0"/>
            
            </td>
            <td>

    

              <input id="total_<?php echo e($listrow); ?>" type="number" name='total[]' placeholder='0.00' class="form-control total text-right" value=""  readonly/></td>
          </tr>
          <?php $num++; ?>     
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

       
        </tbody>
      </table>
    </div>
  </div>
  
  <div class="row justify-content-end clearfix"  style="margin-top:20px">
    <div class="pull-right col-md-12 ">
      <table class="table table-bordered table-hover" id="tab_logic_total">
        <tbody>
          <tr>
            <td rowspan="6" style="width: 50%">(<span id="total_amount_text">0</span>)</td>
            <th class="text-center">รวมเป็นเงิน</th>
            <td class="text-center"><input type="number" name='sub_total' placeholder='0.00' class="form-control text-right" id="sub_total" readonly/></td>
          </tr>
          <tr>
            <th class="text-center">หักส่วนลด</th>
            <td class="text-center"><input type="number" name='discount' placeholder='0.00' class="form-control text-right" id="discount" value="<?php echo e(Session::get('podiscount')); ?>" /></td>
          </tr>
          <tr>
            <tr>
              <th class="text-center">จำนวนเงินหลังหักส่วนลด</th>
              <td class="text-center"><input type="number" name='afterdiscount' placeholder='0.00' class="form-control text-right" id="afterdiscount" readonly/></td>
            </tr>
            <tr>
            <th class="text-center">จำนวนภาษีมูลค่าเพิ่ม 7.00%</th>
            <td class="text-center"><div class="input-group mb-2 mb-sm-0">
                <input type="number" class="form-control text-right" id="vat7" placeholder="0" readonly>
             
              </div></td>
          </tr>
      <th class="text-center">จำนวนเงินทั้งสิ้น</th>
            <td class="text-center text-right"><input type="number" name='total_amount' id="total_amount" placeholder='0.00' class="form-control text-right" readonly/></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
<div class="text-center"> <button id="buttonsubmit" type="button" class="btn btn-primary">สร้างใบสั่งซื้อ</button></div>
<div id="show"></div>
<?php // print_r($poitemarr); ?> 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pagejs'); ?>




<!-- DataTables -->
<script src="<?php echo e(asset('AdminLTE-3/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('AdminLTE-3/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>



<!-- Select2 -->
<script src="<?php echo e(asset('AdminLTE-3/plugins/select2/js/select2.full.min.js')); ?>"></script>

<script>
var countqty = $('.qty').length;
for(var i=0;i<= countqty;i++){
  var willorderid =  $('.qty_'+i).attr( "data-willid" );
  calrow(willorderid);
}

  function calrow(willorderid){

var rowqty =   $('#qty_'+willorderid).val();
var rowprice =   $('#price_'+willorderid).val();
var rowtotal =  (+rowqty)*(+rowprice);
$('#total_'+willorderid).val(rowtotal.toFixed(2));
  }

  function subtotal(){
    var countqty = $('.qty').length;
    var subtotal = 0;
for(var i=0;i<= countqty;i++){
  var willorderid =  $('.qty_'+i).attr( "data-willid" );
  var totalrow =$('#total_'+willorderid).val();
  if(isNaN(totalrow)){
    totalrow =0;
  }
  subtotal = (+subtotal)+(+totalrow);
}
$('#sub_total').val(subtotal);

  }


  function discountall(){
var subtotal = $('#sub_total').val();
var discountpurchase = $('#discount').val();
// alert(subtotal);
 afterdiscount = (+subtotal)-(+discountpurchase);
var vat7 = (+afterdiscount) *(0.07);
var grandtotal = (+afterdiscount)+(+vat7);
 $('#afterdiscount').val(afterdiscount.toFixed(2));
 $('#vat7').val(vat7.toFixed(2));
 $('#total_amount').val(grandtotal.toFixed(2));
 numbertotext()
  }
  function numbertotext(){
   let number =  $('#total_amount').val();
   $.get( "<?php echo e(url('numbertotext')); ?>/"+number )
  .done(function( data ) {

$('#total_amount_text').text(data);
  });

  updatesessionitempo()

   }
   


function updatesessionitempo(){

 ///log dt

 $('.willitem').each(function(index, value) {

var willid =$(this).attr('data-willid');
var code=$(this).attr('data-code');
var name =$(this).attr('data-name');
var qty = $('.qty').eq(index).val();
var price = $('.price').eq(index).val();
var total = $('.total').eq(index).val();
console.log(`.willitem${index}: ${willid} : ${code} : ${name} : ${qty} : ${price} : ${total}` );


// //updatesession
// $.post( "<?php echo e(url('purchase/updatesessionpoitems')); ?>", {  csrf: "<?php echo e(csrf_token()); ?>"
// ,index: index
// ,willid : willid
// ,code:code
// ,name:name
// ,qty:qty
// ,price:price
// ,total:total

// })
// .done(function( data ) {

// });

 });

}




   function updateprchaserow(willorderid,qty,price){  

   $.post( "<?php echo e(url('purchase/updateprchaserow')); ?>", {  csrf: "<?php echo e(csrf_token()); ?>",willorderid : willorderid ,qty:qty,price:price})
   .done(function( data ) {
  calrow(willorderid)
  subtotal();
  discountall()
   });
   }



   function updateprchasedt(discount,recievedate,poremark,shipby){  

   // console.log(discount+'/'+recievedate+'/'+shipby);
$.post( "<?php echo e(url('purchase/updatepurchase')); ?>", {  csrf: "<?php echo e(csrf_token()); ?>",discount:discount,recievedate:recievedate,poremark:poremark,shipby:shipby})

}





   function supplierdt(supplierid){  

$.get( "<?php echo e(url('purchase/checksupplier')); ?>", {  csrf: "<?php echo e(csrf_token()); ?>",supplierid:supplierid})
.done(function( data ) {

  $('#supp_name').text(data.fullname);
  $('#supp_address').text(data.address);
  $('#supp_tel').text(data.phone_number);
  $('#supp_credit').text(data.credit);
});
}

$('#supplierlist').on('change keyUp', function () { 
  var supplierid = $(this).val();
  supplierdt(supplierid)
});


$('body').on('change keyUp blur', '#discount,#recievedate,#poremark,#shipby', function () { 
  discountall()
  var discount = $('#discount').val();
  var recievedate = $('#recievedate').val();
  var poremark= $('#poremark').val();
  var shipby= $('#shipby').val();
  //console.log(discount+'/zzzz'+recievedate+'/'+shipby);
  updateprchasedt(discount,recievedate,poremark,shipby);

});

$('body').on('change', '.qty,.price', function () { 
  var willorderid =  $( this).attr( "data-willid" );
  //calrow(willorderid);
var qty =   $('#qty_'+willorderid).val();
var price =   $('#price_'+willorderid).val();
  updateprchaserow(willorderid,qty,price)
  
});

$( document ).ready(function() {
  subtotal();
  discountall()
  //$('#purchaseadd').DataTable();
  numbertotext()
  $('.select2').select2();
  var supplierid = $('#supplierlist').val();
  supplierdt(supplierid)
});





////create PO

function createpo(){  


var supplier_id=  $('#supplierlist').val();
var po_total=  $('#sub_total').val();
var po_discount=  $('#discount').val();
var po_afterdiscount=  $('#afterdiscount').val();
var po_vat=  $('#vat7').val();
var po_grand_total=  $('#total_amount').val();
var poremark = $('#poremark').val();
var shipby = $('#shipby').val();
var recievedate = $('#recievedate').val();

 var po_items =  $('.willitem').length;

  $.post( "<?php echo e(url('purchase/creatpo')); ?>", {  csrf: "<?php echo e(csrf_token()); ?>",

   supplier_id : 	supplier_id,
  po_items: po_items,
   po_total:po_total,
   po_discount: po_discount,
   po_afterdiscount:po_afterdiscount,
   po_vat:po_vat,
   po_grand_total:po_grand_total,
   poremark:poremark,
   shipby:shipby,
   recievedate:recievedate

})
   .done(function( data ) {
if(data !==null){
  var purchaseid = data;
  $('.willitem').each(function(index, value) {
    var willid =$(this).attr('data-willid');
var code=$(this).attr('data-code');
var name =$(this).attr('data-name');
var qty = $('.qty').eq(index).val();
var price = $('.price').eq(index).val();
var total = $('.total').eq(index).val();
var unit_name =  $('.unit_name').eq(index).val();
$.post( "<?php echo e(url('purchase/creatitems')); ?>", {  csrf: "<?php echo e(csrf_token()); ?>",
purchaseid:purchaseid,
code:code,
name:name,
qty:qty,
price:price,
total:total,
unit_name :unit_name,
willid:willid
})


  })
}
   }).then(function() {

    $.get( "<?php echo e(url('clearsessionpo')); ?>" );

    }).then(function() {
window.location.replace("<?php echo e(url('purchases')); ?>");
}); 
}


  $( "#buttonsubmit" ).click(function() {
   createpo()
  });

</script>

<script src="<?php echo e(asset('AdminLTE-3/pickadate.js-3.6.2/lib/picker.js')); ?>"></script>
<script src="<?php echo e(asset('AdminLTE-3/pickadate.js-3.6.2/lib/picker.date.js')); ?>"></script>
<script src="<?php echo e(asset('AdminLTE-3/pickadate.js-3.6.2/lib/picker.time.js')); ?>"></script>
<script>//Date range picker
  $('#recievedate').pickadate({format: 'dd/mm/yyyy',})
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin_lte.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>