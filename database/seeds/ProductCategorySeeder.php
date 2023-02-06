<?php

use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        while($products = App\Product::paginate(3)) {
            foreach ($products as $product) {
                if (is_null($product->category_id) || $product->category_id === 0) {
                    $product->category_id = 1;

                    $product->save();
                }
            }
        }
    }
}
