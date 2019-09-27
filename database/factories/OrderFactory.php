<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Order::class, function (Faker $faker) {
    return  [
        'code' => $code = time() * rand(2, 100),
        'specializations' => json_encode([$faker->randomElement(['engineering', 'medicine', 'pharmacy'])]),
        'status' => $faker->randomElement(['progressing', 'failed', 'completed']),
        'budget' => $faker->randomElement([1500, 2500, 3000, 3500, 4000, 4500, 5000, 5500, 6000, 7000, 8000, 9000, 9500, 10000]),
        'user_id' => $user = factory(\App\Models\User::class)->create(['role' => 'user']),
        'delegate_id' => factory(\App\Models\User::class)->create(['role' => 'delegate', 'country_id' => $user->country->id]),
        'delegate_assigned_by' => factory(\App\Models\User::class)->create(['role' => 'admin'])
    ];
});
