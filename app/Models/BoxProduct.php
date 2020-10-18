<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BoxProduct extends Model
{
    use SoftDeletes;

    protected $table = "box_product";
    protected $guarded = [];

    public function product(){
        return $this->belongsTo('App\Models\Product');
    }
}
