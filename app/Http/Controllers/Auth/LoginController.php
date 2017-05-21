<?php

namespace App\Http\Controllers\Auth;

use Mail;
use App\User;
use App\Core\Security\Permit;
use App\Core\Security\Aplications;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    protected $auth;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function __construct(Guard $auth)
    {
    	$this->auth = $auth;
    	//$this->middleware('guest', ['except' => 'logout']);
    }
    
    public function getLogin(Request $request)
    {    
    	if ($this->auth->guest()){
    		$messages = [
				'required' => 'El campo :attribute es requerido.',
				'size' => 'El campo :attribute deberia ser mayor a :size.',
				'min' => 'El campo :attribute deberia tener almenos :min. caracteres',
				'max' => 'El campo :attribute no debe tener mas de :max. caracteres',
				'alphaNum' => 'El campo :attribute solo debe tener letras y numeros',
			];
	
			$rules = array(
				'usuario'    => 'required|min:4|max:12', // make sure the username field is not empty
				'contraseña' => 'required|min:6|max:12' // password can only be alphanumeric and has to be greater than 3 characters
			);
			$validator = Validator::make($request->input(), $rules, $messages);
			
			if ($validator->fails()) {
				//el redirect puede redirigir a route, to, back, url
				if(Session::has('orden_id')){
					//hubo un error de logion al intentar acceder a la ordenasi que se intenta nuevamente
					Session::flash('modal', 'modallogin');
 					Session::flash('orden_id', Session::get('orden_id'));
				}						
				return Redirect::to('/')->withErrors($validator)->withInput();
			}else{
				//preguntamos si el usuario no esta autenticado
				if (!$this->auth->check()){
					//no esta autenticado
					$user = new User();
					$userdata = array(
						'name'  => $request->input('usuario'),
						'password'  => $request->input('contraseña'),
						'active'  => 1
					);
					if (!$this->auth->attempt($userdata)){
						//preguntamos si el name es un email
						$usuario = $user->where('email',$request->input('usuario'))->get()->toArray();
						if(count($usuario)){
							//es un email
							$userdata = array(
								'name'  => $usuario[0]['name'],
								'password'  => $request->input('contraseña'),
								'active'  => 1
							);
							if (!$this->auth->attempt($userdata)){
								if(Session::has('orden_id')){
									//hubo un error de logion al intentar acceder a la ordenasi que se intenta nuevamente
									Session::flash('modal', 'modallogin');
				 					Session::flash('orden_id', Session::get('orden_id'));
								}						
								return Redirect::to('/')->withErrors(['Usuario o contraseña invalidos.'])->withInput();
							}
						}else{
							if(Session::has('orden_id')){
								//hubo un error de logion al intentar acceder a la ordenasi que se intenta nuevamente
								Session::flash('modal', 'modallogin');
			 					Session::flash('orden_id', Session::get('orden_id'));
							}
							//el redirect puede redirigir a route, to, back, url
							return Redirect::to('/')->withErrors(['Datos invalidos, comunicate con el administrador','Recuerda que tu correo electrónico tambien funciona como usuario para ingresar a ComprarJuntos.'])->withInput();
						}
					}
					
					//consultamos el usuario
					$result = null;
					try {						
						
						$result = User::where('seg_user.active',$userdata['active'])							
							->join('seg_rol','seg_user.rol_id','=','seg_rol.id')
							->join('seg_user_profile','seg_user.id','=','seg_user_profile.user_id')
							->where('name',$userdata['name'])
							->get()->all()[0]->toArray();
						
					}catch (ModelNotFoundException $e) {
						$message = 'Hay problemas al hallar el perfil de usuario; este problema es delicado, comunicarce con el administrador';
						return Redirect::back()->with('error', [$message]);
					}
					
					$array = Array();
					$array['usuario']['id'] = $user->id = $result['user_id'];
					$array['usuario']['name']=$result['name'];
					$array['usuario']['email']=$result['email'];					
					$array['usuario']['ip'] = $user->ip = $request->server()['REMOTE_ADDR'];
					$array['usuario']['rol_id']=$result['rol_id'];
					$array['usuario']['stores']=$result['stores'];
					$array['usuario']['products']=$result['products'];
					$array['usuario']['account']=$result['account'];
					$array['usuario']['rol']=$result['rol'];					
					$array['usuario']['identificacion']=$result['identificacion'];					
					$array['usuario']['names']=$result['names'];
					$array['usuario']['surnames']=$result['surnames'];
					$array['usuario']['birthdate']=$result['birthdate'];
					$array['usuario']['adress']=$result['adress'];
					$array['usuario']['state']=$result['state'];
					$array['usuario']['city']=$result['city'];
					$array['usuario']['avatar']=$result['avatar'];
					$array['usuario']['template']=$result['template'];
					$array['usuario']['movil_number']=$result['movil_number'];
					$array['usuario']['fix_number']=$result['fix_number'];					
					$array['usuario']['ultimo_ingreso']=$result['updated_at'];
					
					//asignamos la vista en el escritorio
					$array['usuario']['lugar']['lugar']='escritorio';
					$array['usuario']['lugar']['active']=1;
					
					//cambiamos el estylo
					Session::put('style', $array['usuario']['template']);
					
					//consultamos las aplicaciones del usuario del usuario disponibles
					$apps = Array();
					$aplications=\DB::table('seg_app_x_user')->where('active',1)->where('user_id',$array['usuario']['id'])->get();
					
					foreach ($aplications as $value){					
						if($value->active)$apps[]=$value->app_id;
					}
					
					$aplicaciones = null;
					try {
						$aplicaciones=Aplications::find($apps)->where('active',1)->toArray();
					}catch (ModelNotFoundException $e) {
						$message = 'Problemas al hallar las aplicaciones de usuario';
						return Redirect::back()->with('error', $message);
					}
					
					//consultamos los modulos de las aplicaciones permitidos para este usuario
					$permisos = array();//este vector almacena la forma definitiva
					try {
						$permits = Permit::with('modules')->with('options')->where('rol_id',$result['rol_id'])->get()->toArray();
					}catch (ModelNotFoundException $e) {
						$message = 'Problemas al hallar los permisos de usuario';
						return Redirect::back()->with('error', $message);
					}
					
					//filtamos los modulos deacuerso a las plicaciones vigentes para el usuario
					$pmts = Array();
					foreach ($permits as $value){
						if(in_array($value['modules']['app_id'],$apps))$pmts[]=$value;
					}
					$permits = $pmts;
					
					foreach ($permits as $value){
											
						if(!(key_exists($value['modules']['app_id'], $permisos))){
							//se crea el array para permisos de aplicaciòn
							$permisos[$value['modules']['app_id']]['modulos'] = array();
					
							//if(!(key_exists($value['modules']['app_id']['aplicacion'], $permisos))){								
								foreach ($aplicaciones as $app){
									if($value['modules']['app_id'] == $app['id']){
										$permisos[$value['modules']['app_id']]['aplicacion'] = $app['app'];
										$permisos[$value['modules']['app_id']]['descripcion'] = $app['description'];
										$permisos[$value['modules']['app_id']]['preferencias'] = $app['preferences'];
									}
								}
							//}
							
						}
						if(!(key_exists($value['module_id'], $permisos[$value['modules']['app_id']]['modulos']))){
							$permisos[$value['modules']['app_id']]['modulos'][json_decode($value['modules']['preference'])->categoria][$value['module_id']] = array();
							$permisos[$value['modules']['app_id']]['modulos'][json_decode($value['modules']['preference'])->categoria][$value['module_id']]['modulo'] = $value['modules']['module'];
							$permisos[$value['modules']['app_id']]['modulos'][json_decode($value['modules']['preference'])->categoria][$value['module_id']]['preferencias'] = $value['modules']['preference'];
							$permisos[$value['modules']['app_id']]['modulos'][json_decode($value['modules']['preference'])->categoria][$value['module_id']]['descripcion'] = $value['modules']['description'];
							$permisos[$value['modules']['app_id']]['modulos'][json_decode($value['modules']['preference'])->categoria][$value['module_id']]['opciones'] = array();
						}
					}
					//este último ciclo agrega las opciones a los array previamente creados, no se logro hacer en el anterior ciclo.
					foreach ($permits as $value){
						$permisos[$value['modules']['app_id']]['modulos'][json_decode($value['modules']['preference'])->categoria][$value['module_id']]['opciones'][$value['options']['id']][$value['options']['id']] = $value['options']['option'];
						$permisos[$value['modules']['app_id']]['modulos'][json_decode($value['modules']['preference'])->categoria][$value['module_id']]['opciones'][$value['options']['id']]['lugar'] = json_decode($value['options']['preference'])->lugar;
						$permisos[$value['modules']['app_id']]['modulos'][json_decode($value['modules']['preference'])->categoria][$value['module_id']]['opciones'][$value['options']['id']]['vista'] = json_decode($value['options']['preference'])->vista;
						$permisos[$value['modules']['app_id']]['modulos'][json_decode($value['modules']['preference'])->categoria][$value['module_id']]['opciones'][$value['options']['id']]['icono'] = json_decode($value['options']['preference'])->icono;
						$permisos[$value['modules']['app_id']]['modulos'][json_decode($value['modules']['preference'])->categoria][$value['module_id']]['opciones'][$value['options']['id']]['accion'] = $value['options']['action'];
					}
					
					$array['usuario']['permisos']=$permisos;
					//asignamos al session, el array de permisos
					Session::put('comjunplus', $array);
					//actualizamos la ip
					try {
						$user->where('id',$user->id)->update(array('ip' => $user->ip, 'updated_at' => date("Y-m-d")));
					}catch (ModelNotFoundException $e) {
						$message = 'Problemas al actualizar los datos de usuario';
						return Redirect::back()->with('error', $message);
					}
					
					//registamos el log de acceso
					\DB::insert("INSERT INTO `seg_log` (
						`id`,
						`action`,
						`description`,
						`date`,
						`user_id`,
						`created_at`,
						`updated_at`) VALUES (
						NULL,
						'acceso',
						'Login usuario: ".Session::get('comjunplus.usuario.names')."',
						'".date('Y-m-d')."',
						'".Session::get('comjunplus.usuario.id')."',
						NULL,
						NULL)"
					);						
					
					//Mensajes
					if(!empty($request->input('contraseña_dos'))){
						$message[] = 'Tu contraseña fue Cambiada exitosamente';
					}					
					$message[] = 'Bienvenid@: '.Session::get('comjunplus.usuario.names').' '.Session::get('comjunplus.usuario.surnames');
					if(!empty($request->input('user_id'))){
						$message[] = 'Ya puedes crear tu propia tienda y vender tus productos en nuestra gran comunidad';
						$message[] = 'Antes de empezar, date una vuelta por el PERFIL DE USUARIO para que completes la Inscripción, configures tu cuenta y se habiliten todas las opciones';
						$message[] = 'Perfil1';
						
					}else{						
						if(empty($array['usuario']['names']) || empty($array['usuario']['adress']) || empty($array['usuario']['state']) || empty($array['usuario']['city']) || empty($array['usuario']['birthdate']) || empty($array['usuario']['email'])){				
							$message[] = 'Perfil2';
						}
						
					}
					
					//$message[] = 'Tienes varios mensajes por revisar';
					
					//retornamos al index que debe pintar con la nueva imformacion					
					//return Redirect::route('home')->with('message', $message );

					//consulta de orden desde correo electronico
					if(Session::has('orden_id')){						
						//redirigir a mistiendas y mostrar el modal con la orden solicitada
						Session::flash('orden_id', Session::get('orden_id'));			 	
						return Redirect::to('/mistiendas/listar')->with('message', $message);
					}

					return Redirect::to('/')->with('message', $message);
					
				}else{
					//el usuario ya est autenticado					
					return Redirect::route('home');
				}
			}
    	}
    	
    	return Redirect::route('home');
    }
    
    //envio de email
    public function getRecoverPassword(Request $request)
    {
    	//verificamos si el email corresponde a un usuario de la aplicacion
		$data = array(
			'name' => Session::get('copy'),
			'mail' => Session::get('mail'),
			'email' => $request->input()['email'],				
		);
		try {
			$model = User::where('email', '=', $data['email'])->firstOrFail();
		}catch (ModelNotFoundException $e) {
			$message = 'El email suministrado no es valido';
            return Redirect::back()->with('error', [$message]);
		}
		
		$data['password'] = $model->password;
		$data['user'] = $model->name;				
		$data['url'] = $request->url()."email/".$model->name."/".base64_encode($model->password);
						
		Mail::send('email.recover',$data,function($message) use ($model) {
			$message->from(Session::get('mail'),Session::get('copy'));
			$message->to($model->email,$model->name)->subject('Recuperación de Contraseña.');
		});
		
		return Redirect::to('/')->with('message', ['Revisa tu correo elecronico, '. Session::get('copy') .' acaba de enviarte un mensaje que te ayudara a recuperar tu contraseña']);
    }
    
    //procesar email
    public function getRecoverPasswordEmail($user=null, $psw=null)
    {
    	//verificamos las variables
    	if(is_null($user) or is_null($psw)){
    		//retornamos con mensaje de error
    		return Redirect::to('/')->with('error',['Los datos no alcanzarón a llegar desde el correo electronico. ¡Intentalo de nuevo!']);
    	}
    	//si intentan corromper los datos por html
    	$userdata = array(
    		'name'  => $user,
    		'password'  => base64_decode($psw),
    		'active'  => 1
    	);   	
    	
    	try {
    		//hay que validar de este modo ya que el modelo User encripta la contraseña y ya la tenemos encriptada
    		$model = User::where('name', '=', $userdata['name'])->where('password', '=', $userdata['password'])->firstOrFail();
    	}catch (ModelNotFoundException $e) {
    		$message = 'Datos invalidos, tu contraseña o tu usuario actual no coincide.';
    		return Redirect::to('/')->with('error',[$message]);
    	}
    	$userdata['id']=$model->id;
    	return Redirect::to('/')->with('user',$userdata);
    }
    
    public function getChangePassword(Request $request)
    {
    	$messages = [
    		'required' => 'El campo :attribute es requerido.',
    		'size' => 'El campo :attribute deberia ser mayor a :size.',
    		'min' => 'El campo :attribute deberia tener almenos :min. caracteres',
    		'max' => 'El campo :attribute no debe tener mas de :max. caracteres',
    		'alphaNum' => 'El campo :attribute solo debe tener letras y numeros',
    	];
    	
    	$rules = array(
   			'usuario'    => 'required|min:4|max:12', // make sure the username field is not empty
   			'contraseña' => 'required|alphaNum|min:6|max:18', // password can only be alphanumeric and has to be greater than 3 characters
    		'contraseña_dos' => 'required|alphaNum|min:6|max:18' // password can only be alphanumeric and has to be greater than 3 characters
    	);
    	$validator = Validator::make($request->input(), $rules, $messages);
    		
    	if ($validator->fails()) {
    		//el redirect puede redirigir a route, to, back, url
    		return Redirect::to('/')->withErrors($validator)->withInput();
    	}else{
    		
    		//Validamos que exista el usuario
    		$userdata = array(
    			'name'  => $request->input('usuario'),
    			'password'  => $request->input('contraseña'),
    			'active'  => 1
    		);
    		
    		try {
    			//hay que validar de este modo ya que el modelo User encripta la contraseña y ya la tenemos encriptada
    			$model = User::where('name', '=', $userdata['name'])->firstOrFail();
    		}catch (ModelNotFoundException $e) {
    			$message = 'Datos invalidos, tu contraseña no coincide.';
    			return Redirect::to('/')->with('error',[$message]);
    		}
    		//validamos contraseña nueva
    		if ($request->input()['contraseña'] !== $request->input()['contraseña_dos']){
    			return Redirect::back()->withErrors(['Datos invalidos, tu contraseña nueva no coincide'])->withInput();
    		}
    		
    		$user = new User();
    		
    		$user = User::find($model['id']);
    		$user->setPasswordAttribute($request->input()['contraseña_dos']);
    		$user->save();
    		    		
    		$message[]='Contraseña editada OK.';
    		return  $this->getLogin($request)->with('message', $message);;
    		
    	}
    	
    	
    }
    
    public function getLogout(Request $request,$id=null)
    {    	
    	// Cerramos la sesión
		$this->auth->logout();
		$user = new User();
		try {
			$user->where('id',Session::get('opaplus.usuario.id'))->update(array('ip' => Session::get('opaplus.usuario.ip'), 'updated_at' => date("Y-m-d H:i:s")));
		}catch (ModelNotFoundException $e) {
			$message = 'Problemas al actualizar los datos de usuario';
			return Redirect::back()->with('error', [$message]);
		}
		Session::put('style', 'default');
		return Redirect::to('/')->with('message', ['Acabas de Salir de forma segura de ComprarJuntos.','Te epramos en una proxima visita.']);
    }
    
    
}
