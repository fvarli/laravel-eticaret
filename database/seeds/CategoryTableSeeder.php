<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category')->truncate();

        $id = DB::table('category')->insertGetId(['category_name'=>'Electronic', 'slug'=>'electronic','created_at' => date("Y-m-d H:i:s")]);
        DB::table('category')->insert(['category_name'=>'Computer/Laptop', 'slug'=>'computer-laptop', 'cat_id' => $id, 'created_at' => date("Y-m-d H:i:s")]);

        $id = DB::table('category')->insertGetId(['category_name'=>'Software', 'slug'=>'software', 'created_at' => date("Y-m-d H:i:s")]);
        DB::table('category')->insert(['category_name'=>'Android', 'slug'=>'android', 'cat_id' => $id, 'created_at' => date("Y-m-d H:i:s")]);

    }
}
