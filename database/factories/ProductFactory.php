<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'product' => $faker->company,
        'price' => rand(100, 1000),
        'old_price' => rand(900, 1200),
        'in_stock' => rand(0, 1),
        'full_description' => '<p>' . $faker->paragraph . '</p>',
        'created_at' => time(),
        'category_id' => 1,
    ];
});
