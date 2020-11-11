<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use App\OrderItem;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'user_id'      => factory(User::class)->create(),
        'order_number' => '#' . str_pad(1, 8, "0", STR_PAD_LEFT),
        'status'       => $faker->randomElement(['pending', 'in progress', 'delivered','canceled']),
        'total_cost'   => 0,
        'tax'          => 0
    ];
});

$factory->afterCreating(Order::class, function ($order, $faker) {
    $faker      = \Faker\Factory::create();
    $orderItems = factory(OrderItem::class, $faker->numberBetween(1, 4))
    ->create([
        'order_id' => $order->id
    ]);

    $total = 0;

    foreach ($orderItems as $orderItem) {
        $total += $orderItem->price;
    }

    $order->order_number = '#' . str_pad($order->id, 8, "0", STR_PAD_LEFT);
    $order->total_cost = $total;
    $order->tax   = ($total / 100) * 15;
    $order->save();
});
