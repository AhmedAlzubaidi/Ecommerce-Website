<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\OrderItem;
use App\Product;
use Faker\Generator as Faker;

$factory->define(OrderItem::class, function (Faker $faker) {
    $count    = Product::all()->count();
    $id       = $faker->numberBetween(1, $count);
    
    $product  = $count > 0 ?
        Product::where('id', $id)->first() :
        factory(Product::class)->create()->id;

    $quantity = $faker->numberBetween(1, 6);

    return [
        'product_id' => $product->id,
        'quantity'   => $quantity,
        'price'      => ($product->price - $product->discount) * $quantity
    ];
});
