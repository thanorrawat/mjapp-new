 

<?php if(!empty($cartDetails->bookingnumber)): ?>
<?php $__env->startSection('title',trans('file.Booking Number').' : '.$cartDetails->bookingnumber); ?>
<?php $__env->startSection('titlenoblock',trans('file.Booking Number').' : '.$cartDetails->bookingnumber); ?>
<?php else: ?>
<?php $__env->startSection('title','Order Number : '.$cartDetails->ordernumberfull); ?>
<?php $__env->startSection('titlenoblock','Order Number : '.$cartDetails->ordernumberfull); ?>
<?php endif; ?>
<?php $__env->startSection('pagecss'); ?>

<link rel="stylesheet" href="<?php echo e(asset('assets/css/signature-pad.css')); ?>">

<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentnoblock'); ?>
<section>
<?php if(((Auth::user()->role_id!=2&&Auth::user()->role_id==7)  && ($cartDetails->order_status==11|| $cartDetails->order_status==21) ) ): ?>
  <div  class="alert alert-primary text-center" role="alert">

    <h4><i class="fas fa-info-circle"></i></h4>
 <h4>อยู่ระหว่างการรอนุมัติจาก ผู้จัดการ</h4>
 </div>
<?php endif; ?>
<div class="row">
     <div class="col-md-12">
        <div class="card" id="card-selectproduct">
            <div class="card-body" >
              <div class="text-right">
                <?php
                if(!empty($cartDetails->order_status)){
                  $statusdt= DB::table('status_names')
            ->where('st_id', $cartDetails->order_status)
          ->select(['*'])
          ->first();
                      }
                  ?>
         <?php if(!empty($statusdt->statusname)): ?>
      
      
      <span style="background-color:<?php echo e($statusdt->color); ?>" class="btn btn-primary ">Status : <?php echo e($statusdt->statusname); ?></span>
         <?php endif; ?>
                <button id="print-btn" type="button" class="btn btn-outline-info btn-sm ml-3"><i class="dripicons-print"></i> <?php echo e(trans('file.Print')); ?></button>
                <a href="<?php echo e(url("order_pdf",$cartDetails->token)); ?>" id="pdf-btn" target="_blank" type="button" class="btn btn-outline-info btn-sm ml-3"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF</a>
                
              </div>
              <div id="app">
<edit-order baseurl="<?php echo e($baseurl); ?>"  orderurl="<?php echo e(url('order_view', $cartDetails->token)); ?>" orderid="<?php echo e($orderdt->id); ?>"></edit-order>

              </div>
              

<?php if(
(Auth::user()->role_id==6 && ($cartDetails->order_status==12|| $cartDetails->order_status==22) ) //admin รับ ORDER /ใบจอง
||
((Auth::user()->role_id==2||Auth::user()->role_id==7)  && ($cartDetails->order_status==11|| $cartDetails->order_status==21) ) //Manager อนุมัติใบจอง
): ?>
          <form action="<?php echo e(url('confirmform')); ?>" method="post">
            <div class="text-center">
              <hr>
              <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o" aria-hidden="true"></i> <?php if($cartDetails->order_status==21): ?> อนุมัติใบจอง  <?php elseif($cartDetails->order_status==11): ?> อนุมัติ Order <?php elseif($cartDetails->order_status==22): ?> รับใบจอง <?php else: ?> รับOrder <?php endif; ?></button>
              <br>
              <br>

