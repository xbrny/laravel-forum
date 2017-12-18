<?php

use App\User;
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
        User::create([
        	'name' => 'admin',
        	'avatar' => 'avatars/avatar1.png',
        	'admin' => 1,
        	'email' => 'admin@gmail.com',
        	'password' => bcrypt('qweasd')
        ]);

        User::create([
        	'name' => 'Sara Doe',
        	'avatar' => 'avatars/avatar1.png',
        	'email' => 'sara@gmail.com',
        	'password' => bcrypt('qweasd')
        ]);
    }
}
