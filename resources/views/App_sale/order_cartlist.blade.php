
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
            <th>{{trans('file.Image')}}</th>
            <th>{{trans('file.Product Code')}}</th>
            <th>{{trans('file.product')}}</th>
            <th>{{trans('file.stock')}}</th>
            <th>{{trans('file.qty')}}</th>
            <th>ขอซื้อ</th>
            <th>หมายเหตุ</th>
                        <th>Action</th>
            </thead>
@foreach ($cartproducts as $cartproduct)

@php 
if(!empty($cartproduct->image)){
$imageshowarray =  explode(",",$cartproduct->image);
$imageshow = $imageshowarray[0];
}else{
    $imageshow = 'zummXD2dvAtI.png';
}
@endphp
<tr>
    <td>{!! $n !!}</td>
    <td class="text-center"> <a data-toggle="modal" data-target="#product-details" href="#" data-productid="{{ $cartproduct->id   }}" class="productpopup"> <img width="50"  src="{{ url('public/images/product', $imageshow)  }}" alt="{{ $cartproduct->name   }} - {{ $cartproduct->productscode }}"></a></td>
    <td>
        {{ $cartproduct->productscode }}
    </td>
    <td >{{ $cartproduct->name   }}</td>
    <td class="text-center stockstatus" id="stock_{{ $cartproduct->id }}"
        @if($cartproduct->qty>=$cartproduct->orderqty)
        style="background-color:rgb(123, 208, 30)"
        data-stockstatus="1"

@else
        style="background-color:rgb(253, 88, 104)"
        data-stockstatus="2"
        @endif
        >{{ $cartproduct->qty }}</td>
     
    <td class="text-center">
    <input min="1" class="text-right order_qty" style="width:50px" type="number"  data-productid="{{ $cartproduct->id }}" name="qty[{{ $cartproduct->id }}]" id="qty_{{ $cartproduct->id }}" value="{{ $cartproduct->orderqty }}">
    <input type="hidden" name="productid[]" value="{{ $cartproduct->id }}">
    <input type="hidden" name="productscode[{{ $cartproduct->id }}]" value="{{ $cartproduct->productscode }}">
    
    </td>
    <td class="text-center"><div id="pr_{{ $cartproduct->id }}"><?php if($cartproduct->qty<=0){ $stocksale = 0;}else{
     $stocksale = $cartproduct->qty;   
    } if($cartproduct->qty<$cartproduct->orderqty) {
        $prrow = $cartproduct->orderqty-$stocksale;
    } else{
        $prrow = 0; 
    }
    echo $prrow;
    ?></div></td>
<td><input data-productid="{{ $cartproduct->id }}"  class="form-control remarkrow"  type="text" name="remark_{{ $cartproduct->id }}" id="remark_{{ $cartproduct->id }}" value="{{ $cartproduct->remarkrow  }}"></td>
    <td class="text-center"><button type="button" class="delete-from-cart btn btn-out btn-danger btn-sm" data-code="{{ $cartproduct->productscode  }}"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
</tr>
@php 
$n++
@endphp
@endforeach
</table>
</div>







