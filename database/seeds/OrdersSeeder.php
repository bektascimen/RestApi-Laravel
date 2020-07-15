<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::statement("TRUNCATE TABLE products");
        DB::table('orders')->insert(['productId' => 1, 'userId' => 1, 'orderCode' => 'Order-1', 'quantity' => 1, 'address' => 'test adres', 'shippingDate' => '2020-07-15 11:48:00']);

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
