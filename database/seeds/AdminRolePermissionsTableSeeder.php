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

class AdminRolePermissionsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        \DB::table('admin_role_permissions')->delete();

        \DB::table('admin_role_permissions')->insert(array(
            0 => array(
                'role_id' => 1,
                'permission_id' => 1,
                'created_at' => null,
                'updated_at' => null,
            ),
        ));
    }
}
