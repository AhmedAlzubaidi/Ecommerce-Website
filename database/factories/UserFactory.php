<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Address;
use App\Role;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $count = Role::all()->count();
    
    return [
        'role_id' => $count > 0 ? $faker->numberBetween(1, $count) : factory(Role::class)->create(),
        'name' => $faker->userName,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => Hash::make('password'), // password $2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi
        'remember_token' => Str::random(10),
        'full_name' => $faker->firstName
    ];
});

$factory->afterCreating(User::class, function ($user, $faker) {
    $user->createToken('authToken');
    $faker      = \Faker\Factory::create();
    factory(Address::class, $faker->numberBetween(1, 2))->create(['user_id' => $user->id]);
});
