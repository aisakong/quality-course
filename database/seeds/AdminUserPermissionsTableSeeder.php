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

class AdminUserPermissionsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        \DB::table('admin_user_permissions')->delete();
    }
}
