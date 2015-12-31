<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'admin',
            'email' => 'admin@qq.com',
            'password' => bcrypt('123456'),
            'created_at'=> date('Y-m-d H:i:s', time()),
            'updated_at'=> date('Y-m-d H:i:s', time()),
        ]);
    }
}
