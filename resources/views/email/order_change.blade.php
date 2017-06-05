<html lang="es">
	<style>
		.panel{
			width: 40%;
			margin: auto;			
			border-radius: 6px;
			font-family: 'Dosis', sans-serif;
			font-size: 18px;			
			line-height: 1.42857143;
			color: #333;

			box-shadow: 0 5px 15px rgba(0,0,0,.5);

			border: 1px solid rgba(0,0,0,.2);
		}

		.panel-heading{
			/*text-align: center;*/
			padding: 15px;
			border-bottom: 1px solid #e5e5e5;
			background: #dddddd;
			/*color:777777;*/
			color: cadetblue;
		}

		.panel-body{
			padding: 15px;
			font-size: 16px;
			/*color: cadetblue;*/
		}

		.panel-footer{
			text-align: center;
			padding: 15px;
			font-size: 15px;
			border-top: 1px solid #e5e5e5;
			background: #dddddd;
			/*color:777777;*/
			color: cadetblue;			
		}

		a{
			text-decoration: none;
			color: cadetblue;
		}

	</style>	
	<body>
		<div class="container-fluid">			
			<div class="panel panel-default" style="width: 65%;margin: auto;border-radius: 6px;font-family: 'Dosis', sans-serif;font-size: 18px;line-height: 1.42857143;color: #333;box-shadow: 0 5px 15px rgba(0,0,0,.5);border: 1px solid rgba(0,0,0,.2);">
				<div class="panel-heading" style="padding: 15px;border-bottom: 1px solid #e5e5e5;background: #dddddd;">{{ ucwords($tienda) }} te Informa</div>
				<div class="panel-body" style="padding: 15px;font-size: 16px;">
					<div style="float: right;margin-right: 5%;">
						<img src="{{url('/'.$imagen)}}" alt="Imagen Tienda" style="width: 70%;">
					</div>
					<div>Tu Orden de Pedido ha sido <b>{{$estado}}</b>.</div>
					<div>Nùmero de Orden :{{ $orden_id }}</div>
					<div>DATOS DE LA TIENDA</div>		
					<ul>									
						<li>Tendero: {{$nombres_tendero}} {{$apellidos_tendero}}</li>						
						<li>Dirección: {{$direccion_tienda}}</li>						
						<!--<li>Correo Electrónico: {{$email}}</li>-->
						<!--<li>Teléfono: {{$telefono_tienda}}</li>-->
					</ul>
					<div style="text-align: center;">
						<div style="margin-bottom: 15px;margin-top: 15px;"><b>DETALLES DE ORDEN</b></div>
						<table style="text-align: center;width: 90%;margin: auto;  border-collapse: collapse;" >
							<tr >
								<th style = "padding: 8px; text-align: left; border-bottom: 1px solid #ddd;">Producto</th>
								<th style = "padding: 8px; text-align: left; border-bottom: 1px solid #ddd;">Precio</th> 
								<th style = "padding: 8px; text-align: left; border-bottom: 1px solid #ddd;">Cantidad</th>
								<th style = "padding: 8px; text-align: left; border-bottom: 1px solid #ddd;">Total</th>
							</tr>
							@php ($c=0)
							@php ($p=0)	
							@foreach( $detalles as $key => $value )
								<tr>
									<td style = "padding: 8px; text-align: left; border-bottom: 1px solid #ddd;">{{$value->product}} - {{$value->description}}</td>
									<td style = "padding: 8px; text-align: left; border-bottom: 1px solid #ddd;">{{$value->price}}</td>
									<td style = "padding: 8px; text-align: left; border-bottom: 1px solid #ddd;">{{$value->volume}}</td>
									<td style = "padding: 8px; text-align: left; border-bottom: 1px solid #ddd;">{{($value->price*$value->volume)}}</td>
								</tr>
								@php ($c = $c + $value->volume)
								@php ($p = $p + $value->price*$value->volume)
							@endforeach
							<tr>
								<td colspan="4" style = "padding: 8px; text-align: left; border-bottom: 1px solid #ddd;background: #dddddd;"></td>
							</tr>							
							<tr>
								<td colspan="2" style = "padding: 8px; text-align: left; border-bottom: 1px solid #ddd;"></td>								
								<td style = "padding: 8px; text-align: left; border-bottom: 1px solid #ddd;"><b>Total a Pagar</b></td>
								<td style = "padding: 8px; text-align: left; border-bottom: 1px solid #ddd;"><b>{{$p}}</b></td>
							</tr>
						</table>
					</div>

					@if($mensaje_orden != '')
						<div><b>Sugerencias del Tendero</b></div>
						<div style="border: 1px solid black;padding: 5px;">{{$mensaje_orden}}</div>
					@endif

					<br>
					<!--Rechazado o aceptado-->
					@if($estado == "RECHAZADA")
						<div>Te pedimos que 
						<a  href = "{{url('/modal/modalresenatostore/'.$orden_id)}}">aportes con tu reseña al servicio prestado</a>, ya que actualmente esta orden aporta una reseña neutral en esta tienda y tu aporte nos ayuda a cuantificar la repuraciòn de las tiendas en {{Session::get('app')}}.</div>						
						<p>
						<a  href = "{{url('/modal/modalresenatostore/'.$orden_id)}}">Puedes contribuir con tu reseña a la tienda. Aquì!!</a>
						</p>
						<div style="font-size: 12px;">Nota: Pese a que el pedido fue rechazado, no significa que la reseña al servicio sea rotundamente negativa, si la informaciòn llego a tiempo, esto te permite actuar para tomar otra decisiòn rapidamente. Puedes elegir otro proveedor o adquirir un sustituto adecuado.</div>
						
					@else
						@if($estado == "ETREGADO")
							<!--Si el cliente es el tendero no se le permitira calificar el servicio-->
							@if($id_client != $id_tender)						
								<div>Te pedimos que 
								<a href = "{{url('/modal/modalresenatostore/'.$orden_id)}}">aportes con tu reseña al servicio prestado</a>, ya que actualmente la orden aporta una reseña neutral para esta tienda y tu 
								aporte nos ayuda a cuantificar la repuraciòn de las tiendas de {{Session::get('app')}}.</div>
								<p>
								<a  href = "{{url('/modal/modalresenatostore/'.$orden_id)}}">Puedes contribuir con tu calificaciòn al servicio. Aquì!!</a>
								</p>
								<div style="font-size: 12px;">Nota: Si te llego este mensaje significa que ya tienes el pedido en tus manos, ya puedes verificar su calidad y cuantificar el servicio.</div>
							@endif
						@else
							<a  href = "{{url('/modal/modalmessagetotender/'.$orden_id)}}">Escribe un mensaje al tendero. Aquì!!</a>
						@endif						
					@endif					
				</div>

				<div class="panel-footer" style="text-align: center;padding: 15px;font-size: 15px;border-top: 1px solid #e5e5e5;background: #dddddd;color: cadetblue;">
					<a href = "{{url('/'.$tienda)}}"> {{Session::get('app')}} - {{$tienda}} </a>
					@if(!$id_client)						
						<div style="margin-top: 10px;">
							<b>Te invitamos para que hagas parte de esta maravillosa comunidad.</b>
							<a href = "{{url('/modal',['modalregistro'=>'modalregistro','meta'=>'meta'])}}"> Registrate AQUI!!</a>
						</div>
					@endif			
				</div>
			</div>			
		</div>		
	</body>
	
</html>
