@extends('app')

@section('content')
	<style>
		li{
			margin-top: 1.5%;
			margin-bottom: 0.5%;
		}
	</style>
	<div class="row visible-lg" style="margin-top: 3%;"></div>
	<div class="row visible-md" style="margin-top: 5%;"></div>
	<div class="row visible-sm" style="margin-top: 8%;"></div>
	<div class="row visible-xs" style="margin-top: 14%;"></div>

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
							<li>{{ $message }}</li>
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
		
	<div class="col-md-10 col-md-offset-1" style="text-align: justify;"> 
		<h3>Bienvenidos a ComprarJuntos</h3>
		<div>
			Este contrato describe los términos y condiciones que son aplicables al uso del software ComprarJuntos ofrecido por La Corporación para el Fomento de las Finanzas Solidarias - FOMENTAMOS (operador exclusivo de comprarjuntos.com.co);  respecto a los servicios de compra y venta de bienes, artículos y servicios. Cualquier persona que desee acceder y/o usar los servicios podrá hacerlo sujetándose a los Términos y Condiciones junto con las demás políticas y principios que rigen ComprarJuntos.
		</div>
		<div>
			ComprarJuntos se basa en la confianza y en la honestidad de sus Usuarios, para que se puedan realizar transacciones en un ambiente amistoso y confiable. Si cualquier persona no acepta estos tèrminos y condiciones, los cuales tienen un carácter obligatorio y vinculante, deberá abstenerse de utilizar el sitio y sus servicios. FOMENTAMOS vigilará las operaciones realizadas por los Usuarios a fin de prevenir fraudes o estafas; pero no se hace responsable ni legal, ni financieramente por las transacciones realizadas en el sitio, las transacciones son responsabilidad exclusiva de los usuarios del sitio; para lo cual se establecen las siguientes pautas que garantizan la integridad del sitio y  de FOMENTAMOS.
		</div>
		<ol>
			<li>ALCANCE</li>
			<div>
				Los Servicios de ComprarJuntos solo estarán disponibles para personas que estén en capacidad para contratar. No podrán utilizar los servicios los menores de edad. las personas que no tengan esa capacidad o las personas que hayan sido declarados incapaces judicialmente o dados de baja del sistema de ComprarJuntos, temporal o definitivamente, por haber incumplido los Términos y Condiciones o por haber incurrido a criterio de ComprarJuntos en conductas o actos indebidos o fraudulentos mediante el uso del sitio o de los servicios.
			</div>
			<li>MODIFICACIONES DEL ACUERDO</li>
			<div>
				De acuerdo a normas legales, regulaciones del mercado sobre oferta y demanda y cualquier otra situación, los términos y condiciones de este contrato podrán ser modificadas, las cuales serán debidamente notificadas al Usuario publicando una versión actualizada de dichos términos y condiciones en el sitio. Dentro de los 5 (cinco) días siguientes a la publicación de las modificaciones introducidas, el Usuario deberá comunicar por e-mail a info@fomentamos.com.co si no acepta las mismas; en ese caso quedará disuelto el vínculo contractual. Vencido este plazo, se considerará que el Usuario acepta tácitamente los nuevos términos y el contrato continuará vinculando a ambas partes.
			</div>
			<li>LISTADO DE BIENES</li>
			<div>
				El Usuario podrá agregar en las listas de bienes ofrecidos, los artículos que desea vender e ingresarlos según la clase y tipo de objeto en la correspondiente categoría o sub-categoría. Las listas pueden componerse de gráficos, textos, descripciones y fotos de los bienes ofrecidos, siempre que no violen ninguna disposición de este acuerdo. El bien ofrecido por el Usuario Vendedor debe ser exactamente descrito en cuanto al estado, condición, tamaño, marca, modelo, color, material y demás características relevantes. En el caso de que se incluya una fotografía, esta deberá corresponder específicamente al artículo que se ofrece, salvo que se trate de bienes o artículos nuevos.
			</div>
			<li>ARTICULOS PROHIBIDOS</li>
			<div>
				Sólo podrán ser ingresados en las listas de bienes ofrecidos, aquellos cuya venta no se encuentre tácita o expresamente prohibida en este acuerdo o por la ley vigente. Está expresamente prohibida la venta de armas de fuego, estupefacientes, propiedad robada, órganos o residuos humanos, animales salvajes o especies en vías de extinción, o cuya venta se encuentre expresamente prohibida por legislaciones vigentes, moneda o estampillas falsificadas, artículos de contrabando, artículos falsificados o adulterados, pólvora o material explosivo, drogas sujetas a prescripción médica, acciones de empresas que se transen en Bolsa de Valores, billetes de lotería, listas de correo o bases de datos personales, servicios relacionados con la prostitución o similares, material obsceno o contrario a la moral y buenas costumbres, o cuya venta esté expresamente prohibida por las leyes vigentes o que promuevan la violencia y/o discriminación basada en cuestiones de raza, religión, sexo, nacionalidad, orientación sexual o de cualquier otro tipo. Así mismo se prohíbe la venta de discos compactos que contengan música en formato MP3, cuando la misma no esté expresamente autorizada por el artista o compañía discográfica propietaria de los respectivos derechos, o infrinja alguna legislación. Tampoco podrán ser listados u ofrecidos aquellos artículos que violen leyes sobre piratería informática, protección de software, derecho de autor, patentes, marcas, modelos y diseños industriales o secretos industriales, o aquellos bienes que el Usuario carece de derecho a vender, o que únicamente puede vender con participación o conformidad de terceros, y bienes embargados o afectados por alguna restricción de cualquier especie, en cuanto a su uso, explotación o transferencia de dominio o posesión. Es responsabilidad exclusiva del Usuario velar por la legalidad de la venta de sus artículos o servicios y ComprarJuntos no asume ninguna responsabilidad por la existencia en el sitio o por transacciones sobre artículos o servicios que no cumplan con esta restricción, por cuanto ComprarJuntos es considerado un intermediario entre Vendedores Ofertantes y Compradores Demandantes.
			</div>
			<li>PRIVASIDAD DE LA INFORMACIÓN</li>
			<div>
				FOMENTAMOS no venderá, alquilará ni negociará con otras empresas su información personal. Estos datos serán usados únicamente para que quien resulte comprador de un bien ofrecido pueda contactarse con el vendedor y realizar la transacción de una manera eficiente. FOMENTAMOS no venderá su base de datos a otras empresas u organizaciones. Sin embargo, FOMENTAMOS podrá compartir dicha información con proveedores de servicios de valor agregado que se integren dentro del sitio o mediante links a otros sitios de Internet, para atender necesidades de los Usuarios relacionadas con los servicios que suministra ComprarJuntos. Toda la información personal que usted transmite se hace a través de una página de Internet segura que protege y encripta su información. Igualmente, su información personal se almacena en servidores o medios magnéticos que mantienen altos estándares de seguridad. FOMENTAMOS hará todo lo necesario para mantener la confidencialidad y seguridad de que trata esta sección, pero no responderá por perjuicios que se puedan derivar de la violación de dichos medidas por parte de terceros que utilicen las redes públicas o el Internet para acceder a dicha información.
			</div>
			<li>OBLIGACIONES DE LOS COMPRADORES</li>
			<div>
				La orden de compra realizada por el Usuario comprador es irrevocable y no puede ser retractada, cancelada o retirada, salvo en circunstancias excepcionales, esto es, cuando el Usuario Vendedor haya actuado indebidamente o de mala fe, con la intención de confundir a los interesados, un bien distinto al que finalmente ha ofrecido en venta; o bien, cuando no haya podido verificarse la información o identidad del Usuario Vendedor; asimismo en los casos en los que se haya modificado la descripción del bien después de realizada alguna oferta.La cantidad ofrecida también podrá ser retractada o cancelada, cuando surgiera de la misma un evidente error tipográfico. Las órdenes  de compra sólo serán consideradas válidas, una vez que hayan sido procesadas por el sistema informático de ComprarJuntos.
			</div>
			<li>OBLIGACIONES DEL VENDEDOR</li>
			<div>
				El Usuario Vendedor debe tener capacidad legal para vender el bien objeto de su oferta. Además debe tener el bien en el mismo estado y condiciones en los que se lo publicará en las listas de bienes ofrecidos de ComprarJuntos. El vendedor podra retractar la venta, cuando no haya podido acordar con el Usuario Comprador sobre la forma de pago, de entrega o no sea posible verificar la verdadera identidad o demás información del Comprador.
			</div>
			<li>PROHIBICIONES</li>
			<div>
				No está permitido el uso de ningún dispositivo, software, u otro medio tendiente a interferir tanto en las actividades y operatoria de ComprarJuntos como en los pedidos o en las bases de datos de ComprarJuntos. Cualquier intromisión, tentativa o actividad violatoria o contraria a las leyes sobre derecho de autor y/o a las prohibiciones estipuladas en este contrato harán pasible a su responsable de las acciones legales pertinentes, y a las sanciones previstas por este acuerdo, así como lo hará responsable de indemnizar los daños ocasionados.
			</div>
			<li>SANCIONES</li>
			<div>
				ComprarJuntos podrá advertir, suspender o cancelar, temporal o definitivamente la Cuenta de un Usuario en cualquier momento, e iniciar las acciones legales que correspondan, si se quebrantara cualquiera de las estipulaciones de este contrato, si se incurre a criterio de ComprarJuntos en conductas o actos indebidos o fraudulentos, o bien si no pudiera verificarse la identidad del Usuario o cualquier información proporcionada por el mismo fuere errónea. En el caso de la suspensión o inhabilitación de un Usuario, todos los productos que tuviera publicados serán dadas de baja. ComprarJuntos se reserva el derecho de cancelar la Cuenta del Usuario que hubiere incumplido sus obligaciones derivadas de una transacción, o si se detectara en su conducta intencionalidad de perjudicar o defraudar a otros Usuarios.
			</div>
			<li>RESPONSABILIDAD</li>
			<div>
				El Usuario acepta que al realizar transacciones con otros Usuarios o terceros lo hace bajo su propio riesgo. El Usuario cuenta con un sistema de información sobre Usuarios, así como un sistema de calificaciones actualizado en tiempo real por los mismos Usuarios. Esto ayudará a evaluar al Usuario con el cual habrá de realizar la transacción. ComprarJuntos NO será responsable por las calificaciones, opiniones y/o comentarios que sus usuarios pongan en cualquier sección dentro de ComprarJuntos , puesto que tales criterios y calificaciones son de la autoría y responsabilidad de los anunciantes y Usuarios. Tales comentarios serán incluidos bajo exclusiva responsabilidad de los Usuarios que los emitan, tal como se expresa en estos Términos y Condiciones. En ningún caso ComprarJuntos se hace responsable por lucro cesante, o por cualquier otro perjuicio que haya podido sufrir el Usuario, debido a las transacciones realizadas o no realizadas a través de ComprarJuntos ,por cuanto tales transacciones se realizan entre Usuarios Vendedores y Compradores de productos y servicios, y ComprarJuntos proporciona el medio a través del cual dichas transacciones pueden realizarse. ComprarJuntos NO será responsable por las transacciones que se lleven a cabo entre los Usuarios, o entre los Usuarios y terceros, por cuanto tales transacciones se realizan entre Usuarios Vendedores y Compradores de productos y servicios, y ComprarJuntos proporciona el medio al través del cual dichas transacciones pueden realizarse. En caso que uno o más Usuarios o algún tercero inicie cualquier tipo de reclamo o acciones legales contra otro u otros Usuarios, todos y cada uno de los Usuarios involucrados en dichos reclamos o acciones eximen de toda responsabilidad a FOMENTAMOS y a sus directores, gerentes, empleados, agentes, operarios, representantes y apoderados, por cuanto tales transacciones se realizan entre Usuarios Vendedores y Compradores de productos y servicios y ComprarJuntos proporciona el medio a través del cual dichas transacciones pueden realizarse.
			</div>
			<li>ALCANCE DE LOS SERVICIOS</li>
			<div>
				Este acuerdo no crea ningún contrato de sociedad, de mandato, de franquicia, o relación laboral entre ComprarJuntos y el Usuario. ComprarJuntos no será responsable respecto de la calidad, cantidad, estado, integridad o legitimidad de los bienes ofrecidos, adquiridos o enajenados por los Usuarios, así como de la capacidad para contratar de los Usuarios. ComprarJuntos no otorga garantía de evicción ni por vicios ocultos o aparentes de los bienes objeto de las transacciones entre los Usuarios, por cuanto tales transacciones se realizan entre Usuarios Vendedores y Compradores de productos y servicios y ComprarJuntos proporciona el medio a través del cual dichas transacciones pueden realizarse. ComprarJuntos no será responsable por la solvencia del Usuario Comprador. El Usuario deberá realizar los pagos correspondientes por envíos, servicios y otros gastos en que incurra por la compra  y por las transacciones realizadas a través de ComprarJuntos . El Usuario reconoce que la transferencia de bienes inmuebles o registrables está sujeta a regulaciones específicas con las cuales deberá cumplir.
			</div>
			<li>FALLAS DEL SISTEMA</li>
			<div>
				ComprarJuntos no se responsabiliza por cualquier daño, perjuicio o pérdida en el equipo del Usuario causado por fallas en el sistema, en el servidor o en Internet, a no ser que se compruebe que por acción, omisión, negligencia por parte de ComprarJuntos. ComprarJuntos tampoco será responsable por cualquier virus que pudiera infectar el equipo del Usuario como consecuencia del acceso, uso o examen del Sitio o a raíz de cualquier transferencia de datos, archivos, imágenes, textos, o audio contenidos en el mismo a no ser que se compruebe acción, omisión, negligencia por parte de ComprarJuntos . Los Usuarios NO podrán imputar responsabilidad alguna ni exigir pago por lucro cesante, en virtud de perjuicios resultantes de dificultades técnicas o fallas en los sistemas o en Internet a no ser que se compruebe acción, omisión, negligencia por parte de ComprarJuntos. ComprarJuntos no garantiza el acceso y uso continuado o ininterrumpido de su Sitio, por causas externas a no ser que se compruebe que por acción, omisión, negligencia por parte de ComprarJuntos se produjo tal interrupción. El sistema puede eventualmente no estar disponible debido a dificultades técnicas o fallas de Internet, o por cualquier otra circunstancia ajena a ComprarJuntos; en tales casos se procurará restablecerlo con la mayor rapidez posible sin que por ello pueda imputarse algún tipo de responsabilidad.
			</div>
			<li>PROPIEDAD INTELECTUAL</li>
			<div>
				Los contenidos de las pantallas relativas a los servicios de ComprarJuntos como así también los programas, bases de datos, redes, archivos que permiten al Usuario acceder y usar su Cuenta, son de propiedad de FOMENTAMOS. y están protegidas por las leyes y tratados internacionales de derecho de autor, marcas, patentes, modelos y diseños industriales. El uso indebido y la reproducción total o parcial de dichos contenidos quedan prohibidos, están penados por la ley con sanciones civiles y penales, y serán objeto de todas las acciones judiciales pertinentes.
			</div>
			<li>LEY APLICABLE</li>
			<div>
				Este acuerdo estará regido en todos sus puntos por las leyes vigentes en la República de Colombia.
			</div>
			<li>JURISDICCIÓN APLICABLE</li>
			<div>
				Para todo lo relativo a la interpretación y cumplimiento de este Contrato, las partes se someten a las leyes aplicables y a los Tribunales competentes de la Ciudad de Medellín, y renuncian a cualquier otro que por razón de sus domicilios presentes o futuros pudiere corresponderles.
			</div>
		</ol>
	</div>
		

	
@endsection
