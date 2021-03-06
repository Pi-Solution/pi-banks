<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Bank;
use Faker\Generator as Faker;

$factory->define(Bank::class, function (Faker $faker) {
    return [
        //
        'name'=> $faker->text(10),
        'allowed_overdraft' => $faker->numberBetween(1000, 10000),
        'starting_balance' => $faker->numberBetween(1000, 10000),
        'style_id' => $faker->numberBetween(1, App\BankStyle::count()),
    ];
});
