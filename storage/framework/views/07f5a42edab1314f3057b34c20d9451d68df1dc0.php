 
<?php $__env->startSection('title',  __('file.profile')." : ".$lims_user_data->name); ?> 
<?php $__env->startSection('pagecss'); ?>

<link rel="stylesheet" href="<?php echo e(asset('assets/css/signature-pad.css')); ?>">

<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentnoblock'); ?>
<?php if(Auth::id()==$lims_user_data->id): ?>
<?php if(session()->has('not_permitted')): ?>
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('not_permitted')); ?></div> 
<?php endif; ?>
<?php if(session()->has('message1')): ?>
        <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('message1')); ?></div> 
<?php endif; ?>
<?php if(session()->has('message2')): ?>
        <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('message2')); ?></div> 
<?php endif; ?>
<?php if(session()->has('message3')): ?>
        <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('message3')); ?></div> 
<?php endif; ?>

<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <?php echo Form::open(['route' => ['user.profileUpdate', Auth::id()], 'method' => 'put', 'files' => true]); ?>

                    <div class="card-header d-flex align-items-center">
                        <h4><?php echo e(trans('file.Update User Profile')); ?></h4>
                    </div>
                    <div class="card-body">
                        <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>
                    
                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label><strong><?php echo e(trans('file.FullName')); ?> *</strong> </label>
                                    <input type="text" name="fullname" required class="form-control" value="<?php echo e($lims_user_data->fullname); ?>">
                                    <?php if($errors->has('name')): ?>
                                   <span>
                                       <strong><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">

                                    <?php if(!empty($lims_user_data->image)): ?>
                                    <div><img src="<?php echo e(url("public/images/users",$lims_user_data->image)); ?>"  style="max-width:300px"  >
                                    <input type="hidden" name="oldimage" value="public/images/users/<?php echo e($lims_user_data->image); ?>">
                                    <input type="checkbox" name="deloldimage" value="1"> ลบรูป
                                    </div>
                                        
                                    <?php endif; ?>


                                    <label><strong><?php echo e(trans('file.Image')); ?></strong></label>
                                    <input type="file" name="image" class="form-control">
                                    <?php if($errors->has('image')): ?>
                                   <span>
                                       <strong><?php echo e($errors->first('image')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label><?php echo e(trans('file.UserName')); ?> *</strong> </label>
                                    <input type="text" name="name" value="<?php echo e($lims_user_data->name); ?>" required class="form-control" />
                                    <?php if($errors->has('name')): ?>
                                    <span>
                                       <strong><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label><?php echo e(trans('file.Email')); ?> *</strong> </label>
                                    <input type="email" name="email" value="<?php echo e($lims_user_data->email); ?>" required class="form-control">
                                    <?php if($errors->has('email')): ?>
                                    <span>
                                       <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label><?php echo e(trans('file.Phone Number')); ?> *</strong> </label>
                                    <input type="text" name="phone" value="<?php echo e($lims_user_data->phone); ?>" required class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label><?php echo e(trans('file.Company Name')); ?></strong> </label>
                                    <input type="text" name="company_name" value="<?php echo e($lims_user_data->company_name); ?>" class="form-control" />
                                </div>
                            
                            </div>
                        </div>
                       
                    </div>

                    <div class="card-header d-flex align-items-center">
                        <h4>ลายเซ็น</h4>
                    </div>
                    <div class="card-body">

                        <div style="" id="signimgbox" class="text-center">
                            <img  style="width:500px;max-width:100%" src="<?php echo e($lims_user_data->sign); ?>" alt="" id="signimg" >
                         <br> 
                         <br> 
                         <div class="text-center"><button type="button" class="btn btn-warning btn-sm" id="editsign">เพิ่ม / แก้ไข ลายเซ็น</button></div>
                         
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
                        
                       
            
                  <input type="hidden" name="sign" id="signinput" value="<?php echo e($lims_user_data->sign ?? ''); ?>">
                  <input type="hidden" name="old_signinput" id="old_signinput" value="<?php echo e($lims_user_data->sign ?? ''); ?>">

                  <div class="form-group">
                    <input type="submit" value="<?php echo e(trans('file.submit')); ?>" class="btn btn-primary">
                </div>
                    </div>
                    <?php echo Form::close(); ?>


                </div>
            </div>

        </div>
    </div>
</div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('pagejs'); ?>

<!-- JS, Popper.js, and jQuery -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
 <script src="<?php echo e(asset('assets/js/signature-pad/signature-pad-app.js')); ?>"></script>
<script type="text/javascript">
    $("ul#setting").siblings('a').attr('aria-expanded','true');
    $("ul#setting").addClass("show");
    $("ul#setting #user-menu").addClass("active");

    

    $('#confirm_pass').on('input', function(){

        if($('input[name="new_pass"]').val() != $('input[name="confirm_pass"]').val())
            $("#divCheckPasswordMatch").html("Password doesn't match!");
        else
            $("#divCheckPasswordMatch").html("Password matches!");
         
    });




    
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

<?php if(!empty($lims_user_data->sign)): ?>
$("#signature-pad_box").hide();
<?php else: ?>
$("#signimgbox").hide();
<?php endif; ?>


clearButton.addEventListener("click", function (event) {
  $("#signinput").val("");
});

</script>

<?php else: ?>
<div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>ท่านไม่ได้รับสิทธิ์ในการแก้ไขข้อมูลผู้ใช้รายนี้</div> 
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout-theme-gradient-able.app2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>