<?php

/*
 * This file is part of the hui-ho/quality-course.
 *
 * (c) jiehui <hui-ho@outlook.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    // 随机取一个月以内的时间
    $updated_at = $faker->dateTimeThisMonth();
    // 传参为生成最大时间不超过，创建时间永远比更改时间要早
    $created_at = $faker->dateTimeThisMonth($updated_at);

    return [
        'name' => $faker->sentence(),
        'description' => $faker->text(),
        'post_count' => 0,
        'created_at' => $created_at,
        'updated_at' => $updated_at,
    ];
});
