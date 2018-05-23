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
        
        //disable foreign key check for this connection before running seeders
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
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

        //enable foreign key check for this connection after running seeders
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
    }
}
