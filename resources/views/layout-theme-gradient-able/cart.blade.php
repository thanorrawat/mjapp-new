<?php 
if(!empty(Auth::user()->id)){
$cartproductqty = DB::table('ordersale_products_cart')->where('orderesaleid', Auth::user()->id)->count();}else{
    $cartproductqty=0;
}
 ?>
<a href="#"  onclick="return false;">
    <i class="fa fa-shopping-cart"></i>
    @if($cartproductqty>0)
<span  class="badge badge-pill  cartqty">{{ $cartproductqty }}</span> 
@endif
</a>


<div class="show-notification ">

    <div class="noti-head">
        <h6 class="d-inline-block m-b-0">รายการสินค้าที่เลือก</h6>
        <div class="float-right">
      
            <a href="{{ url('create_order') }}">Show all</a>
        </div>
    </div>


    <div style="max-height: 350px;overflow-y: scroll;">
        @if(!empty(Auth::user()->id))
  <ul>
     
    <?php 
 
    $cartproducts= DB::table('ordersale_products_cart')
    ->leftJoin('products', 'ordersale_products_cart.productscode', '=', 'products.code')
    ->where('orderesaleid', Auth::user()->id)->get(); ?>
@foreach ($cartproducts as $cartproduct)

@php
if(!empty($cartproduct->image)){
$imageshowarray =  explode(",",$cartproduct->image);
$imageshow = $imageshowarray[0];
}else{
    $imageshow = 'zummXD2dvAtI.png';
}
@endphp
<li>
<div class="media">
        <img class="d-flex align-self-center" src="{{ url('public/images/product', $imageshow)  }}" alt="Generic placeholder image">
        <div class="media-body">
            <h5 class="notification-user">{{ $cartproduct->productscode }}</h5>
            <p class="notification-msg">{{ $cartproduct->name   }}</p>
        </div>
    </div>

  
    </li>
@endforeach

</ul>
@endif
    </div>

</div>








