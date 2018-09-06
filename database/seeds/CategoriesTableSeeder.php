<?php

/*
 * This file is part of the hui-ho/quality-course.
 *
 * (c) jiehui <hui-ho@outlook.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        \DB::table('categories')->delete();

        \DB::table('categories')->insert(array(
            0 => array(
                'id' => 1,
                'name' => '分享',
                'description' => '分享创造，分享发现',
                'post_count' => 0,
                'created_at' => '2018-08-23 10:16:24',
                'updated_at' => '2018-08-23 10:16:25',
            ),
            1 => array(
                'id' => 2,
                'name' => '教程',
                'description' => '开发技巧、推荐扩展包等',
                'post_count' => 0,
                'created_at' => '2018-08-23 10:16:38',
                'updated_at' => '2018-08-23 10:16:40',
            ),
            2 => array(
                'id' => 3,
                'name' => '问答',
                'description' => '请保持友善，互帮互助',
                'post_count' => 0,
                'created_at' => '2018-08-23 10:16:56',
                'updated_at' => '2018-08-23 10:16:57',
            ),
        ));
    }
}
