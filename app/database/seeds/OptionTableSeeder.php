<?php

use Illuminate\Database\Seeder;

class OptionTableSeeder extends Illuminate\Database\Seeder {
	
	public function run(){
		\DB::table('seg_option')->insert(array(
				'option'=>'Listar',
				'action'=>'enumerar',
				'preference'=>'{"lugar":"escritorio","vista":"none","icono":"fa fa-th-list"}',
				'active'=>1
				)
		);
		\DB::table('seg_option')->insert(array(
				'option'=>'Listar',
				'action'=>'enumerar',
				'preference'=>'{"lugar":"papelera","vista":"none","icono":"fa fa-th-list"}',
				'active'=>1
				)
		);
		\DB::table('seg_option')->insert(array(
				'option'=>'Ver',
				'action'=>'mirar',
				'preference'=>'{"lugar":"escritorio","vista":"listar","icono":"fa fa-eye"}',
				'active'=>1
				)
		);
		\DB::table('seg_option')->insert(array(
				'option'=>'Agregar',
				'action'=>'crear',
				'preference'=>'{"lugar":"escritorio","vista":"listar","icono":"fa fa-plus"}',
				'active'=>1
				)
		);
		\DB::table('seg_option')->insert(array(
				'option'=>'Agregar',
				'action'=>'crear',
				'preference'=>'{"lugar":"escritorio","vista":"none","icono":"fa fa-plus"}',
				'active'=>1
				)
		);
		\DB::table('seg_option')->insert(array(
				'option'=>'Editar',
				'action'=>'actualizar',
				'preference'=>'{"lugar":"escritorio","vista":"listar","icono":"fa fa-gears"}',
				'active'=>1
			)
		);	
		\DB::table('seg_option')->insert(array(
				'option'=>'Reciclar',
				'action'=>'botar',
				'preference'=>'{"lugar":"escritorio","vista":"listar","icono":"fa fa-trash-o"}',
				'active'=>1
			)
		);
		\DB::table('seg_option')->insert(array(
				'option'=>'Restaurar',
				'action'=>'recuperar',
				'preference'=>'{"lugar":"papelera","vista":"listar","icono":"fa fa-long-arrow-up"}',
				'active'=>1
			)
		);
		\DB::table('seg_option')->insert(array(
				'option'=>'Borrar',
				'action'=>'eliminar',
				'preference'=>'{"lugar":"papelera","vista":"listar","icono":"fa fa-times"}',
				'active'=>1
			)
		);	
		\DB::table('seg_option')->insert(array(
				'option'=>'Borrar',
				'action'=>'eliminar',
				'preference'=>'{"lugar":"escritorio","vista":"listar","icono":"fa fa-times"}',
				'active'=>1
			)
		);
		\DB::table('seg_option')->insert(array(
				'option'=>'Borrar',
				'action'=>'eliminar',
				'preference'=>'{"lugar":"escritorio","vista":"none","icono":"fa fa-times"}',
				'active'=>1
			)
		);
		\DB::table('seg_option')->insert(array(
				'option'=>'Crear una Tienda',
				'action'=>'nuevatienda',
				'preference'=>'{"lugar":"escritorio","vista":"listar","icono":"glyphicon glyphicon-plus"}',
				'active'=>1
				)
		);
		
	}
}
