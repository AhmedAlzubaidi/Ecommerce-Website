<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Privilege;
use App\Role;
use Faker\Generator as Faker;

$factory->define(Role::class, function (Faker $faker) {
    return [
        // * name is provided by RolesTableSeeder
        // 'name' => 'Admin'
    ];
});

$factory->afterCreating(Role::class, function ($role, $faker) {
    factory(Privilege::class, 8)->create();
    $faker = \Faker\Factory::create();
    $id = $faker->numberBetween(1, 5);
    
    for ($index = 0; $index < 3; $index++) {
        $privilege = Privilege::where('id', $id + $index)->first();
        $role->privileges()->attach($privilege);
    }
});
