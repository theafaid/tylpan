<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\University::class, function (Faker $faker) {
    return [
        'name' => $name = $faker->unique()->text(40),
        'slug' => \Str::slug($name),
        'description' => $faker->realText(100000),
        'site_url' => $faker->url,
        'country_id' => \App\Models\Country::where('travel_to', true)->get()->random()->id,
    ];
});
