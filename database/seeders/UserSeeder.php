<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Str;
use Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		
		if(DB::table('users')->count() == 0){
            DB::table('users')->insert([

                [
                     'name' => Str::random(10),
					'email' => Str::random(10).'@gmail.com',
					'password' => Hash::make('password'),
					'created_at'=>date('Y-m-d H:i:s'),
					 'updated_at'=>date('Y-m-d H:i:s'),
                ],
                [
                     'name' => Str::random(10),
					'email' => Str::random(10).'@gmail.com',
					'password' => Hash::make('password'),
					'created_at'=>date('Y-m-d H:i:s'),
					'updated_at'=>date('Y-m-d H:i:s'),
                
                ],
                [
                    'name' => Str::random(10),
					'email' => Str::random(10).'@gmail.com',
					'password' => Hash::make('password'),
					'created_at'=>date('Y-m-d H:i:s'),
					'updated_at'=>date('Y-m-d H:i:s'),
                ]

            ]); 
            
        } else { echo "Not Insert "; }
       
    }
}
