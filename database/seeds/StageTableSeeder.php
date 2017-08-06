<?php

use Illuminate\Database\Seeder;

class StageTableSeeder extends Illuminate\Database\Seeder {
	
	public function run(){
		\DB::table('clu_stage')->insert(array(
			'stage'=>'PENDIENTE',
			'description'=>'Pedido pendiente por confirmar',					
			'active'=>1
			)
		);	
		\DB::table('clu_stage')->insert(array(
			'stage'=>'ACEPTADO',
			'description'=>'Pedido en proceso de entrega',						
			'active'=>1
			)
		);	
		\DB::table('clu_stage')->insert(array(
			'stage'=>'RECHAZADO',
			'description'=>'Pedido cancelado',							
			'active'=>1
			)
		);	
		\DB::table('clu_stage')->insert(array(
			'stage'=>'FINALIZADO',
			'description'=>'Pedido entregado',						
			'active'=>1
			)
		);	
		
	}
}
