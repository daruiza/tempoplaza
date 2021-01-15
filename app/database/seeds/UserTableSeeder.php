<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Illuminate\Database\Seeder {
	
	public function run(){
		\DB::table('seg_user')->insert(array(
			'name'=>'superadmin',
			'email'=>'super@yopmail.com',
			'password'=>\Hash::make('000000'),
			'active'=>1,
			'login'=>0,
			'stores'=>4,
			'products'=>60,
			'ip'=>'0',
			'rol_id'=>1
			)
		);
		\DB::table('seg_user')->insert(array(
			'name'=>'david',
			'email'=>'david@yopmail.com',
			'password'=>\Hash::make('000000'),
			'active'=>1,
			'login'=>0,
			'stores'=>4,
			'products'=>60,
			'ip'=>'0',
			'rol_id'=>2
		)
		);
	}
}
