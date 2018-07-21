<?php

use Illuminate\Database\Seeder;
use App\Model\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        if(Role::get()->count() == 0){
        	Role::insert([
        		[
        			'name' => 'Admin',
        			'description' => 'Admin user'
        		]
        	]);
        }
    }
}
