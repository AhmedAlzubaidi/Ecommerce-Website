<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Address;
use App\City;
use App\Country;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {
    $country = factory(Country::class)->create();
    $city    = factory(City::class)->create(['country_id' => $country->id]);
    
    return [
        'city_id'     => $city->id,
        'address'     => $faker->address,
        'apartment'   => $faker->address,
        'postal_code' => $faker->postcode
    ];
});
