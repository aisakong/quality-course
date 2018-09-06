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

class AdminRoleUsersTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        \DB::table('admin_role_users')->delete();

        \DB::table('admin_role_users')->insert(array(
            0 => array(
                'role_id' => 1,
                'user_id' => 1,
                'created_at' => null,
                'updated_at' => null,
            ),
        ));
    }
}
