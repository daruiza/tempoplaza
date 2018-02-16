@extends('app')

@section('content')	
	<style>
		.data_cell{
			text-align: center;
			border-bottom: 1px solid;
			border-bottom-color: #ddd;
			border-bottom-style: dashed;
		}
		.data_cell:hover{
			background-color: #ddd;
			color: #333;
		}
		/*Estilo para el pie de datos*/
		.data_cell_c{
			text-align: center;			
		}
		.data_cell_c:hover{
			background-color: #ddd;
			color: #333;
		}
		/*Estilo para opciones*/
		.data_cell_b{
			text-align: center;
			border-bottom: 1px solid;
			border-bottom-color: #ddd;
			border-bottom-style: dashed;
			cursor:pointer;
		}
		.data_cell_b:hover{
			background-color: #ddd;
			color: #333;
		}
		.data_cell_b_c{
			text-align: center;			
			cursor:pointer;
		}
		.data_cell_b_c:hover{
			background-color: #ddd;
			color: #333;
		}
		.input_danger{
			color: #a94442;
    		background-color: #f2dede;
    		border-color: #ebccd1;
		}
		.btn{
			font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
			font-size: 14px;
			border-color: #449aa2;
		}
		.chosen-container .chosen-container-multi{
			border: 1px solid #ccc !important;
			border-radius: 4px !important;
		}
		
		
	</style>

	<link  rel="stylesheet" href="{{ url('css/bootstrap-datepicker.min.css') }}" type="text/css" />	
	<link  rel="stylesheet" href="{{ url('css/datatables.min.css') }}" type="text/css" />	
	<link  rel="stylesheet" href="{{ url('css/datatables-responsive.min.css') }}" type="text/css" />
	<link  rel="stylesheet" href="{{ url('css/chosen.css') }}" type="text/css" />

	<div class="row visible-lg" style="margin-top: 5%;"></div>
	<div class="row visible-md" style="margin-top: 7%;"></div>
	<div class="row visible-sm" style="margin-top: 10%;"></div>
	<div class="row visible-xs" style="margin-top: 16%;"></div>
	<div  class="row">	
	<div class="alerts col-md-12 col-md-offset-0">	
		<!-- $error llega si la función validator falla en autenticar los datos -->
		@if (count($errors) > 0)
			<div class="alert alert-danger alert-dismissible fade in" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<strong>Algo no va bien con el proceso!</strong>
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
						@if ($message  == 'Tiendauno')						
							<li>								
								Ya puedes crear tu primer tienda en Macalú. ¡Animate a crear tu tieanda! dando <a  href="{{url('/mistiendas/listar/nueva')}}"><span class ="tienda_uno">CLICK AQUI</span></a>. Ó dando click sobre la opción Mis Tiendas.
							</li>	
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
					<li>{{ $error }}</li>
				@endforeach															
				</ul>
			</div>                
		@endif
	</div>
	</div>
	<div class="row">		
		<div class="col-md-12 col-md-offset-0">
			<div class="col-md-3 col-md-offset-0">
				<div class="panel panel-default">
					<div class="panel-heading">Menú de Opciones</div>					
					<div class="panel-body">
						<div class="col-md-12 col-md-offset-0 data_cell_b" id="btn_edit_up" data-toggle="modal" data-target="#cpep_modal"> Editar Los Datos De Mi Perfil</div>
						<div class="col-md-12 col-md-offset-0 data_cell_b"  id="btn_new_psw" data-toggle="modal" data-target="#cpsw_modal"> Cambiar Mi Contraseña</div>					
						<!--<div class="col-md-12 col-md-offset-0 data_cell_b" style = "margin-top: 0px;"> Ir a Mi Buzón de Mensajes</div>-->
						<div class="col-md-12 col-md-offset-0 data_cell_b" data-toggle="popover" title="Cuenta {!! ucwords(Session::get('comjunplus.usuario.account'))!!}" data-placement="bottom" data-content="<div>Rol: {!!Session::get('comjunplus.usuario.rol')!!}</div><div>Nº de Tiendas: {!!Session::get('comjunplus.usuario.stores')!!}</div><div style='margin-bottom: 10%;'>Nº de Productos por Tienda: {!!Session::get('comjunplus.usuario.products')!!}</div><div style='font-size: 12px;'>Nota: Puedes modificar tu cuenta para que soporte más productos o más tiendas. <div style='color: blue;cursor: pointer;' data-toggle='modal' data-target='#mesadmin_modal'>Comunicate con soporte Aqui!.</div></div>" data-html="true">Resumen de Cuenta</div>
						<!--<div class="col-md-12 col-md-offset-0 data_cell_b"> Preguntas Frecuentes</div>-->
						<div class="col-md-12 col-md-offset-0 data_cell_b" data-toggle='modal' data-target='#mesadmin_modal'> Envianos tus Sugerencia</div>
						<div class="col-md-12 col-md-offset-0 data_cell_b_c" > 
						<a href="{{ url('/welcome/terminosycondiciones')}}" style="text-decoration: none;color: #333;">Terminos y Condiciones </a></div>
					</div>
				</div>
			</div>
		
			<div class="col-md-9 col-md-offset-0">		
				<div class="panel panel-default">				
					<div class="panel-heading">Datos de Mi Perfil de Usuario {{--{{Session::get('comjunplus.usuario.name')}}--}}			 
						{{ Html::image('users/'.str_replace(' ','',Session::get('comjunplus.usuario.name')).'/profile/'.Session::get('comjunplus.usuario.avatar'),'Imagen no disponible',array( 'style'=>'width: 10%; border:2px solid #ddd;border-radius: 50%; float: right;' ))}}					
					</div>					
					<div class="panel-body">
						<div class="row">
							<div class="col-md-3 col-md-offset-0 data_cell">							
								<b>Usuario</b></br> {{Session::get('comjunplus.usuario.name')}}						
							</div>
							<div class="col-md-3 col-md-offset-0 data_cell">							
								<b>Nombres</b></br> {{Session::get('comjunplus.usuario.names')}}						
							</div>
							<div class="col-md-3 col-md-offset-0 data_cell">							
								<b>Apellidos</b></br> {{Session::get('comjunplus.usuario.surnames')}}						
							</div>
							<div class="col-md-3 col-md-offset-0">							
														
							</div>
						</div>
						<div class="row">
							<div class="col-md-3 col-md-offset-0 data_cell">							
								<b>Identificación</b></br> {{Session::get('comjunplus.usuario.identificacion')}}						
							</div>
							<div class="col-md-3 col-md-offset-0 data_cell">							
								<b>Fecha de Nacimento</b></br> {{Session::get('comjunplus.usuario.birthdate')}}						
							</div>
							<div class="col-md-3 col-md-offset-0 data_cell">							
								<b>Teléfono Fijo</b></br> {{Session::get('comjunplus.usuario.fix_number')}}						
							</div>
							<div class="col-md-3 col-md-offset-0 data_cell">							
								<b>Teléfono Movil</b></br> {{Session::get('comjunplus.usuario.movil_number')}}						
							</div>
						</div>
						<div class="row">
							<div class="col-md-3 col-md-offset-0 data_cell_c">							
								<b>Correo Electronico</b></br> {{Session::get('comjunplus.usuario.email')}}						
							</div>						
							<div class="col-md-3 col-md-offset-0 data_cell_c">							
								<b>Dirección</b></br> {{Session::get('comjunplus.usuario.adress')}}						
							</div>
							<div class="col-md-3 col-md-offset-0 data_cell_c">							
								<b>Departamento</b></br> {{Session::get('comjunplus.usuario.state')}}						
							</div>
							<div class="col-md-3 col-md-offset-0 data_cell_c">							
								<b>Ciudad</b></br> {{Session::get('comjunplus.usuario.city')}}						
							</div>						
						</div>					
					</div>
				</div>			
			</div>
		</div>
		
		<div class="col-md-6 col-md-offset-0">
			<div class="panel panel-default">
				<div class="panel-heading">Mensajes Recibidos</div>
				<div class="panel-body">
					<table id="table_msj_enviados" class="display responsive no-wrap " cellspacing="0" width="96%" style="margin: auto;">
						<thead >
				            <tr>
			        			<td>ASUNTO</td>
			        			<td>MENSAJE</td>
			        			<td>FECHA</td>		        			
				            </tr>
				        </thead>              
					</table>
				</div>
			</div>
		</div>
		
		<div class="col-md-6 col-md-offset-0">
			<div class="panel panel-default">
				<div class="panel-heading">Mensajes Enviados</div>
				<div class="panel-body">
					<table id="table_msj_recibidos" class="display responsive no-wrap " cellspacing="0" width="96%" style="margin: auto;">
						<thead >
				            <tr>				          			        			
			        			<td>ASUNTO</td>
			        			<td>MENSAJE</td>
			        			<td>FECHA</td>		        			
				            </tr>
				        </thead>              
					</table>
				</div>
			</div>
		</div>
		
		
	</div>