<h4><?php if($cartDetails->order_status==22): ?> Click เพื่ออนุมัติใบจอง  <?php elseif($cartDetails->order_status==12): ?> Click เพื่ออนุมัติ Order <?php elseif($cartDetails->order_status==21): ?> Click เพื่อรับ ใบจอง <?php else: ?> Click เพื่อรับ Order <?php endif; ?> </h4>
              

              <div style="" id="signimgbox">
                <img  style="width:500px" src="<?php echo e(Auth::user()->sign); ?>" alt="" id="signimg" >
             <br> 
             <br> 
             <button type="button" class="btn btn-warning btn-sm" id="editsign">เพิ่ม / แก้ไข ลายเซ็น</button>
              </div>

              <div id="signature-pad_box" style="">



          
                <div id="signature-pad" class="signature-pad">
                  <div class="signature-pad--body">
                    <canvas width="664" height="126" style="touch-action: none;"></canvas>
                  </div>
                  <div class="signature-pad--footer">
                    <div class="description">Sign above</div>
              
                    <div class="signature-pad--actions">
                      <div>
                        <button type="button" class="button clear" data-action="clear">Clear</button>
                        <button style="display:none" type="button" class="button" data-action="change-color">Change color</button>
                        <button type="button" class="button" data-action="undo">Undo</button>
              
                      </div>
                      <div style="display:none">
                        <button type="button" class="button save" data-action="save-png">Save as PNG</button>
                        <button type="button" class="button save" data-action="save-jpg">Save as JPG</button>
                        <button type="button" class="button save" data-action="save-svg">Save as SVG</button>
                      </div>
                      <button type="button" class="btn btn-sm btn-warning" id="cancleeditsign">ยกเลิกการแก้ไข</button>
                    </div>
                  </div>
                </div>
                <br>
                
              </div>
            
            </div>
        <div class="text-center"><?php echo e(ucfirst(Auth::user()->fullname)); ?>

        <br>
        <?php   $permissionname= DB::table('roles')
                                       ->where('id', Auth::user()->role_id)
                                       ->first();?>
       ( <?php echo e($permissionname->name_thai); ?> ) 
      </div>    
      <input type="hidden" name="signinput" id="signinput" value="<?php echo e(Auth::user()->sign ?? ''); ?>">
      <input type="hidden" name="old_signinput" id="old_signinput" value="<?php echo e(Auth::user()->sign ?? ''); ?>">
      <input type="hidden" name="orderid" id="orderid" value="<?php echo e($cartDetails->id ?? ''); ?>">
      <input type="hidden" name="nowstatus" id="nowstatus" value="<?php echo e($cartDetails->order_status); ?>">
      <?php echo csrf_field(); ?>
      
          </form>
          <?php endif; ?>
                   <div>

              </div>

 </div>
        </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
        <h5>Timeline : </h5>
    </div>
    <div class="card-body ">
    <div class="container">
        <div class="row">
            <div class="col-md-10" id="timelineblock">
            
            </div>
        </div>
    </div>
</div>
</div>
</section>
<div id="product-details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title"><?php echo e(trans('Product Details')); ?></h5>
          <button id="print-btn" type="button" class="btn btn-default btn-sm ml-3"><i class="dripicons-print"></i> <?php echo e(trans('file.Print')); ?></button>
          <button type="button" id="close-btn" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
        </div>
        <div class="modal-body">
         
        </div>
      </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('pagejs'); ?>
<!-- JS, Popper.js, and jQuery -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
 
<script> 
  // let orderurl = '<?php echo e(url('order_view', $cartDetails->token)); ?>';
  // $("#orderdt").load(orderurl)

  $.get( "<?php echo e(url('order_timeline')); ?>/<?php echo e($cartDetails->id); ?>", function( data ) {
    $('#timelineblock').html(data);
});

</script>


<?php if(
(Auth::user()->role_id==6 && ($cartDetails->order_status==12|| $cartDetails->order_status==22) ) //admin รับ ORDER /ใบจอง

||
((Auth::user()->role_id==2||Auth::user()->role_id==7)  && ($cartDetails->order_status==11|| $cartDetails->order_status==21) ) //Manager อนุมัติใบจอง
): ?>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
 <script src="<?php echo e(asset('assets/js/signature-pad/signature-pad-app.js')); ?>"></script>
  
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script>

  $("#editsign").click(function() {
  $("#signature-pad_box").show();
  $("#signimgbox").hide();
  $("#signinput").val("");
});
$("#cancleeditsign").click(function() {
  let oldsign = $("#old_signinput").val();
$("#signature-pad_box").hide();
$("#signimgbox").show();
$("#signimg").attr("src",oldsign);
$("#signinput").val(oldsign);
signaturePad.clear();
});

<?php if(!empty(Auth::user()->sign)): ?>
$("#signature-pad_box").hide();
<?php else: ?>
$("#signimgbox").hide();
<?php endif; ?>


clearButton.addEventListener("click", function (event) {
  $("#signinput").val("");
});
</script> 
<?php endif; ?> 


<script>
  $("#print-btn").on("click", function(){
            var divToPrint=document.getElementById('orderdt');
            var newWin=window.open('','Print-Window');
            newWin.document.open();
            newWin.document.write('<link rel="stylesheet" href="<?php echo e(asset('assets/css/custom.css')); ?>" type="text/css"><style type="text/css">.modal-header{ display: none;},.modal-content{border: none;}@media    print {.modal-dialog { max-width: 1000px;}}</style><body onload="window.print()">'+divToPrint.innerHTML+'</body>');
            newWin.document.close();
            setTimeout(function(){newWin.close();},10);
      });
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin_lte.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>