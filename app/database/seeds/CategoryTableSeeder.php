<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Illuminate\Database\Seeder {
	
	public function run(){
		\DB::table('clu_category')->insert(array(
			'name'=>'ComidaRapida',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Fritos',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Azados',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Bebidas',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Lacteos',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Helados',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Frutas',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Verduras',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Cereales',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Enlatados',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Condimentos',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Salsas',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Golosinas',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Postres',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Deporte',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Salud',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Aseo',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Belleza',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Electrodomesticos',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Electrònica',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Libros',
			'category_id'=> 0		
			)
		);				
		\DB::table('clu_category')->insert(array(
			'name'=>'Muebles',
			'category_id'=> 0		
			)
		);		
		\DB::table('clu_category')->insert(array(
			'name'=>'Herramienta',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Jueguetes',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Bebes',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Regalos',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Mascotas',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Bodas',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Ropa',
			'category_id'=> 0		
			)
		);		
		\DB::table('clu_category')->insert(array(
			'name'=>'Vehiculos',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Plantas',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Papeleria',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Joyeria',
			'category_id'=> 0		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Bisuteria',
			'category_id'=> 0		
			)
		);

		//SUBCATEGORIAS
		//1 Comida rapida
		\DB::table('clu_category')->insert(array(
			'name'=>'Perros Calientes',
			'category_id'=> 1		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Quesadillas',
			'category_id'=> 1		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Hamburguesas',
			'category_id'=> 1		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Pizzas',
			'category_id'=> 1		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Sanduches',
			'category_id'=> 1		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Cubanos',
			'category_id'=> 1		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Arepas',
			'category_id'=> 1		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Empanadas',
			'category_id'=> 1		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Papas',
			'category_id'=> 1		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Burritos',
			'category_id'=> 1		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Pasteles',
			'category_id'=> 1		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Papas Fritas',
			'category_id'=> 1		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Chuzos',
			'category_id'=> 1		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Albondigas',
			'category_id'=> 1		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Comida Casera',
			'category_id'=> 1		
			)
		);

		//2 Fritos
		\DB::table('clu_category')->insert(array(
			'name'=>'Pasteles',
			'category_id'=> 2		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Carnes',
			'category_id'=> 2		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Papas',
			'category_id'=> 2		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Donas',
			'category_id'=> 2		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Buñuelos',
			'category_id'=> 2		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Vegetales',
			'category_id'=> 2		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Arepas',
			'category_id'=> 2		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Chorizos',
			'category_id'=> 2		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Pollos',
			'category_id'=> 2	
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'pescados',
			'category_id'=> 2		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Shalchichas',
			'category_id'=> 2
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Costillas',
			'category_id'=> 2		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Chicharron',
			'category_id'=> 2		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Patacones',
			'category_id'=> 2		
			)
		);

		//3 Azados
		\DB::table('clu_category')->insert(array(
			'name'=>'Carnes',
			'category_id'=> 3		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Chorizos',
			'category_id'=> 3		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Pollos',
			'category_id'=> 3		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'pescados',
			'category_id'=> 3		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Shalchichas',
			'category_id'=> 3		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Costillas',
			'category_id'=> 3		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Tortas',
			'category_id'=> 3		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Galletas',
			'category_id'=> 3		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Panes',
			'category_id'=> 3		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Parva',
			'category_id'=> 3		
			)
		);


		//4 bebidas
		\DB::table('clu_category')->insert(array(
			'name'=>'Gaseosas',
			'category_id'=>4		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Jugos naturales en agua',
			'category_id'=>4		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Jugos naturales en leche',
			'category_id'=>4		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Te',
			'category_id'=>4		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Cafe',
			'category_id'=>4		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Chocolate',
			'category_id'=>4		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Guarapo',
			'category_id'=>4		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Claro',
			'category_id'=>4		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Avena',
			'category_id'=>4		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Milo',
			'category_id'=>4		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Vinos',
			'category_id'=>4		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Cervezas',
			'category_id'=>4		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Aguardiente',
			'category_id'=>4		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Ron',
			'category_id'=>4		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Licores',
			'category_id'=>4		
			)
		);

		//5 Lacteos
		\DB::table('clu_category')->insert(array(
			'name'=>'Leche',
			'category_id'=>5		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Yogurt',
			'category_id'=>5		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Quesos',
			'category_id'=>5		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Cuajadas',
			'category_id'=>5		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'kumis',
			'category_id'=>5		
			)
		);

		//6 helados
		\DB::table('clu_category')->insert(array(
			'name'=>'Conos',
			'category_id'=>6		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Conchas',
			'category_id'=>6		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Barquillos',
			'category_id'=>6		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Copas',
			'category_id'=>6		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Vasos',
			'category_id'=>6		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Galletas',
			'category_id'=>6		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Paletas',
			'category_id'=>6		
			)
		);

		//7 Frutas
		\DB::table('clu_category')->insert(array(
			'name'=>'Manzanas',
			'category_id'=> 7		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Peras',
			'category_id'=> 7		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Mangos',
			'category_id'=> 7		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Fresas',
			'category_id'=> 7		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Cerezas',
			'category_id'=> 7		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Aguacates',
			'category_id'=> 7		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Guanabanas',
			'category_id'=> 7		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Sandias',
			'category_id'=> 7		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Papayas',
			'category_id'=> 7		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Guayabas',
			'category_id'=> 7		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Uvas',
			'category_id'=> 7		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Ochuas',
			'category_id'=> 7		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Moras',
			'category_id'=> 7		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Lulos',
			'category_id'=> 7		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Limones',
			'category_id'=> 7		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Maracuya',
			'category_id'=> 7		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Bananos',
			'category_id'=> 7		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Kiwi',
			'category_id'=> 7		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Naranjas',
			'category_id'=> 7		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Mandarinas',
			'category_id'=> 7		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Limas',
			'category_id'=> 7		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Melones',
			'category_id'=> 7		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Melocotones',
			'category_id'=> 7		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Piñas',
			'category_id'=> 7		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Pitallas',
			'category_id'=> 7		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Torombolo',
			'category_id'=> 7		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Cocos',
			'category_id'=> 7		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Calabazas',
			'category_id'=> 7		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Higos',
			'category_id'=> 7		
			)
		);

		//8 verduras
		\DB::table('clu_category')->insert(array(
			'name'=>'Papas',
			'category_id'=> 8		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Lechugas',
			'category_id'=> 8		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Zanahorias',
			'category_id'=> 8		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Coliflor',
			'category_id'=> 8		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Brocolis',
			'category_id'=> 8		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Repollos',
			'category_id'=> 8		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Pimentones',
			'category_id'=> 8		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Pimientos',
			'category_id'=> 8		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Remolacha',
			'category_id'=> 8		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Cebolla Larga',
			'category_id'=> 8		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Cebolla de Huevo',
			'category_id'=> 8		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Peregil',
			'category_id'=> 8		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Pepino',
			'category_id'=> 8		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Apio',
			'category_id'=> 8		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Champiñones',
			'category_id'=> 8		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Tomate',
			'category_id'=> 8		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Yuca',
			'category_id'=> 8		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Platano',
			'category_id'=> 8		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Arracacha',
			'category_id'=> 8		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Jengibre',
			'category_id'=> 8		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Cilantro',
			'category_id'=> 8		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Coles',
			'category_id'=> 8		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Albaca',
			'category_id'=> 8		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Espinaca',
			'category_id'=> 8		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Arvejas',
			'category_id'=> 8		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Frijoles',
			'category_id'=> 8		
			)
		);

		//9 Cereales

		\DB::table('clu_category')->insert(array(
			'name'=>'Avena',
			'category_id'=> 9		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Arroz',
			'category_id'=> 9		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Cebada',
			'category_id'=> 9		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Centeno',
			'category_id'=> 9		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Maiz',
			'category_id'=> 9		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Mijo',
			'category_id'=> 9		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Sorgo',
			'category_id'=> 9		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Trigo',
			'category_id'=> 9		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Kamut',
			'category_id'=> 9		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Teff',
			'category_id'=> 9		
			)
		);


		//10 Enlatados
		\DB::table('clu_category')->insert(array(
			'name'=>'Carnes',
			'category_id'=> 10		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Pescados',
			'category_id'=> 10		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Cereales',
			'category_id'=> 10		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Frutas',
			'category_id'=> 10		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Verduras',
			'category_id'=> 10		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Sopas',
			'category_id'=> 10		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Almibar',
			'category_id'=> 10		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Granos',
			'category_id'=> 10		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Postres',
			'category_id'=> 10		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Lacteos',
			'category_id'=> 10		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Bebidas',
			'category_id'=> 10		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Condimentos',
			'category_id'=> 10		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Salsas',
			'category_id'=> 10		
			)
		);

		//11 Condimentos
		\DB::table('clu_category')->insert(array(
			'name'=>'Cubitos Maggi',
			'category_id'=> 11		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Cubitos Knorr',
			'category_id'=> 11		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Ajonjoli',
			'category_id'=> 11		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Albaca',
			'category_id'=> 11		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Anis',
			'category_id'=> 11		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Apio',
			'category_id'=> 11		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Azafran',
			'category_id'=> 11		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Cardamomo',
			'category_id'=> 11		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Cocoa',
			'category_id'=> 11		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Cacao',
			'category_id'=> 11		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Curcuma',
			'category_id'=> 11		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Jengibre',
			'category_id'=> 11		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Oregano',
			'category_id'=> 11		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Pimienta',
			'category_id'=> 11		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Romero',
			'category_id'=> 11		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Tomillo',
			'category_id'=> 11		
			)
		);

		//12 Salsas
		\DB::table('clu_category')->insert(array(
			'name'=>'Salsa de Tomate',
			'category_id'=> 12		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Salsa Vinagrega',
			'category_id'=> 12		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Salsa Mayonesa',
			'category_id'=> 12		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Salsa Casera',
			'category_id'=> 12		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Salsa BBQ',
			'category_id'=> 12		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Salsa Bechamel',
			'category_id'=> 12		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Salsa Frutas',
			'category_id'=> 12		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Salsa Holandesa',
			'category_id'=> 12		
			)
		);

		//13 Golosinas
		\DB::table('clu_category')->insert(array(
			'name'=>'Chocolate',
			'category_id'=> 13		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Gomitas',
			'category_id'=> 13		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Caramelo',
			'category_id'=> 13		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Pasabocas',
			'category_id'=> 13		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Frutas',
			'category_id'=> 13		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Arequipes',
			'category_id'=> 13		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Turrones',
			'category_id'=> 13		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Galletas',
			'category_id'=> 13		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Cafe',
			'category_id'=> 13		
			)
		);

		//14 Postres
		\DB::table('clu_category')->insert(array(
			'name'=>'Cafe',
			'category_id'=> 14		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Leche',
			'category_id'=> 14		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Frutas',
			'category_id'=> 14		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Cafe',
			'category_id'=> 14		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Masapan',
			'category_id'=> 14		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Arroz',
			'category_id'=> 14		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Queso',
			'category_id'=> 14		
			)
		);

		//15 Deportes
		\DB::table('clu_category')->insert(array(
			'name'=>'Accesorios',
			'category_id'=> 15		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Balones',
			'category_id'=> 15
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Uniformes',
			'category_id'=> 15
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'seguridad',
			'category_id'=> 15
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Indumentaria',
			'category_id'=> 15
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Entrenamiento',
			'category_id'=> 15
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Maquinas',
			'category_id'=> 15
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Armas',
			'category_id'=> 15
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Municiones',
			'category_id'=> 15
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Coleccionables',
			'category_id'=> 15
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Entrenimiento',
			'category_id'=> 15
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Juegos',
			'category_id'=> 15
			)
		);


		//16 Salud
		\DB::table('clu_category')->insert(array(
			'name'=>'Cremas',
			'category_id'=> 16
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Jarabes',
			'category_id'=> 16
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Pastillas',
			'category_id'=> 16
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Aceites',
			'category_id'=> 16
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Unguentos',
			'category_id'=> 16
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Higiene',
			'category_id'=> 16
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Cuidado',
			'category_id'=> 16
			)
		);
		
		//17 Aseo
		\DB::table('clu_category')->insert(array(
			'name'=>'Baldes',
			'category_id'=> 17
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Mangueras',
			'category_id'=> 17
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Maquinas',
			'category_id'=> 17
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Quimicos',
			'category_id'=> 17
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Atibacterial',
			'category_id'=> 17
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Desinfectantes',
			'category_id'=> 17
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Desengrasantes',
			'category_id'=> 17
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Cremas',
			'category_id'=> 17
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Polvos',
			'category_id'=> 17
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Liquidos',
			'category_id'=> 17
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Accesorios',
			'category_id'=> 17
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Esponjas',
			'category_id'=> 17
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Escobas',
			'category_id'=> 17
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Traperos',
			'category_id'=> 17
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Cepillos',
			'category_id'=> 17
			)
		);

		//18 Belleza
		\DB::table('clu_category')->insert(array(
			'name'=>'Cremas',
			'category_id'=> 18
			)
		);				
		\DB::table('clu_category')->insert(array(
			'name'=>'Aceites',
			'category_id'=> 18
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Perfumes',
			'category_id'=> 18
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Jabones',
			'category_id'=> 18
			)
		);			
		\DB::table('clu_category')->insert(array(
			'name'=>'Maquillaje',
			'category_id'=> 18
			)
		);		
		\DB::table('clu_category')->insert(array(
			'name'=>'Capilares',
			'category_id'=> 18
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Faciales',
			'category_id'=> 18
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Corporales',
			'category_id'=> 18
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Maquinas',
			'category_id'=> 18
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Accesorios',
			'category_id'=> 18
			)
		);

		//19 Electrodomesticos
		\DB::table('clu_category')->insert(array(
			'name'=>'Lavadoras',
			'category_id'=> 19		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Neveras',
			'category_id'=> 19		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Secadoras',
			'category_id'=> 19		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Hornos',
			'category_id'=> 19		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Cuidado Personal',
			'category_id'=> 19		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Cafeteras',
			'category_id'=> 19		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Licuadoras',
			'category_id'=> 19		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Aspiradoras',
			'category_id'=> 19		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Planchas',
			'category_id'=> 19		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Ollas',
			'category_id'=> 19		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Batidoras',
			'category_id'=> 19		
			)
		);

		//20 Electronica
		\DB::table('clu_category')->insert(array(
			'name'=>'Televisores',
			'category_id'=> 20		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Computadoras',
			'category_id'=> 20		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Camaras Fotograficas',
			'category_id'=> 20		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Camaras de Video',
			'category_id'=> 20		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Tabletas',
			'category_id'=> 20		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Celulares',
			'category_id'=> 20		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Telefonos',
			'category_id'=> 20		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Accesorios',
			'category_id'=> 20		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Consolas de Videojuegos',
			'category_id'=> 20		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Reproductores de Musica',
			'category_id'=> 20		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Relojes',
			'category_id'=> 20		
			)
		);

		//21 Libros
		\DB::table('clu_category')->insert(array(
			'name'=>'Ciencia Ficción',
			'category_id'=> 21		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Fantasia',
			'category_id'=> 21		
			)
		);

		\DB::table('clu_category')->insert(array(
			'name'=>'Novelas',
			'category_id'=> 21		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Obras',
			'category_id'=> 21		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Clasicos Literatura',
			'category_id'=> 21		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Educaciòn',
			'category_id'=> 21		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Infantiles',
			'category_id'=> 21		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Historia',
			'category_id'=> 21		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Politica',
			'category_id'=> 21		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Ensayos',
			'category_id'=> 21		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Poesia',
			'category_id'=> 21		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Manuales',
			'category_id'=> 21		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Revistas',
			'category_id'=> 21		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Biografias',
			'category_id'=> 21		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Comedia',
			'category_id'=> 21		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Suspenso',
			'category_id'=> 21		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Tragedia',
			'category_id'=> 21		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Drama',
			'category_id'=> 21		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Teatro',
			'category_id'=> 21		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Oda',
			'category_id'=> 21		
			)
		);

		//22Muebles
		\DB::table('clu_category')->insert(array(
			'name'=>'Comedores',
			'category_id'=> 22		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Escaparates',
			'category_id'=> 22		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Cajones',
			'category_id'=> 22		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Cajoneros',
			'category_id'=> 22		
			)
		);

		\DB::table('clu_category')->insert(array(
			'name'=>'Tocadores',
			'category_id'=> 22		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Mesas',
			'category_id'=> 22		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Sillas',
			'category_id'=> 22		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Salas',
			'category_id'=> 22		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Poltronas',
			'category_id'=> 22		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Camas',
			'category_id'=> 22		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Camarotes',
			'category_id'=> 22		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Bases Cama',
			'category_id'=> 22		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Escaparates',
			'category_id'=> 22		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Puertas',
			'category_id'=> 22		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Cuadros',
			'category_id'=> 22		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Anaqueles',
			'category_id'=> 22		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Accesorios',
			'category_id'=> 22		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Cocinas',
			'category_id'=> 22		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Centros',
			'category_id'=> 22		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Estanterias',
			'category_id'=> 22		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Bibliotecas',
			'category_id'=> 22		
			)
		);

		//23Herramienta
		\DB::table('clu_category')->insert(array(
			'name'=>'Montaje',
			'category_id'=> 23		
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Sujeción',
			'category_id'=> 23
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Percusión',
			'category_id'=> 23
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Corte',
			'category_id'=> 23
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Union',
			'category_id'=> 23
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Medición',
			'category_id'=> 23
			)
		);

		//24 Juguetes
		\DB::table('clu_category')->insert(array(
			'name'=>'Ejercicio',
			'category_id'=> 24
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Construcción',
			'category_id'=> 24
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Didacticos',
			'category_id'=> 24
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Educación',
			'category_id'=> 24
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Simbolicos',
			'category_id'=> 24
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Videojuegos',
			'category_id'=> 24
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Cooperativos',
			'category_id'=> 24
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Juego de Mesa',
			'category_id'=> 24
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Adultos',
			'category_id'=> 24
			)
		);

		//25Bebes
		\DB::table('clu_category')->insert(array(
			'name'=>'Comida',
			'category_id'=> 25
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Ropa',
			'category_id'=> 25
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Calzado',
			'category_id'=> 25
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Cunas',
			'category_id'=> 25
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Coches',
			'category_id'=> 25
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Bañeras',
			'category_id'=> 25
			)		);

		\DB::table('clu_category')->insert(array(
			'name'=>'Cremas',
			'category_id'=> 25
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Aceites',
			'category_id'=> 25
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Lociones',
			'category_id'=> 25
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Jabones',
			'category_id'=> 25
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Disfraces',
			'category_id'=> 25
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Juguetes',
			'category_id'=> 25
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Accesorios',
			'category_id'=> 25
			)
		);

		//26 Regalos
		\DB::table('clu_category')->insert(array(
			'name'=>'Juguetes',
			'category_id'=> 26
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Peluches',
			'category_id'=> 26
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Cumpleaños',
			'category_id'=> 26
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Niños',
			'category_id'=> 26
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Amor y Amistad',
			'category_id'=> 26
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Cortesia',
			'category_id'=> 26
			)
		);		
		\DB::table('clu_category')->insert(array(
			'name'=>'Desayunos',
			'category_id'=> 26
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Nacimientos',
			'category_id'=> 26
			)
		);
		

		//27 Mascotas
		\DB::table('clu_category')->insert(array(
			'name'=>'Comida',
			'category_id'=> 27
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Ropa',
			'category_id'=> 27
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Camas',
			'category_id'=> 27
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Bañeras',
			'category_id'=> 27
			)		);

		\DB::table('clu_category')->insert(array(
			'name'=>'Cremas',
			'category_id'=> 27
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Aceites',
			'category_id'=> 27
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Lociones',
			'category_id'=> 27
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'jabones',
			'category_id'=> 27
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Disfraces',
			'category_id'=> 27
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Juguetes',
			'category_id'=> 27
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Accesorios',
			'category_id'=> 27
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Medicinas',
			'category_id'=> 27
			)
		);

		//28 Bodas
		\DB::table('clu_category')->insert(array(
			'name'=>'Vestuario',
			'category_id'=> 28
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Joyeria',
			'category_id'=> 28
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Bisuteria',
			'category_id'=> 28
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Arreglos Florales',
			'category_id'=> 28
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Targetas de Invitación',
			'category_id'=> 28
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Comida',
			'category_id'=> 28
			)
		);

		//29 Ropa
		\DB::table('clu_category')->insert(array(
			'name'=>'Formal',
			'category_id'=> 29
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Casual',
			'category_id'=> 29
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Deportiva',
			'category_id'=> 29
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Etiqueta',
			'category_id'=> 29
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Escolar',
			'category_id'=> 29
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Empresarial',
			'category_id'=> 29
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Busos',
			'category_id'=> 29
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Chaquetas',
			'category_id'=> 29
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Zapatos',
			'category_id'=> 29
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Zapatillas',
			'category_id'=> 29
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Tenis',
			'category_id'=> 29
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Cinturones',
			'category_id'=> 29
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Sandalias',
			'category_id'=> 29
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Botas',
			'category_id'=> 29
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Tacones',
			'category_id'=> 29
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Ropa Interior',
			'category_id'=> 29
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Accesorios',
			'category_id'=> 29
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Ropa de Picina',
			'category_id'=> 29
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Ropa de Embarazo',
			'category_id'=> 29
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Pijamas',
			'category_id'=> 29
			)
		);

		//30 Vehiculos
		\DB::table('clu_category')->insert(array(
			'name'=>'Automoviles',
			'category_id'=> 30
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Motocicletas',
			'category_id'=> 30
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Bicicletas',
			'category_id'=> 30
			)
		);

		\DB::table('clu_category')->insert(array(
			'name'=>'Camionetas',
			'category_id'=> 30
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Tricimotos',
			'category_id'=> 30
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Cuadrimotos',
			'category_id'=> 30
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Camiones',
			'category_id'=> 30
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Repuestos',
			'category_id'=> 30
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Buses',
			'category_id'=> 30
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Lubricantes',
			'category_id'=> 30
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Accesorios',
			'category_id'=> 30
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Servicio de Reparacion',
			'category_id'=> 30
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Servicio de Limpieza',
			'category_id'=> 30
			)
		);

		//31 Plantas
		\DB::table('clu_category')->insert(array(
			'name'=>'Pantas Artificiales',
			'category_id'=> 31
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Plantas Vivas',
			'category_id'=> 31
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Tierra',
			'category_id'=> 31
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Compostadoras',
			'category_id'=> 31
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'herramienta',
			'category_id'=> 31
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Semillas',
			'category_id'=> 31
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Pesticidas',
			'category_id'=> 31
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Riego',
			'category_id'=> 31
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Fertilizantes',
			'category_id'=> 31
			)
		);

		//32 papeleria
		\DB::table('clu_category')->insert(array(
			'name'=>'Escolares',
			'category_id'=> 32
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Oficina',
			'category_id'=> 32
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Diseñador',
			'category_id'=> 32
			)
		);		
		\DB::table('clu_category')->insert(array(
			'name'=>'Didacticos',
			'category_id'=> 32
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Juguetes',
			'category_id'=> 32
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Arquitectura',
			'category_id'=> 32
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Construcción',
			'category_id'=> 32
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Regalos',
			'category_id'=> 32
			)
		);

		//33 Yoyeria		
		\DB::table('clu_category')->insert(array(
			'name'=>'Collares',
			'category_id'=> 33
			)
		);

		\DB::table('clu_category')->insert(array(
			'name'=>'Collares',
			'category_id'=> 33
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Anillos',
			'category_id'=> 33
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Aretes',
			'category_id'=> 33
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Pulseras',
			'category_id'=> 33
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Accesorios',
			'category_id'=> 33
			)
		);

		//34 Bisuteria
		\DB::table('clu_category')->insert(array(
			'name'=>'Collares',
			'category_id'=> 34
			)
		);

		\DB::table('clu_category')->insert(array(
			'name'=>'Collares',
			'category_id'=> 34
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Anillos',
			'category_id'=> 34
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Aretes',
			'category_id'=> 34
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Pulseras',
			'category_id'=> 34
			)
		);
		\DB::table('clu_category')->insert(array(
			'name'=>'Accesorios',
			'category_id'=> 34
			)
		);


	}
}
