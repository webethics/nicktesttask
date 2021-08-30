<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
    {
       
		if(DB::table('websites')->count() == 0){
            DB::table('websites')->insert([

                [
                    'name' => 'A', 
					'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'B',
					'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s'),
                
                ],
                [
                    'name' => 'C',
					'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s'),
                ]

            ]);
            
        } else { echo "Not Insert "; }
		
    }
}
