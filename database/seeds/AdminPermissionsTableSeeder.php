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

class AdminPermissionsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        \DB::table('admin_permissions')->delete();

        \DB::table('admin_permissions')->insert(array(
            0 => array(
                'id' => 1,
                'name' => 'All permission',
                'slug' => '*',
                'http_method' => '',
                'http_path' => '*',
                'created_at' => null,
                'updated_at' => null,
            ),
            1 => array(
                'id' => 2,
                'name' => 'Dashboard',
                'slug' => 'dashboard',
                'http_method' => 'GET',
                'http_path' => '/',
                'created_at' => null,
                'updated_at' => null,
            ),
            2 => array(
                'id' => 3,
                'name' => 'Login',
                'slug' => 'auth.login',
                'http_method' => '',
                'http_path' => '/auth/login
/auth/logout',
                'created_at' => null,
                'updated_at' => null,
            ),
            3 => array(
                'id' => 4,
                'name' => 'User setting',
                'slug' => 'auth.setting',
                'http_method' => 'GET,PUT',
                'http_path' => '/auth/setting',
                'created_at' => null,
                'updated_at' => null,
            ),
            4 => array(
                'id' => 5,
                'name' => 'Auth management',
                'slug' => 'auth.management',
                'http_method' => '',
                'http_path' => '/auth/roles
/auth/permissions
/auth/menu
/auth/logs',
                'created_at' => null,
                'updated_at' => null,
            ),
        ));
    }
}
