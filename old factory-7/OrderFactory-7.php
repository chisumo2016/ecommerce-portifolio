<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'status'=> $this->faker->randomElement(['pending' ,'paid' ,'shipped']),
        //'customer_id' not needed
    ];

});
