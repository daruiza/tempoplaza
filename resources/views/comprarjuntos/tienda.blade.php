@extends('app')

@section('content')
	<style>
		.input_danger{
			color: #a94442;
    		background-color: #f2dede;
    		border-color: #ebccd1;
		}
		.option_store{
			text-align: center;
			cursor:pointer;			
		}

		.option_store a{
			text-decoration:none;			
		}

		.option_store_icon{
			font-size: 17px;
		}
		.option_store:hover{			
			color: #000 !important;
		}
		.option_store a:hover{			
			color: #000 !important;
		}
		.modal-header a:hover{
			color: #333 !important;
		}
		
		.chosen-container .chosen-container-multi{
			border: 1px solid #ccc !important;
			border-radius: 4px !important;
		}
		.categorias{
			width: 100% !important;
			border-radius: 4px !important;
			position: relative !important;
			min-height: 1px !important;
			padding-right: 15px !important;
			padding-left: 15px !important;			
		}
		td.details-control {
			/*
			position: relative;
		    top: 1px;
		    display: inline-block;
		    font-family: 'Glyphicons Halflings';
		    font-style: normal;
		    font-weight: 400;
		    line-height: 1;
		    -webkit-font-smoothing: antialiased;
		    content: "\e134";
		    */
		}

		td.details-control {
		    background: url('../css/DataTables-1.10.11/images/details_open.png') no-repeat center center;
		    cursor: pointer;
		}
		tr.shown td.details-control {
		    background: url('../css/DataTables-1.10.11/images/details_close.png') no-repeat center center;
		}
		.product_more{
			text-align: justify;
		}
		.glyphicon-star{
			color: #ffcc00;
		}
		.btn{
			font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
			font-size: 14px;
			border-color: #449aa2;
		}
		
		
	</style>
	<link  rel="stylesheet" href="{{ url('css/bootstrap-colorpicker.min.css') }}" type="text/css" />
	<link  rel="stylesheet" href="{{ url('css/chosen.css') }}" type="text/css" />
	<link  rel="stylesheet" href="{{ url('css/bootstrap-social.css') }}" type="text/css" />
	<link  rel="stylesheet" href="{{ url('css/font-awesome.css') }}" type="text/css" />

	<div class="row visible-lg" style="margin-top: 5%;"></div>
	<div class="row visible-md" style="margin-top: 7%;"></div>
	<div class="row visible-sm" style="margin-top: 10%;"></div>
	<div class="row visible-xs" style="margin-top: 16%;"></div>
	
	<div class="row">	
		<div class="alerts col-md-12 col-md-offset-0">
		<!-- $error llega si la función validator falla en autenticar los datos -->
			@if (count($errors) > 0)
				<div class="alert alert-danger alert-dismissible fade in" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<strong>Algo no va bien con el acceso!</strong> Hay problemas con los datos diligenciados.
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
			
			@if(Session::has('message'))
				<div class="alert alert-info alert-dismissible fade in" role="alert" >
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<strong>¡Operación exitosa!</strong>  El proceso se ha ejecutado adecuadamente.<br>
					<ul>
						@foreach (Session::get('message') as $message)
							@if ($message  == 'Tiendas0')
								<li style="display: inline-flex;"> {{Session::get('comjunplus.usuario.names')}}, no tienes ninguna tienda que administar. No esperes màs y crea una dando click en la opciòn.&nbsp;<a href="#"><div class="" id="btn_nueva_tienda_a" data-toggle="modal" data-target="#nuevatienda_modal"><b> Crear una tienda</b></div></a> </li>
							@elseif ($message  == 'ProductosOK' || $message  == 'ProductosEDITOK' )						
							@else
								<li>{{ $message }}</li>
							@endif
						@endforeach								
														
					</ul>
				</div>
		                
			@endif
			
			@if(Session::has('alerta'))
				<div class="alert alert-warning alert-dismissible fade in" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<strong>¡Algo no va bien!</strong>  El proceso no se ejecuto correctamente.<br>			
					<ul>								
						@foreach (Session::get('alerta') as $alerta)
							<li>{{ $alerta }}</li>
						@endforeach															
					</ul>
				</div>                
			@endif		            
			
		    @if(Session::has('error'))
				<div class="alert alert-danger alert-dismissible fade in" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<strong>¡Algo no va bien!</strong>  El proceso no pudo ejecutarce.<br>
					<ul>								
						@foreach (Session::get('error') as $error)
							@if ($error  == 'Productos0')
							@else
								<li>{{ $error }}</li>
							@endif						
					@endforeach															
					</ul>				
				</div>                
			@endif
		</div>
	</div>

	<!--Listar las tiendas-->
	<div class="col-md-12 col-md-offset-0">
		@foreach(Session::get('modulo.tiendas') as $tienda)		
			<div class="col-md-2 col-mx-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading" style="background-color:{{$tienda->color_one}}; color: {{$tienda->color_two}}; border-color:{{$tienda->color_two}};">{{$tienda->name}}
						@if($tienda->status == 'Activa')
							<span class="glyphicon glyphicon-ok" aria-hidden="true" style="float: right;font-size: 20px;" data-toggle="tooltip" title="{{$tienda->status}}"></span>
						@else
							<span class="glyphicon glyphicon-remove" aria-hidden="true" style="float: right;font-size: 20px;" data-toggle="tooltip" title="{{$tienda->status}}"></span>
						@endif
						
					</div>
				    <div class="panel-body">
				    	<div class="row">
				    		<div class="col-md-12">
				    			<a href="{{url('/'.$tienda->name)}}">
				    				{{ Html::image('users/'.Session::get('comjunplus.usuario.name').'/stores/'.$tienda->image,'Imagen no disponible',array( 'style'=>'width: 100%;height: 150px;border-radius: 0%;' ))}}    				
				    			</a>				    			
				    		</div>
				    	</div>
				    </div>
				    <div class="panel-footer " style="background-color:{{$tienda->color_one}}; color: {{$tienda->color_two}}; border-color:
				    	{{$tienda->color_two}};">
				    	<div class="row">
				    		<div class="col-md-3 col-mx-offset-0 option_store" style="color:{{$tienda->color_two}};">
				    			<a href="{{url('/mistiendas/actualizar/'.$tienda->id.'/'.Session::get('comjunplus.usuario.id'))}}" style="color:{{$tienda->color_two}};">
				    				<span class="glyphicon glyphicon-cog option_store_icon" aria-hidden="true"></span>
				    				<div style="font-size: 10px;">Editar Tienda</div>
				    			</a>
				    		</div>
				    		<div class="col-md-3 col-mx-offset-0 option_store option_products" style="color:{{$tienda->color_two}};" id ="prod_{{$tienda->name}}_{{$tienda->id}}">
				    			<span class="glyphicon glyphicon-th option_store_icon" aria-hidden="true"></span>
				    			<div style="font-size: 10px; margin-left: -10px;">Productos</div>
				    		</div>
				    		<div class="col-md-3 col-mx-offset-0 option_store option_order" style="color:{{$tienda->color_two}};" id ="order_{{$tienda->name}}_{{$tienda->id}}">				    			
				    			<span class="glyphicon glyphicon-book option_store_icon"  aria-hidden="true"></span>
				    			<div style="font-size: 10px;">Pedidos</div>
				    		</div>
				    		<div class="col-md-3 col-mx-offset-0 option_store option_ver" style="color:{{$tienda->color_two}};">
				    			<a href="{{url('/'.$tienda->name)}}" style="text-decoration:none; color:{{$tienda->color_two}};">
				    				<span class="glyphicon glyphicon-tags option_store_icon" aria-hidden="true"></span>
				    				<div style="font-size: 10px;">Reseñas</div>
				    			</a>	
				    		</div>				    		
				    	</div>				    	
				    </div>
			   </div>				
			</div>			
		@endforeach
	</div>

