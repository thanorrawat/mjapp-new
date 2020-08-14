
    <?php 
    if(!empty($orderid)){
    $cartproducts= DB::table('mj_order_products')
    ->leftJoin('products', 'mj_order_products.productscode', '=', 'products.code')
    ->where('order_id', $orderid)
    ->select(['*','mj_order_products.qty AS orderqty'])
    ->get();
      }else{
    $cartproducts= DB::table('ordersale_products_cart')
    ->leftJoin('products', 'ordersale_products_cart.productscode', '=', 'products.code')
    ->where('orderesaleid', Auth::user()->id)
    ->select(['*','ordersale_products_cart.qty AS orderqty'])
    ->get();
        }
    $n=1; ?>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <th>#</th>
            <th><?php echo e(trans('file.Image')); ?></th>
            <th><?php echo e(trans('file.Product Code')); ?></th>
            <th><?php echo e(trans('file.product')); ?></th>
            <th><?php echo e(trans('file.stock')); ?></th>
            <th><?php echo e(trans('file.qty')); ?></th>
            <th>ขอซื้อ</th>
            <th>หมายเหตุ</th>
                        <th>Action</th>
            </thead>
<?php $__currentLoopData = $cartproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cartproduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<?php 
if(!empty($cartproduct->image)){
$imageshowarray =  explode(",",$cartproduct->image);
$imageshow = $imageshowarray[0];
}else{
    $imageshow = 'zummXD2dvAtI.png';
}
?>
<tr>
    <td><?php echo $n; ?></td>
    <td class="text-center"> <a data-toggle="modal" data-target="#product-details" href="#" data-productid="<?php echo e($cartproduct->id); ?>" class="productpopup"> <img width="50"  src="<?php echo e(url('public/images/product', $imageshow)); ?>" alt="<?php echo e($cartproduct->name); ?> - <?php echo e($cartproduct->productscode); ?>"></a></td>
    <td>
        <?php echo e($cartproduct->productscode); ?>

    </td>
    <td ><?php echo e($cartproduct->name); ?></td>
    <td class="text-center stockstatus" id="stock_<?php echo e($cartproduct->id); ?>"
        <?php if($cartproduct->qty>=$cartproduct->orderqty): ?>
        style="background-color:rgb(123, 208, 30)"
        data-stockstatus="1"

<?php else: ?>
        style="background-color:rgb(253, 88, 104)"
        data-stockstatus="2"
        <?php endif; ?>
        ><?php echo e($cartproduct->qty); ?></td>
     
    <td class="text-center">
    <input min="1" class="text-right order_qty" style="width:50px" type="number"  data-productid="<?php echo e($cartproduct->id); ?>" name="qty[<?php echo e($cartproduct->id); ?>]" id="qty_<?php echo e($cartproduct->id); ?>" value="<?php echo e($cartproduct->orderqty); ?>">
    <input type="hidden" name="productid[]" value="<?php echo e($cartproduct->id); ?>">
    <input type="hidden" name="productscode[<?php echo e($cartproduct->id); ?>]" value="<?php echo e($cartproduct->productscode); ?>">
    
    </td>
    <td class="text-center"><div id="pr_<?php echo e($cartproduct->id); ?>"><?php if($cartproduct->qty<=0){ $stocksale = 0;}else{
     $stocksale = $cartproduct->qty;   
    } if($cartproduct->qty<$cartproduct->orderqty) {
        $prrow = $cartproduct->orderqty-$stocksale;
    } else{
        $prrow = 0; 
    }
    echo $prrow;
    ?></div></td>
<td><input data-productid="<?php echo e($cartproduct->id); ?>"  class="form-control remarkrow"  type="text" name="remark_<?php echo e($cartproduct->id); ?>" id="remark_<?php echo e($cartproduct->id); ?>" value="<?php echo e($cartproduct->remarkrow); ?>"></td>
    <td class="text-center"><button type="button" class="delete-from-cart btn btn-out btn-danger btn-sm" data-code="<?php echo e($cartproduct->productscode); ?>"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
</tr>
<?php 
$n++
?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>
</div>







