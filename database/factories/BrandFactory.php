<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Models\Brand::class, function (Faker $faker) {
    return [
        'brand_name' => $faker->name,
        'brand_url' => $faker->unique()->safeEmail,
        'brand_logo' => '/brand_upload/SXhRI23S35AlXGs636aneF60dD8Ci5C5h7YVGfHL.jpeg', // secret
        'brand_desc' => Str::random(10),
    ];
});
