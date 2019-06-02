<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\SocialLogin;
use Faker\Generator as Faker;

$factory->define(SocialLogin::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement(['Github', 'Twitter', 'Facebook', 'Google', 'LinkedIn']),
        'driver' => $faker->unique()->randomElement(['github', 'twitter', 'facebook', 'google', 'linkedin']),
        'icon' => $faker->imageUrl(200, 200, 'technics')
    ];
});
