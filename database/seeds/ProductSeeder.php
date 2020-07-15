<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("product")->insert([
            'name' => 'Product A',
            'slug' => 'product-a',
            'description' => 'Description 1',
            'price' => 5,
        ]);
        DB::table("product")->insert([
            'name' => 'Product B',
            'slug' => 'product-b',
            'description' => 'Description 2',
            'price' => 7.5,
        ]);
        DB::table("product")->insert([
            'name' => 'Product C',
            'slug' => 'product-c',
            'description' => 'Description 3',
            'price' => 10,
        ]);

    }
}