@endsection

@section('modal')

	<!-- Modal para editar datos de perfil -->
	<div class="modal fade" id="cpep_modal" role="dialog" >
		<div class="modal-dialog modal-lg">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Editar Datos de Perfil {{Session::get('comjunplus.usuario.name')}}</h4>
				</div>
				<div class = "alerts-module"></div>	
				<div class="modal-body col-md-12">
					
					{!! Form::open(array('id'=>'cpfep','url' => '/editarperfil','method'=>'post','files'=>true,'onsubmit'=>'javascript:return seg_user.validateEditPerfil()')) !!}
					<div class="row col-md-12 ">
					{!! Form::hidden('usuario_id', Session::get('comjunplus.usuario.id')) !!}	
					<div class="col-md-4">																			
						<div class="form-group ">													
							{!! Form::label('usuario', 'Usuario', array('class' => 'col-md-12 control-label')) !!}
							<div class="col-md-12">
								{!! Form::text('usuario',value(Session::get('comjunplus.usuario.name')), array('class' => 'form-control','placeholder'=>'Ingresa tu usuario','disabled'=>'disabled')) !!}
							</div>
							
							{!! Form::label('nombres', 'Nombres', array('class' => 'col-md-12 control-label')) !!}
							<div class="col-md-12">
								{!! Form::text('nombres',value(Session::get('comjunplus.usuario.names')), array('class' => 'form-control','placeholder'=>'Nombres completos', 'autofocus'=>'autofocus')) !!}
							</div>
							
							{!! Form::label('apellidos', 'Apellidos', array('class' => 'col-md-12 control-label')) !!}
							<div class="col-md-12">
								{!! Form::text('apellidos',value(Session::get('comjunplus.usuario.surnames')), array('class' => 'form-control','placeholder'=>'Apellidos completos')) !!}
							</div>
							
							{!! Form::label('identificacion', 'Identificación', array('class' => 'col-md-12 control-label')) !!}
							<div class="col-md-12">
								{!! Form::number('identificacion',value(Session::get('comjunplus.usuario.identificacion')), array('class' => 'form-control','placeholder'=>'C.C, C.E ó T.I')) !!}
							</div>
							
							{!! Form::label('fecha_nacimiento', 'Fecha de Nacimiento', array('class' => 'col-md-12 control-label')) !!}
							<div class="col-md-12">																
								{!! Form::text('fecha_nacimiento',value(Session::get('comjunplus.usuario.birthdate')), array('class' => 'form-control','placeholder'=>'aaaa-mm-dd')) !!}								
							</div>	
							
							{!! Form::label('correo_electronico', 'Correo Electronico', array('class' => 'col-md-12 control-label')) !!}
							<div class="col-md-12">
								{!! Form::email('correo_electronico',value(Session::get('comjunplus.usuario.email')), array('class' => 'form-control','placeholder'=>'Ingresa tu email')) !!}
							</div>
																							
						</div>						
					</div>
					
					<div class=" col-md-4 ">						
						<div class="form-group ">								
													
							{!! Form::label('departamento', 'Departamento', array('class' => 'col-md-12 control-label')) !!}
							<div class="col-md-12">
								{!! Form::select('departamento',$departamentos,value(Session::get('comjunplus.usuario.state')), array('class' => 'form-control chosen-select','placeholder'=>'Departamento de residencia')) !!}
							</div>
							
							{!! Form::label('municipio', 'Municipio', array('class' => 'col-md-12 control-label')) !!}
							<div class="col-md-12">
								{!! Form::select('municipio',$ciudades,value(Session::get('comjunplus.usuario.city')), array('class' => 'form-control chosen-select','placeholder'=>'Municipio de recidencia')) !!}
							</div>
							
							{!! Form::label('direccion', 'Dirección', array('class' => 'col-md-12 control-label')) !!}
							<div class="col-md-12">
								{!! Form::text('direccion',value(Session::get('comjunplus.usuario.adress')), array('class' => 'form-control','placeholder'=>'Dirección Recidencial')) !!}
							</div>	
							
							{!! Form::label('telefono_movil', 'Teléfono Fijo', array('class' => 'col-md-12 control-label')) !!}
							<div class="col-md-12">
								{!! Form::number('telefono_fijo',value(Session::get('comjunplus.usuario.fix_number')), array('class' => 'form-control','placeholder'=>'Ingresa tu Fijo')) !!}
							</div>
							
							{!! Form::label('telefono_movil', 'Teléfono Móvil', array('class' => 'col-md-12 control-label')) !!}
							<div class="col-md-12">
								{!! Form::number('telefono_movil',value(Session::get('comjunplus.usuario.movil_number')), array('class' => 'form-control','placeholder'=>'Ingresa tu Celular')) !!}
							</div>
							
							{!! Form::label('fuente', 'Fuente Tipográfica', array('class' => 'col-md-12 control-label')) !!}
							<div class="col-md-12">
								{!! Form::select('fuente_tipografica',array('default' => 'default', 'flowers' => 'flowers'),value(Session::get('comjunplus.usuario.template')), array('class' => 'form-control','placeholder'=>'Elige Una fuente tipografica')) !!}			
							</div>
																						
						</div>						
					</div>
					
					<div class=" col-md-4 ">	
						<div class="form-group ">
							{!! Form::label('img_user', 'Imagen de Usuario', array('class' => 'col-md-12 control-label')) !!}
							{{ Html::image('users/'.str_replace(' ','',Session::get('comjunplus.usuario.name')).'/profile/'.Session::get('comjunplus.usuario.avatar'),'Imagen no disponible',array('id'=>'img_user_img','style'=>'width: 100%; border:2px solid #ddd;border-radius: 0%;' ))}}
							
						</div>
						<div>
							{!! Form::file('image',array('id'=>'img_user','style'=>'font-size: 14px;')) !!}
						</div>
					</div>
					
					</div>
					
					{!! Form::close() !!}
					</div><!-- Cierre de modal body -->				
				
				<div class="modal-footer">
		          <button type="submit" form = "cpfep" class="btn btn-default " >Enviar</button>
		          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>		                  
		        </div>
		         
			</div>
		 </div>
	</div>
	
	<!-- Modal para cambiar de pasword -->
	<div class="modal fade" id="cpsw_modal" role="dialog" >
	    <div class="modal-dialog  modal-sm">	    
	      <!-- Modal content-->
	      <div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Cambiar contraseña</h4>
				</div>
				<div class = "alerts-module"></div>				
				<div class="modal-body">
					<div class="row ">
						<div class="col-md-12 col-md-offset-0 row_init">
							{!! Form::open(array('id'=>'cpsw','url' => '/cambiarcontrasena','method'=>'get','onsubmit'=>'javascript:return seg_user.validatePassword()')) !!}
				        		<div class="form-group">
									{!! Form::hidden('usuario', Session::get('comjunplus.usuario.name')) !!}
									{!! Form::label('contraseña_uno', 'Contraseña', array('class' => 'col-md-12 control-label')) !!}
									<div class="col-md-12">
										{!! Form::password('contraseña', array('class' => 'form-control','placeholder'=>'Ingresa tu nueva contraseña', 'autofocus'=>'autofocus')) !!}
									</div>
									
									{!! Form::label('contraseña_dos', 'Contraseña Nuevamente', array('class' => 'col-md-12 control-label')) !!}
									<div class="col-md-12">
										{!! Form::password('contraseña_dos', array('class' => 'form-control','placeholder'=>'Ingresa nuevamente tu contraseña')) !!}
									</div>
								</div>
					        {!! Form::close() !!}
						</div>						
					</div>
		        </div>
		        <div class="modal-footer">
		          <button type="submit" form = "cpsw" class="btn btn-default " >Enviar</button>
		          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>                  
		        </div>     
	      </div>
      </div>
	</div>

	<div class="modal fade" id="mesadmin_modal" role="dialog" >
		<div class="modal-dialog">
			<!-- Modal content-->
	      <div class="modal-content">
	      	<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Contacto Soporte</h4>
			</div>
			<div class = "alerts-module"></div>
			<div class="modal-body">
				<div class="row ">
					<div class="col-md-12 col-md-offset-0 row_init">
						{!! Form::open(array('id'=>'formormesad','url' => 'welcome/messageamin','method'=>'post','onsubmit'=>'javascript:return seg_user.validateMessageAdmin()')) !!}
							{!! Form::textarea('message_admin_text',null, array('class' => 'form-control','rows' => 3,'placeholder'=>'Escribe aqui el mensaje para soporte.','maxlength'=>'512')) !!}
						{!! Form::close() !!}
					</div>
				</div>
			</div>
			<div class="modal-footer">
		        <button type="submit" form = "formormesad" class="btn btn-default " >Enviar</button>
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>	                  
		    </div>   
	      </div>	    
		</div>
	</div>
	<!-- Form en blanco para consultar Ciudades -->
	{!! Form::open(array('id'=>'form_consult_city','url' => 'user/consultarcity')) !!}		
    {!! Form::close() !!}

