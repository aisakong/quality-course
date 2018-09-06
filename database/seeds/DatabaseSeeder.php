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

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        // $this->call(TopicsTableSeeder::class);
        // $this->call(ReplysTableSeeder::class);
        $this->call(AdminUsersTableSeeder::class);
        $this->call(AdminRolesTableSeeder::class);
        $this->call(AdminPermissionsTableSeeder::class);
        $this->call(AdminMenuTableSeeder::class);
        $this->call(AdminUserPermissionsTableSeeder::class);
        $this->call(AdminRoleUsersTableSeeder::class);
        $this->call(AdminRolePermissionsTableSeeder::class);
        $this->call(AdminRoleMenuTableSeeder::class);
    }
}
