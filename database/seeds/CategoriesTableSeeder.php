<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = DB::table('categories');

        for ($i = 0; $i < 10; $i++) {
            $categories->insert([
                'category' => sprintf('Category %d', $i),
                'description' => '<p>Full description</p>',
                'alias' => sprintf('category-%d', $i),
                'main_image' => 'images/categories.jpg',
            ]);
        }
    }
}
