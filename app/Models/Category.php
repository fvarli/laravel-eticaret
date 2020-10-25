<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $table = "category";
    // protected $fillable = ["category_name", "slug"];
    protected $guarded = [];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETED_AT = 'deleted_at';

    public function products(){
        return $this->belongsToMany('App\Models\Product', 'category_product');
    }

    public function primary_category()
    {
        return $this->belongsTo('App\Models\Category', 'cat_id')->withDefault([
            'category_name' => "Main Category"
        ]);
    }
}
