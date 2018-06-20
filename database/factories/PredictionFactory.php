<?php

$factory->define(App\Prediction::class, function (Faker\Generator $faker) {
    return [
        "user_id" => factory('App\User')->create(),
        "match_id" => factory('App\Match')->create(),
        "result_team1" => $faker->randomNumber(2),
        "result_team2" => $faker->randomNumber(2),
        "points" => $faker->randomFloat(2, 1, 100),
    ];
});
