<?php

use Illuminate\Database\Seeder;

class TypePaymentMethodTableSeeder extends Illuminate\Database\Seeder {
	
	public function run(){
		\DB::table('clu_type_payment_method')->insert(array(
			'type'=>'payU',
			'description'=>'{"parametros":[{
				"post":"https://sandbox.gateway.payulatam.com/ppp-web-gateway/",
				"input-name":	"merchantId",
				"input-name":	"accountId",
				"input-name":	"description",
				"input-name":	"accountId",
				"input-name":	"accountId",
				"input-name":	"accountId",
				"input-name":	"accountId",
				"input-name":	"accountId",
				"input-name":	"accountId",
				"input-name":	"accountId",
				"input-name":	"accountId",
				"input-name":	"accountId",
				

			}]}'
			)
		);
		
	}
}
