<?php

use Illuminate\Database\Seeder;
use App\Model\CaseStatus;

class CaseStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        if(CaseStatus::get()->count() == 0){
        	CaseStatus::insert([
        		[
        			'name' => 'Received',
        			'created_at' => date('Y-m-d H:i:s'),
        			'updated_at' => date('Y-m-d H:i:s')
        		],
        		[
        			'name' => 'In Progress',
        			'created_at' => date('Y-m-d H:i:s'),
        			'updated_at' => date('Y-m-d H:i:s')
        		],
        		[
        			'name' => 'Resolved',
        			'created_at' => date('Y-m-d H:i:s'),
        			'updated_at' => date('Y-m-d H:i:s')
        		]
        	]);
        }
    }
}
