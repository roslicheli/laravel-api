<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('users')->truncate();

        DB::table('users')->insert([
            [
            	'name'=>'user 1',
            	'email'=>'user1@gmail.com',
            	'password'=>bcrypt('password'),
            	'created_at'=>\Carbon\Carbon::now()
            ],
            [
            	'name'=>'user 2',
            	'email'=>'user2@gmail.com',
            	'password'=>bcrypt('password'),
            	'created_at'=>\Carbon\Carbon::now()
            ],
        ]);
        
    }
}
