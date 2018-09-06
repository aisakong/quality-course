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

class AdminRolesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        \DB::table('admin_roles')->delete();

        \DB::table('admin_roles')->insert(array(
            0 => array(
                'id' => 1,
                'name' => 'Administrator',
                'slug' => 'administrator',
                'created_at' => '2018-08-25 00:33:51',
                'updated_at' => '2018-08-25 00:33:51',
            ),
        ));
    }
}
