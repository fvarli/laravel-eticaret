<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    public function index()
    {
        $show_best_seller = DB::select("
        SELECT pro.product_name, SUM(b_product.piece) piece
        FROM product_order p_order
        INNER JOIN box b ON b.id = p_order.box_id
        INNER  JOIN box_product b_product ON b.id = b_product.box_id
        INNER JOIN product pro ON pro.id = b_product.product_id
        GROUP BY pro.product_name
        ORDER BY SUM('box_product.piece') DESC
        ");

        $monthly_orders = DB::select("
        SELECT
        DATE_FORMAT(p_order.created_at, '%Y-%m') month, SUM(b_product.piece) piece
        FROM product_order p_order
        INNER JOIN box b ON b.id = p_order.box_id
        INNER JOIN box_product b_product ON b.id = b_product.box_id
        GROUP BY DATE_FORMAT(p_order.created_at, '%Y-%m')
        ORDER BY DATE_FORMAT(p_order.created_at, '%Y-%m')
        ");

        return view('admin.home', compact('show_best_seller', 'monthly_orders'));
    }
}