@endsection

@section('modal')	
	<!-- Modal crear tienda -->
	<div class="modal fade" id="nuevatienda_modal" role="dialog" >
		<div class="modal-dialog modal-lg">
		 <!-- Modal content-->
	      <div class="modal-content">
	      	<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">@if(Session::has('_old_input.edit')) Editar @else Nueva @endif Tienda</h4>
			</div>
			<div class = "alerts-module"></div>
			{!! Form::open(array('url' => Session::get('controlador').'nuevatienda', 'id'=>'form_nueva_tienda','files'=>true,'onsubmit'=>'javascript:return clu_tienda.validateNuevaTienda()')) !!}
			<div class="modal-body">
				<ul class="nav nav-tabs">
					<li role="presentation" class="active"><a href="#tab1" data-toggle="tab">Informaciòn Basica</a></li>
					<li role="presentation"><a href="#tab2" data-toggle="tab">Infomaciòn Complementaria</a></li>
					@if(Session::has('_old_input.edit'))
						<li role="presentation"><a href="#tab3" data-toggle="tab">Infomaciòn de Interes</a></li>
					@endif			
				</ul>
				<div class="tab-content">					
					<div class="tab-pane fade in active" id="tab1">
						<div class="row">
							<div class="col-md-12 col-md-offset-0 row_init">								
								<div class="row col-md-12 ">
									<div class="col-md-8">
										<div class="col-md-6">
											<div class="form-group ">
												{!! Form::label('nombre', 'Nombre', array('class' => 'col-md-12 control-label')) !!}
												<div class="col-md-12">
													{!! Form::text('nombre',old('nombre'), array('class' => 'form-control','placeholder'=>'Ingresa el Nombre o La Razòn Social')) !!}
												</div>

												{{--
													{!! Form::label('nit', 'NIT', array('class' => 'col-md-12 control-label')) !!}
													<div class="col-md-12">
														{!! Form::text('nit',old('nit'), array('class' => 'form-control','placeholder'=>'Nùmero de identificaciòn Tributaria')) !!}
													</div>
												--}}

												{!! Form::label('departamento', 'Departamento', array('class' => 'col-md-12 control-label')) !!}
												<div class="col-md-12">
													{!! Form::select('departamento',Session::get('modulo.departamentos'),old('departamento'), array('class' => 'form-control','placeholder'=>'Departamento de Tienda')) !!}
												</div>
												
												{!! Form::label('municipio', 'Municipio', array('class' => 'col-md-12 control-label')) !!}
												<div class="col-md-12">
													{!! Form::select('municipio',Session::get('modulo.ciudades'),old('municipio'), array('class' => 'form-control','placeholder'=>'Municipio de Tienda')) !!}
												</div>
												
												{!! Form::label('direccion', 'Dirección', array('class' => 'col-md-12 control-label')) !!}
												<div class="col-md-12">
													{!! Form::text('direccion',old('direccion'), array('class' => 'form-control','placeholder'=>'Dirección de Tienda')) !!}
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group ">
												
												{!! Form::label('color_uno', 'Color Primario', array('class' => 'col-md-12 control-label')) !!}
												<div class="col-md-12">
													<div id="cp1" class="input-group colorpicker-component">
														@if(old('color_uno'))
															{!! Form::text('color_uno',old('color_uno'), array('class' => 'form-control sample-selector','placeholder'=>'Color Primario de tu tienda')) !!}
														@else
															{!! Form::text('color_uno','#ddd', array('class' => 'form-control sample-selector','placeholder'=>'Color Primario de tu tienda')) !!}
														@endif
														
														<span class="input-group-addon"><i></i></span>
													</div>
												</div>

												{!! Form::label('color_dos', 'Color Secundario', array('class' => 'col-md-12 control-label')) !!}
												<div class="col-md-12">
													<div id="cp2" class="input-group colorpicker-component">
														@if(old('color_dos'))
															{!! Form::text('color_dos',old('color_dos'), array('class' => 'form-control sample-selector','placeholder'=>'Color Secundario de tu tienda')) !!}											
														@else
															{!! Form::text('color_dos','#777', array('class' => 'form-control sample-selector','placeholder'=>'Color Secundario de tu tienda')) !!}											
														@endif
														<span class="input-group-addon"><i></i></span>
													</div>
												</div>

												{!! Form::label('descripcion', 'Descripciòn', array('class' => 'col-md-12 control-label')) !!}
												<div class="col-md-12">
													{!! Form::textarea('descripcion',old('descripcion'), array('class' => 'form-control','rows' => 3,'placeholder'=>'Descripciòn de tu Tienda','maxlength' => 256)) !!}
												</div>

											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group ">
												{!! Form::label('categorias', 'Categorias', array('class' => 'col-md-12 control-label')) !!}
												<div class="input-group input-grp categorias col-md-12">		
													{!! Form::select('categorias_select',Session::get('modulo.categorias'),old('categorias_select'), array('id'=>'categorias_select','class' => 'form-control chosen-select','multiple' ,'data-placeholder'=>'Selecciona las categorias','tabindex'=>'4', 'style'=>'width:350px;')) !!}
													{!! Form::hidden('categorias',old('categorias'),array('id'=>'categorias')) !!}
												</div>											
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group" >
											<div class="col-md-12" style="text-align: center; margin-bottom: 9px;">
												{!! Form::label('img_store', 'Logo o Imagen de Tienda', array('class' => 'col-md-12 control-label')) !!}
												@if( old('img_store'))
													{{ Html::image('users/'.Session::get('comjunplus.usuario.name').'/stores/'.old('img_store'),'Imagen no disponible',array( 'style'=>'width: 90%; border:2px solid #ddd;border-radius: 0%;'))}}
												@else
													{{ Html::image('users/'.Session::get('comjunplus.usuario.name').'/stores/default.png','Imagen no disponible',array( 'style'=>'width: 90%; border:2px solid #ddd;border-radius: 0%;'))}}
												@endif												
											</div>
											<div  class="col-md-12 filestyle">
												{!! Form::file('image_store',array('id'=>'image_store','style'=>'font-size: 14px;')) !!}
											</div>
											<div class="col-md-12" style="margin-top: 28px;">		
												<button id="to_tab2" type="button" class="btn btn-default" style="width: 100%;">Siguiente >></button>
											</div>
											
										</div>
									</div>
								</div>
								
							</div>
						</div>
					</div>
					<div class="tab-pane fade " id="tab2">
						<div class="row ">
							<div class="col-md-12 col-md-offset-0 row_init">								
								<div class="row col-md-12 ">
									<div class="col-md-4">
										<div class="form-group ">
											<label for="sitio_web" class="col-md-12 control-label"><span class="fa fa-soundcloud"></span>  Sitio Web</label>												
											<div class="col-md-12">
												{!! Form::text('sitio_web',old('sitio_web'), array('class' => 'form-control','placeholder'=>'URL del sitio de tu tienda')) !!}
											</div>

											<label for="facebook_web" class="col-md-12 control-label"><span class="fa fa-facebook"></span>  Pàgina de Facebook</label>
											<div class="col-md-12">
												{!! Form::text('facebook_web',old('facebook_web'), array('class' => 'form-control','placeholder'=>'URL de la FanPage de Facebook')) !!}
											</div>

											<label for="movil" class="col-md-12 control-label"><span class="fa fa-whatsapp"></span>  Movil WhatsUP</label>											
											<div class="col-md-12">
												{!! Form::text('movil',old('movil'), array('id' => 'movil' , 'class' => 'form-control solo_numeros','placeholder'=>'Ìngresa un nùmero de Celular')) !!}
											</div>

											<label for="ubicacion" class="col-md-12 control-label"><span class="fa fa-google"></span>  Ubicaciòn</label>											
											<div class="col-md-12">
												<div class="input-group">	
													{!! Form::text('ubicacion',old('ubicacion'), array('class' => 'form-control','placeholder'=>'Ubicaciòn en Google Maps')) !!}
													<span class="input-group-addon" style="cursor: pointer;"  data-toggle="modal" data-target="#guiaubicacion_modal">?</span>
												</div>
											</div>

											{!! Form::label('prioridad', 'Prioridad' , array('class' => 'col-md-12 control-label')) !!} 
											<div class="col-md-12">
												<div class="input-group ">									
													{!! Form::text('prioridad',old('prioridad'), array('class' => 'form-control solo_numeros','placeholder'=>'Prioridad de la Tienda para Macalú')) !!}
													<span class="input-group-addon" data-toggle="tooltip" title="La prioridad es un nùmero que indica el orden en el cual se listaran las tiendas dentro de Macalú.">?</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-8">
										<div class="form-group " style="text-align: center;";>
											{!! Form::label('img_banner', 'Imagen Tipo Banner' , array('class' => 'col-md-12 control-label')) !!}
											<div class="col-md-12">
												Un Banner es una imagen ubicada en la parte superior de la tienda, su objetivo es dar la bienvenida a los visitantes, la cùal puede tratarse de un mensaje de amor y paz, una promociòn o una metafora visual de la mision y la visiòn de la tienda.
											</div>

											<div class="col-md-12" style="text-align: center; margin-bottom: 9px; margin-top: 9px;">
												@if( old('img_banner'))
													{{ Html::image('users/'.Session::get('comjunplus.usuario.name').'/banners/'.old('img_banner'),'Imagen no disponible',array( 'style'=>'width: 90%; border:2px solid #ddd;border-radius: 0%;'))}}
												@else
													{{ Html::image('users/'.Session::get('comjunplus.usuario.name').'/banners/default.png','Imagen no disponible',array( 'style'=>'width: 90%; border:2px solid #ddd;border-radius: 0%;'))}}
												@endif
											</div>
											<div class="col-md-12 filestyle" style="text-align: center;">
												{!! Form::file('image_banner',array('id'=>'image_banner','style'=>'font-size: 14px;')) !!}
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					@if(Session::has('_old_input.edit'))
					<div class="tab-pane fade " id="tab3">
						<div class="row ">
							<div class="col-md-12 col-md-offset-0 row_init">								
								<div class="row col-md-12 ">
									<div class="col-md-4">
										<div class="form-group ">
											{!! Form::label('estado', 'Estado', array('class' => 'col-md-12 control-label')) !!}
											<div class="col-md-12">											
											@if(old('status') == 'Activa' )												
												<div>{{Form::radio('estado', 'Activa', true)}} Activa</div>
												<div>{{Form::radio('estado', 'Desactiva', false)}} Desactiva</div>		
											@else
												<div>{{Form::radio('estado', 'Activa', false)}} Activa</div>
												<div>{{Form::radio('estado', 'Desactiva', true)}} Desactiva</div>
											@endif											
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>											
					</div>
					@endif				
				</div>				
			</div>
			{!! Form::hidden('edit', old('edit')) !!}
			{!! Form::hidden('store_id', old('store_id')) !!}
			{!! Form::close() !!}
			<div class="modal-footer">
		          <button type="submit" form = "form_nueva_tienda" class="btn btn-default " > @if(Session::has('_old_input.edit')) Editar @else Crear @endif Tienda</button>
		          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>		                  
		        </div>
	      	</div>
		</div>
	</div>

	<div class="modal fade" id="guiaubicacion_modal" role="dialog" >
		<div class="modal-dialog modal-lg">
		 <!-- Modal content-->
	      <div class="modal-content">
	      	<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Guia para el Campo Ubicaciòn de una Tienda</h4>
			</div>
			<div class = "alerts-module"></div>
			<div class="modal-body">
				<div class="row ">
					<div class="col-md-12 col-md-offset-0 row_init">
					</div>
				</div>
			</div>
			<div class="modal-footer">		         
		          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>		                  
		        </div>
	      	</div>
		</div>
	</div>

	<div class="modal fade" id="productos_modal" role="dialog" >
		<div class="modal-dialog modal-lg">
		 <!-- Modal content-->
	    	<div class="modal-content">
		      	<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Productos Tienda</h4>
					<a href="#" style="text-decoration: none; color: #777">
					<div class="" id="btn_nuevo_producto" data-toggle="modal" data-target="#nuevoproducto_modal">
						<span class="glyphicon glyphicon-plus" aria-hidden="true" style="font-size: 12px;"></span>
						<span>Crear un Producto</span>
					</div>
					</a>
				</div>
				<div class = "alerts-module"></div>
				<div class="modal-body">
					<div class="row ">
						<div class="col-md-12 col-md-offset-0 row_init">
							<table id="table_prods" class="display responsive no-wrap " cellspacing="0" width="100%">
						         <thead>
						            <tr>
						            	<th></th>					            	
				            			<th>Nombre</th>
				            			<th>Precio</th>
				            			<th>Categorìa</th>
				            			<th>Unidades de Venta</th>
				            			<th>Estado</th>
						            </tr>
						        </thead>              
						    </table> 
						</div>
					</div>
				</div>
				<div class="modal-footer">				
			        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
		        </div>
	      	</div>
		</div>
	</div>

	<div class="modal fade" id="nuevoproducto_modal" role="dialog" >
		<div class="modal-dialog">
			<div class="modal-content">
		      	<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 id="modal-title-product" class="modal-title">Nuevo Producto</h4>				
				</div>
				<div class = "alerts-module"></div>
				{!! Form::open(array('url' => Session::get('controlador').'nuevoproducto', 'id'=>'form_nuevo_producto','files'=>true,'onsubmit'=>'javascript:return clu_tienda.validateNuevoProducto()')) !!}
				<div class="modal-body">
					<ul class="nav nav-tabs">
						<li role="presentation" class="active"><a href="#tab_prod1" data-toggle="tab">Informaciòn Basica</a></li>
						<li role="presentation"><a href="#tab_prod2" data-toggle="tab">Infomaciòn Complementaria</a></li>			
					</ul>
					<div class="tab-content">					
						<div class="tab-pane fade in active" id="tab_prod1">
							<div class="row ">
								<div class="col-md-12 col-md-offset-0 row_init">								
									<div class="row col-md-12 ">
										<div class="col-md-6">
											<div class="form-group ">
												{!! Form::label('nombre_producto', 'Nombre', array('class' => 'col-md-12 control-label')) !!}
												<div class="col-md-12">
													{!! Form::text('nombre_producto',old('nombre_producto'), array('class' => 'form-control','placeholder'=>'Ingresa el Nombre')) !!}
												</div>
												{!! Form::label('precio', 'Precio', array('class' => 'col-md-12 control-label')) !!}
												<div class="col-md-12">
													{!! Form::text('precio',old('precio'), array('class' => 'form-control solo_numeros','placeholder'=>'Ingresa precio sin puntos ni comas')) !!}
												</div>
												{!! Form::label('categoria', 'Categoria', array('class' => 'col-md-12 control-label')) !!}
												<div class="input-group categorias input-grp col-md-12">		
													{!! Form::select('categoria_select',array(),old('categoria_select'), array('id'=>'categoria_select', 'class' => 'form-control chosen-select', 'style'=>'width:350px;')) !!}						
												</div>
												{!! Form::label('descripcion_producto', 'Descripciòn', array('class' => 'col-md-12 control-label')) !!}
												<div class="col-md-12">
													{!! Form::textarea('descripcion_producto',old('descripcion_producto'), array('class' => 'form-control','rows' => 2,'placeholder'=>'Descripciòn de tu Producto')) !!}
												</div>
												{!! Form::label('prioridad_producto', 'Prioridad' , array('class' => 'col-md-12 control-label')) !!} 
												<div class="col-md-12">
													<div class="input-group">									
														{!! Form::text('prioridad_producto',old('prioridad_producto'), array('class' => 'form-control solo_numeros','placeholder'=>'Prioridad del Producto')) !!}
														<span class="input-group-addon" data-toggle="tooltip" title="La prioridad es un nùmero que indica el orden en el cual se listaran los productos en la Tienda">?</span>
													</div>
												</div>										
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group ">
												<div class="col-md-12" style="text-align: center;">
													{!! Form::label('img_product', 'Imagen de Producto', array('class' => 'col-md-12 control-label')) !!}
													@if( old('img_product'))
														{{ Html::image('users/'.Session::get('comjunplus.usuario.name').'/products/'.old('img_product'),'Imagen no disponible',array('id'=>'img_product', 'style'=>'width: 90%; border:2px solid #ddd;border-radius: 0%;'))}}
													@else
														{{ Html::image('users/'.Session::get('comjunplus.usuario.name').'/products/default.png','Imagen no disponible',array('id'=>'img_product','style'=>'width: 90%; border:2px solid #ddd;border-radius: 0%;'))}}
													@endif
												</div>
												<div class="col-md-12 filestyle" style="text-align: center; margin-top: 10px">
													{!! Form::file('imge_product',array('id'=>'imge_product','style'=>'font-size: 13px;')) !!}
												</div>
												<div class="col-md-12" style="margin-top: 28px;">		
													<button id="to_prod2" type="button" class="btn btn-default" style="width: 100%;">Siguiente >></button>
												</div>
											</div>
										</div>
									</div>
								</div>								
							</div>
						</div>
						<div class="tab-pane fade " id="tab_prod2">
							<div class="row ">
								<div class="col-md-12 col-md-offset-0 row_init">								
									<div class="row col-md-12 ">
										<div class="col-md-12">
											<div class="form-group ">
												{!! Form::label('unidades_medida', 'Unidad de Medida', array('class' => 'col-md-12 control-label')) !!}
												<div class="input-group input-grp categorias col-md-12">		
													{!! Form::select('unidades_select',array('Unidad'=>'Unidad','Paquete'=>'Paquete','Paca'=>'Paca','Bolsa'=>'Bolsa','Bulto'=>'Bulto','Litro'=>'Litro','Kilo'=>'Kilo','Metro'=>'Metro'),old('unidades_select'), array('id'=>'unidades_select','class' => 'form-control chosen-select' ,'data-placeholder'=>'Selecciona las categorias','tabindex'=>'4', 'style'=>'width:350px;')) !!}
													{!! Form::hidden('unidades_medida',old('unidades_medida'),array('id'=>'unidades_medida')) !!}													
												</div>

												{!! Form::label('colores', 'Colores Disponibles', array('class' => 'col-md-12 control-label')) !!}
												<div class="input-group input-grp categorias col-md-12">		
													{!! Form::select('colores_select',array('Amarillo'=>'Amarillo','Azùl'=>'Azùl','Rojo'=>'Rojo','Verde'=>'Verde','Naranjado'=>'Naranjado','Violeta'=>'Violeta','Rosado'=>'Rosado','Blanco'=>'Blanco','Negro'=>'Negro','Gris'=>'Gris','Cafe'=>'Cafe','Beis'=>'Beis'),old('colores_select'), array('id'=>'colores_select','class' => 'form-control chosen-select','multiple' ,'data-placeholder'=>'Selecciona los colores','tabindex'=>'4', 'style'=>'width:350px;')) !!}
													{!! Form::hidden('colores',old('colores'),array('id'=>'colores')) !!}
													<span class="input-group-addon" data-toggle="tooltip" title="Los colores en los que se puede adquirir este producto.">?</span>
												</div>

												{!! Form::label('tallas', 'Tallas o Tamaños Disponibles', array('class' => 'col-md-12 control-label')) !!}
												<div class="input-group input-grp categorias col-md-12">		
													{!! Form::select('tallas_select',array('Grande'=>'Grande','Mediano'=>'Mediano','Pequeño'=>'Pequeño','S'=>'S','L'=>'L','M'=>'M','XS'=>'XS','XM'=>'XM','XL'=>'XL','Docena'=>'Docena'),old('tallas_select'), array('id'=>'tallas_select','class' => 'form-control chosen-select','multiple' ,'data-placeholder'=>'Selecciona los colores','tabindex'=>'4', 'style'=>'width:350px;')) !!}
													{!! Form::hidden('tallas',old('tallas'),array('id'=>'tallas')) !!}
													<span class="input-group-addon" data-toggle="tooltip" title="Las Tallas disponibles para la venta de este producto.">?</span>
												</div>

												{!! Form::label('sabores', 'Sabores Disponibles', array('class' => 'col-md-12 control-label')) !!}
												<div class="input-group input-grp categorias col-md-12">		
													{!! Form::select('sabores_select',array('Amargo'=>'Amargo','Âcido'=>'Âcido','Dulce'=>'Dulce','Salado'=>'Salado','Ezimàtico'=>'Ezimàtico','Picante'=>'Picante'),old('sabores_select'), array('id'=>'sabores_select','class' => 'form-control chosen-select','multiple' ,'data-placeholder'=>'Selecciona los colores','tabindex'=>'4', 'style'=>'width:350px;')) !!}
													{!! Form::hidden('sabores',old('sabores'),array('id'=>'sabores')) !!}
													<span class="input-group-addon" data-toggle="tooltip" title="Los Sabores en los que se puede consumir este producto.">?</span>
												</div>

												{!! Form::label('materiales', 'Materiales Disponibles', array('class' => 'col-md-12 control-label')) !!}
												<div class="input-group input-grp categorias col-md-12">		
													{!! Form::select('materiales_select',array('Madera'=>'Madera','Piedra'=>'Piedra','Metal'=>'Metal','Plastico'=>'Plastico','Textil'=>'Textil','Ceramica'=>'Ceramica','Fibra'=>'Fibra','Vidrio'=>'Vidrio','Papel'=>'Papel','Marmol'=>'Marmol','Barro'=>'Barro'),old('materiales_select'), array('id'=>'materiales_select','class' => 'form-control chosen-select','multiple' ,'data-placeholder'=>'Selecciona los colores','tabindex'=>'4', 'style'=>'width:350px;')) !!}
													{!! Form::hidden('materiales',old('materiales'),array('id'=>'materiales')) !!}
													<span class="input-group-addon" data-toggle="tooltip" title="Los diferentes materiales en los cuales se puede adquirir el producto; por ejemplo, en una floristeria se vende un mismo diseño de florero en dos materiales diferentes: barro y metal.">?</span>
												</div>

												{!! Form::label('modelos', 'Modelo', array('class' => 'col-md-12 control-label')) !!}
												<div class="col-md-12">
													<div class="input-group">
														{!! Form::text('modelos',old('modelos'), array('class' => 'form-control','placeholder'=>'Ingresa el o los modelos en los cuales esta disponible el producto.')) !!}
														<span class="input-group-addon" data-toggle="tooltip" title="Para diligenciar adecuadamente este campo, ponemos una coma entre modelo y modelo; ejemplo; Modelo 2016, Modelo 2015, Modelo 2000.">?</span>
													</div>
												</div>
												<div class="col-md-12 estado-roduct" style="display:none">
													{!! Form::label('estado', 'Estado', array('class' => 'col-md-12 control-label')) !!}
													<div>{{Form::radio('estado_producto', '1', true)}} Activo</div>
													<div>{{Form::radio('estado_producto', '0', false)}} Desactivo</div>
												</div>

											</div>
										</div>										
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				{!! Form::hidden('edit_product', old('edit_product')) !!}
				{!! Form::hidden('product_id', old('product_id')) !!}
				{!! Form::close() !!}
				<div class="modal-footer">
					 <button type="submit" form = "form_nuevo_producto" id="modal-button-product" class="btn btn-default " > Crear Producto</button>			
			        <button type="button" id="bnt-close-products" class="btn btn-default" data-dismiss="modal">Cancelar</button>		                  
		        </div>
	      	</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="odenes_modal" role="dialog" >
		<div class="modal-dialog modal-lg">
		 <!-- Modal content-->
	    	<div class="modal-content">
		      	<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Pedidos Tienda</h4>				
				</div>
				<div class = "alerts-module"></div>
				<div class="modal-body">
					<div class="row ">
						<div class="col-md-12 col-md-offset-0 row_init">
							<table id="table_orders" class="display responsive no-wrap " cellspacing="0" width="100%">
						         <thead>
						            <tr>
						            	<th></th>					            	
				            			<th>Número</th>
				            			<th>Fecha</th>
				            			<th>Cliente</th>
				            			<!--
				            			<th>Dirección</th>
				            			<th>Correo</th>
				            			<th>Contacto</th>
				            			-->
				            			<th>Estado</th>
						            </tr>
						        </thead>              
						    </table> 
						</div>
					</div>
				</div>
				<div class="modal-footer">				
			        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		        </div>
	      	</div>
		</div>
	</div>

	<div class="modal fade" id="confirm_order" role="dialog" >
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
			 		<div class="row ">
			 			<div class="col-md-12 col-md-offset-0 row_init">
							Agrega un Mensaje para el Cliente ante el cambio de estado de esta Orden.
							{!! Form::textarea('message_order',null, array('class' => 'form-control','rows' => 3,'placeholder'=>'Este mensaje llegara al correo electronico del cliente asosciado a esta orden de pedido.')) !!}
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn btn-default" id="continue_order">Continuar</button>
					<!--<button type="button" data-dismiss="modal" class="btn btn-default">Cancelar</button>-->
				</div>
		 	</div>
	  	</div>
	</div>

	<!-- Form en blanco para consultar Ciudades -->
	{!! Form::open(array('id'=>'form_consult_city','url' => 'user/consultarcity')) !!}		
    {!! Form::close() !!}

    {!! Form::open(array('id'=>'form_consult_products','url' => 'mistiendas/consultarproducts')) !!}
    {!! Form::close() !!}

    {!! Form::open(array('id'=>'form_consult_product','url' => 'mistiendas/consultarproduct')) !!}
    {!! Form::close() !!}

    {!! Form::open(array('id'=>'form_consult_orders','url' => 'mistiendas/consultarorders')) !!}
    {!! Form::close() !!}

    {!! Form::open(array('id'=>'form_consult_order','url' => 'mistiendas/consultarorder')) !!}
    {!! Form::close() !!}

    {!! Form::open(array('id'=>'form_stage_order','url' => 'mistiendas/cambioestadoorder')) !!}
    {!! Form::close() !!}

