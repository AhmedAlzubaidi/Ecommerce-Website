<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProductOption;
use Faker\Generator as Faker;

$factory->define(ProductOption::class, function (Faker $faker) {
    $key = $faker->randomElement([
        'color',
        'size'
    ]);

    $value = $key === 'color' ?
        $faker->colorName :
        $faker->randomElement([
            'XL', 'L', 'M/L', 'M', 'S', 'XS/S'
        ]);

    return [
        'key'   => $key,
        'value' => $value
    ];
});
