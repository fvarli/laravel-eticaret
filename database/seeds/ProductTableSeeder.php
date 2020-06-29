<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("product")->insert(
        [
            "product_name" => "İskender",
            "price" => "14",
            "description" => "İskender fiyatı."
        ]);
    }
}
