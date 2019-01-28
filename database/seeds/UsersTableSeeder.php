<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Joyce A. Perez',
            'username' => 'Administrator',
            'email' => 'jpgarcia@gmail.com',
            'admin' => 1,
            'password' => bcrypt('admin')
        ]);
    }
}
