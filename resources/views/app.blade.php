<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		
		<title>{!! Session::get('app') !!}</title>
		<meta name="description" content="Plaza de Mercado Virtual, donde crear una tienda virtual, ofrecer vender y comprar productos en Colombia" />
		<meta name="keywords" content="plaza virtual de mercado, Colombia, economía solidaria, crear una tienda virtual,vender online, comprar online, plaza Macalú para la economía el bien común" />

		<link rel="shortcut icon" href="{{ url('images/icons/icon.png') }}">		
		<link  rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}" type="text/css" />		

		<!--
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		-->
		
		@php ($style = "default")
		@if (Session::has('style'))
			@php ($style=Session::get('style'))
		@endif		
			
		<link  rel="stylesheet" href="{{ url('css/'.$style.'/app.css') }}" type="text/css" />		
		<link  rel="stylesheet" href="{{ url('css/jquery-ui.css') }}" type="text/css" />
		<link  rel="stylesheet" href="{{ url('css/bootstrap-submenu.min.css') }}" type="text/css" />		
		
		<!--Google analitycs-->
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-102562779-1', 'auto');
		  ga('send', 'pageview');
		</script>
		
	</head>
	
	<body >	
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container-fluid">			
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle Navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand nav-titulo" style="font-family: 'Calligraffitti';font-size:34px ;" href="{{ url('/') }}"><b>{{ Session::get('app') }}</b></a>					 
				</div>
				
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<!-- Usuario sin Loguear -->
				@if (Auth::guest())					
					<ul class="nav navbar-nav">
					<!--
					<li class="dropdown">					
						<a href="#" data-submenu="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" tabindex="0">Como Iniciar<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">							
							<li><a href="{{ url('/auth/logout') }}">Ser Un Tendero</a></li>							
							<li><a href="{{ url('/auth/logout') }}">Atender una Venta</a></li>
							<li><a href="{{ url('/auth/logout') }}">Crear un Grupo</a></li>											
						</ul>
					</li>				
					-->
					<!-- Social para web -->
					<li class="visible-lg">
						<a href="https://facebook.com/macaluplaza" data-toggle="modal" target="_blank" style="padding: 10px 0px 5px 7px;">
							{{ Html::image('images/icons/facebook_icon.png','www.facebook.com/macaluplaza',array( 'style'=>'width: auto; height: 39px;border-radius: 0%;' ))}}
						</a>
					</li>	
					<li class="visible-lg">
						<a href="https://www.youtube.com/channel/UC6VfuiG58SCtsDfbh8oifJA" data-toggle="modal" target="_blank" style="padding: 13px 0px 5px 7px;">
							{{ Html::image('images/icons/youtube_icon.png','www.facebook.com/macaluplaza',array( 'style'=>'width: auto; height: 33px;border-radius: 0%;' ))}}
						</a>
					</li>					
					

					</ul>
					<div class="visible-lg div-finder-conteiner">
						<div class="div-finder">
							{!! Form::open(array('url' => '/','method'=>'get','class'=>'navbar-form navbar-left visible-lg','onsubmit'=>'javascript:return seg_user.validateFinder()')) !!}
							   <div class="input-group " style="width: 35%;position: absolute;margin-left: 20%;">						   		
									{!! Form::text('finder','', array('class' => 'form-control','placeholder'=>'Busca Productos o Tiendas','style'=>'text-align: center;border: 1px solid #009999;}','maxlength' => 48)) !!}
									<span class="input-group-btn">
										<button class="btn btn-default btn-search" type="submit">Buscar!</button>
									</span>								
								</div>
						    {!! Form::close() !!}
					    </div>
				    </div>

				    <div class="visible-md div-finder-conteiner" style="margin-left: 30%;position: absolute;width: 35%;">
					    <div class="div-finder">					    
						   <div class="input-group" style="width: 100%;">					   		
						   		{!! Form::open(array('url' => '/','method'=>'get','class'=>'navbar-form navbar-left visible-md','onsubmit'=>'javascript:return seg_user.validateFinder()','style'=>'width: 100%;')) !!}
									{!! Form::text('finder','', array('class' => 'form-control','placeholder'=>'Busca Productos o Tiendas','style'=>'text-align: center;width: 70%;border: 1px solid #009999;','maxlength' => 48)) !!}
									<span class="input-group-btn">
										<button class="btn btn-default btn-search" type="submit">Buscar!</button>
									</span>							
								{!! Form::close() !!}
							</div>					    
					    </div>
				    </div>

				    <div class="visible-sm div-finder-conteiner" style="width: 35%;position: absolute;margin-left: 30%;">
			    		<div class="div-finder">				    					    
					   		<div class="input-group div-finder-conteiner" style="width: 100%;">
					   			{!! Form::open(array('url' => '/','method'=>'get','class'=>'navbar-form navbar-left visible-sm','onsubmit'=>'javascript:return seg_user.validateFinder()','style'=>'width: 100%;')) !!}	
									{!! Form::text('finder','', array('class' => 'form-control','placeholder'=>'Busca Productos o Tiendas','style'=>'text-align: center;width: 60%;border: 1px solid #009999;','maxlength' => 48)) !!}
									<span class="input-group-btn">
										<button class="btn btn-default btn-search" type="submit">Buscar!</button>
									</span>
								{!! Form::close() !!}							
							</div>
				    	</div>
				    </div>

					<ul class="nav navbar-nav navbar-right">				
						<li><a href="#" data-toggle="modal" data-target="#registry_modal" >Registrate</a></li>
						<li><a href="#" data-toggle="modal" data-target="#login_modal" >Ingresa</a></li>
						<li>
							<a href="#" id="cart_modal_a">		
								<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true" style = "font-size: 20px;"></span>
								<span style = "font-size: 16px;" >Carro</span>
								<span id="bange_cart" class="badge"></span>
							</a>
							
						</li>												
					</ul>
					<input type="hidden" name="value_login" id="value_login" value="0">
				@else
					<!-- Usuario Logueado -->
					<ul class="nav navbar-nav">
					<!-- Para pintar los modulos de las aplicaciones -->
					<!-- Para importar los js de los modulos -->
					@foreach (Session::get('comjunplus.usuario.permisos') as $llave_permiso => $permiso)
						
						<li>
							<a href="{{ url(json_decode($permiso['preferencias'])->js.'/listar/')}}">
								<span class="{{json_decode($permiso['preferencias'])->icono}}" aria-hidden="true" style = "font-size: 15px;"></span>
								<span>{{$permiso['aplicacion']}}</span>
							</a>
						
						<!-- Por cada categoria -->
						@foreach ($permiso['modulos'] as $llave_categoria => $categoria)
							<!-- Por cada modulo dentro de la categoria -->
							@foreach ($categoria as $llave_modulo => $modulo)
								<!-- Por cada opcion dentro del modulo -->
								<!-- Listamos opciones Si el modulo esta en esta ruta -->
								@if(Session::get('controlador') == json_decode($modulo['preferencias'])->controlador )
									@foreach ($modulo['opciones'] as $llave_opcion => $opcion)
									<!-- Se lista la opcion deacuerdo al modulo -->
										<li>											
											<a href="#">
												<div class="" id="btn_nueva_tienda" data-toggle="modal" data-target="#{{$opcion['accion']}}_modal">
												<span class="{{$opcion['icono']}}" aria-hidden="true" style = "font-size: 12px;"></span>
											<span>{{$opcion[$llave_opcion]}}</span>
											</div>
											</a>
										</li>
									
									@endforeach	
								@endif															
							
								<!-- Cargamos los js que hacer referencia alos modulos para el cliente -->
								{{ Html::script('js/'.json_decode($permiso['preferencias'])->js.'/'.json_decode($modulo['preferencias'])->js.'.js') }}
							@endforeach
						@endforeach
						</li>
					@endforeach				
					</ul>
					<div class="visible-lg div-finder-conteiner">
						<div class="div-finder">
							{!! Form::open(array('url' => '/','method'=>'get','class'=>'navbar-form navbar-left visible-lg','onsubmit'=>'javascript:return seg_user.validateFinder()')) !!}
							   <div class="input-group " style="width: 35%;position: absolute;margin-left: 15%;">						   		
									{!! Form::text('finder','', array('class' => 'form-control','placeholder'=>'Busca Productos o Tiendas','style'=>'text-align: center;border: 1px solid #009999;','maxlength' => 48)) !!}
									<span class="input-group-btn">
										<button class="btn btn-default btn-search" type="submit">Buscar!</button>
									</span>								
								</div>
						    {!! Form::close() !!}
					    </div>
				    </div>

				    <div class="visible-md div-finder-conteiner" style="margin-left: 30%;position: absolute;width: 35%;">
					    <div class="div-finder">					    
						   <div class="input-group" style="width: 100%;">					   		
						   		{!! Form::open(array('url' => '/','method'=>'get','class'=>'navbar-form navbar-left visible-md','onsubmit'=>'javascript:return seg_user.validateFinder()','style'=>'width: 100%;')) !!}
									{!! Form::text('finder','', array('class' => 'form-control','placeholder'=>'Busca Productos o Tiendas','style'=>'text-align: center;width: 70%;border: 1px solid #009999;','maxlength' => 48)) !!}
									<span class="input-group-btn">
										<button class="btn btn-default btn-search" type="submit">Buscar!</button>
									</span>							
								{!! Form::close() !!}
							</div>					    
					    </div>
				    </div>

				    <div class="visible-sm div-finder-conteiner" style="width: 35%;position: absolute;margin-left: 30%;">
			    		<div class="div-finder">				    					    
					   		<div class="input-group div-finder-conteiner" style="width: 100%;">
					   			{!! Form::open(array('url' => '/','method'=>'get','class'=>'navbar-form navbar-left visible-sm','onsubmit'=>'javascript:return seg_user.validateFinder()','style'=>'width: 100%;')) !!}	
									{!! Form::text('finder','', array('class' => 'form-control','placeholder'=>'Busca Productos o Tiendas','style'=>'text-align: center;width: 60%;border: 1px solid #009999;','maxlength' => 48)) !!}
									<span class="input-group-btn">
										<button class="btn btn-default btn-search" type="submit">Buscar!</button>
									</span>
								{!! Form::close() !!}							
							</div>
				    	</div>
				    </div>
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" data-submenu="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" tabindex="0">{{Session::get('comjunplus.usuario.name')}}<span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">							
								<!--
								<li>
									<a href="{{ url('/buzon/'.Session::get('comjunplus.usuario.id')) }}">
										<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>										
										<span class="" aria-hidden="true" style = "font-size: 10px;" >{{Session::get('comjunplus.usuario.messages')}}</span>
										Buzón de Mensajes
										<span class="badge">5</span>
									</a>
								</li>
								-->
								<li>
									<a href="{{ url('/perfil/'.Session::get('comjunplus.usuario.name')) }}">
										<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
										Perfil de Usuario
									</a>
								</li>							
								<li>
									<a href="{{ url('/salida/'.Session::get('comjunplus.usuario.id')) }}">
										<span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
										Salida Segura
									</a>
								</li>																		
							</ul>
						</li>
						<li>
							<a href="#" id="cart_modal_a">																
								<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true" style = "font-size: 20px;"></span>
								<span style = "font-size: 16px;">Carro</span>
								<span id="bange_cart" class="badge"></span>
																
							</a>							
						</li>				
					</ul>
					<input type="hidden" name="value_login" id="value_login" value="1">
				@endif				
				</div>
			</div>
		</nav>		
		<div class="container-fluid">
			@yield('content')
		</div>		

		<!-- Scripts -->		
		<script type="text/javascript" src="{{ url('js/jquery.min.js') }}"></script>
		<script type="text/javascript" src="{{ url('js/jquery-ui.js') }}"></script>
		<script type="text/javascript" src="{{ url('js/bootstrap.min.js') }}"></script>
		<script type="text/javascript" src="{{ url('js/bootstrap.submenu.min.js') }}"></script>		
		
		<script type="text/javascript" src="{{ url('js/seguridad/seg_user.js') }}"></script>
		<script type="text/javascript" src="{{ url('js/seguridad/seg_ajaxobject.js') }}"></script>
		
		<script type="text/javascript">	$('[data-submenu]').submenupicker();</script>
		<script type="text/javascript">	$('#cart_modal_a').on('click', function (e) { seg_user.openModalCart();});</script>
				
		@yield('modal')
		@yield('script')
		
	</body>
	<footer>
		<div class="form-group">
			<div class="col-md-12 col-md-offset-0" style="text-align: center;">
				<p>© 2017 {{ Session::get('copy') }}, Inc.</p>
			</div>		
		</div>	
	</footer>
 </html>