
<div class="form-group row">

<label class="col-md-1"><?php echo e(__('file.customer')); ?></label><div class="col-md-3"> 
<select name="selectcustomer" id="selectcustomer" class="form-control" required>
<option value=""><?php echo e(__('file.Select Customer')); ?></option>
<?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<option <?php if(!empty($cartDetails->customer_id) && $cartDetails->customer_id ==$customer->id): ?> selected <?php endif; ?> value="<?php echo e($customer->id); ?>"><?php echo e($customer->name); ?></option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
</div>

<?php if($_GET['doctype']==1): ?>

    <label class="col-md-2">วันที่ทำรายการ</label>
    <div class="col-md-2"><?php echo e(date("j/m/Y")); ?></div>
    <label class="col-md-2"><?php echo e(__('file.Delivery Date')); ?></label>
    <div class="col-md-2"> 
<input type="text" class="form-control datepicker" id="deliverydate" name="deliverydate"  value="<?php if(!empty($cartDetails->deliverydate)): ?><?php echo e(date('j/m/Y', strtotime($cartDetails->deliverydate))); ?><?php else: ?><?php echo e(date("j/m/Y")); ?><?php endif; ?>">
    </div>
    <?php elseif($_GET['doctype']==2): ?>

        <label class="col-md-2">วันที่จอง</label>
        <div class="col-md-2"><?php echo e(date("j/m/Y")); ?></div>
        <label class="col-md-2">วันที่สิ้นสุดการจอง</label>
        <div class="col-md-2"> 
        <input type="text" class="form-control datepicker" id="deliverydate" name="deliverydate"  value="<?php if(!empty($cartDetails->deliverydate)): ?><?php echo e(date('j/m/Y', strtotime($cartDetails->deliverydate))); ?><?php else: ?><?php echo e(date("j/m/Y")); ?><?php endif; ?>">
            </div>


 <?php endif; ?>




      <div class="col-md-6 row"><label class="col-md-5"><?php echo e(__('file.Order Type')); ?></label><div class="col-md-7"> 

  <input type="radio" <?php if((!empty($cartDetails->ordertype) && $cartDetails->ordertype==1) || empty($cartDetails->ordertype) ): ?> checked <?php endif; ?> name="ordertype" id="ordertype_1" value="1"> ปรกติ
  <input <?php if(!empty($cartDetails->ordertype) && $cartDetails->ordertype==2 ): ?> checked <?php endif; ?>  type="radio" name="ordertype" id="ordertype_2" value="2"> Project
      </div></div>
      <div class="col-md-6 row"><label class="col-md-5">ผู้ขออนุมัติ</label><div class="col-md-7"> 
  <input type="text" name="usercreate" id="usercreate" class="form-control" value="<?php if(!empty($cartDetails->createby_name)): ?><?php echo e($cartDetails->createby_name); ?><?php elseif(!empty(Auth::user()->fullname)): ?><?php echo e(ucfirst(Auth::user()->fullname)); ?><?php else: ?><?php echo e(ucfirst(Auth::user()->name)); ?><?php endif; ?>">
  <input type="hidden" name="usercreate_id" id="usercreate_id" value="<?php echo e(Auth::user()->id); ?>">
      </div></div>
      </div> 
