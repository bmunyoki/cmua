<?php

use Illuminate\Database\Seeder;
use App\Model\Priority;

class PrioritiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        if(Priority::get()->count() == 0){
        	Priority::insert([
        		[
        			'name' => 'High',
        			'created_at' => date('Y-m-d H:i:s'),
        			'updated_at' => date('Y-m-d H:i:s')
        		],
        		[
        			'name' => 'Medium',
        			'created_at' => date('Y-m-d H:i:s'),
        			'updated_at' => date('Y-m-d H:i:s')
        		],
        		[
        			'name' => 'Low',
        			'created_at' => date('Y-m-d H:i:s'),
        			'updated_at' => date('Y-m-d H:i:s')
        		]
        	]);
        }
    }
}
