<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Post::class, function (Faker $faker) {
    return [
        'image' => 'uploads/NrvoBWidkeithOB8lzYXzLD6I0saFar3yRiOf9hO.jpg',
        'caption' => 'Hello',
        'user_id' => 17,
        'category_id' => 2,
        'voucher_enable' => \Carbon\Carbon::now(),
        'voucher_quantity' => rand(10,20),
        'title' => 'HIHI',
    ];
});
