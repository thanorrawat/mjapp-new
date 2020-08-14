<?php 
if(!empty(Auth::user()->id)){
$cartproductqty = DB::table('ordersale_products_cart')->where('orderesaleid', Auth::user()->id)->count();}else{
    $cartproductqty=0;
}
 ?>
<a href="#"  onclick="return false;">
    <i class="fa fa-shopping-cart"></i>
    <?php if($cartproductqty>0): ?>
<span  class="badge badge-pill  cartqty"><?php echo e($cartproductqty); ?></span> 
<?php endif; ?>
</a>


<div class="show-notification ">

    <div class="noti-head">
        <h6 class="d-inline-block m-b-0">รายการสินค้าที่เลือก</h6>
        <div class="float-right">
      
            <a href="<?php echo e(url('create_order')); ?>">Show all</a>
        </div>
    </div>


    <div style="max-height: 350px;overflow-y: scroll;">
        <?php if(!empty(Auth::user()->id)): ?>
  <ul>
     
    <?php 
 
    $cartproducts= DB::table('ordersale_products_cart')
    ->leftJoin('products', 'ordersale_products_cart.productscode', '=', 'products.code')
    ->where('orderesaleid', Auth::user()->id)->get(); ?>
<?php $__currentLoopData = $cartproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cartproduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<?php
if(!empty($cartproduct->image)){
$imageshowarray =  explode(",",$cartproduct->image);
$imageshow = $imageshowarray[0];
}else{
    $imageshow = 'zummXD2dvAtI.png';
}
?>
<li>
<div class="media">
        <img class="d-flex align-self-center" src="<?php echo e(url('public/images/product', $imageshow)); ?>" alt="Generic placeholder image">
        <div class="media-body">
            <h5 class="notification-user"><?php echo e($cartproduct->productscode); ?></h5>
            <p class="notification-msg"><?php echo e($cartproduct->name); ?></p>
        </div>
    </div>

  
    </li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</ul>
<?php endif; ?>
    </div>

</div>








