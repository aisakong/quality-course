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

class AdminUsersTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        \DB::table('admin_users')->delete();

        \DB::table('admin_users')->insert(array(
            0 => array(
                'id' => 1,
                'username' => 'admin',
                'password' => '$2y$10$3oh4mnj/a4hUsFMWMKeXFuHkkuH3AbBNtCA/5MACL4w4nXTDMpuuO',
                'name' => 'Administrator',
                'avatar' => null,
                'remember_token' => null,
                'created_at' => '2018-08-25 00:33:51',
                'updated_at' => '2018-08-25 00:33:51',
            ),
        ));
    }
}
