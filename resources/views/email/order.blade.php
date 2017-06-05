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
				<div class="panel-heading" style="padding: 15px;border-bottom: 1px solid #e5e5e5;background: #dddddd;">{{ ucwords($tienda) }} Te Informa</div>
				<div class="panel-body" style="padding: 15px;font-size: 16px;">
					<div style="float: right;margin-right: 5%;">
						<img src="{{url('/'.$imagen)}}" alt="Imagen Tienda" style="width: 70%;">
					</div>
					<div>Una nueva Orden de Pedido ha llegado a tu tienda.</div>
					<div>Nùmero de Orden :{{ $orden_id }}</div>					
					<div>DATOS DEL CLIENTE</div>
					<ul>						
						<li>Nombre: {{$nombre_cliente}}</li>
						<li>Dirección: {{$adress_client}}</li>
						<li>Correo Electrónico: {{$email_client}}</li>
						<li>Teléfono: {{$number_client}}</li>
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
						@foreach( $detalle as $key => $array )							
							@foreach( $array as $key => $value )
								<tr>
									<td style = "padding: 8px; text-align: left; border-bottom: 1px solid #ddd;">{{$value['nprod']}} - {{$value['crtrcs']}}</td>
									<td style = "padding: 8px; text-align: left; border-bottom: 1px solid #ddd;">{{$value['precio']}}</td>
									<td style = "padding: 8px; text-align: left; border-bottom: 1px solid #ddd;">{{$value['volume']}}</td>
									<td style = "padding: 8px; text-align: left; border-bottom: 1px solid #ddd;">{{($value['precio']*$value['volume'])}}</td>
								</tr>
								@php ($c = $c + $value['volume'])
								@php ($p = $p + $value['precio']*$value['volume'])
							@endforeach							
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
					@if($order_description != '')
						<div>Sugerencias del Cliente</div>
						<div>{{$order_description}}</div>
					@endif					
				</div>

				<div class="panel-footer" style="text-align: center;padding: 15px;font-size: 15px;border-top: 1px solid #e5e5e5;background: #dddddd;color: cadetblue;">					
					<div>
						<a  href = "{{url('/modal/modalorden/'.$orden_id)}}">Consultar La orden en ComprarJuntos</a>
					</div>
					
				</div>
			</div>			
		</div>		
	</body>
	
</html>
