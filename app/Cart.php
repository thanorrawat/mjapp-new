<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'ordersale_products_cart';
    protected $guarded = [];
}
