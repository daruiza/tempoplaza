<?php

use Illuminate\Database\Seeder;

class RolTableSeeder extends Illuminate\Database\Seeder {
	
	public function run(){
		\DB::table('seg_rol')->insert(array(
			'rol'=>'Super Administrador',
			'description'=>'Posee acceso a todas las aplicaciones y sus opciones'				
			)
		);
		\DB::table('seg_rol')->insert(array(
			'rol'=>'Tendero',
			'description'=>'Administra las tiendas las tiendas a su cargo'
			)
		);
	}
}
