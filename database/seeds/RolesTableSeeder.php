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
        			'name' => 'Vol',
        			'description' => 'Volunteer users. Users table type 1'
        		],
        		[
        			'name' => 'Admin',
        			'description' => 'Backend Admin User. Admin roles. Users table type 2'
        		],
        		[
        			'name' => 'Super',
        			'description' => 'Backend priviledged user. Can perform all roles in the application. Users table type 3'
        		]
        	]);
        }
    }
}
