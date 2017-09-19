<?php

namespace App\Http\Controllers\Auth;

use Mail;
use App\User;
use Validator;
use App\Core\Security\AppUser;
use App\Core\Security\UserProfile;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
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
        //$this->middleware('guest');
        $this->auth = $auth;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
    
    public function getRegistry(Request $request)
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
				//'email'    => 'required|min:6|max:18', // make sure the username field is not empty
				'contraseña_uno' => 'required|min:6|max:12', // password can only be alphanumeric and has to be greater than 3 characters
				'contraseña_dos' => 'required|min:6|max:12', // password can only be alphanumeric and has to be greater than 3 characters
			);
			$validator = Validator::make($request->input(), $rules, $messages);
				
			if ($validator->fails()) {
				//el redirect puede redirigir a route, to, back, url
				return Redirect::to('/')->withErrors($validator)->withInput();
			}else{				
				//verificamos que el nombre de usuario no exista
				$user = User::where('name', '=', $request->input('usuario'))->first();
				if(empty($user)){
					//verificamos que el email no exista
					$user = User::where('email', '=', $request->input('email'))->first();
					if(empty($user)){
						//verificamos que las contraseñas sean iguales
						if($request->input()['contraseña_uno'] == $request->input()['contraseña_dos']){
							//se realiza la inscripción
							$user = new User();
							$userprofile = new UserProfile();
								
							$user->name = $request->input()['usuario'];
							$user->ip = $request->server()['REMOTE_ADDR'];
							$user->email =  $request->input()['usuario'].'@yopmail.com';
							if(!empty($request->input()['email']))$user->email = $request->input()['email'];
							$user->password = '0000';
							if(!empty($request->input()['contraseña_uno'])){
								$user->password = $request->input()['contraseña_uno'];
							}
							$user->rol_id = 2;
							$user->stores = env('APP_STORES',4);
							$user->products = env('APP_PRODUCTS',60);

							try {
								$user->save();
								$user_app = new AppUser();
								$user_app->app_id = 2;
								$user_app->user_id = $user->id;
								$user_app->save();								
								$userprofile->user_id = $user->id;
								$userprofile->avatar = 'default.png';
								$userprofile->template = 'default';
								$userprofile->save();
							}catch (ModelNotFoundException $e) {
								$user->delete();
								$userprofile->delete();
								$message[] = '¡Lo sentimos!, se presentarón problemas al crear el usuario';
								return Redirect::back()->with('error', $message);
							}							

							//creación de directorio de usuario							
							if (!is_dir(str_replace(' ','',$user->name))){
								if(!mkdir('users/'.str_replace(' ','',$user->name).'/profile',0777,true)){
									$message[] = '¡Lo sentimos!, se presentarón problemas al crear el usuario';
									$message[] = '¡Fallo la creación de tu directorio.';
									return Redirect::back()->with('error', $message);									
								}								
								chmod('users/'.str_replace(' ','',$user->name), 0777);
								
								//ubicamos la imagen del perfil de usuario
								if (!copy('images/user/default.png', 'users/'.str_replace(' ','',$user->name).'/profile/default.png')) {
									$message[] = '¡Lo sentimos!, se presentarón problemas al crear el usuario';
									$message[] = '¡Fallo la copia de archivos.';
									return Redirect::back()->with('error', $message);	
								}
								chmod('users/'.str_replace(' ','',$user->name).'/profile/default.png', 0777);

								if(!mkdir('users/'.str_replace(' ','',$user->name).'/stores',0777,true)){
									$message[] = '¡Lo sentimos!, se presentarón problemas al crear el usuario';
									$message[] = '¡Fallo la creación de tu directorio.';
									return Redirect::back()->with('error', $message);									
								}								
								chmod('users/'.str_replace(' ','',$user->name), 0777);

								//ubicamos la imagen de la tienda de usuario, necesaria para que se cree el directorio
								if (!copy('images/store/default.png', 'users/'.str_replace(' ','',$user->name).'/stores/default.png')) {
									$message[] = '¡Lo sentimos!, se presentarón problemas al crear el usuario';
									$message[] = '¡Fallo la copia de archivos.';
									return Redirect::back()->with('error', $message);	
								}
								chmod('users/'.str_replace(' ','',$user->name).'/stores/default.png', 0777);

								if(!mkdir('users/'.str_replace(' ','',$user->name).'/banners',0777,true)){
									$message[] = '¡Lo sentimos!, se presentarón problemas al crear el usuario';
									$message[] = '¡Fallo la creación de tu directorio.';
									return Redirect::back()->with('error', $message);									
								}								
								chmod('users/'.str_replace(' ','',$user->name), 0777);

								//ubicamos la imagen del banner de tienda
								if (!copy('images/banner/default.png', 'users/'.str_replace(' ','',$user->name).'/banners/default.png')) {
									$message[] = '¡Lo sentimos!, se presentarón problemas al crear el usuario';
									$message[] = '¡Fallo la copia de archivos.';
									return Redirect::back()->with('error', $message);	
								}
								chmod('users/'.str_replace(' ','',$user->name).'/banners/default.png', 0777);

								if(!mkdir('users/'.str_replace(' ','',$user->name).'/products',0777,true)){
									$message[] = '¡Lo sentimos!, se presentarón problemas al crear el usuario';
									$message[] = '¡Fallo la creación de tu directorio.';
									return Redirect::back()->with('error', $message);									
								}								
								chmod('users/'.str_replace(' ','',$user->name), 0777);

								//ubicamos la imagen del producto por defecto
								if (!copy('images/product/default.png', 'users/'.str_replace(' ','',$user->name).'/products/default.png')) {
									$message[] = '¡Lo sentimos!, se presentarón problemas al crear el usuario';
									$message[] = '¡Fallo la copia de archivos.';
									return Redirect::back()->with('error', $message);	
								}
								chmod('users/'.str_replace(' ','',$user->name).'/products/default.png', 0777);
							}								
							
							//envio de mensage al administrador							
							$data['user'] = $user->name;
							$data['email'] = $user->email;
							
							Mail::send('email.registry',$data,function($message) {
								$message->from(Session::get('mail'),Session::get('copy'));
								$message->to(Session::get('mail'),Session::get('name'))->subject('Registro de Tendero.');
							});						
							
							return redirect()->action('Auth\LoginController@getLogin', ['user_id' => $user->id, 'usuario'=>$user->name, 'contraseña'=>  $request->input()['contraseña_uno']]);

						}else{
							return Redirect::to('/')->withErrors(['Datos invalidos, La contraseña no coincide']);
						}
					}else{
						return Redirect::to('/')->withErrors(['Datos invalidos, el email '.$request->input('email').' Ya existe en '.Session::get('app').'.']);
					}
				}else{
					//el usuario ya existe					 
					return Redirect::to('/')->withErrors(['Datos invalidos, el nombre de usuario '.$request->input('usuario').' Ya existe en '.Session::get('app').'.']);
				}
				
				
			}
    	}
    	
    	return Redirect::route('home');
    	
    }
}
