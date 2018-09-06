<?php

use Illuminate\Database\Seeder;

class AdminUsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_users')->delete();
        
        \DB::table('admin_users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'username' => 'admin',
                'password' => '$2y$10$3oh4mnj/a4hUsFMWMKeXFuHkkuH3AbBNtCA/5MACL4w4nXTDMpuuO',
                'name' => 'Administrator',
                'avatar' => NULL,
                'remember_token' => NULL,
                'created_at' => '2018-08-25 00:33:51',
                'updated_at' => '2018-08-25 00:33:51',
            ),
        ));
        
        
    }
}