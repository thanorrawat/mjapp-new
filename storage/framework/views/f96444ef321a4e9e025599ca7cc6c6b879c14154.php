 
<?php $__env->startSection('title',  __('file.Update User')); ?>  <?php $__env->startSection('contentnoblock'); ?>

<?php if(session()->has('not_permitted')): ?>
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('not_permitted')); ?></div> 
<?php endif; ?>
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4><?php echo e(trans('file.Update User')); ?></h4>
                    </div>
                    <div class="card-body">
                        <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>
                        <?php echo Form::open(['route' => ['user.update', $lims_user_data->id], 'method' => 'put', 'files' => true]); ?>

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
                                        <label><strong><?php echo e(trans('file.UserName')); ?> *</strong> </label>
                                        <input type="text" name="name" required class="form-control" value="<?php echo e($lims_user_data->name); ?>">
                                        <?php if($errors->has('name')): ?>
                                       <span>
                                           <strong><?php echo e($errors->first('name')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label><strong><?php echo e(trans('file.Change Password')); ?></strong> </label>
                                        
                                            <input type="password" name="password" class="form-control">
                                            
                                    </div>
                                    <div class="form-group mt-3">
                                        <label><strong><?php echo e(trans('file.Email')); ?> *</strong></label>
                                        <input type="email" name="email" placeholder="example@example.com" required class="form-control" value="<?php echo e($lims_user_data->email); ?>">
                                        <?php if($errors->has('email')): ?>
                                       <span>
                                           <strong><?php echo e($errors->first('email')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label><strong><?php echo e(trans('file.Phone Number')); ?></strong></label>
                                        <input type="text" name="phone"  class="form-control" value="<?php echo e($lims_user_data->phone); ?>">
                                    </div>
                                    <div class="form-group">
                                        <?php if($lims_user_data->is_active): ?>
                                        <input class="mt-2" type="checkbox" name="is_active" value="1" checked>
                                        <?php else: ?>
                                        <input class="mt-2" type="checkbox" name="is_active" value="1">
                                        <?php endif; ?>
                                        <label class="mt-2"><strong><?php echo e(trans('file.Active')); ?></strong></label>
                                    </div>
                                 
                                
                                    
                                    <div class="form-group">
                                        <label><strong><?php echo e(trans('file.Role')); ?> *</strong></label>
                                        <input type="hidden" name="role_id_hidden" value="<?php echo e($lims_user_data->role_id); ?>">
                                        <select name="role_id" required class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Role...">
                                          <?php $__currentLoopData = $lims_role_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                              <option value="<?php echo e($role->id); ?>"><?php echo e($role->name); ?></option>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>


                                    
                                    <div class="form-group">
                                        <input type="submit" value="<?php echo e(trans('file.submit')); ?>" class="btn btn-primary">
                                    </div>
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
<script type="text/javascript">

    $("ul#people").siblings('a').attr('aria-expanded','true');
    $("ul#people").addClass("show");
    $('#biller-id').hide();
    $('#warehouseId').hide();
    
    

    $('select[name=role_id]').val($("input[name='role_id_hidden']").val());
    if($('select[name=role_id]').val() > 2){
        $('#warehouseId').show();
        $('select[name=warehouse_id]').val($("input[name='warehouse_id_hidden']").val());
        $('#biller-id').show();
        $('select[name=biller_id]').val($("input[name='biller_id_hidden']").val());
    }
    $('.selectpicker').selectpicker('refresh');

    $('select[name="role_id"]').on('change', function() {
        if($(this).val() > 2){
            $('select[name="warehouse_id"]').prop('required',true);
            $('select[name="biller_id"]').prop('required',true);
            $('#biller-id').show();
            $('#warehouseId').show();
        }
        else{
            $('select[name="warehouse_id"]').prop('required',false);
            $('select[name="biller_id"]').prop('required',false);
            $('#biller-id').hide();
            $('#warehouseId').hide();
        }
    });

    $('#genbutton').on("click", function(){
      $.get('../genpass', function(data){
        $("input[name='password']").val(data);
      });
    });

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin_lte.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>