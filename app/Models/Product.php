<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static find(array|\Illuminate\Http\Request|string $request)
 */
class Product extends Model
{
    use SoftDeletes;

    protected $table = "product";
    // protected $fillable = ["product_name", "slug"];
    protected $guarded = [];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETED_AT = 'deleted_at';

    public function category(){
        return $this->belongsToMany('App\Models\Category', 'category_product');
    }

    public function detail()
    {
        return $this->hasOne('App\Models\ProductDetail');
    }
}
