<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {

    return [
        'name' => $faker->word,
        'email' => $faker->word,
        'email_verified_at' => $faker->date('Y-m-d H:i:s'),
        'password' => $faker->word,
        'remember_token' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'last_name' => $faker->word,
        'org_role_id' => $faker->randomDigitNotNull,
        'department_id' => $faker->randomDigitNotNull,
        'is_2fa' => $faker->randomDigitNotNull,
        'start_date' => $faker->word,
        'end_date' => $faker->word
    ];
});
