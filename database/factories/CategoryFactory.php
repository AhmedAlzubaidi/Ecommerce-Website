<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->randomElement([
            'Clothing',
            'Computers',
            'Cameras',
            'Household furniture',
            'Entertainment',
            'Washing machines and dishwashers',
            'Mobile phones',
            'Sports equipment',
            'Office furniture',
            'Events equipment',
            'Cars',
            'Games',
            'Books',
            'Art',
            'Tablets',
            'Electronics',
            'Music',
            'Movies',
            'Anime',
            'Manga'
        ])
    ];
});
