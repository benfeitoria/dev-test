<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\PostCategories;
use Faker\Generator as Faker;

$factory->define(PostCategories::class, function (Faker $faker) {
    return [
        'name'=>$faker->name,
    ];
});
