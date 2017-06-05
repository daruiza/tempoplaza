<?php namespace App\Http\Controllers;

use Mail;
use DateTime;
use Auth;
use App\Core\ComprarJuntos\Tienda;
use App\Core\ComprarJuntos\Producto;
use App\Core\ComprarJuntos\Orden;
use App\Core\ComprarJuntos\Anotacion;
use App\Core\ComprarJuntos\Detalle;
use App\Core\ComprarJuntos\Mensaje;
use App\Core\Security\Conector;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index(Request $request){
		
		if(!empty($request->input())){
			//si es el finder es el buscador inicial			
			if(array_key_exists('finder',$request->input())){
				return redirect('/'.$request->input('finder'));
			}
		}

		Session::put('app', env('APP_NAME','Macalù'));
		Session::put('copy', env('APP_RIGTH','Temposolutions'));
		Session::put('mail', env('MAIL_USERNAME','soportemacalu@gmail.com'));
		Session::put('support', env('APP_SUPPORT','daruiza@gmail.com'));
		//Session::put('style', env('APP_STYLE','default'));		
		/**
		 * REALIZAMOS CONSULTAS PARA INDEX
		 * 
		 */
		
		Session::flash('controlador', '/inicio/');

		//departamentos
		$departments = \DB::table('seg_department')->orderBy('department','asc')->get();		
		foreach ($departments as $department){
			$departamentos[$department->department] = $department->department;
		}
		$moduledata['departamentos']=$departamentos;

		//consultamos las ciudades del departamento		
		$moduledata['ciudades']= array();
		if(!empty(Session::get('comjunplus.usuario.state'))){
			//hay un departamento asignado
			$department_id = \DB::table('seg_department')
				->where('department',Session::get('comjunplus.usuario.state'))
				->get()[0]->id;

			$citys = \DB::table('seg_city')->orderBy('city','asc')
				->where('department_id',$department_id)
				->get();

			foreach ($citys as $city){
				$ciudades[$city->city] = $city->city;
			}
			$moduledata['ciudades']=$ciudades;
		}		

		$moduledata['category'] = \DB::table('clu_category')
		->select('clu_category.name','fc.name as fname')
		->leftjoin('clu_category as fc', 'clu_category.category_id', '=', 'fc.id')
		->orderByRaw("RAND()")
		->get();
		//construimos el array
		$cat =  array();
		foreach ($moduledata['category'] as $key => $value) {
			if(!$value->fname){
				if(!array_key_exists($value->name,$cat))$cat[$value->name] = array(); 
			}else{
				$cat[$value->fname][] = $value->name;
			}
		}

		$moduledata['categorias'] = $cat;

		//un tendero
		$moduledata['tendero'] = \DB::table('seg_user_profile')
		->select('seg_user_profile.*','seg_user.name as user_name')
		->leftjoin('seg_user', 'seg_user_profile.user_id', '=', 'seg_user.id')			
		->where('seg_user_profile.avatar','!=','default.png')
		->orderByRaw("RAND()")
		->skip(0)->take(1)
		->get();

		//ultima_tienda		
		$moduledata['ultima_tienda'] = \DB::table('clu_store')
		->select('clu_store.*','seg_user.name as user_name','seg_user_profile.avatar as avatar','seg_user_profile.names as tnames','seg_user_profile.surnames as tsurnames')
		->leftjoin('seg_user', 'clu_store.user_id', '=', 'seg_user.id')
		->leftjoin('seg_user_profile', 'clu_store.user_id', '=', 'seg_user_profile.user_id')
		->where('clu_store.status','Activa')
		->where('clu_store.id',\DB::table('clu_store')->max('clu_store.id'))		
		->get();		

		//HAY REQUEST
		if(!empty($request->input())){
			//si es el finder es el buscador inicial			
			if(array_key_exists('categoria',$request->input())){
				//hay filtro de categoria
				//consultamos id de categoria
				$categoria = \DB::table('clu_category')
				->select('clu_category.*')
				->where('clu_category.name',$request->input('categoria'))							
				->get();

				if($categoria[0]->category_id){
					//es subcategoria, consultamos con su padre				

					$moduledata['tiendas'] = \DB::table('clu_store')
					->select('clu_store.*','seg_user.name as user_name','seg_user_profile.avatar as avatar','seg_user_profile.names as tnames','seg_user_profile.surnames as tsurnames')
					->leftjoin('seg_user', 'clu_store.user_id', '=', 'seg_user.id')
					->leftjoin('seg_user_profile', 'clu_store.user_id', '=', 'seg_user_profile.user_id')
					->where('clu_store.metadata','like','%'.$categoria[0]->category_id.'%')
					->where('clu_store.status','Activa')
					->orderByRaw("RAND()")
					->skip(0)->take(6)
					->get();		

					//productos		
					$moduledata['productos'] = \DB::table('clu_products')
					->select('clu_products.*','clu_store.id as store_id','clu_store.name as store_name','clu_store.city as store_city','clu_store.adress as store_adress','clu_store.image as store_image','clu_store.color_one as color_one','clu_store.color_two as color_two','seg_user.name as user_name')
					->leftjoin('clu_store', 'clu_products.store_id', '=', 'clu_store.id')
					->leftjoin('seg_user', 'clu_store.user_id', '=', 'seg_user.id')
					->where('clu_products.active',1)
					->where('clu_products.category','like','%'.$categoria[0]->id.'%')
					->where('clu_store.status','Activa')
					->orderByRaw("RAND()")
					->skip(0)->take(18)
					->get();

				}else{
					//es categoria, consultamos con su id
					$moduledata['tiendas'] = \DB::table('clu_store')
					->select('clu_store.*','seg_user.name as user_name','seg_user_profile.avatar as avatar','seg_user_profile.names as tnames','seg_user_profile.surnames as tsurnames')
					->leftjoin('seg_user', 'clu_store.user_id', '=', 'seg_user.id')
					->leftjoin('seg_user_profile', 'clu_store.user_id', '=', 'seg_user_profile.user_id')
					->where('clu_store.metadata','like','%'.$categoria[0]->id.'%')
					->where('clu_store.status','Activa')
					->orderByRaw("RAND()")
					->skip(0)->take(6)
					->get();
					
					//necesitamos las subcategorias
					$subcategorias = \DB::table('clu_category')
					->select('clu_category.*')
					->where('clu_category.category_id',$categoria[0]->id)							
					->get();
					$subcat=array();
					foreach ($subcategorias as $key => $value) {
						$subcat[] = $value->id;	
					}

					if(count($subcat)){						
						//productos		
						$moduledata['productos'] = \DB::table('clu_products')
						->select('clu_products.*','clu_store.id as store_id','clu_store.name as store_name','clu_store.city as store_city','clu_store.adress as store_adress','clu_store.image as store_image','clu_store.color_one as color_one','clu_store.color_two as color_two','seg_user.name as user_name')
						->leftjoin('clu_store', 'clu_products.store_id', '=', 'clu_store.id')
						->leftjoin('seg_user', 'clu_store.user_id', '=', 'seg_user.id')
						->where('clu_products.active',1)						
						->where('clu_store.status','Activa')
						->where(function($q) use ($subcat){
							foreach($subcat as $key => $value){
								$q->orwhere('clu_products.category', 'like', '%'.$value.'%');
							}
						})
						->orderByRaw("RAND()")
						->skip(0)->take(18)
						->get();
					}					
				}
			}

			if(array_key_exists('criterio',$request->input())){
				$criterio = explode(' ',strtolower($request->input('criterio')));
				$conectors = Conector::all()->toArray();			
				foreach ($conectors as $key => $value) {
					$conectores[] = $value['conector'];
				}
				foreach ($criterio as $key => $value) {			
					if(strlen($value) < 3 )unset($criterio[$key]);
					if(in_array($value, $conectores))unset($criterio[$key]);
				}
				$moduledata['tiendas'] = \DB::table('clu_store')
				->distinct()->select('clu_store.*','seg_user.name as user_name','seg_user_profile.avatar as avatar','seg_user_profile.names as tnames','seg_user_profile.surnames as tsurnames')
				->leftjoin('seg_user', 'clu_store.user_id', '=', 'seg_user.id')
				->leftjoin('seg_user_profile', 'clu_store.user_id', '=', 'seg_user_profile.user_id')
				->leftjoin('clu_products', 'clu_store.id', '=', 'clu_products.store_id')
				->where('clu_store.status','Activa')
				->where(function($q) use ($criterio){
					foreach($criterio as $key => $value){
						$q->orwhere('clu_products.name', 'like', '%'.$value.'%')
						->orwhere('clu_products.description', 'like', '%'.$value.'%')
						->orwhere('clu_store.name', 'like', '%'.$value.'%')
						->orwhere('clu_store.description', 'like', '%'.$value.'%');
					}
				})
				->orderByRaw("RAND()")
				->skip(0)->take(6)
				->get();

				$moduledata['productos'] = \DB::table('clu_products')
				->select('clu_products.*','clu_store.id as store_id','clu_store.name as store_name','clu_store.city as store_city','clu_store.adress as store_adress','clu_store.image as store_image','clu_store.color_one as color_one','clu_store.color_two as color_two','seg_user.name as user_name')
				->leftjoin('clu_store', 'clu_products.store_id', '=', 'clu_store.id')
				->leftjoin('seg_user', 'clu_store.user_id', '=', 'seg_user.id')			
				->where('clu_products.active',1)
				->where('clu_store.status','Activa')
				->where(function($q) use ($criterio){
					foreach($criterio as $key => $value){
						$q->orwhere('clu_products.name', 'like', '%'.$value.'%')
						->orwhere('clu_products.description', 'like', '%'.$value.'%')
						->orwhere('clu_store.name', 'like', '%'.$value.'%')
						->orwhere('clu_store.description', 'like', '%'.$value.'%');					
					}
				})
				->orderByRaw("RAND()")
				->skip(0)->take(18)
				->get();				
			}

			if(array_key_exists('finder_store',$request->input())){
				//buscador de la tienda, intentan buscar productos o categorias
				$criterio = explode(' ',strtolower($request->input('finder_store')));
				$conectors = Conector::all()->toArray();			
				foreach ($conectors as $key => $value) {
					$conectores[] = $value['conector'];
				}
				foreach ($criterio as $key => $value) {			
					if(strlen($value) < 3 )unset($criterio[$key]);
					if(in_array($value, $conectores))unset($criterio[$key]);
				}				

				$moduledata['tienda'] = \DB::table('clu_store')
				->select('clu_store.*','seg_user.name as user_name')
				->leftjoin('seg_user', 'clu_store.user_id', '=', 'seg_user.id')
				->where('clu_store.id',$request->input('store'))							
				->get();
				$moduledata['tendero'] = \DB::table('seg_user_profile')
				->select('seg_user_profile.*','seg_user.name as user_name')
				->leftjoin('seg_user', 'seg_user_profile.user_id', '=', 'seg_user.id')					
				->where('seg_user.id',$moduledata['tienda'][0]->user_id)		
				->get();			

				$moduledata['productos'] = \DB::table('clu_products')
				->select('clu_products.*',\DB::raw('SUM(clu_order_detail.volume) as ventas'))			
				->leftjoin('clu_order_detail', 'clu_products.id', '=', 'clu_order_detail.product_id')
				//->leftjoin('clu_order', 'clu_order_detail.order_id', '=', 'clu_order.id')			
				->where('clu_products.store_id',$moduledata['tienda'][0]->id)
				//->where('clu_order.stage_id',4)
				->where(function($q) use ($criterio){
					foreach($criterio as $key => $value){
						$q->orwhere('clu_products.name', 'like', '%'.$value.'%')
						->orwhere('clu_products.description', 'like', '%'.$value.'%');						
					}
				})
				->groupBy('clu_products.id')
				->skip(0)->take(16)		
				->get();

				$ventas = \DB::table('clu_products')
				->select('clu_products.*',\DB::raw('SUM(clu_order_detail.volume) as ventas'))			
				->leftjoin('clu_order_detail', 'clu_products.id', '=', 'clu_order_detail.product_id')
				->leftjoin('clu_order', 'clu_order_detail.order_id', '=', 'clu_order.id')			
				->where('clu_products.store_id',$moduledata['tienda'][0]->id)
				->where('clu_order.stage_id',4)
				->where(function($q) use ($criterio){
					foreach($criterio as $key => $value){
						$q->orwhere('clu_products.name', 'like', '%'.$value.'%')
						->orwhere('clu_products.description', 'like', '%'.$value.'%');						
					}
				})
				->groupBy('clu_products.id')
				->skip(0)->take(16)		
				->get();

				foreach ($moduledata['productos'] as $pkey => $producto) {
					$producto->ventas = 0;				
					foreach ($ventas as $vkey => $venta) {
						if($producto->id == $venta->id){
							//el producto tiene ventas reales
							$producto->ventas = $venta->ventas;
							 break; 
						}
					}				
				}

				//categorias para el boton del menu			
				$tienda_categorias = explode(',',$moduledata['tienda'][0]->metadata);			
				$categorias = \DB::table('clu_category')
				->select('clu_category.*')
				->where(function($q) use ($tienda_categorias){
					foreach($tienda_categorias as $key => $value){
						$q->orwhere('clu_category.category_id', '=', $value);
					}
				})		
				->get();
				$moduledata['categorias'] = array();
				foreach ($categorias as $key => $value) {
					$moduledata['categorias'][] = $value->name;
				}

				//autocomplete para el buscador
				$products = \DB::table('clu_products')
				->select('clu_products.name as pname','clu_category.name as cname')
				->leftjoin('clu_category', 'clu_products.category', '=', 'clu_category.id')	
				->where('clu_products.store_id',$moduledata['tienda'][0]->id)
				->orderByRaw("RAND()")
				->skip(0)->take(128)					
				->get();
				$moduledata['products_name'] = array();
				foreach ($products as $key => $value) {
					$moduledata['products_name'][] = $value->pname.' '.$value->cname;
				}

				//resumen estadistico
				$moduledata['orders'] = \DB::table('clu_order')
				->select('clu_stage.stage', \DB::raw('count(*) as total'))
				->join('clu_stage', 'clu_order.stage_id', '=', 'clu_stage.id')
				->where('clu_order.store_id',$moduledata['tienda'][0]->id)
				->groupBy('clu_order.stage_id')	
				->get();
				foreach ($moduledata['orders'] as $key => $value) {
					if($value->stage == "PENDIENTE") $value->color = "#e6e600";
					if($value->stage == "ACEPTADO") $value->color = "#0099cc";
					if($value->stage == "RECHAZADO") $value->color = "#ff5c33";
					if($value->stage == "FINALIZADO") $value->color = "#33cc33";
				}
				$moduledata['calificaciones'] = \DB::table('clu_order')
				->select('clu_order.resenia', \DB::raw('count(*) as total'))			
				->where('clu_order.store_id',$moduledata['tienda'][0]->id)
				->groupBy('clu_order.resenia')	
				->get();			
				foreach ($moduledata['calificaciones'] as $key => $value) {
					if($value->resenia == 1){$value->resenia_text = "Muy Malo";$value->color = "red";}
					if($value->resenia == 2){$value->resenia_text = "Malo";$value->color = "#ff9900";}
					if($value->resenia == 3){$value->resenia_text = "Regular";$value->color = "#ffcc00";}
					if($value->resenia == 4){$value->resenia_text = "Bueno";$value->color = "#66ccff";}
					if($value->resenia == 5){$value->resenia_text = "Muy Bueno";$value->color = "#00cc66";}
				}	

				//paginador
				$moduledata['paginador']['total'] =Producto::where('clu_order.store_id',$moduledata['tienda'][0]->id)->count();
				$moduledata['paginador']['ppp'] =16;//productospor pagina
				$moduledata['paginador']['pagina'] =1;
				$moduledata['paginador']['paginas'] = ceil($moduledata['paginador']['total'] / $moduledata['paginador']['ppp']);
				
				$ordenes = array();
				$ordenes = \DB::table('clu_order')							
				->where('clu_order.store_id',$moduledata['tienda'][0]->id)		
				->where('clu_order.stage_id',4)		
				->get();	

				//calculo de reputaciòn 
				$reputacion_score = 0;
				foreach ($ordenes as $key => $value) {
					$reputacion_score = $reputacion_score+$value->resenia;
				}

				//$moduledata['ordenes'] = $ordenes;

				$moduledata['tienda'][0]->reputacion = 0;
				$moduledata['tienda'][0]->reputacionpercent = 0;
				$moduledata['tienda'][0]->ordenes = 0;	
				if($reputacion_score){
					$moduledata['tienda'][0]->reputacion = ($reputacion_score / (count($ordenes)*5))*5;
					$moduledata['tienda'][0]->reputacionpercent = ($reputacion_score / (count($ordenes)*5));	
					$moduledata['tienda'][0]->ordenes = count($ordenes);	
				}		
				//asignamos el id para listar las ordenes, en listarajaxorders
				Session::put('store.id', $moduledata['tienda'][0]->id);			
				return view('comprarjuntos/vertienda')->with($moduledata);

			}

		}else{
			//no hay filtro
			//algunas tiendas
			$moduledata['tiendas'] = \DB::table('clu_store')
			->select('clu_store.*','seg_user.name as user_name','seg_user_profile.avatar as avatar','seg_user_profile.names as tnames','seg_user_profile.surnames as tsurnames')
			->leftjoin('seg_user', 'clu_store.user_id', '=', 'seg_user.id')
			->leftjoin('seg_user_profile', 'clu_store.user_id', '=', 'seg_user_profile.user_id')
			->where('clu_store.status','Activa')
			->orderByRaw("RAND()")
			->skip(0)->take(6)
			->get();		

			// algunos productos		
			$moduledata['productos'] = \DB::table('clu_products')
			->select('clu_products.*','clu_store.id as store_id','clu_store.name as store_name','clu_store.city as store_city','clu_store.adress as store_adress','clu_store.image as store_image','clu_store.color_one as color_one','clu_store.color_two as color_two','seg_user.name as user_name')
			->leftjoin('clu_store', 'clu_products.store_id', '=', 'clu_store.id')
			->leftjoin('seg_user', 'clu_store.user_id', '=', 'seg_user.id')
			->where('clu_products.active',1)
			->where('clu_store.status','Activa')
			->orderByRaw("RAND()")
			->skip(0)->take(18)
			->get();

		}
		
		//return view('welcome',['modulo'=>$moduledata]);
		return view('welcome')->with($moduledata);		
	}

	//Este es el metodo que controla el buscador principal
	public function getFind($data = null){
		//BUSQUEDA DE TIENDA PRODUCTO O CATEGORIA
		
		//PRIMERO miramos si coincide con el nombre de una tienda
		$moduledata['tienda'] = \DB::table('clu_store')
		->select('clu_store.*','seg_user.name as user_name')
		->leftjoin('seg_user', 'clu_store.user_id', '=', 'seg_user.id')
		->where('clu_store.name',strtolower($data))							
		->get();

		//al momento de hallar una tienda
		if(count($moduledata['tienda'])){
			
			$moduledata['tendero'] = \DB::table('seg_user_profile')
			->select('seg_user_profile.*','seg_user.name as user_name')
			->leftjoin('seg_user', 'seg_user_profile.user_id', '=', 'seg_user.id')					
			->where('seg_user.id',$moduledata['tienda'][0]->user_id)		
			->get();

			$moduledata['productos'] = \DB::table('clu_products')
			->select('clu_products.*',\DB::raw('SUM(clu_order_detail.volume) as ventas'))			
			->leftjoin('clu_order_detail', 'clu_products.id', '=', 'clu_order_detail.product_id')
			//->leftjoin('clu_order', 'clu_order_detail.order_id', '=', 'clu_order.id')			
			->where('clu_products.store_id',$moduledata['tienda'][0]->id)
			//->where('clu_order.stage_id',4)
			->groupBy('clu_products.id')
			->skip(0)->take(16)		
			->get();
			$ventas = \DB::table('clu_products')
			->select('clu_products.*',\DB::raw('SUM(clu_order_detail.volume) as ventas'))			
			->leftjoin('clu_order_detail', 'clu_products.id', '=', 'clu_order_detail.product_id')
			->leftjoin('clu_order', 'clu_order_detail.order_id', '=', 'clu_order.id')			
			->where('clu_products.store_id',$moduledata['tienda'][0]->id)
			->where('clu_order.stage_id',4)
			->groupBy('clu_products.id')
			->skip(0)->take(16)		
			->get();
			foreach ($moduledata['productos'] as $pkey => $producto) {
				$producto->ventas = 0;				
				foreach ($ventas as $vkey => $venta) {
					if($producto->id == $venta->id){
						//el producto tiene ventas reales
						$producto->ventas = $venta->ventas;
						 break; 
					}
				}				
			}

			//categorias para el boton del menu			
			$tienda_categorias = explode(',',$moduledata['tienda'][0]->metadata);			
			$categorias = \DB::table('clu_category')
			->select('clu_category.*')
			->where(function($q) use ($tienda_categorias){
				foreach($tienda_categorias as $key => $value){
					$q->orwhere('clu_category.category_id', '=', $value);
				}
			})		
			->get();
			$moduledata['categorias'] = array();
			foreach ($categorias as $key => $value) {
				$moduledata['categorias'][] = $value->name;
			}

			//autocomplete para el buscador
			$products = \DB::table('clu_products')
			->select('clu_products.name as pname','clu_category.name as cname')
			->leftjoin('clu_category', 'clu_products.category', '=', 'clu_category.id')	
			->where('clu_products.store_id',$moduledata['tienda'][0]->id)
			->orderByRaw("RAND()")
			->skip(0)->take(128)					
			->get();
			$moduledata['products_name'] = array();
			foreach ($products as $key => $value) {
				$moduledata['products_name'][] = $value->pname.' '.$value->cname;
			}

			//resumen estadistico		
			$moduledata['orders'] = \DB::table('clu_order')
			->select('clu_stage.stage', \DB::raw('count(*) as total'))
			->join('clu_stage', 'clu_order.stage_id', '=', 'clu_stage.id')
			->where('clu_order.store_id',$moduledata['tienda'][0]->id)
			->groupBy('clu_order.stage_id')	
			->get();
			foreach ($moduledata['orders'] as $key => $value) {
				if($value->stage == "PENDIENTE") $value->color = "#e6e600";
				if($value->stage == "ACEPTADO") $value->color = "#0099cc";
				if($value->stage == "RECHAZADO") $value->color = "#ff5c33";
				if($value->stage == "FINALIZADO") $value->color = "#33cc33";
			}
			$moduledata['calificaciones'] = \DB::table('clu_order')
			->select('clu_order.resenia', \DB::raw('count(*) as total'))			
			->where('clu_order.store_id',$moduledata['tienda'][0]->id)
			->groupBy('clu_order.resenia')	
			->get();			
			foreach ($moduledata['calificaciones'] as $key => $value) {
				if($value->resenia == 1){$value->resenia_text = "Muy Malo";$value->color = "red";}
				if($value->resenia == 2){$value->resenia_text = "Malo";$value->color = "#ff9900";}
				if($value->resenia == 3){$value->resenia_text = "Regular";$value->color = "#ffcc00";}
				if($value->resenia == 4){$value->resenia_text = "Bueno";$value->color = "#66ccff";}
				if($value->resenia == 5){$value->resenia_text = "Muy Bueno";$value->color = "#00cc66";}
			}
												
			//paginador
			$moduledata['paginador']['total'] =Producto::where('clu_products.store_id',$moduledata['tienda'][0]->id)->count();
			$moduledata['paginador']['ppp'] =16;//productospor pagina
			$moduledata['paginador']['pagina'] =1;
			$moduledata['paginador']['paginas'] = ceil($moduledata['paginador']['total'] / $moduledata['paginador']['ppp']);
			
			$ordenes = array();
			$ordenes = \DB::table('clu_order')							
			->where('clu_order.store_id',$moduledata['tienda'][0]->id)		
			->where('clu_order.stage_id',4)		
			->get();	

			//calculo de reputaciòn 
			$reputacion_score = 0;
			foreach ($ordenes as $key => $value) {
				$reputacion_score = $reputacion_score+$value->resenia;
			}

			//$moduledata['ordenes'] = $ordenes;

			$moduledata['tienda'][0]->reputacion = 0;
			$moduledata['tienda'][0]->reputacionpercent = 0;
			$moduledata['tienda'][0]->ordenes = 0;	
			if($reputacion_score){
				$moduledata['tienda'][0]->reputacion = ($reputacion_score / (count($ordenes)*5))*5;
				$moduledata['tienda'][0]->reputacionpercent = ($reputacion_score / (count($ordenes)*5));	
				$moduledata['tienda'][0]->ordenes = count($ordenes);	
			}		
			//asignamos el id para listar las ordenes, en listarajaxorders
			Session::put('store.id', $moduledata['tienda'][0]->id);			
			return view('comprarjuntos/vertienda')->with($moduledata);
		}

		//SEGUNDO, miramos si coincide con el nombre de una categoria, y si alguna tienda la posee
		$categoria = \DB::table('clu_category')
		->select('clu_category.*')
		->where('clu_category.name',$data)							
		->get();
		$tiendas = array();
		if(count($categoria)){
			//hallamos la categoria padre
			if($categoria[0]->category_id){
				//es subcategoria
				$tiendas = \DB::table('clu_store')
				->select('clu_store.*')				
				->where('clu_store.metadata','like','%'.$categoria[0]->category_id.'%')							
				->skip(0)->take(1)
				->get();
			}else{
				//es categoria
				$tiendas = \DB::table('clu_store')
				->select('clu_store.*')				
				->where('clu_store.metadata','like','%'.$categoria[0]->id.'%')
				->skip(0)->take(1)						
				->get();
			}

			if(count($tiendas)){
				return redirect()->action('WelcomeController@index', ['categoria' => $data]);	
			}else{
				return Redirect::to('/')->with('message_ok', ['Actualmente no tenemos en ComprarJuntos alguna tienda que ofrezca '.$data.'.']);				
			}			
		}

		//TERCERO, buscamos por nombre de producto o buscamos alguna descripcion de productos, y tiendas.
		//dividimos el criterio de busqueda por espacios y eliminamos los conectores
		$criterio = explode(' ',strtolower($data));
		$conectors = Conector::all()->toArray();			
		foreach ($conectors as $key => $value) {
			$conectores[] = $value['conector'];
		}		
		foreach ($criterio as $key => $value) {			
			if(strlen($value) < 3 )unset($criterio[$key]);
			if(in_array($value, $conectores))unset($criterio[$key]);
		}		
		
		if(count($criterio)){
			//hay criterios de busqueda			

			$productos = \DB::table('clu_products')
			->select('clu_products.*','clu_store.id as store_id','clu_store.name as store_name','clu_store.city as store_city','clu_store.adress as store_adress','clu_store.image as store_image','clu_store.color_one as color_one','clu_store.color_two as color_two','seg_user.name as user_name')
			->leftjoin('clu_store', 'clu_products.store_id', '=', 'clu_store.id')
			->leftjoin('seg_user', 'clu_store.user_id', '=', 'seg_user.id')			
			->where('clu_products.active',1)
			->where('clu_store.status','Activa')
			->where(function($q) use ($criterio){
				foreach($criterio as $key => $value){
					$q->orwhere('clu_products.name', 'like', '%'.$value.'%')
					->orwhere('clu_products.description', 'like', '%'.$value.'%')
					->orwhere('clu_store.description', 'like', '%'.$value.'%')
					->orwhere('clu_products.description', 'like', $value.'%');
				}
			})
			->orderByRaw("RAND()")
			->skip(0)->take(1)
			->get();
			
			if(count($productos)){
				return redirect()->action('WelcomeController@index', ['criterio' => strtolower($data)]);	
			}
		}

		//POR ULTIMO
		return Redirect::to('/')->with('message_ok', ['Lo sentimos, no encontramos información para la consulta '.$data.'.']);				
	}

	//Funcion para desplegar un modal den el index
	public function getModal($data = null, $metadata = null){		
		if($data == 'modalregistro' ){
			Session::flash('modal', 'modalregistro');
		}
		if($data == 'modalorden' ){
			//el tendero esea ver el pedido desde el correo
			//aqui usamos los datos y los metadatos par desplegar la orden
			//preguntamos si se halla logueado el usuario
			if (Auth::guest()) {
			 	//es un invitado, primero debe loguearce
			 	Session::flash('modal', 'modallogin');
			 	Session::flash('orden_id', $metadata);			 				 	
			}else{
				//puede ir directamente hasta la orden de pedido
				Session::flash('orden_id', $metadata);			 	
				return Redirect::to('/mistiendas/listar');
				
			}			
		}

		if($data == 'modalmessagetotender' ){
			//el cliente desea dejar un mensaje para el tendero deacuerdo ala orden aceptada o rechazada.
			Session::flash('modal', 'modalmessagetotender');
			//calculamos la tienda y el tendero y
			$moduledata['orden'] = \DB::table('clu_order')
			->select('clu_order.*','clu_store.id as store_id','clu_store.name as store','clu_store.color_one','clu_store.color_two','seg_user_profile.names','seg_user_profile.surnames','seg_user_profile.user_id as user_id')
			->leftjoin('clu_store', 'clu_order.store_id', '=', 'clu_store.id')
			->leftjoin('seg_user_profile', 'clu_store.user_id', '=', 'seg_user_profile.user_id')
			->where('clu_order.id',$metadata)							
			->get();
			//consultaremos la ùltimas 3 annotaciones
			$moduledata['annotations'] = \DB::table('clu_order_annotation')
			->select('clu_order_annotation.*')	
			->leftjoin('clu_order', 'clu_order_annotation.order_id', '=', 'clu_order.id')			
			->where('clu_order.id',$metadata)							
			->orderBy('id','ascd')
			->take(3)	
			->get();			
			Session::flash('orden_data', $moduledata);	
		}

		if($data == 'modalresenatostore' ){			
			Session::flash('modal', 'modalresenatostore');
			$moduledata['orden'] = \DB::table('clu_order')
			->select('clu_order.*','clu_store.id as store_id','clu_store.name as store','clu_store.color_one','clu_store.color_two','seg_user_profile.names','seg_user_profile.surnames','seg_user_profile.user_id as user_id')
			->leftjoin('clu_store', 'clu_order.store_id', '=', 'clu_store.id')
			->leftjoin('seg_user_profile', 'clu_store.user_id', '=', 'seg_user_profile.user_id')
			->where('clu_order.id',$metadata)							
			->get();
			Session::flash('orden_data_resena', $moduledata);	
		}

		return redirect('/');
	}

	//para listar las ordenes para las reseñas
	public function getListarajaxorders(Request $request){
		//Tienda id
		if(empty(Session::get('store.id'))){
			//algo anda muy mal, no se udo asignar el id de tienda en la funcion Consultarproductos
			return response()->json(['draw'=>$request->input('draw')+1,'recordsTotal'=>0,'recordsFiltered'=>0,'data'=>[]]);
		}
		$moduledata['total']=Orden::where('clu_order.store_id',Session::get('store.id'))->count();
		if(!empty($request->input('search')['value'])){
			Session::flash('search', $request->input('search')['value']);			
			
			$moduledata['ordenes']=
			Orden::
			select('clu_order.*')			
			->where('clu_order.store_id',Session::get('store.id'))
			->where('clu_order.resenia_active',1)		
			->where(function ($query) {
				$query->where('clu_order.name_client', 'like', '%'.Session::get('search').'%')
				->orWhere('clu_order.resenia', 'like', '%'.Session::get('search').'%')	
				->orWhere('clu_order.resenia_test', 'like', '%'.Session::get('search').'%');				
			})
			->skip($request->input('start'))->take($request->input('length'))
			->orderBy('id', 'desc')
			->get();		
			$moduledata['filtro'] = count($moduledata['ordenes']);
		}else{			
			$moduledata['ordenes']=\DB::table('clu_order')
			->where('clu_order.store_id',Session::get('store.id'))
			->where('clu_order.resenia_active',1)
			->skip($request->input('start'))->take($request->input('length'))
			->orderBy('id', 'desc')
			->get();			
				
			$moduledata['filtro'] = $moduledata['total'];
		}

		return response()->json(['draw'=>$request->input('draw')+1,'recordsTotal'=>$moduledata['total'],'recordsFiltered'=>$moduledata['filtro'],'data'=>$moduledata['ordenes']]);

	}

	//para el paginador de productos
	public function postListarajaxproducts(Request $request){

		//Tienda id
		if(empty(Session::get('store.id'))){
			return response()->json(['respuesta'=>true,'request'=>$request->input(),'data'=>null]);	
		}

		//preguntamos por el buscador
		$criterio = array();
		if(array_key_exists('finder_store',$request->input())){
			$criterio = explode(' ',strtolower($request->input('finder_store')));
			$conectors = Conector::all()->toArray();			
			foreach ($conectors as $key => $value) {
				$conectores[] = $value['conector'];
			}
			foreach ($criterio as $key => $value) {			
				if(strlen($value) < 3 )unset($criterio[$key]);
				if(in_array($value, $conectores))unset($criterio[$key]);
			}
		}
		
		if(count($criterio)){

			$productos = \DB::table('clu_products')
			->select('clu_products.*',\DB::raw('COUNT(clu_products.id) as ventas'))
			->leftjoin('clu_order_detail', 'clu_products.id', '=', 'clu_order_detail.product_id')								
			->where('clu_products.store_id',Session::get('store.id'))
			->where(function($q) use ($criterio){
				foreach($criterio as $key => $value){
					$q->orwhere('clu_products.name', 'like', '%'.$value.'%')
					->orwhere('clu_products.description', 'like', '%'.$value.'%');						
				}
			})
			->groupBy('clu_products.id')
			->skip($request->input('ppp')*($request->input('pagina_solicitada')-1))->take($request->input('ppp'))				
			->get();

			$ventas = \DB::table('clu_products')
			->select('clu_products.*',\DB::raw('SUM(clu_order_detail.volume) as ventas'))			
			->leftjoin('clu_order_detail', 'clu_products.id', '=', 'clu_order_detail.product_id')
			->leftjoin('clu_order', 'clu_order_detail.order_id', '=', 'clu_order.id')			
			->where('clu_products.store_id',Session::get('store.id'))
			->where('clu_order.stage_id',4)
			->where(function($q) use ($criterio){
				foreach($criterio as $key => $value){
					$q->orwhere('clu_products.name', 'like', '%'.$value.'%')
					->orwhere('clu_products.description', 'like', '%'.$value.'%');						
				}
			})
			->groupBy('clu_products.id')
			->skip(0)->take(16)		
			->get();
			
		}else{
			$productos = \DB::table('clu_products')
			->select('clu_products.*',\DB::raw('COUNT(clu_products.id) as ventas'))
			->leftjoin('clu_order_detail', 'clu_products.id', '=', 'clu_order_detail.product_id')								
			->where('clu_products.store_id',Session::get('store.id'))
			->groupBy('clu_products.id')
			->skip($request->input('ppp')*($request->input('pagina_solicitada')-1))->take($request->input('ppp'))				
			->get();

			$ventas = \DB::table('clu_products')
			->select('clu_products.*',\DB::raw('SUM(clu_order_detail.volume) as ventas'))			
			->leftjoin('clu_order_detail', 'clu_products.id', '=', 'clu_order_detail.product_id')
			->leftjoin('clu_order', 'clu_order_detail.order_id', '=', 'clu_order.id')			
			->where('clu_products.store_id',Session::get('store.id'))
			->where('clu_order.stage_id',4)
			->groupBy('clu_products.id')
			->skip(0)->take(16)		
			->get();
		}

		foreach ($productos as $pkey => $producto) {
			$producto->ventas = 0;				
			foreach ($ventas as $vkey => $venta) {
				if($producto->id == $venta->id){
					//el producto tiene ventas reales
					$producto->ventas = $venta->ventas;
					 break; 
				}
			}				
		}

		return response()->json(['respuesta'=>true,'request'=>$request->input(),'data'=>$productos]);
	}

	public function postMessageamin(Request $request){
		//verificamos si el email corresponde a un usuario de la aplicacion
		$data = array(
			'name' => Session::get('copy'),
			'mail' => Session::get('mail'),
			'email' => Session::get('support'),
			'user' => Session::get('comjunplus.usuario.name'),
			'names' => Session::get('comjunplus.usuario.names'),
			'surnames' => Session::get('comjunplus.usuario.surnames'),
			'uemail' => Session::get('comjunplus.usuario.email'),
			'movil' => Session::get('comjunplus.usuario.movil_number'),
			'fix' => Session::get('comjunplus.usuario.fix_number'),
			'adress' => Session::get('comjunplus.usuario.adress'),
			'text' => $request->input('message_admin_text'),
		);		
				
		Mail::send('email.support',$data,function($message) use ($data) {
			$message->from(Session::get('mail'),Session::get('app'));
			$message->to($data['email'],'Soporte')->subject('Solicitud de Usuario.');
		});

		//enviar mensaje a super de tendero en mailbox	
		$hoy = new DateTime();	
		$mensaje = new Mensaje();
		$mensaje->subject = 'Solicitud a Soporte';
		$mensaje->date = $hoy->format('Y-m-d H:i:s');
		$mensaje->object = 'seg_user';
		$mensaje->object_id = 1;		
		$mensaje->user_sender_id = Session::get('comjunplus.usuario.id');//envia el tendero
		$mensaje->user_receiver_id = 1;//superadmin					
		$mensaje->message = $request->input('message_admin_text');
		$html = '<div>'.
				''.$request->input('message_admin_text').''.
				'</div>';
		$mensaje->body = $html;

		try {				
			$mensaje->save();	
		}catch (ModelNotFoundException $e) {				
			//no hacer nada
		}	
		
		return Redirect::to('/')->with('message', ['Tu solicitud se ha enviado correctamente a Soporte']);
	}

	//envio de mensaje de un cliente a un tendero en modal de inicio
	public function postMessageorder(Request $request){
		try {
			//enviar mensaje a tendero			
			//consultamos la orden
			$orden=\DB::table('clu_order')			
			->leftjoin('clu_store', 'clu_order.store_id', '=', 'clu_store.id')
			->where('clu_order.id',$request->input()['msg_orden_id'])					
			->get();
			
			$tienda = \DB::table('clu_store')
			->select('clu_store.*','seg_user.email','seg_user.name as uname','seg_user_profile.names as nombres_tendero','seg_user_profile.surnames as apellidos_tendero','seg_user_profile.movil_number','seg_user_profile.fix_number','seg_user.id as user_id')
			->leftjoin('seg_user', 'clu_store.user_id', '=', 'seg_user.id')
			->leftjoin('seg_user_profile', 'clu_store.user_id', '=', 'seg_user_profile.user_id')								
			->where('clu_store.id',$request->input()['msg_store_id'])
			->get();

			$detalles = \DB::table('clu_order')
			->select('clu_order_detail.*')
			->leftjoin('clu_order_detail', 'clu_order.id', '=', 'clu_order_detail.order_id')
			->where('clu_order.id',$request->input()['msg_orden_id'])
			->get();

			//anotaciones
			$anotaciones = \DB::table('clu_order_annotation')
			->where('clu_order_annotation.order_id',$request->input()['msg_orden_id'])
			->get();

			$data = Array();					
			$data['tienda'] = $tienda[0]->name;
			$data['orden_id'] = $request->input()['msg_orden_id'];
			$data['email'] = $tienda[0]->email;
			$data['direccion_tienda'] = $tienda[0]->city.' - '.$tienda[0]->adress;
			$data['ciudad_tienda'] = $tienda[0]->city;
			$data['telefono_tienda'] = $tienda[0]->movil_number.' - '.$tienda[0]->fix_number;
			$data['imagen'] = 'users/'.$tienda[0]->uname.'/stores/'.$tienda[0]->image;		

			$data['nombres_tendero'] =  $tienda[0]->nombres_tendero;
			$data['apellidos_tendero'] = $tienda[0]->apellidos_tendero;					

			$data['url'] = $request->url();

			$data['detalles'] = $detalles;
			$data['mensaje_orden'] =$request->input()['message_orden_text'];
			$data['anotaciones'] = $anotaciones;

			$data['id_client'] = $orden[0]->client_id;
			$data['name_client'] = $orden[0]->name_client;
			$data['email_client'] = $orden[0]->email_client;
			$data['number_client'] = $orden[0]->number_client;
			$data['adress_client'] = $orden[0]->adress_client;
						
			try{
				Mail::send('email.order_message_tender',$data,function($message) use ($orden,$tienda) {
					$message->from(Session::get('mail'),Session::get('app').' - '.$orden[0]->id);
					$message->to($tienda[0]->email,$tienda[0]->uname)->subject('Orden de Pedido.');
				});
			}catch (\Exception  $e) {	
				$message[] = 'Lo sentimos, el mensaje no pudo ser enviado al tendero. Intenta hacerle llegar tu mensaje acudiendo directamente a su correo electronico o a su nùmero de contacto.'; 
				return Redirect::to('/')->with('error', $message);
			}

			//agregamosel mensaje del tendero a las notaciones de la orden
			$hoy = new DateTime();
			if($data['mensaje_orden'] != ""){
				$anotacion = new Anotacion();				
				$anotacion->user_name = $data['name_client'];
				$anotacion->date = $hoy->format('Y-m-d H:i:s');
				$anotacion->description = $data['mensaje_orden'];
				$anotacion->active = true;
				$anotacion->order_id = $data['orden_id'] ;				
				try {
					//guardado de anotacion de pedido
					$anotacion->save();
				}catch (ModelNotFoundException $e) {
					//no pasa gran cosa, ya se ha enviado el mensaje al correo					
				}
			}				
			
			//agregar en message interno a mailbox
			$mensaje = new Mensaje();
			$mensaje->subject = 'Respuesta orden de pedido';
			$mensaje->date = $hoy->format('Y-m-d H:i:s');
			$mensaje->object = 'seg_order';
			$mensaje->object_id = $request->input()['msg_orden_id'];
			$mensaje->user_sender_id = 0;//envia el cliente
			if(Session::get('comjunplus.usuario.id'))$mensaje->user_sender_id = Session::get('comjunplus.usuario.id');//envia el cliente
			$mensaje->user_receiver_id = $tienda[0]->user_id;//tendero recive
			$mensaje->message = 'Orden de pedido, codigo: '.$request->input()['msg_orden_id'].', Respuesta: '. $request->input()['message_orden_text'];
			$html = '<div>'.
					'Orden de pedido, codigo: '.$request->input()['msg_orden_id'].''.
					''.$request->input()['message_orden_text'].''.
					'</div>';
			$mensaje->body = $html;

			try {				
				$mensaje->save();	
			}catch (ModelNotFoundException $e) {				
				//no hacer nada
			}

			$message[] = 'Mensaje enviado con exito al tendero.';
			
		}catch (ModelNotFoundException $e) {			
			//Modificamos el mensaje a mostrar
			$message[] = 'Lo sentimos, el mensaje no pudo ser enviado al tendero. Intenta hacerle llegar tu mensaje acudiendo directamente a su correo electronico o a su nùmero de contacto.'; 
			return Redirect::to('/')->with('error', $message);
		}
		return Redirect::to('/')->with('message', $message);					
	}

	public function postReseniaorder(Request $request){
		/*
			"rsn_usuario_id" => "2"//tendero	
			"rsn_store_id" => "1"//tienda y cliente.
		*/		
		//actualizamos la senenia de la orden, eso es todo, pro solo se puede actualizar una solo vez a menos que sea regular		
		$orden = Orden::find($request->input('rsn_orden_id'));
		
		if(!$orden->resenia_active){
			//si se actualiza
			$orden->resenia = $request->input('rsn_resenia');
			$orden->resenia_test = $request->input('rsn_resenia_text');
			$orden->resenia_active = 1;
			try {
				$orden->save();
			}catch (ModelNotFoundException $e) {			
				//Modificamos el mensaje a mostrar
				$message[] = 'Lo sentimos, La orden de pedido no fue correctamente cuentificada. Intentalo nuevamente.'; 
				return Redirect::to('/')->with('error', $message);
			}
			$message[] = 'La orden de pedido fue correctamente cuantificada.';
		}else{
			$message[] = 'La orden de pedido ya ha sido previamente cuantificada.';	
		}
		//enviamos mensaje a tendero interno?
		//enviamos mensaje a tendero externo?
		
		return Redirect::to('/')->with('message', $message);					
	}

	//este motodo es para retornar datos para mostar el modal, al querer agregar un producto al carrito
	public function postAddproduct(Request $request){
		//consultamos las caracteristicas del producto		
		$producto = \DB::table('clu_products')							
			->where('clu_products.id',$request->input('id'))		
			->get();			
		return response()->json(['respuesta'=>true,'request'=>$request->input(),'data'=>$producto]);	
	}

	//este motodo es para mandar la orden de pedido, guardarla
	public function postAddorder(Request $request){
				
		$orden = new Orden();	
		$hoy = new DateTime();
		$orden->date = $hoy->format('Y-m-d H:i:s');
		//miramos si es usuario o invitado
		if(!empty($request->input('name_invitado')) && !empty($request->input('dir_invitado')) ){
			//es invitado, captamos los datos de contacto
			$orden->name_client = $request->input('name_invitado');
			$orden->adress_client = $request->input('dir_invitado');
			$orden->email_client = strtolower($request->input('email_invitado'));
			$orden->number_client = $request->input('tel_invitado');
			$orden->client_id = 0;
			
		}else{
			//es usuario del sistema y esta logueado
			//$cliente = User::find(Session::get('comjunplus.usuario.id'));
			$cliente = \DB::table('seg_user_profile')			
			->leftjoin('seg_user', 'seg_user_profile.user_id', '=', 'seg_user.id')
			->where('seg_user.id',Session::get('comjunplus.usuario.id'))
			->get();

			$orden->name_client = $cliente[0]->names.' '.$cliente[0]->surnames;
			$orden->adress_client = $cliente[0]->city.' - '.$cliente[0]->adress;
			$orden->email_client = $cliente[0]->email;
			$orden->number_client = $cliente[0]->movil_number.', ' .$cliente[0]->fix_number;
			$orden->client_id = $cliente[0]->user_id;
			//verificamos si ya terminado sus datos de perfil
			if(empty($cliente[0]->names) || empty($cliente[0]->adress) || empty($cliente[0]->email) ){
				//el cleinte no ha terminado su registro
				return Redirect::back()->with('error',['Lo sentimos pero el pedido no pudo realizarce, aùn tienes datos por diligenciar en tu perfil de usuario.']);

			}
		}
		$orden->active= true;
		$orden->stage_id = 1;

		$data = Array();
		$productos = Array();
		foreach($request->input() as $key=>$value){
			if(strpos($key,'prod_') !== false){
				$vector=explode('_',$key);
				$n=count($vector);
				$id_prod = end($vector);
				
				$productos[$vector[$n-2]][$id_prod][$vector[1]] = str_replace(",,","",$value);
				$data['detalle'][$vector[$n-2]][$id_prod][$vector[1]] = str_replace(",,","",$value);
			}
		}

		if(count($productos)){
			//buscamos la tienda y su tendero
			$tienda = \DB::table('clu_store')
			->select('clu_store.*','seg_user.email','seg_user.name as uname','seg_user_profile.names as nombres_tendero','seg_user_profile.surnames as apellidos_tendero','seg_user_profile.movil_number','seg_user_profile.fix_number','seg_user.id as user_id')
			->leftjoin('seg_user', 'clu_store.user_id', '=', 'seg_user.id')
			->leftjoin('seg_user_profile', 'clu_store.user_id', '=', 'seg_user_profile.user_id')	
			->leftjoin('clu_products', 'clu_store.id', '=', 'clu_products.store_id')			
			->where('clu_products.id',key($productos))
			->get();

			$orden->store_id = $tienda[0]->id;		
			try {
				//guardado de pedido en base
				$orden->save();	
			}catch (ModelNotFoundException $e) {				
				return Redirect::back()->with('error',['No se pudo guardar la orden de pedido, Intentalo nuevamente.']);
			}

			//guardado de anotaciones
			if(!empty($request->input('description'))){
				$anotacion = new Anotacion();
				$anotacion->user_name = $orden->name_client;
				$anotacion->date = $hoy->format('Y-m-d H:i:s');
				$anotacion->description = $request->input('description');
				$anotacion->active = true;
				$anotacion->order_id = $orden->id;				
				try {
					//guardado de anotacion de pedido
					$anotacion->save();
				}catch (ModelNotFoundException $e) {				
					return Redirect::back()->with('error',['No se pudo guardar la orden de pedido, Intentalo nuevamente. Error en guardar anotaciones ']);
				}
			}		
			
			//guardado de detalles
			foreach ($productos as $id_prod => $prod) {
				//de un producto pude haber diferentes configuraciones			
				foreach ($prod as $key => $values) {					
					$detalle = new Detalle();
					$detalle->product = $values['nprod'];
					$detalle->price = $values['precio'];
					$detalle->volume = $values['volume'];
					$detalle->description = $values['crtrcs'];
					$detalle->product_id = $id_prod;
					$detalle->order_id = $orden->id;
					try{
						$detalle->save();
					}catch (ModelNotFoundException $e) {				
						return Redirect::back()->with('error',['No se pudo guardar la orden de pedido, Intentalo nuevamente. Error en guardar detalles']);
					}
				}				
			}
			
			//envio de correo a tendero de pedido			
			$data['tienda'] = $tienda[0]->name;
			$data['orden_id'] = $orden->id;
			$data['email'] = $tienda[0]->email;
			$data['direccion_tienda'] = $tienda[0]->city.' - '.$tienda[0]->adress;
			$data['ciudad_tienda'] = $tienda[0]->city;
			$data['telefono_tienda'] = $tienda[0]->movil_number.' - '.$tienda[0]->fix_number;
			$data['imagen'] = 'users/'.$tienda[0]->uname.'/stores/'.$tienda[0]->image;		

			$data['nombres_tendero'] =  $tienda[0]->nombres_tendero;
			$data['apellidos_tendero'] = $tienda[0]->apellidos_tendero;

			$data['nombre_cliente'] = $orden->name_client;
			$data['adress_client'] = $orden->adress_client;
			$data['email_client'] = $orden->email_client;
			$data['number_client'] = $orden->number_client;
			$data['id_client'] = $orden->client_id;

			$data['order_description'] = $request->input('description');

			$data['url'] = $request->url();
			
			//envio de correo al tendero
			try{
				Mail::send('email.order',$data,function($message) use ($tienda,$orden) {
					$message->from(Session::get('mail'),Session::get('app').' - '.$orden->id);
					$message->to($tienda[0]->email,$tienda[0]->name)->subject('Orden de Pedido.');
				});
			}catch (\Exception  $e) {	
				$mensage[]='No se logro enviar el correo al Tendero';				
			}

			//envio de correo a cliente, si falla notificar al tendero en mensage
			try{
				Mail::send('email.order_client',$data,function($message) use ($orden) {
					$message->from(Session::get('mail'),Session::get('app').' - '.$orden->id);
					$message->to($orden->email_client,$orden->name_client)->subject('Orden de Pedido.');
				});
			}catch (\Exception  $e) {	
				$mensage[]='El correo suministrado no es valido';
				$mensage[]='Si no eres usuario de ComprarJuntos lo mejor es realizar nuevamente el pedido. Si ya eres usuario, tu correo electronico esta mal diligenciado y deberias correjirlo';				
			}

			//envio a buzon interno mailbox de pedido, a tendero
			$mensaje = new Mensaje();
			$mensaje->subject = 'Orden de Pedido';
			$mensaje->date = $hoy->format('Y-m-d H:i:s');
			$mensaje->object = 'clu_order';
			$mensaje->object_id = $orden->id;
			$mensaje->user_receiver_id = $tienda[0]->user_id;//tendero			
			$mensaje->user_sender_id = 0;//enviada al cliente
			$mensaje->message = 'Nueva Orden de pedido, codigo:'.  $orden->id;
			//enviada al cliente
			if($orden->client_id){
				$mensaje->user_sender_id = $orden->client_id;
			}else{
				$mensaje->message = 'Nueva Orden de pedido, codigo:'.  $orden->id.' Cliente: '.$orden->name_client.' - '.$orden->email_client.' - '.$orden->number_client.' - '.$orden->adress_client.' Tienda: '.$tienda[0]->name;
				if(!empty($request->input('description'))){
					$mensaje->message = 'Nueva Orden de pedido, codigo:'.  $orden->id.' Cliente: '.$orden->name_client.' - '.$orden->email_client.' - '.$orden->number_client.' - '.$orden->adress_client.' Tienda: '.$tienda[0]->name.' Indicaciones: '.$request->input('description');
				}
			}
			
			$html = '<div>'.
					'Nueva Orden de pedido, codigo: '.$orden->id.''.
					'</div>';
			$mensaje->body = $html;

			try {				
				$mensaje->save();	
			}catch (ModelNotFoundException $e) {				
				//no hacer nada
			}		

			//retornar ala tienda con mensajes de ejecuciòn			
			$mensage[]='El pedido fue enviado con EXITO!, Con Consecutivo: '.$orden->id;
			return Redirect::back()->with('message',$mensage);
		}else{
			//la tienda no tiene productos
			return Redirect::back()->with('error',['Error Inesperado, no alcanzo a llegar ningun producto.']);
		}
		
	}

	public function getTerminosycondiciones(Request $request){
		
		return view('user/terminos');		
	}
	

}
