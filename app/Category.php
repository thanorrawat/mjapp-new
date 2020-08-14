<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable =[

        "name","code","cate_type","description","parent_id", "is_active","number"
    ];

    public function product()
    {
    	return $this->hasMany('App\Product');
    }
}
