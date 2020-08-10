<?php

/** @var  \Illuminate\Database\Eloquent\Factory $factory */

use App\Productos;
use Faker\Generator as Faker;


$factory->define(Productos::class, function (Faker $faker) {
    return [
        'nombre' => $faker->text,
        'precio' => $faker->randomFloat(),
        'existencia' => $faker->randomDigit,
        'medida' => $faker->text,
    ];
});
