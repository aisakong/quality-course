<?php

use Illuminate\Database\Seeder;

class AdminMenuTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_menu')->delete();
        
        \DB::table('admin_menu')->insert(array (
            0 => 
            array (
                'id' => 1,
                'parent_id' => 0,
                'order' => 1,
                'title' => '首页',
                'icon' => 'fa-bar-chart',
                'uri' => '/',
                'created_at' => NULL,
                'updated_at' => '2018-08-25 00:36:58',
            ),
            1 => 
            array (
                'id' => 2,
                'parent_id' => 0,
                'order' => 2,
                'title' => '系统管理',
                'icon' => 'fa-tasks',
                'uri' => NULL,
                'created_at' => NULL,
                'updated_at' => '2018-08-25 00:37:04',
            ),
            2 => 
            array (
                'id' => 3,
                'parent_id' => 2,
                'order' => 3,
                'title' => '管理员',
                'icon' => 'fa-users',
                'uri' => 'auth/users',
                'created_at' => NULL,
                'updated_at' => '2018-08-25 00:37:13',
            ),
            3 => 
            array (
                'id' => 4,
                'parent_id' => 2,
                'order' => 4,
                'title' => '角色',
                'icon' => 'fa-user',
                'uri' => 'auth/roles',
                'created_at' => NULL,
                'updated_at' => '2018-08-25 00:37:23',
            ),
            4 => 
            array (
                'id' => 5,
                'parent_id' => 2,
                'order' => 5,
                'title' => '权限',
                'icon' => 'fa-ban',
                'uri' => 'auth/permissions',
                'created_at' => NULL,
                'updated_at' => '2018-08-25 00:37:30',
            ),
            5 => 
            array (
                'id' => 6,
                'parent_id' => 2,
                'order' => 6,
                'title' => '菜单',
                'icon' => 'fa-bars',
                'uri' => 'auth/menu',
                'created_at' => NULL,
                'updated_at' => '2018-08-25 00:37:38',
            ),
            6 => 
            array (
                'id' => 7,
                'parent_id' => 2,
                'order' => 7,
                'title' => '操作日志',
                'icon' => 'fa-history',
                'uri' => 'auth/logs',
                'created_at' => NULL,
                'updated_at' => '2018-08-25 00:37:45',
            ),
            7 => 
            array (
                'id' => 8,
                'parent_id' => 0,
                'order' => 8,
                'title' => '用户管理',
                'icon' => 'fa-users',
                'uri' => 'users',
                'created_at' => '2018-08-25 01:01:47',
                'updated_at' => '2018-08-27 09:44:27',
            ),
            8 => 
            array (
                'id' => 9,
                'parent_id' => 0,
                'order' => 9,
                'title' => '话题管理',
                'icon' => 'fa-book',
                'uri' => NULL,
                'created_at' => '2018-08-25 01:28:52',
                'updated_at' => '2018-08-27 09:45:28',
            ),
            9 => 
            array (
                'id' => 10,
                'parent_id' => 9,
                'order' => 10,
                'title' => '分类',
                'icon' => 'fa-cubes',
                'uri' => 'categories',
                'created_at' => '2018-08-25 01:29:18',
                'updated_at' => '2018-08-27 09:47:11',
            ),
            10 => 
            array (
                'id' => 11,
                'parent_id' => 9,
                'order' => 11,
                'title' => '话题',
                'icon' => 'fa-bookmark-o',
                'uri' => 'topics',
                'created_at' => '2018-08-25 01:29:38',
                'updated_at' => '2018-08-27 09:49:05',
            ),
            11 => 
            array (
                'id' => 12,
                'parent_id' => 9,
                'order' => 12,
                'title' => '回复',
                'icon' => 'fa-comments',
                'uri' => 'replies',
                'created_at' => '2018-08-25 01:30:01',
                'updated_at' => '2018-08-27 09:49:15',
            ),
            12 => 
            array (
                'id' => 13,
                'parent_id' => 0,
                'order' => 13,
                'title' => '课程管理',
                'icon' => 'fa-calendar-plus-o',
                'uri' => NULL,
                'created_at' => '2018-08-25 08:00:52',
                'updated_at' => '2018-08-25 08:02:04',
            ),
            13 => 
            array (
                'id' => 14,
                'parent_id' => 13,
                'order' => 14,
                'title' => '系列',
                'icon' => 'fa-cubes',
                'uri' => 'series',
                'created_at' => '2018-08-25 08:01:25',
                'updated_at' => '2018-08-27 09:49:58',
            ),
            14 => 
            array (
                'id' => 15,
                'parent_id' => 13,
                'order' => 15,
                'title' => '视频',
                'icon' => 'fa-video-camera',
                'uri' => 'videos',
                'created_at' => '2018-08-25 08:02:00',
                'updated_at' => '2018-08-25 08:02:04',
            ),
        ));
        
        
    }
}