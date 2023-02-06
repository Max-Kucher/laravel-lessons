<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = DB::table('products');

        for ($i = 0; $i < 11; $i++) {
            $products->insert([
                'product' => sprintf('IPhone X (%d)', $i),
                'price' => 100.00,
                'old_price' => 120.00,
                'in_stock' => true,
                'full_description' => '<p>Full description</p>',
                'short_description' => '<p>Short description</p>',
            ]);
        }
    }
}