@endsection

@section('script')
	<script type="text/javascript" src="{{ url('js/bootstrap-datepicker.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('js/locales/bootstrap-datepicker.es.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('js/datatables_row.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('js/datatables-responsive.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('js/chosen.jquery.min.js') }}"></script>

	<script type="text/javascript"> 
		//select
		$('.chosen-select').chosen();
		$('.chosen-container').width('100%');
		//tabla de mensajes recibidos
		javascript:seg_user.table_receiver = $('#table_msj_recibidos').DataTable( {
		    "responsive": true,
		    "processing": true,
		    "bLengthChange": false,
		    "bFilter": false,
			"ordering": false,
        	"info":     false,
		    "serverSide": true,	        
		    "ajax": "{{url('user/listarajaxmsjreceiver')}}",	
		    "iDisplayLength": 25,       
		    "columns": [
		        { "data": "subject" },		        
		        { "data": "message" },
		        { "data": "date" }		        		        
		    ],	       
		    "language": {
		        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
		    },		   
		    "fnRowCallback": function( nRow, aData ) {
            }
		});

		//tabla de mensajes enviadod
		javascript:seg_user.table_senders = $('#table_msj_enviados').DataTable( {
		    "responsive": true,
		    "processing": true,
		    "bLengthChange": false,
		    "bFilter": false,
			"ordering": false,
        	"info":     false,
		    "serverSide": true,	        
		    "ajax": "{{url('user/listarajaxmsjsender')}}",	
		    "iDisplayLength": 25,       
		    "columns": [
		        { "data": "subject" },		        
		        { "data": "message" },
		        { "data": "date" }		        		        
		    ],	       
		    "language": {
		        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
		    },		   
		    "fnRowCallback": function( nRow, aData ) {
            }
		});

		$('#fecha_nacimiento').datepicker({
			format: "yyyy-mm-dd",
			autoclose: true,			
			language: "es"
		});

		$( "#departamento" ).change(function() {
			var datos = new Array();
			datos['id'] =$( "#departamento option:selected" ).val();			   
			seg_ajaxobject.peticionajax($('#form_consult_city').attr('action'),datos,"seg_user.consultaRespuestaCity");			
		});

		$('[data-toggle="popover"]').popover({
			html: true,
	        trigger: 'manual',			
			container: 'body'
		 }).on('click', function(e) {
		 	$('[data-toggle="popover"]').each(function () {
		        //the 'is' for buttons that trigger popups
		        //the 'has' for icons within a button that triggers a popup		        
		        if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
		            $(this).popover('hide');
		        }
		    });	        
		 	$(this).popover('show');
		 });

		$(document).on('click', function(e) {
	        $('[data-toggle="popover"]').each(function () {
		        //the 'is' for buttons that trigger popups
		        //the 'has' for icons within a button that triggers a popup
		        if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
		            $(this).popover('hide');
		        }
		    });		   
	    });

		$('#img_user').change(function(e) {
	    	var file = e.target.files[0],
		    imageType = /image.*/;
		    
		    if (!file.type.match(imageType))
		    return;
		  
		    var reader = new FileReader();
		    reader.onload = function(e) {
		    	var result=e.target.result;
		    	$('#img_user_img').attr("src",result);
		    }
		    reader.readAsDataURL(file);
	    });

	</script>
@endsection

