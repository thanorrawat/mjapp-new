<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsCart extends Model
{
    protected $table = 'ordersale_products_cart';
    protected $guarded = ['id'];
}