<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleHistory extends Model
{
    //

    public function product()
{
    return $this->belongsTo('App\Product', 'productcode_code', 'code');
}

}
