<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {

    $parent_id = $faker->numberBetween(0, 1100);
    if ($parent_id < 200) {
        $is_top = true;
        $parent_id = null;
    } else {
        $is_top = false;
    }

    return [
        'subject' => $faker->realText(40),
        'content' => $faker->realText,
        'user_id' => $faker->numberBetween(1, 50),
        'category_id' => $faker->numberBetween(1, 9),
        'is_top' => $is_top,
        'parent_id' => $parent_id,
    ];
});
