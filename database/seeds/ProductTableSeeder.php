<?php

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductDetail;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param \Faker\Generator $faker
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Product::truncate();
        ProductDetail::truncate();

        for($i=0; $i<30; $i++){
            $product_name = $faker->sentence(2);
            $product = Product::create([
                'product_name' => $product_name,
                'slug' => str_slug($product_name),
                'description' => $faker->sentence(20),
                'price' => $faker->randomFloat(2,1,20)
            ]);

            $detail = $product->detail()->create([
                'show_slider' =>rand(0,1),
                'show_today_opportunity' =>rand(0,1),
                'show_featured' =>rand(0,1),
                'show_best_seller' =>rand(0,1),
                'show_discount' =>rand(0,1),
            ]);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    }
}
