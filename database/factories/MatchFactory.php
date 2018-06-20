<?php

$factory->define(App\Match::class, function (Faker\Generator $faker) {
    return [
        "team1_id" => factory('App\Team')->create(),
        "team2_id" => factory('App\Team')->create(),
        "start_time" => $faker->date("Y-m-d H:i:s", $max = 'now'),
        "result1" => $faker->randomNumber(2),
        "result2" => $faker->randomNumber(2),
        "comment" => $faker->name,
    ];
});
