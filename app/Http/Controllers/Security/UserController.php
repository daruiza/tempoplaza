<?php namespace App\Http\Controllers\Security;

use App\User;
use App\Core\Security\UserProfile;
use App\Core\Security\City;
use App\Core\ComprarJuntos\Mensaje;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class UserController extends Controller {

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
	protected $auth;

	/**
	 * Create a new filter instance.
	 *
	 * @param  Guard  $auth
	 * @return void
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		return view('welcome');
	}
	
	//función para mostrar la vista perfil
	public function getPerfil(){
					
		/**
		 * REALIZAMOS CONSULTAS PARA PERFIL, GRAFICAS, EMAIL	 
		 */
		//consultamos los Departamentos los selects
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

		return view('user/perfil')->with($moduledata);
	}
		
	//función para mostrar la vista perfil
	public function getBuzon(Request $request,$id=null){
		//controlador de metodo buzon
		return 'buzon';
		return view('user/buzon');
	}
	
	//Esta función es para guardar el usuario de la vista perfil, el usuario personal
	public function postEditarPerfil(Request $request,$id=null)
	{			
		//rutina para refinar los inputs		
		$array_input = array();
		$array_input['_token'] = $request->input('_token');
		$array_input['correo_electronico'] = $request->input('correo_electronico');		
		$array_input['fuente_tipografica'] = $request->input('fuente_tipografica');
		
		foreach($request->input() as $key=>$value){
			if($key != "_token" && $key != "correo_electronico" && $key != "fuente_tipografica"){
				$array_input[$key] = ucwords(strtolower($value));
			}
		}
		$request->replace($array_input);
		
		//calculo de fechas para mayores de 18 años
		$hoy = date('Y-m-j');
		$fecha = strtotime('-18 year',strtotime($hoy));
		$fecha = date('Y-m-j',$fecha);

		$messages = [
			'required' => 'El campo :attribute es requerido.',
			'size' => 'La :attribute deberia ser mayor a :size.',
			'min' => 'La :attribute deberia tener almenos :min. caracteres',
			'max' => 'La :attribute no debe tener maximo :max. caracteres',
			'numeric' => 'El :attribute  debe ser un número',
			'before' => "El :attribute  debe ser menor a: $fecha",
			'date' => 'El :attribute  no es una fecha valida',
			'mimes' => 'La :attribute debe ser de tipo jpeg, png o bmp',
		];
		
		$rules = array(			
			'correo_electronico' => 'required',
			'nombres'    => 'required|min:3|max:60', // make sure the username field is not empty
			//'apellidos' => 'required|min:3|max:60',
			'fecha_nacimiento' => "date|before:$fecha",
			'departamento' => 'required',
			'municipio' => 'required',
			'direccion' => 'required',						
		);		
		
		$validator = Validator::make($request->input(), $rules, $messages);		
		if ($validator->fails()) {			
			return Redirect::back()->withErrors($validator)->withInput();
		}else{

			//preparación y validacion de imagen
			if(!empty(Input::file('image'))){
				$file = array('image' => Input::file('image'));
				$rules = array(
					'image'=>'required|mimes:jpeg,bmp,png',
				);
				$validator = Validator::make($file, $rules, $messages);
				if ($validator->fails()) {			
					return Redirect::back()->withErrors($validator)->withInput();;
				}else{
					//eliminamos todos los ficheros
					$dir = 'users/'.Session::get('comjunplus.usuario.name').'/profile/';
					$handle = opendir($dir);
					$ficherosEliminados = 0;
					while ($file = readdir($handle)) {
			            if (is_file($dir.$file)) {
			                if (unlink($dir.$file) ){
			                    $ficherosEliminados++;
			                }
			            }
			        }


					if(Input::file('image')->isValid()){						
						$destinationPath = 'users/'.Session::get('comjunplus.usuario.name').'/profile';
						$extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
						$fileName = rand(1,9999999).'.'.$extension; // renameing image
						Input::file('image')->move($destinationPath, $fileName); 						
					}

				}	
			}	

			$user = new User();
			$userprofile = new UserProfile();
							
			$userprofile = UserProfile::find(Session::get('comjunplus.usuario.id'));
			$user = User::find(Session::get('comjunplus.usuario.id'));
			
			$user->ip = $request->server()['REMOTE_ADDR'];			
			$user->email = $request->input()['correo_electronico'];			

			$userprofile ->identificacion =  $request->input()['identificacion'];					
			$userprofile ->names =  $request->input()['nombres'];			
			$userprofile ->surnames =  $request->input()['apellidos'];			
			$userprofile ->birthdate =  $request->input()['fecha_nacimiento'];					
			$userprofile ->adress =  $request->input()['direccion'];
			$userprofile ->state =  $request->input()['departamento'];
			$userprofile ->city =  $request->input()['municipio'];									
			$userprofile ->movil_number =  $request->input()['telefono_movil'];
			$userprofile ->fix_number =  $request->input()['telefono_fijo'];			
			$userprofile ->template =  $request->input()['fuente_tipografica'];
			$userprofile ->avatar =  Session::get('comjunplus.usuario.avatar');
			
			if(!empty($fileName))$userprofile ->avatar =  $fileName;
			
			try {
				$userAffectedRows = User::where('id', Session::get('comjunplus.usuario.id'))->update(array(
					'ip' => $user->ip,					
					'email' => $user->email));

				$userProfileAffectedRows = UserProfile::where('user_id', Session::get('comjunplus.usuario.id'))->update(array(
					'identificacion' => $userprofile->identificacion,
					'names' => $userprofile->names,
					'surnames' => $userprofile->surnames,
					'birthdate' => $userprofile->birthdate,
					'adress' => $userprofile->adress,
					'state' => $userprofile->state,
					'city' => $userprofile->city,						
					'movil_number' => $userprofile->movil_number,
					'fix_number' => $userprofile->fix_number,
					'avatar' => $userprofile->avatar,
					'template' => $userprofile->template
				));
			}catch (\Illuminate\Database\QueryException $e) {
				$message = 'La Identificación,el usuario o el email ya existen';
				return Redirect::to('perfil')->with('error', [$message]);
			}		
			
			//actualizaciopn del session			
			Session::put('comjunplus.usuario.email', $request->input()['correo_electronico']);
			Session::put('comjunplus.usuario.identificacion', $request->input()['identificacion']);			
			Session::put('comjunplus.usuario.names', $request->input()['nombres']);
			Session::put('comjunplus.usuario.surnames', $request->input()['apellidos']);
			Session::put('comjunplus.usuario.birthdate', $request->input()['fecha_nacimiento']);			
			Session::put('comjunplus.usuario.state', $request->input()['departamento']);
			Session::put('comjunplus.usuario.city', $request->input()['municipio']);
			Session::put('comjunplus.usuario.adress', $request->input()['direccion']);			
			Session::put('comjunplus.usuario.movil_number', $request->input()['telefono_movil']);
			Session::put('comjunplus.usuario.fix_number', $request->input()['telefono_fijo']);
			Session::put('comjunplus.usuario.avatar', $userprofile ->avatar);		
			Session::put('comjunplus.usuario.template', $request->input()['fuente_tipografica']);			
			//return Redirect::to('perfil')->with('message', ['¡Los Datos de tu perfil se han actualizado correctamente!']);
			return Redirect::back()->with('message', ['¡Los Datos de tu perfil se han actualizado correctamente!']);
		}
	}

	//para tabla de remitentes
	public function getListarajaxmsjsender(Request $request){

		$moduledata['total']=Mensaje::where('user_receiver_id',Session::get('comjunplus.usuario.id'))->count();
		if(!empty($request->input('search')['value'])){
			$moduledata['mensajes']=
			Mensaje::
			select('clu_mailbox.*')			
			->where('clu_mailbox.user_receiver_id',Session::get('comjunplus.usuario.id'))
			->where(function ($query) {
				$query->where('clu_mailbox.subject', 'like', '%'.Session::get('search').'%')
				->orWhere('clu_mailbox.message', 'like', '%'.Session::get('search').'%')	
				->orWhere('clu_mailbox.object_id', 'like', '%'.Session::get('search').'%')	
				->orWhere('clu_mailbox.date', 'like', '%'.Session::get('search').'%');				
			})
			->skip($request->input('start'))->take($request->input('length'))
			->orderBy('id', 'desc')
			->get();		
			$moduledata['filtro'] = count($moduledata['ordenes']);

		}else{
			$moduledata['mensajes']=\DB::table('clu_mailbox')
			->where('clu_mailbox.user_receiver_id',Session::get('comjunplus.usuario.id'))
			->skip($request->input('start'))->take($request->input('length'))
			->orderBy('id', 'desc')
			->get();			
				
			$moduledata['filtro'] = $moduledata['total'];
		}

		return response()->json(['draw'=>$request->input('draw')+1,'recordsTotal'=>$moduledata['total'],'recordsFiltered'=>$moduledata['filtro'],'data'=>$moduledata['mensajes']]);
	}

	//para tabla de destinatarios
	public function getListarajaxmsjreceiver(Request $request){

		$moduledata['total']=Mensaje::where('user_sender_id',Session::get('comjunplus.usuario.id'))->count();
		if(!empty($request->input('search')['value'])){
			$moduledata['mensajes']=
			Mensaje::
			select('clu_mailbox.*')			
			->where('clu_mailbox.user_sender_id',Session::get('comjunplus.usuario.id'))
			->where(function ($query) {
				$query->where('clu_mailbox.subject', 'like', '%'.Session::get('search').'%')
				->orWhere('clu_mailbox.message', 'like', '%'.Session::get('search').'%')	
				->orWhere('clu_mailbox.object_id', 'like', '%'.Session::get('search').'%')	
				->orWhere('clu_mailbox.date', 'like', '%'.Session::get('search').'%');				
			})
			->skip($request->input('start'))->take($request->input('length'))
			->orderBy('id', 'desc')
			->get();		
			$moduledata['filtro'] = count($moduledata['ordenes']);

		}else{
			$moduledata['mensajes']=\DB::table('clu_mailbox')
			->where('clu_mailbox.user_sender_id',Session::get('comjunplus.usuario.id'))
			->skip($request->input('start'))->take($request->input('length'))
			->orderBy('id', 'desc')
			->get();			
				
			$moduledata['filtro'] = $moduledata['total'];
		}

		return response()->json(['draw'=>$request->input('draw')+1,'recordsTotal'=>$moduledata['total'],'recordsFiltered'=>$moduledata['filtro'],'data'=>$moduledata['mensajes']]);
	}
		
	//Función para cambiar de lugar 
	public function postLugar(Request $request){		
		$array = Array();
		if($request->input('lugar')){
			//estamos en la papelera
			$array['usuario']['lugar']['lugar']='escritorio';
			$array['usuario']['lugar']['active']=1;
			Session::put('comjunplus.usuario.lugar.lugar', 'escritorio');
			Session::put('comjunplus.usuario.lugar.active', 1);
		}else{
			//estamos en el escritorio
			$array['usuario']['lugar']['lugar']='papelera';
			$array['usuario']['lugar']['active']=0;
			Session::put('comjunplus.usuario.lugar.lugar', 'papelera');
			Session::put('comjunplus.usuario.lugar.active', 0);			
		}
		return response()->json(['respuesta'=>true,'data'=>$array]);
		
	}

	public function postConsultarcity(Request $request){
		//consultamos el departamento
		if(!empty($request->input()['id'])){
			$department_id = \DB::table('seg_department')
			->where('department',$request->input()['id'])
			->get()[0]->id;
				

			$citys = City::where('seg_city.department_id', $department_id)
				->orderBy('city','asc')
				->get()
				->toArray();
			$i=0;	
			foreach ($citys as $city){
				$ciudades[$i] = $city['city'];				
				$i++;
			}
			if(count($ciudades)){
				return response()->json(['respuesta'=>true,'data'=>$ciudades]);
			}
		}
		
		return response()->json(['respuesta'=>true,'data'=>null]);
	}
	
	
}

