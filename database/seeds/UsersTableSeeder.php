<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::insert([
            ['role' => NULL,
                'name' => 'Joyce A. Perez',
                'username' => 'Joyce',
                'email' => 'jpgarcia@gmail.com',
                'admin' => 1,
                'password' => bcrypt('admin'),
                'created_at' => NULL,
                'updated_at' => NULL],
            ['role' => 'teacher',
                'name' => 'Emma P. Garcia',
                'username' => 'Emma',
                'email' => 'emma@gmail.com',
                'admin' => 0,
                'password' => bcrypt('123456789'),
                'created_at' => NULL,
                'updated_at' => NULL],
            ['role' => 'teacher',
                'name' => 'Adam P. Garcia',
                'username' => 'Adam',
                'email' => 'adam@gmail.com',
                'admin' => 0,
                'password' => bcrypt('123456789'),
                'created_at' => NULL,
                'updated_at' => NULL],
            ['role' => 'student',
                'name' => 'John Garcia',
                'username' => 'john',
                'email' => 'john@gmail.com',
                'admin' => 0,
                'password' => bcrypt('123456789'),
                'created_at' => NULL,
                'updated_at' => NULL],
            ['role' => 'student',
                'name' => 'Jem A. Perez',
                'username' => 'Jem',
                'email' => 'jem@gmail.com',
                'admin' => 0,
                'password' => bcrypt('123456789'),
                'created_at' => NULL,
                'updated_at' => NULL],
            ['role' => 'student',
                'name' => 'Joey A. Perez',
                'username' => 'Joey',
                'email' => 'joey@gmail.com',
                'admin' => 0,
                'password' => bcrypt('123456789'),
                'created_at' => NULL,
                'updated_at' => NULL],
            ['role' => 'student',
                'name' => 'Joy A. Perez',
                'username' => 'Joyjoy',
                'email' => 'joyjoy@gmail.com',
                'admin' => 0,
                'password' => bcrypt('123456789'),
                'created_at' => NULL,
                'updated_at' => NULL],

        ]);
    }
}
