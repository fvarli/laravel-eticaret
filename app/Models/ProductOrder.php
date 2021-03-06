<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductOrder extends Model
{
    use SoftDeletes;

    protected $table = "product_order";

    protected $fillable = ['box_id', 'order_price', 'status', 'full_name', 'address', 'phone', 'cell_phone', 'bank', 'installment'];

    public function box()
    {
        return $this->belongsTo('App\Models\Box');
    }
}
