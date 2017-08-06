<?php

use Illuminate\Database\Seeder;

class UserProfileTableSeeder extends Illuminate\Database\Seeder {
	
	public function run(){
		\DB::table('seg_user_profile')->insert(array(
			'identificacion'=>100000001,
			'names'=>'Super',
			'surnames'=>'Administrator',
			'birthdate'=>'1988/05/25',
			'adress'=>'Cr 1 #1-1',
			'state'=>'Antioquia',
			'city'=>'Envigado',
			'avatar'=>'default.png',
			'template'=>'flowers',
			'movil_number'=>5555555555,
			'fix_number'=>5555555,			
			'user_id'=>1	
			)
		);
		\DB::table('seg_user_profile')->insert(array(
			'identificacion'=>100000002,
			'names'=>'Administrador',
			'surnames'=>'ClubAmigos',
			'birthdate'=>'1988/05/25',
			'adress'=>'Cr 1 #1-1',
			'state'=>'Antioquia',
			'city'=>'Envigado',
			'avatar'=>'default.png',
			'template'=>'default',
			'movil_number'=>5555555555,
			'fix_number'=>5555555,
			'user_id'=>2			
			)
		);
	}
}
