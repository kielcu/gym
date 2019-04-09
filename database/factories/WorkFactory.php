<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Work::class, function (Faker $faker) {
    return [
        'exercise_id' => function() {
            return factory(\App\Models\Exercise::class)->create()->id;
        },
        'training_id' => function() {
            return factory(\App\Models\Training::class)->create()->id;
        },
        'series' => $faker->numberBetween(1,4),
        'weight' => $faker->numberBetween(10, 200),
        'repeat' => $faker->numberBetween(5, 12),
        'rest' => $faker->numberBetween(30, 300),
        'description' => $faker->text(),
    ];
});
