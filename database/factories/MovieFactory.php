<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Movie;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Movie::class, function (Faker $faker) {
    return [
    	'user_id' =>auth()->user()->id,
        'title' => $faker->word,
        'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
    ];
});