@endsection

@section('script')
	<script type="text/javascript" src="{{ url('js/bootstrap-colorpicker.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('js/chosen.jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('js/bootstrap-filestyle.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('js/spin.min.js') }}"></script>
	<script type="text/javascript">
		//cambio de municipio ante el cambio del departamento
		$( "#departamento" ).change(function() {
			var datos = new Array();
			datos['id'] =$( "#departamento option:selected" ).val();			   
			seg_ajaxobject.peticionajax($('#form_consult_city').attr('action'),datos,"seg_user.consultaRespuestaCity");
		});
		
		//estilo de titulos
		$('[data-toggle="tooltip"]').tooltip();

		//estilo de selectores de imagen
		$(":file").filestyle({buttonText: "Elige una Imagen"});
		
		$('#cp1').colorpicker({ /*options...*/ });
		$('#cp2').colorpicker({ /*options...*/ });
		$('.sample-selector').colorpicker({ /*options...*/ });
		
		//boton siguiente tienda
		$('#to_tab2').on('click', function (e) {
		    $('.nav-tabs a[href="#tab2"]').tab('show');
		});

		//boton siguiente producto
		$('#to_prod2').on('click', function (e) {
		    $('.nav-tabs a[href="#tab_prod2"]').tab('show');
		});

		//Consultar los productos de la tienda, listado
		$('.option_products').on('click', function (e) {
			var datos = new Array();
			datos['id'] = this.id.split('_')[2];
			datos['name'] = this.id.split('_')[1];				
		    seg_ajaxobject.peticionajax($('#form_consult_products').attr('action'),datos,"clu_tienda.consultaRespuestaProducts",false);

		    //llamado sincrono, para cambiar el id de tienda
		    //la otra opciòn es retardar el listado de las los productos

		    javascript:clu_tienda.table_products = $('#table_prods').DataTable( {		
			    "responsive": true,
			    "columnDefs": [
			        { responsivePriority: 1, targets: 0 },
			        { responsivePriority: 2, targets: 0 }
	    		],
			    "processing": true,
			    "bLengthChange": false,
			    "serverSide": true,
			    "bDestroy": true,      
			    "ajax": "{{url('mistiendas/listarajax')}}",
			    "iDisplayLength": 15,     	       
			    "columns": [
			    	{
		                "className":      'details-control',
		                "orderable":      false,
		                "data":           null,
		                "defaultContent": ''
		            },		   
					{ "data": "name"},
					{ "data": "price"},		        
					{ "data": "category_name"},  	    
			        { "data": "unity_measure"},
			        { "data": "active",render: function ( data, type, row ) {
		        		if (data == 1) {
		                    return 'Activo';
	                    }else{
		                    return 'Desactivo';
	                    }
			        	}
			    	}               
			    ],       
			    "language": {
			        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
			    },
			});

			//metodo para la tabla
			$('#table_prods tbody').on('click', 'td.details-control', function () {
				//cerramos el div anterior
				if(clu_tienda.tr != undefined){
					if(clu_tienda.row.data().id != clu_tienda.table_products.row($(this).closest('tr')).data().id){
						clu_tienda.row.child.hide();
		        		clu_tienda.tr.removeClass('shown');
					}					
				}				

		        clu_tienda.tr = $(this).closest('tr');
		        clu_tienda.row = clu_tienda.table_products.row( clu_tienda.tr );
		 		
		        if ( clu_tienda.row.child.isShown() ) {
		            // la fila esta abierta
		            clu_tienda.row.child.hide();
		            clu_tienda.tr.removeClass('shown');
		        }
		        else {
		            //la fila esta cerrada
		            //llamado asincrono datos de producto
		            var datos = new Array();
		            datos['id_producto'] = clu_tienda.row.data().id;
		            datos['id_tienda'] = clu_tienda.row.data().store_id;
		            datos['url'] = "{{url('/')}}";
					datos['usuario'] = "{{Session::get('comjunplus.usuario.name')}}";
		            seg_ajaxobject.peticionajax($('#form_consult_product').attr('action'),datos,"clu_tienda.consultaRespuestaProduct");
		            clu_tienda.tr.addClass('shown');
		        }
		    });		    
		});

		$('.option_order').on('click', function (e) {
			var datos = new Array();
			datos['id'] = this.id.split('_')[2];
			datos['name'] = this.id.split('_')[1];			
			seg_ajaxobject.peticionajax($('#form_consult_orders').attr('action'),datos,"clu_tienda.consultaRespuestaOrders",false);

			//llamado sincrono, para cambiar el id de tienda
		    //la otra opciòn es retardar el listado de las los pedidos

		    javascript:clu_tienda.table_orders = $('#table_orders').DataTable({
		    	"responsive": true,
			    "columnDefs": [
			        { responsivePriority: 1, targets: 0 },
			        { responsivePriority: 2, targets: 0 },
			        { responsivePriority: 7, targets: 0 }
	    		],
			    "processing": true,
			    "bLengthChange": false,
			    "serverSide": true,
			    "bDestroy": true,      
			    "ajax": "{{url('mistiendas/listarajaxorders')}}",
			    "iDisplayLength": 15,     	       
			    "columns": [
			    	{
		                "className":      'details-control',
		                "orderable":      false,
		                "data":           null,
		                "defaultContent": ''
		            },		   
					{ "data": "id"},
					{ "data": "date"},		        
					{ "data": "name_client"},  	    
			        //{ "data": "adress_client"},
			        //{ "data": "email_client"},
			        //{ "data": "number_client"},
			        { "data": "stage_id",render: function ( data, type, row ) {
			        		if (data == 1) {
			                    return 'PENDIENTE';
		                    }
		                    if (data == 2) {
			                    return 'ACEPTADO';
		                    }
		                    if (data == 3) {
			                    return 'RECHAZADO';
		                    }
		                    if (data == 4) {
			                    return 'FINALIZADO';
		                    }
			        	}
			    	}               
			    ],       
			    "language": {
			        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
			    },
			    "fnRowCallback": function( nRow, aData ) {
			    	if(aData.stage_id == 1){
			    		$(nRow).children()[4].style.backgroundColor = '#fcf8e4';
			    		$(nRow).children()[4].style.color = '#8a6d3b';
			    	}
			    	if(aData.stage_id == 2){
			    		$(nRow).children()[4].style.backgroundColor = '#d9edf7';
			    		$(nRow).children()[4].style.color = '#31708f';
			    	}
			    	if(aData.stage_id == 3){
			    		$(nRow).children()[4].style.backgroundColor = '#f2dede';
			    		$(nRow).children()[4].style.color = '#a94442';
			    	}
			    	if(aData.stage_id == 4){
			    		$(nRow).children()[4].style.backgroundColor = '#dff0d8';
			    		$(nRow).children()[4].style.color = '#3c763d';
			    	}		       		        
            	}
		    });

		    //metodo para la tabla
			$('#table_orders tbody').on('click', 'td.details-control', function () {

				//cerramos el div anterior
				if(clu_tienda.tr != undefined){
					if(clu_tienda.row.data().id != clu_tienda.table_orders.row($(this).closest('tr')).data().id){
						clu_tienda.row.child.hide();
		        		clu_tienda.tr.removeClass('shown');
					}					
				}				

		        clu_tienda.tr = $(this).closest('tr');
		        clu_tienda.row = clu_tienda.table_orders.row( clu_tienda.tr );
		 		
		        if ( clu_tienda.row.child.isShown() ) {
		            // la fila esta abierta
		            clu_tienda.row.child.hide();
		            clu_tienda.tr.removeClass('shown');
		        }
		        else {
		            //la fila esta cerrada
		            //llamado asincrono datos de producto
		            var datos = new Array();
		            datos['id_order'] = clu_tienda.row.data().id;
		            datos['id_tienda'] = clu_tienda.row.data().store_id;
		            datos['url'] = "{{url('/')}}";
					datos['usuario'] = "{{Session::get('comjunplus.usuario.name')}}";
		            seg_ajaxobject.peticionajax($('#form_consult_order').attr('action'),datos,"clu_tienda.consultaRespuestaOrder");
		            clu_tienda.tr.addClass('shown');
		        }
				
			});
		});
		
		$( ".solo_numeros" ).keypress(function(evt) {
			 evt = (evt) ? evt : window.event;
		    var charCode = (evt.which) ? evt.which : evt.keyCode;
		    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
		        return false;
		    }
		    return true;
		});		

		$('.chosen-select').chosen();
		$('.chosen-container').width('100%');

		$("#categorias_select").chosen().change(function(event) {
			$('#categorias').val($('#categorias_select').chosen().val());		    
		});
		$("#unidades_select").chosen().change(function(event) {
			$('#unidades_medida').val($('#unidades_select').chosen().val());		    
		});
		$("#colores_select").chosen().change(function(event) {
			$('#colores').val($('#colores_select').chosen().val());		    
		});
		$("#unidades_select").chosen().change(function(event) {
			$('#unidades_medida').val($('#unidades_select').chosen().val());		    
		});
		$("#tallas_select").chosen().change(function(event) {
			$('#tallas').val($('#tallas_select').chosen().val());		    
		});
		$("#sabores_select").chosen().change(function(event) {
			$('#sabores').val($('#sabores_select').chosen().val());		    
		});
		$("#materiales_select").chosen().change(function(event) {
			$('#materiales').val($('#materiales_select').chosen().val());		    
		});

		$('#nuevoproducto_modal').on('hidden.bs.modal', function () {
		   //limpiamos todos los datos, puudo haver sido un edit quien abrio el modal
			$('#modal-title-product').html('Crear Producto');
			$( "input[name='edit_product']").val(false);
			$( "input[name='product_id']").val('');
			$('#nombre_producto').val('');
			$('#precio').val('');
			$('#categoria_select').val('');
			$('#descripcion_producto').val('');
			$('#prioridad_producto').val('');			
			//imagen, se reemplaza el src del elemento
			$('#img_product').attr('src',$('#img_product').attr('src').replace($('#img_product').attr('src').split('/')[$('#img_product').attr('src').split('/').length-1],'default.png'));
			$('#unidades_select').val('');
			$('#unidades_medida').val('');
			$('#colores_select').val('');
			$('#colores').val('');
			$('#tallas_select').val('');
			$('#tallas').val('');
			$('#sabores_select').val('');
			$('#sabores').val('');
			$('#materiales_select').val('');
			$('#materiales').val('');
			$('#modelos').val('');
			$('.estado-roduct').hide();
			$("input[name=estado_producto][value=1]").attr("checked", "checked");
			$('#modal-button-product').html('Crear Producto')			
			
			//para hacer efectivo el cambio del chossen
			$('#categoria_select').trigger("chosen:updated");
			$('#unidades_select').val([]).trigger("chosen:updated");
			$('#colores_select').val([]).trigger("chosen:updated");
			$('#tallas_select').val([]).trigger("chosen:updated");
			$('#sabores_select').val([]).trigger("chosen:updated");
			$('#materiales_select').val([]).trigger("chosen:updated");
		});

		$('#productos_modal').on('hidden.bs.modal', function () {
			 clu_tienda.table_products.destroy();
			 $('#table_prods tbody').off('click');
		});

		$('#odenes_modal').on('hidden.bs.modal', function () {
			 clu_tienda.table_orders.destroy();
			 $('#table_orders tbody').off('click');
		});

		//limpiamos el spinner
		//clu_tienda.spinner.el.remove();

	</script>
	@if(old('edit'))		
		<script> $("#nuevatienda_modal").modal(); </script>
	@endif

	@if(Session::has('error'))
		@if(in_array('Productos0',Session::get('error')))
			<script> 				
				$("#nuevoproducto_modal").modal(); 
				$('#nuevoproducto_modal .alerts-module').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>!Problemas al crear el producto!</strong> No puedes crear màs de {{Session::get("comjunplus.usuario.products")}} productos por Tienda, Para màs informaciòn envìa tu sugerencia al administrador en tu perfil de usuario.</div>');
			</script>
		@endif		
	@endif

	@if(Session::has('message'))
		@if(in_array('ProductosOK',Session::get('message')) || in_array('ProductosEDITOK',Session::get('message')))
			{{--Luego de haber guardado un producto correctameten, hay que listarlo en la tabla.--}}
			<script type="text/javascript">
				
				@if(in_array('ProductosOK',Session::get('message'))) 								
				$('#productos_modal .alerts-module').html('<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>!Producto creado satisfactoriamente!</strong> Tù tienda ahora cuenta con un producto màs que ofertar, recuerda compartir la URL ({{url("/".Session::get("store.name"))}}) de tu tienda para que otros puedan verlo y comprarlo.</div>');
				@else
				$('#productos_modal .alerts-module').html('<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>!Producto editado satisfactoriamente!</strong> Recuerda compartir la URL ({{url("/".Session::get("store.name"))}}) de tu tienda para que otros puedan verlo y comprarlo.</div>');
				@endif
				//$('#productos_modal').modal();
				
				//llamado apra categorias
				var datos = new Array();
				datos['id'] = "{!!Session::get('store.id')!!}";
				datos['name'] = "{!!Session::get('store.name')!!}";						
			    seg_ajaxobject.peticionajax($('#form_consult_products').attr('action'),datos,"clu_tienda.consultaRespuestaProducts",false);

				//recarga la tabla de productos
				javascript:clu_tienda.table_products = $('#table_prods').DataTable( {		
				    "responsive": true,
				    "columnDefs": [
				        { responsivePriority: 1, targets: 0 },
				        { responsivePriority: 2, targets: 0 }
		    		],
				    "processing": true,
				    "bLengthChange": false,
				    "serverSide": true,
				    "bDestroy": true,      
				    "ajax": "{{url('mistiendas/listarajax')}}",
				    "iDisplayLength": 15,     	       
				    "columns": [
				    	{
			                "className":      'details-control',
			                "orderable":      false,
			                "data":           null,
			                "defaultContent": ''
			            },				   
						{ "data": "name"},
						{ "data": "price"},		        
						{ "data": "category_name"},  	    
				        { "data": "unity_measure"},
				        { "data": "active",render: function ( data, type, row ) {
			        		if (data == 1) {
			                    return 'Activo';
		                    }else{
			                    return 'Desactivo';
		                    }
			        	}
			    	}                     
				    ],       
				    "language": {
				        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
				    },
				});

				//metodo para la tabla
				$('#table_prods tbody').on('click', 'td.details-control', function () {
					//cerramos el div anterior
					if(clu_tienda.tr != undefined){
						if(clu_tienda.row.data().id != clu_tienda.table_products.row($(this).closest('tr')).data().id){
							clu_tienda.row.child.hide();
			        		clu_tienda.tr.removeClass('shown');
						}					
					}

			        clu_tienda.tr = $(this).closest('tr');
			        clu_tienda.row = clu_tienda.table_products.row( clu_tienda.tr );
			 		
			        if ( clu_tienda.row.child.isShown() ) {
			            // la fila esta abierta
			            clu_tienda.row.child.hide();
			            clu_tienda.tr.removeClass('shown');
			        }
			        else {
			            //la fila esta cerrada
			            //llamado asincrono datos de producto
			            var datos = new Array();
			            datos['id_producto'] = clu_tienda.row.data().id;
			            datos['id_tienda'] = clu_tienda.row.data().store_id;
			            datos['url'] = "{{url('/')}}";
						datos['usuario'] = "{{Session::get('comjunplus.usuario.name')}}";
			            seg_ajaxobject.peticionajax($('#form_consult_product').attr('action'),datos,"clu_tienda.consultaRespuestaProduct");
			            clu_tienda.tr.addClass('shown');
			        }
			    });		
				
			</script>
		@endif		
	@endif

	@if(Session::has('orden_id'))
		{{Session::flash('orden_id', Session::get('orden_id'))}}
		<script type="text/javascript">

			var datos = new Array();
			datos['id'] = "{!!Session::get('modulo.tienda_orden.0')->id!!}";
			datos['name'] = "{!!Session::get('modulo.tienda_orden.0')->name!!}";			
			seg_ajaxobject.peticionajax($('#form_consult_orders').attr('action'),datos,"clu_tienda.consultaRespuestaOrders",false);

			//llamado sincrono, para cambiar el id de tienda
		    //la otra opciòn es retardar el listado de las los pedidos

		    javascript:clu_tienda.table_orders = $('#table_orders').DataTable({
		    	"responsive": true,
			    "columnDefs": [
			        { responsivePriority: 1, targets: 0 },
			        { responsivePriority: 2, targets: 0 },
			        { responsivePriority: 7, targets: 0 }
	    		],
			    "processing": true,
			    "bLengthChange": false,
			    "serverSide": true,
			    "bDestroy": true,      
			    "ajax": "{{url('mistiendas/listarajaxorders')}}",
			    "iDisplayLength": 15,     	       
			    "columns": [
			    	{
		                "className":      'details-control',
		                "orderable":      false,
		                "data":           null,
		                "defaultContent": ''
		            },		   
					{ "data": "id"},
					{ "data": "date"},		        
					{ "data": "name_client"},  	    
			        //{ "data": "adress_client"},
			        //{ "data": "email_client"},
			        //{ "data": "number_client"},
			        { "data": "stage_id",render: function ( data, type, row ) {
			        		if (data == 1) {
			                    return 'PENDIENTE';
		                    }
		                    if (data == 2) {
			                    return 'ACEPTADO';
		                    }
		                    if (data == 3) {
			                    return 'RECHAZADO';
		                    }
		                    if (data == 4) {
			                    return 'FINALIZADO';
		                    }
			        	}
			    	}               
			    ],       
			    "language": {
			        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
			    },
			    "fnRowCallback": function( nRow, aData ) {
			    	if(aData.stage_id == 1){
			    		$(nRow).children()[4].style.backgroundColor = '#fcf8e4';
			    		$(nRow).children()[4].style.color = '#8a6d3b';
			    	}
			    	if(aData.stage_id == 2){
			    		$(nRow).children()[4].style.backgroundColor = '#d9edf7';
			    		$(nRow).children()[4].style.color = '#31708f';
			    	}
			    	if(aData.stage_id == 3){
			    		$(nRow).children()[4].style.backgroundColor = '#f2dede';
			    		$(nRow).children()[4].style.color = '#a94442';
			    	}
			    	if(aData.stage_id == 4){
			    		$(nRow).children()[4].style.backgroundColor = '#dff0d8';
			    		$(nRow).children()[4].style.color = '#3c763d';
			    	}		       		        
            	}
		    });

		    @if(Session::has('orden_id'))
				clu_tienda.table_orders.search( "Orden_{!!Session::get('orden_id')!!}" ).draw();				
			@endif	

		    //metodo para la tabla
			$('#table_orders tbody').on('click', 'td.details-control', function () {

				//cerramos el div anterior
				if(clu_tienda.tr != undefined){
					if(clu_tienda.row.data().id != clu_tienda.table_orders.row($(this).closest('tr')).data().id){
						clu_tienda.row.child.hide();
		        		clu_tienda.tr.removeClass('shown');
					}					
				}				

		        clu_tienda.tr = $(this).closest('tr');
		        clu_tienda.row = clu_tienda.table_orders.row( clu_tienda.tr );
		 		
		        if ( clu_tienda.row.child.isShown() ) {
		            // la fila esta abierta
		            clu_tienda.row.child.hide();
		            clu_tienda.tr.removeClass('shown');
		        }
		        else {
		            //la fila esta cerrada
		            //llamado asincrono datos de producto
		            var datos = new Array();
		            datos['id_order'] = clu_tienda.row.data().id;
		            datos['id_tienda'] = clu_tienda.row.data().store_id;
		            datos['url'] = "{{url('/')}}";
					datos['usuario'] = "{{Session::get('comjunplus.usuario.name')}}";
		            seg_ajaxobject.peticionajax($('#form_consult_order').attr('action'),datos,"clu_tienda.consultaRespuestaOrder");
		            clu_tienda.tr.addClass('shown');
		        }
			});
		</script>			
	@endif
	
@endsection