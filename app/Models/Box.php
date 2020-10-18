<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Box extends Model
{
    use SoftDeletes;

    protected $table = "box";
    protected $guarded = [];

    public function product_order()
    {
        return $this->belongsTo('App\Models\ProductOrder');
    }

}
