<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */

    protected $auth;
    
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next, $guard = null)
    {
        if ($this->auth->guest()) {
            /*
             * Si no esta logueado
             * Asignamos nombre de aplicación
             */         
            //dd($request);
            return redirect()->to('/')->with('alerta', ['La ruta suministrada solo puede accederce por los Usuarios de '.env('APP_NAME','Macalù').'.', 'Haste usuario de '.env('APP_NAME','Macalù').' en la Opción Registrate.'] );//esto es una direccion,return redirect()->to('ingreso');
            //return Redirect::route('home')->with('message', ['La ruta suministrada solo puede accederce por Usuarios', 'Haste usuario de ComprarJuntos en la Oción de Registro'] );
        }

        return $next($request);
    }
}
