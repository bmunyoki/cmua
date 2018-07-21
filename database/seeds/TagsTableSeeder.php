<?php

use Illuminate\Database\Seeder;
use App\Model\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        if(Tag::get()->count() == 0){
        	Tag::insert([
        		[
        			'name' => 'FGM',
        			'created_at' => date('Y-m-d H:i:s'),
        			'updated_at' => date('Y-m-d H:i:s')
        		],
        		[
        			'name' => 'Child Abuse',
        			'created_at' => date('Y-m-d H:i:s'),
        			'updated_at' => date('Y-m-d H:i:s')
        		],
        		[
        			'name' => 'Early Childhood Marriage',
        			'created_at' => date('Y-m-d H:i:s'),
        			'updated_at' => date('Y-m-d H:i:s')
        		]
        	]);
        }
    }
}
