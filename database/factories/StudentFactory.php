<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
   $index = $faker->numberBetween($min = 0, $max = 1);
   $gender = array('F','M');
    return [
       'name' => $faker->firstNameMale,
       'lastname' => $faker->lastname,
       'age' => $faker->numberBetween($min = 7, $max = 14),
       'gender' =>$gender[$index],
       'phone' => $faker->phoneNumber,
       'address' => $faker->address,
       'parent_name'=>$faker->firstNameMale,
       'parent_DUI'=>$faker->numberBetween($min = 10000000, $max = 99999999),
       'status' => 'NI'
    ];
});
