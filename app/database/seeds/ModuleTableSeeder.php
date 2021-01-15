<?php

use Illuminate\Database\Seeder;

class ModuleTableSeeder extends Illuminate\Database\Seeder {
	
	public function run(){
		\DB::table('seg_module')->insert(array(
			'module'=>'Aplicaciones',
			'preference'=>'{"js":"seg_aplicacion","categoria":"Componentes","controlador":"/aplicacion/","uiicono":"ui-jqueri","icono":"fa fa-th-large fa-fw"}',
			'description'=>'Este modulo contine toda la información de las aplicaciones de la pieza de software',
			'active'=>1,
			'app_id'=>1
			)
		);
		\DB::table('seg_module')->insert(array(
			'module'=>'Modulos',
			'preference'=>'{"js":"seg_modulo","categoria":"Componentes","controlador":"/modulo/","uiicono":"ui-jqueri","icono":"fa fa-th fa-fw"}',
			'description'=>'Este modulo contine toda la información de los modulos de la aplicación',
			'active'=>1,
			'app_id'=>1
			)
		);
		\DB::table('seg_module')->insert(array(
			'module'=>'Opciones',
			'preference'=>'{"js":"seg_opcion","categoria":"Componentes","controlador":"/opcion/","uiicono":"ui-jqueri","icono":"fa fa-tags fa-fw"}',
			'description'=>'Este modulo contine toda la información de las opciones de los modulos de la aplicación',
			'active'=>1,
			'app_id'=>1
			)
		);
		\DB::table('seg_module')->insert(array(
			'module'=>'Permisos',
			'preference'=>'{"js":"seg_permiso","categoria":"Acceso","controlador":"/permiso/","uiicono":"ui-jqueri","icono":"fa fa-retweet fa-fw"}',
			'description'=>'Este modulo contine toda la información de los permisos de los usuarios en la aplicación',
			'active'=>1,
			'app_id'=>1
			)
		);
		\DB::table('seg_module')->insert(array(
			'module'=>'Roles',
			'preference'=>'{"js":"seg_rol","categoria":"Componentes","controlador":"/rol/","uiicono":"ui-jqueri","icono":"fa fa-file-o fa-fw"}',
			'description'=>'Este modulo contine toda la información de los roles que pueden tomar los usuarios de la aplicación',
			'active'=>1,
			'app_id'=>1
			)
		);
		\DB::table('seg_module')->insert(array(
			'module'=>'Usuarios',
			'preference'=>'{"js":"seg_usuario","categoria":"Agentes","controlador":"/usuario/","uiicono":"ui-jqueri","icono":"fa fa-users fa-fw"}',
			'description'=>'Este modulo contine toda la información de los usuarios de la aplicación',
			'active'=>1,
			'app_id'=>1
			)
		);
		\DB::table('seg_module')->insert(array(
			'module'=>'Buzon De Mensajes',
			'preference'=>'{"js":"clu_buzon","categoria":"Componentes","controlador":"/buzon/","uiicono":"ui-jqueri","icono":"fa fa-envelope-o fa-fw"}',
			'description'=>'Este modulo gestiona la correspondencia de la aplicación',
			'active'=>1,
			'app_id'=>2
			)
		);
		\DB::table('seg_module')->insert(array(
			'module'=>'Tiendas',
			'preference'=>'{"js":"clu_tienda","categoria":"Componentes","controlador":"/mistiendas/","uiicono":"ui-jqueri","icono":"fa fa-envelope-o fa-fw"}',
			'description'=>'Este modulo gestiona las tiendas de los tenderos',
			'active'=>1,
			'app_id'=>2
			)
		);
		\DB::table('seg_module')->insert(array(
			'module'=>'Productos',
			'preference'=>'{"js":"clu_producto","categoria":"Componentes","controlador":"/producto/","uiicono":"ui-jqueri","icono":"fa fa-envelope-o fa-fw"}',
			'description'=>'Este modulo gestiona los productos de las tiendas',
			'active'=>1,
			'app_id'=>2
			)
		);
				
	}
}
