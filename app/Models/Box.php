<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Box extends Model
{
    use SoftDeletes;

    protected $table = "box";
    protected $guarded = [];

    public function product_order()
    {
        return $this->belongsTo('App\Models\ProductOrder');
    }

    public static function active_box_id()
    {
        $active_box = DB::table('box as b')
            ->leftJoin('product_order as p_order', 'p_order.box_id', '=', 'b.id')
            ->where('b.user_id', auth()->id())
            ->whereRaw('p_order.id is null')
            ->orderByDesc('b.created_at')
            ->select('b.id')
            ->first();

        if (!is_null($active_box)) return $active_box->id;
    }

}
