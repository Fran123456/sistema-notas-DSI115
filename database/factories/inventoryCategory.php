<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\inventoryCategory;
use App\Model;
use Faker\Generator as Faker;

$factory->define(inventoryCategory::class, function (Faker $faker) {

    return [
        'name' => $faker->sentence($nbWords = 3, $variableNbWords = true),
        'description' => $faker->sentence($nbWords = 9, $variableNbWords = true),
    ];
});
