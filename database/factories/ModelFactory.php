<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Model\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'firstname' => $faker->name,
        'lastname' => $faker->lastName,
        'second_lastname' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'avatar' => '/images/user-default.png',
        'remember_token' => str_random(10),
        'role_id' => rand(1,3)
    ];
});

$factory->define(App\Model\NodeCategory::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text,
    ];
});

$factory->define(App\Model\NodeType::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text,
    ];
});

$factory->define(App\Model\Node::class, function (Faker\Generator $faker) {
    return [
        'id_official' => $faker->unique()->randomNumber($nbDigits = 8),
        'name' => $faker->name,
        'definition' => $faker->text,
    ];
});

