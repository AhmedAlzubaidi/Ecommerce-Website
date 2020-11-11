<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Privilege;
use Faker\Generator as Faker;

$factory->define(Privilege::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->randomElement([
            '*',
            'CREATE_PRODUCT',
            'CREATE_PRODUCT_OPTION',
            'CREATE_ADDRESS',
            'CREATE_PRIVILEGE',
            'CREATE_ROLE',
            'CREATE_USER',
            'CREATE_CATEGORY',
            'CREATE_COUNTRY',
            'CREATE_CITY',
            'VIEW_ROLE_SELF',
            'VIEW_USER_SELF',
            'VIEW_PRODUCT_ALL',
            'VIEW_PRODUCT_OPTION_ALL',
            'VIEW_ROLE_ALL',
            'VIEW_USER_ALL',
            'VIEW_CATEGORY_SELF',
            'VIEW_TEST_SELF',
            'VIEW_TEMP_ALL',
            'VIEW_CATEGORY_ALL',
            'VIEW_TEST_ALL',
            'VIEW_TEMP_ALL',
            '0CREATE_PRODUCT',
            '0CREATE_PRODUCT_OPTION',
            '0CREATE_ADDRESS',
            '0CREATE_PRIVILEGE',
            '0CREATE_ROLE',
            '0CREATE_USER',
            '0CREATE_CATEGORY',
            '0CREATE_COUNTRY',
            '0CREATE_CITY',
            '0VIEW_ROLE_SELF',
            '0VIEW_USER_SELF',
            '0VIEW_PRODUCT_ALL',
            '0VIEW_PRODUCT_OPTION_ALL',
            '0VIEW_ROLE_ALL',
            '0VIEW_USER_ALL',
            '0VIEW_CATEGORY_SELF',
            '0VIEW_TEST_SELF',
            '0VIEW_TEMP_ALL',
            '0VIEW_CATEGORY_ALL',
            '0VIEW_TEST_ALL',
            '0VIEW_TEMP_ALL'
        ])
    ];
});
