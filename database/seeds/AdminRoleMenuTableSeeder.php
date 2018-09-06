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

class AdminRoleMenuTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        \DB::table('admin_role_menu')->delete();

        \DB::table('admin_role_menu')->insert(array(
            0 => array(
                'role_id' => 1,
                'menu_id' => 2,
                'created_at' => null,
                'updated_at' => null,
            ),
        ));
    }
}
