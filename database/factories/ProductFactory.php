<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $price = $faker->randomFloat(2, 50, 6000);
    $onSale = $faker->boolean();

    return [
        'name'     => $faker->unique()->name,
        'price'    => $price,
        'on_sale'  => $onSale,
        'discount' => $onSale ? $price / $faker->numberBetween(2, 5) : 0,
        'quantity' => $faker->numberBetween(10, 200),
    ];
});

$factory->afterCreating(Product::class, function ($product, $faker) {
    $faker    = \Faker\Factory::create();
    $category = Category::where('id', $faker->numberBetween(1, 5))->first();
    $product->categories()->attach($category);
});
