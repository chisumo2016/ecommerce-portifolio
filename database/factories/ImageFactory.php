<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Image;
use App\User;
use Faker\Generator as Faker;

$factory->define(Image::class, function (Faker $faker) {

    $filename = $this->faker->numberBetween(1,10) . 'jpg';

    return [
        'path' => "img/products/{$filename}",
    ];

});

$factory->define(User::class, function (Faker $faker) {

    $filename = $this->faker->numberBetween(1,5) . 'jpg';

      return  $this->state([

        'path' => "img/users/{$filename}",

    ]);


});
