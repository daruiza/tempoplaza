<?php

use Illuminate\Database\Seeder;

class DepartmentTableSeeder extends Illuminate\Database\Seeder {
	
	public function run(){
		\DB::table('seg_department')->insert(array(
			'code'=>5,
			'department'=>'Antioquia'			
			)
		);		
	}
}
