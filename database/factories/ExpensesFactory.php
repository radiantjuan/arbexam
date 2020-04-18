<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Expenses;
use Faker\Generator as Faker;

$factory->define(Expenses::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'expense_value' => $faker->biasedNumberBetween(10,5000),
        'user_id' => rand(1,5),
        'expense_category_id' => rand(1,5)
    ];
});
