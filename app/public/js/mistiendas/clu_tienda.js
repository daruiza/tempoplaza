function clu_tienda() {
	this.datos_pie = [];
	this.table_products = '';
	this.table_orders = '';
	this.table_providers = '';
	this.url_img_product = '';
	this.fillable = ['Nombre','Precio','Categorìa','Descripciòn'];
	
}

clu_tienda.prototype.onjquery = function() {
};

clu_tienda.prototype.opt_select = function(controlador,metodo) {
	
	if(clu_tienda.table_products.rows('.selected').data().length){		
		window.location=metodo + "/" + clu_tienda.table_products.rows('.selected').data()[0]['id'];
	}else{
		$('.alerts').html('<div class="alert alert-info fade in"><strong>¡Seleccione un registro!</strong>Esta opción requiere la selección de un registro!!!.<br><br><ul><li>Selecciona un registro dando click sobre él, luego prueba nuevamente la opción</li></ul></div>');
	}
};

clu_tienda.prototype.validateNuevaTienda = function() {
	
	if($("#form_nueva_tienda :input")[1].value =="" || $("#form_nueva_tienda :input")[2].value =="" || $("#form_nueva_tienda :input")[6].value =="" || $("#municipio").val() ==""){
		$('#nuevatienda_modal .alerts-module').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close close_alert_edit_perfil" data-dismiss="alert">&times;</button><strong>!Envio Fallido!</strong></br> Faltan campos por diligenciar.</div>');
		//pintar los inputs problematicos
		for(var i=0; i < $("#form_nueva_tienda :input").length ; i++){
	        if( i==1 || i==2 || i==3 || i==4 || i==6) {
	            if($("#form_nueva_tienda :input")[i].value ==""){
	                $($("#form_nueva_tienda :input")[i]).addClass('input_danger');
	            }
	            if($("#form_nueva_tienda :input")[8].value ==""){
	            	$(".categorias").addClass('input_danger');
	            }
	        }
        }
        $(".close_alert_edit_perfil").on('click', function () { 
        	$("#form_nueva_tienda :input").removeClass("input_danger");
        	$(".categorias").removeClass('input_danger');
        });
		return false;
	}

	//loading
	var opts = {
		  lines: 13 // The number of lines to draw
		, length: 41 // The length of each line
		, width: 10 // The line thickness
		, radius: 56 // The radius of the inner circle
		, scale: 1 // Scales overall size of the spinner
		, corners: 1 // Corner roundness (0..1)
		, color: '#000' // #rgb or #rrggbb or array of colors
		, opacity: 0.25 // Opacity of the lines
		, rotate: 0 // The rotation offset
		, direction: 1 // 1: clockwise, -1: counterclockwise
		, speed: 1 // Rounds per second
		, trail: 60 // Afterglow percentage
		, fps: 20 // Frames per second when using setTimeout() as a fallback for CSS
		, zIndex: 2e9 // The z-index (defaults to 2000000000)
		, className: 'spinner' // The CSS class to assign to the spinner
		, top: '50%' // Top position relative to parent
		, left: '50%' // Left position relative to parent
		, shadow: false // Whether to render a shadow
		, hwaccel: false // Whether to use hardware acceleration
		, position: 'absolute' // Element positioning
	}		
	clu_tienda.spinner = new Spinner(opts).spin(document.getElementsByTagName("body")[0]);
	
	return true;
};

clu_tienda.prototype.validateNuevoProducto = function() {
	if($("#form_nuevo_producto :input")[1].value =="" || $("#form_nuevo_producto :input")[2].value ==""){
		$('#nuevoproducto_modal .alerts-module').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close close_alert_product" data-dismiss="alert">&times;</button><strong>!Envio Fallido!</strong></br> Faltan campos por diligenciar.</div>');
		//pintar los inputs problematicos
		for(var i=0; i < $("#form_nuevo_producto :input").length ; i++){
	        if( i==1 || i==2 ) {
	            if($("#form_nuevo_producto :input")[i].value ==""){
	                $($("#form_nuevo_producto :input")[i]).addClass('input_danger');
	            }	            
	        }
        }
        $(".close_alert_product").on('click', function () { 
        	$("#form_nuevo_producto :input").removeClass("input_danger");        	
        });
		return false;
	}
	return true;
};

clu_tienda.prototype.validateNuevoProveedorPago = function() {
	if($("#form_nuevo_proveedorpago :input")[1].value =="" || $("#form_nuevo_proveedorpago :input")[6].value =="" || $("#form_nuevo_proveedorpago :input")[7].value ==""){
		$('#nuevoproveedor_modal .alerts-module').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close close_alert_product" data-dismiss="alert">&times;</button><strong>!Envio Fallido!</strong></br> Faltan campos por diligenciar.</div>');
		//pintar los inputs problematicos
		for(var i=0; i < $("#form_nuevo_proveedorpago :input").length ; i++){
	        if( i==6 || i==7 ) {
	            if($("#form_nuevo_proveedorpago :input")[i].value ==""){
	                $($("#form_nuevo_proveedorpago :input")[i]).addClass('input_danger');
	            }	            
	        }
        }
        $(".close_alert_product").on('click', function () { 
        	$("#form_nuevo_proveedorpago :input").removeClass("input_danger");        	
        });
		return false;
	}
	return true;
};

clu_tienda.prototype.consultaRespuestaProducts = function(result) {

	$('#productos_modal .modal-title').html('Productos Tienda '+result.request.name);
	if(!result.productos){
		$('#productos_modal .alerts-module').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>!La tienda aùn no tiene Productos!</strong></br> Para crear un nuevo producto, no esperes màs y crea un producto dando click en la opciòn <a href="#"><div class="" id="btn_nueva_tienda_a" data-toggle="modal" data-target="#nuevoproducto_modal"><b> Crear un Producto</b></div></a></div>');
	}
	//$('#productos_modal').modal();
	//llenamos el select de categorias, para la creación de nuevos productos, de esta tienda seleccionada
	categoria_select=document.getElementById('categoria_select')
	categoria_select.innerHTML = "";
	for (var key in result.data) {
		var opt = document.createElement('option');
		opt.value = key;
		opt.innerHTML = result.data[key];
		categoria_select.appendChild(opt);
	}
	//actualiza el select dinamico
	$('#categoria_select').trigger("chosen:updated");
	
	$('#productos_modal').modal();
};

clu_tienda.prototype.consultaRespuestaProduct = function(result) {
	clu_tienda.rowprod.child( clu_tienda.format(clu_tienda.rowprod.data(),result.request)).show();

	//limpiar el imput file
	$('#imge_product').val('');
	$($('#imge_product').parent().children()[1]).children()[0].value="";
	//reasignamos la imagen por defecto		
	$('#img_product').attr('src',result.request.url+'/users/'+result.request.usuario+'/products/'+clu_tienda.rowprod.data().image1);
	clu_tienda.url_img_product = result.request.url+'/users/'+result.request.usuario+'/products/'+clu_tienda.rowprod.data().image1;

	$('.editproduct').on('click', function (e) {
		//buscamos los datos seleccionados
		for(var i=0; i < clu_tienda.table_products.data().length; i++){
			if(this.className.split(' ')[0].split('_')[3]==clu_tienda.table_products.data()[i].id){
				//encontramos los datos
				$('#modal-title-product').html('Editar Producto');
				$( "input[name='edit_product']").val(true);
				$( "input[name='product_id']").val(clu_tienda.table_products.data()[i].id);
				$('#nombre_producto').val(clu_tienda.table_products.data()[i].name);
				$('#precio').val(clu_tienda.table_products.data()[i].price);
				$('#categoria_select').val(clu_tienda.table_products.data()[i].category);
				$('#descripcion_producto').val(clu_tienda.table_products.data()[i].description);
				$('#prioridad_producto').val(clu_tienda.table_products.data()[i].order);				
				//imagen, se reemplaza el src del elemento
				$('#img_product').attr('src',$('#img_product').attr('src').replace($('#img_product').attr('src').split('/')[$('#img_product').attr('src').split('/').length-1],clu_tienda.table_products.data()[i].image1));
				$('#img_product2').attr('src',$('#img_product2').attr('src').replace($('#img_product2').attr('src').split('/')[$('#img_product2').attr('src').split('/').length-1],clu_tienda.table_products.data()[i].image2));
				$('#img_product3').attr('src',$('#img_product3').attr('src').replace($('#img_product3').attr('src').split('/')[$('#img_product3').attr('src').split('/').length-1],clu_tienda.table_products.data()[i].image3));
				$('#unidades_select').val(clu_tienda.table_products.data()[i].unity_measure);
				$('#unidades_medida').val(clu_tienda.table_products.data()[i].unity_measure);
				$('#colores_select').val(clu_tienda.table_products.data()[i].colors);
				$('#colores').val(clu_tienda.table_products.data()[i].colors);
				$('#tallas_select').val(clu_tienda.table_products.data()[i].sizes);
				$('#tallas').val(clu_tienda.table_products.data()[i].sizes);
				$('#sabores_select').val(clu_tienda.table_products.data()[i].flavors);
				$('#sabores').val(clu_tienda.table_products.data()[i].flavors);
				$('#materiales_select').val(clu_tienda.table_products.data()[i].flavors);
				$('#materiales').val(clu_tienda.table_products.data()[i].materials);
				$('#modelos').val(clu_tienda.table_products.data()[i].models);
				$('#basic_class').val(clu_tienda.table_products.data()[i].basic_class);
				$('.estado-roduct').show();
				$('input[name=estado_producto][value='+clu_tienda.table_products.data()[i].active+']').attr("checked", "checked");
				$('#modal-button-product').html('Editar Producto')

				//Mostrar Modal
				$('#nuevoproducto_modal').modal();
				//para hacer efectivo el cambio del chossen
				$('#categoria_select').trigger("chosen:updated");
				$('#unidades_select').val(clu_tienda.table_products.data()[i].unity_measure.split(',')).trigger("chosen:updated");
				$('#colores_select').val(clu_tienda.table_products.data()[i].colors.split(',')).trigger("chosen:updated");
				$('#tallas_select').val(clu_tienda.table_products.data()[i].sizes.split(',')).trigger("chosen:updated");
				$('#sabores_select').val(clu_tienda.table_products.data()[i].flavors.split(',')).trigger("chosen:updated");
				$('#materiales_select').val(clu_tienda.table_products.data()[i].materials.split(',')).trigger("chosen:updated");
				break;
			}
		}	

		$('#imge_product').change(function(e) {
	    	var file = e.target.files[0],
		    imageType = /image.*/;
		    
		    if (!file.type.match(imageType))
		    return;
		  
		    var reader = new FileReader();
		    reader.onload = function(e) {
		    	var result=e.target.result;
		    	$('#img_product').attr("src",result);
		    }
		    reader.readAsDataURL(file);
	    });

	    $('#imge_product2').change(function(e) {
	    	var file = e.target.files[0],
		    imageType = /image.*/;
		    
		    if (!file.type.match(imageType))
		    return;
		  
		    var reader = new FileReader();
		    reader.onload = function(e) {
		    	var result=e.target.result;
		    	$('#img_product2').attr("src",result);
		    }
		    reader.readAsDataURL(file);
	    });	

	    $('#imge_product3').change(function(e) {
	    	var file = e.target.files[0],
		    imageType = /image.*/;
		    
		    if (!file.type.match(imageType))
		    return;
		  
		    var reader = new FileReader();
		    reader.onload = function(e) {
		    	var result=e.target.result;
		    	$('#img_product3').attr("src",result);
		    }
		    reader.readAsDataURL(file);
	    });		   
			    
	});	

};

clu_tienda.prototype.format= function(d,r) {    			
    var html = ''+
    '<div class="panel panel-default">'+
    	'<div class="panel-heading">'+
    		'<a href="#" style="text-decoration: none; color: #777">'+
				'<div class="btn_editar_producto_'+d.id+' editproduct" id="btn_editar_producto" >'+
					'<span class="glyphicon glyphicon-cog" aria-hidden="true" style=""></span>'+
					'<span> Editar este Producto</span>'+
				'</div>'+
			'</a>'+
    	'</div>'+			        
    	'<div class="panel-body">'+
			'<div class="row">'+
				'<div class="col-md-12">'+
					'<div class="col-md-8 product_more">'+
						'<div>'+					
							'<label for="description" class="col-md-12 control-label">Descripciòn</label>'+
							''+d.description+''+
						'</div>';
						
						if(d.colors != ''){
							html = html + '<div>';
							html = html +'<label for="colores" class="col-md-12 control-label">Colores Disponibles</label>'+
							''+d.colors+'</div>';						
						}

						if(d.sizes != ''){
							html = html +'<div><label for="tallas" class="col-md-12 control-label">Tallas o Tamaños Disponibles</label>'+
							''+d.sizes+'</div>';						
						}	

						if(d.flavors != ''){
							html = html +'<div><label for="sabores" class="col-md-12 control-label">Sabores Disponibles</label>'+
							''+d.flavors+'</div>';				
						}

						if(d.materials != ''){
							html = html +'<div><label for="materiales" class="col-md-12 control-label">Materiales Disponibles</label>'+
							''+d.materials+'</div>';					
						}

						if(d.models != ''){
							html = html +'<div><label for="modelos" class="col-md-12 control-label">Modelos Disponibles</label>'+
							''+d.models+'</div>';					
						}

						if(d.basic_class != ''){
							html = html +'<div><label for="basic_class" class="col-md-12 control-label">Etiqueta</label>'+
							''+d.basic_class+'</div>';					
						}

						html = html +'<div><label for="prioridad" class="col-md-12 control-label">Nivel de Prioridad</label>';
						html = html + 'Orden: '+d.order+'</div>';

						if(d.active){
							html = html +'<div><label for="active" class="col-md-12 control-label">Estado de Producto</label>';
							html = html + 'Activo </div>';
						}else{
							html = html +'<div><label for="active" class="col-md-12 control-label">Estado de Producto</label>';
							html = html + 'Desactivo </div>';
						}					
		html = html +'</div>'+
					'<div class="col-md-4" style="text-align: center;">'+
						'<label for="img_product_descrip" class="col-md-12 control-label">Imagen de Producto</label>'+
						'<img src="'+r.url+'/users/'+r.usuario+'/products/'+d.image1+'" id="img_product_descrip" style="width: 90%; border:2px solid #ddd;border-radius: 0%;" alt="Imagen no disponible">'+
						'<a href="#" class="btn btn-default col-md-12" style="text-decoration: none; color: #777; margin-top: 10px; " >'+
							'<div class="btn_editar_producto_'+d.id+' editproduct" id="btn_editar_producto" >'+
								'<span class="glyphicon glyphicon-cog" aria-hidden="true" style=""></span>'+
								'<span> Editar este Producto</span>'+
							'</div>'+
						'</a>'+
					'</div>'+
				'</div>'+
			'</div>'+
    	'</div>'+    
    '</div>';
    return html;
};

clu_tienda.prototype.consultaRespuestaOrders = function(result) {
	$('#odenes_modal').modal();
	//recuperar el focus sobre el modal de ordenes
	/*
	$('#odenes_modal').modal({
		focus: this,
		show: true
	});
	*/
};

clu_tienda.prototype.consultaRespuestaOrder = function(result) {
	clu_tienda.roworder.child( clu_tienda.formatorder(clu_tienda.roworder.data(),result.request ,result.data,result.annotations)).show();
	//OPCIONES DE PEDIDO DE ORDEN
	$('.stage_cambio').on('click', function (e) {

		var datos = new Array();
		datos['stage'] = this.id.split('_')[1];
		datos['id_order'] = this.id.split('_')[2];
		datos['id_store'] = this.id.split('_')[3];
		clu_tienda.datos_order = datos;

		$('#confirm_order').modal().one('click', '#continue_order', function(e) {
			//bloquear el div de los botones
		    $('.stage_cambio')[0].parentElement.remove();
		    //agregamos el mensaje
		    clu_tienda.datos_order.menssage_order = $( "textarea[name='message_order']").val().split("\n").join("");
		    seg_ajaxobject.peticionajax($('#form_stage_order').attr('action'),clu_tienda.datos_order,"clu_tienda.cambiarRespuestaOrden");
		    //loading
			var opts = {
				  lines: 13 // The number of lines to draw
				, length: 41 // The length of each line
				, width: 10 // The line thickness
				, radius: 56 // The radius of the inner circle
				, scale: 1 // Scales overall size of the spinner
				, corners: 1 // Corner roundness (0..1)
				, color: '#000' // #rgb or #rrggbb or array of colors
				, opacity: 0.25 // Opacity of the lines
				, rotate: 0 // The rotation offset
				, direction: 1 // 1: clockwise, -1: counterclockwise
				, speed: 1 // Rounds per second
				, trail: 60 // Afterglow percentage
				, fps: 20 // Frames per second when using setTimeout() as a fallback for CSS
				, zIndex: 2e9 // The z-index (defaults to 2000000000)
				, className: 'spinner' // The CSS class to assign to the spinner
				, top: '50%' // Top position relative to parent
				, left: '50%' // Left position relative to parent
				, shadow: false // Whether to render a shadow
				, hwaccel: false // Whether to use hardware acceleration
				, position: 'absolute' // Element positioning
			}		
			clu_tienda.spinner = new Spinner(opts).spin(document.getElementsByTagName("body")[0]);
	    });
	});	
};

clu_tienda.prototype.formatorder= function(d,r,data,annotations) {
	 var html = ''+
    	
	 	'<div class="panel panel-default">'+
	 		'<div class="panel-body">'+
	 			'<div class="row" style="text-align: center;"> '+
	 				'<div class="col-md-4">'+
	 					'<b>Direcciòn:</b> '+d.adress_client+''+
	 				'</div>'+	
	 				'<div class="col-md-4">'+
	 					'<b>Correo:</b> '+d.email_client+''+
	 				'</div>'+	
	 				'<div class="col-md-4">'+
	 					'<b>Contacto:</b> '+d.number_client+''+
	 				'</div>'+	
	 			'</div>'+
	 		'</div>'+
	 	'</div>'+

    	'<div class="panel panel-default">'+
    		'<div class="panel-heading">'+
	    		'<a href="#" style="text-decoration: none; color: #777">'+
					'<div class=" btn_editar_orden_'+d.id+'" id="btn_editar_orden" >'+
						//'<span class="glyphicon glyphicon-th-list" aria-hidden="true" style=""></span>'+
						'<span style="color: black;"><b> DETALLES DEL PEDIDO</b></span>'+
					'</div>'+
				'</a>'+
	    	'</div>'+
	    	'<div class="panel-body">'+
				'<div class="row" style="text-align: center;"> '+
					'<div class="col-md-12">'+
						'<div class="col-md-12" style="border: solid black;border-width: 0px 0px 1px 0px;">'+
							'<div class="col-md-3">'+							
								'<span for="producto" class="col-md-12 ">PRODUCTO</span>'+	
							'</div>'+
							'<div class="col-md-3">'+							
								'<span for="description" class="col-md-12 ">DESCRPCIÒN</span>'+	
							'</div>'+
							'<div class="col-md-2">'+							
								'<span for="precio" class="col-md-12">PRECIO</span>'+	
							'</div>'+
							'<div class="col-md-2">'+							
								'<span for="cantidad" class="col-md-12 ">CANTIDAD</span>'+	
							'</div>'+						
							'<div class="col-md-2">'+							
								'<span for="total" class="col-md-12 ">TOTAL</span>'+	
							'</div>'+
						'</div>';

						fondo_bandera = -1;
						background = 'none';
						cantidad_total = 0;
        				precio_total = 0;

						for(var i=0; i < data.length ; i++){
							
							if(fondo_bandera==1){
				                background = "#e7e7e7";
				            }

			html = html +'<div class="col-md-12" style="background:'+background+';">'+
							'<div class="col-md-3">'+							
								''+data[i]['product']+
							'</div>'+
							'<div class="col-md-3">'+							
								''+data[i]['description']+
							'</div>'+
							'<div class="col-md-2">'+							
								''+data[i]['price']+
							'</div>'+							
							'<div class="col-md-2">'+							
								''+data[i]['volume']+
							'</div>'+							
							'<div class="col-md-2">'+							
								'$'+(parseInt(data[i]['volume'])*parseInt(data[i]['price']))+
							'</div>'+
						'</div>';

						cantidad_total = parseInt(cantidad_total) + parseInt(data[i]['volume']);
						precio_total = parseInt(precio_total) + (parseInt(data[i]['volume'])*parseInt(data[i]['price']));

						 fondo_bandera = fondo_bandera*-1;
						 background = 'none';

						}			

     html = html +'</div>'+			
				'</div>'+
	    	'</div>'+
			'<div class="panel-footer" >'+
				'<span> Cantidad de productos a llevar: <label>'+cantidad_total+'</label>. Total a Pagar: $'+precio_total+'.</span>';
	 
	 //los botones dependen del estado de la orden
	 if(d.stage_id == 1){
	 	//estado PENDIENTE
	 	html = html +'<div style="float: right;">'+				
					'<a href="#"  id = "stage_rechazado_'+d.id+'_'+r.id_tienda+'" class="btn btn-warning stage_cambio" style="text-decoration: none; margin-right: 10px;" >'+						
						'<span class="glyphicon glyphicon-remove" aria-hidden="true" style=""></span>'+
						'<span> Rechazar Pedido</span>'+						
					'</a>'+
					'<a href="#" id = "stage_aceptado_'+d.id+'_'+r.id_tienda+'" class="btn btn-success stage_cambio" style="text-decoration: none; margin-right: 10px;">'+						
						'<span class="glyphicon glyphicon-ok" aria-hidden="true" style=""></span>'+
						'<span> Aceptar Pedido</span>'+						
					'</a>'+
				'</div>';
	 }else{
	 	if(d.stage_id == 2){
	 		//ACEPTADO
	 		html = html +'<div style="float: right;">'+
	 				'<a href="#"  id = "stage_rechazado_'+d.id+'_'+r.id_tienda+'" class="btn btn-warning stage_cambio" style="text-decoration: none; margin-right: 10px;" >'+						
						'<span class="glyphicon glyphicon-remove" aria-hidden="true" style=""></span>'+
						'<span> Rechazar Pedido</span>'+						
					'</a>'+								
					'<a href="#" id = "stage_finalizado_'+d.id+'_'+r.id_tienda+'" class="btn btn-success stage_cambio" style="text-decoration: none; margin-right: 10px;">'+						
						'<span class="glyphicon glyphicon-ok" aria-hidden="true" style=""></span>'+
						'<span> Pedido Entregado</span>'+						
					'</a>'+
				'</div>';
	 	}else{
	 		//
	 		//RECHAZADO, podriamos retornarlo a pendiente.
	 	}
	 }	  


	html = html +'</div>'+		
   		'</div>';
   	//fin del panel de detalle

   	//panel de sugerencias
   	html =  html +
    	'<div class="panel panel-default">'+
    		'<div class="panel-heading">'+
	    		'<a href="#" style="text-decoration: none; color: #777">'+
					'<div class="" id="" >'+
						//'<span class="glyphicon glyphicon-list-alt" aria-hidden="true" style=""></span>'+
						'<span style="color: black;"><b> INDICACIONES Y SUGERENCIAS</b></span>'+
					'</div>'+
				'</a>'+
	    	'</div>'+
	    	'<div class="panel-body">'+
	    		'<div class="row" style="text-align: center;"> '+
	    			'<div class="col-md-12">'+	
						'<div class="col-md-12" style="border: solid black;border-width: 0px 0px 1px 0px;">'+
							'<div class="col-md-2">'+							
								'<span for="nombre_usuario" class="col-md-12 ">USUARIO</span>'+	
							'</div>'+
							'<div class="col-md-7">'+							
								'<span for="nota_usuario" class="col-md-12 ">DESCRIPCIÒN</span>'+	
							'</div>'+
							'<div class="col-md-3">'+							
								'<span for="fecha_nota" class="col-md-12 ">FECHA</span>'+	
							'</div>'+
						'</div>';

						fondo_bandera = -1;
						background = 'none';
						for(var i=0; i < annotations.length ; i++){
							
							if(fondo_bandera==1){
				                background = "#e7e7e7";
				            }

	            html = html +'<div class="col-md-12" style="background:'+background+';">'+
		            			'<div class="col-md-2">'+							
									''+annotations[i]['user_name']+
								'</div>'+
								'<div class="col-md-7" style="text-align: justify;">'+							
									''+annotations[i]['description']+
								'</div>'+
								'<div class="col-md-3">'+							
									''+annotations[i]['date']+
								'</div>'+
	            			'</div>';

				            fondo_bandera = fondo_bandera*-1;
						 	background = 'none';
				        }

	 	html = html +'</div>'+
	 			'</div>'+
	    	'</div>'+	    	
    	'</div>';

    	if(d.resenia_active){
    		html =  html +
	    	'<div class="panel panel-default">'+
		 		'<div class="panel-heading">'+
		    		'<a href="#" style="text-decoration: none; color: #777">'+
						'<div class="" id="" >'+
							//'<span class="glyphicon glyphicon-list-alt" aria-hidden="true" style=""></span>'+
							'<span style="color: black;"><b>RESEÑA</b></span>'+
						'</div>'+
					'</a>'+
		    	'</div>'+
		 		'<div class="panel-body">'+
		 			'<div class="row" style="text-align: center;"> '+
		 				'<div class="col-md-3">';

		 					if(d.resenia == 1){
		 						html =  html +'Muy Mal Servicio'+
	 							'</div>'+
	 							'<div class="col-md-2">'+
				 					'<span class="rating" style="font-size: 20px;">'+
							        	'<span id="star_1" class="star  glyphicon glyphicon-star"></span>'+
							        	'<span id="star_2" class="star  glyphicon glyphicon-star-empty"></span>'+
							        	'<span id="star_3" class="star  glyphicon glyphicon-star-empty"></span>'+
							        	'<span id="star_4" class="star  glyphicon glyphicon-star-empty"></span>'+
							        	'<span id="star_5" class="star  glyphicon glyphicon-star-empty"></span>'+
							        '</span>'+
				 				'</div>';
		 					}

		 					if(d.resenia == 2){
		 						html =  html +'Mal Servicio'+
		 						'</div>'+
		 						'<div class="col-md-2">'+
				 					'<span class="rating" style="font-size: 20px;">'+
							        	'<span id="star_1" class="star  glyphicon glyphicon-star"></span>'+
							        	'<span id="star_2" class="star  glyphicon glyphicon-star"></span>'+
							        	'<span id="star_3" class="star  glyphicon glyphicon-star-empty"></span>'+
							        	'<span id="star_4" class="star  glyphicon glyphicon-star-empty"></span>'+
							        	'<span id="star_5" class="star  glyphicon glyphicon-star-empty"></span>'+
							        '</span>'+
				 				'</div>';
		 					}
		 					if(d.resenia == 3){
		 						html =  html +'Regular Servicio'+
		 						'</div>'+
		 						'<div class="col-md-2">'+
				 					'<span class="rating" style="font-size: 20px;">'+
							        	'<span id="star_1" class="star  glyphicon glyphicon-star"></span>'+
							        	'<span id="star_2" class="star  glyphicon glyphicon-star"></span>'+
							        	'<span id="star_3" class="star  glyphicon glyphicon-star"></span>'+
							        	'<span id="star_4" class="star  glyphicon glyphicon-star-empty"></span>'+
							        	'<span id="star_5" class="star  glyphicon glyphicon-star-empty"></span>'+
							        '</span>'+
				 				'</div>';
		 					}
		 					if(d.resenia == 4){
		 						html =  html +'Buen Servicio'+
		 						'</div>'+
		 						'<div class="col-md-2">'+
				 					'<span class="rating" style="font-size: 20px;">'+
							        	'<span id="star_1" class="star  glyphicon glyphicon-star"></span>'+
							        	'<span id="star_2" class="star  glyphicon glyphicon-star"></span>'+
							        	'<span id="star_3" class="star  glyphicon glyphicon-star"></span>'+
							        	'<span id="star_4" class="star  glyphicon glyphicon-star"></span>'+
							        	'<span id="star_5" class="star  glyphicon glyphicon-star-empty"></span>'+
							        '</span>'+
				 				'</div>';
		 					}
		 					if(d.resenia == 5){
		 						html =  html +'Muy Buen Servicio'+
		 						'</div>'+
		 						'<div class="col-md-2">'+
				 					'<span class="rating" style="font-size: 20px;">'+
							        	'<span id="star_1" class="star  glyphicon glyphicon-star"></span>'+
							        	'<span id="star_2" class="star  glyphicon glyphicon-star"></span>'+
							        	'<span id="star_3" class="star  glyphicon glyphicon-star"></span>'+
							        	'<span id="star_4" class="star  glyphicon glyphicon-star"></span>'+
							        	'<span id="star_5" class="star  glyphicon glyphicon-star"></span>'+
							        '</span>'+
				 				'</div>';
		 					}

		 				html =  html + ''+
		 				'<div class="col-md-7" style="text-align: justify;">'+
		 					''+d.resenia_test+''+
		 				'</div>'+	
		 			'</div>'+
		 		'</div>'+
		 	'</div>';
    	}
    
	return html;
};

clu_tienda.prototype.cambiarRespuestaOrden = function(result) {	
	clu_tienda.spinner.el.remove();
	//clu_tienda.table_orders.ajax.reload();
	clu_tienda.table_orders.search( "Orden_"+result.request.id_order).draw();
	if(result.data == true){
		$('#odenes_modal .alerts-module').html('<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>!La Orden ha sido actualizada correctamente!</strong></br> Orden actualizada: '+result.request.id_order+'</br> Ahora la Orden esta en el estado: '+result.request.stage+'</div>');
	}else{
		//ubo un error en el envio del mensage
		$('#odenes_modal .alerts-module').html('<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>!La Orden ha sido actualizada correctamente!</strong></br> Sin embargo el correo no llego al cliente </br> '+result.data+' </br>Intenta contactar el cliente si en caso dejo su nùmero de contacto para que sepa sobre el nuevo estado ('+result.request.stage+') de la orden de pedido: '+result.request.id_order+' </div>');
	}	
};

clu_tienda.prototype.consultaRespuestaProviders = function(result) {
	$('#ppago_modal .modal-title').html('Provedores de Pago Tienda '+result.request.name);
	
	if(!result.data){
		$('#ppago_modal .alerts-module').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>!La tienda aùn no tiene Métodos de pago Virtual!</strong></br> Para agregar un nuevo método de pago, no esperes màs y agrega un proveedor dando click en la opciòn <a href="#"><div class="" id="btn_nueva_tienda_a" data-toggle="modal" data-target="#nuevoproveedor_modal"><b> Crear un Proveedor de Pago</b></div></a></div>');
	}

	type_select=document.getElementById('type_select')
	type_select.innerHTML = "";
	var opt = document.createElement('option');
	opt.value = '';
	opt.innerHTML = 'Selecciona un tipo de Proveedor';
	type_select.appendChild(opt);
	for (var key in result.types) {
		var opt = document.createElement('option');
		opt.value = key;
		opt.innerHTML = result.types[key];
		type_select.appendChild(opt);
	}
	//actualiza el select dinamico
	$('#type_select').trigger("chosen:updated");

	//metodo type select
	$("#type_select").chosen().change(function(event) {

		if($('#type_select').chosen().val() == 'payu'){
			$('#nuevoproveedor_modal #data').text('{"merchantId":"", "accountId":"", "ApiKey":"", "ApiLogin":"", "PlublicKey":"", "currency":"", "shippingCountry":""}');
			
			var html = ''+
			'<h4>PayU</h4>'+
			'<div>URL: https://www.payulatam.com/co/ </div>'+
			'<xmp><form method="post" action="https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu/"></xmp>'+
			'<xmp><input name="merchantId" type="hidden" value="508029"></xmp>'+
			'<xmp><input name="accountId" type="hidden" value="512321"></xmp>'+
			'<xmp><input name="description" type="hidden" value="Test PAYU"></xmp>'+
			'<xmp><input name="referenceCode" type="hidden" value="TestPayU"></xmp>'+
			'<xmp><input name="amount" type="hidden" value="20000"></xmp>'+
			'<xmp><input name="tax" type="hidden" value="3193"></xmp>'+
			'<xmp><input name="taxReturnBase" type="hidden" value="16806"></xmp>'+
			'<xmp><input name="currency" type="hidden" value="COP"></xmp>'+
			'<xmp><input name="lng" type="hidden"  value="es"></xmp>'+
			'<xmp><input name="signature" type="hidden" value="7ee7cf808ce6a39b17481c54f2c57acc"></xmp>'+
			'<xmp><input name="test" type="hidden" value="1"></xmp>'+
			'<xmp><input name="buyerEmail" type="hidden" value="test@test.com"></xmp>'+
			'<xmp><input name="responseUrl" type="hidden" value="http://www.test.com/response"></xmp>'+
			'<xmp><input name="confirmationUrl" type="hidden" value="http://www.test.com/confirmation"></xmp>'+
			'<xmp><input name="Submit" type="submit" value="Enviar" ></xmp>'+				
			'<xmp><form></xmp>'+
			'<p>Pruebas: https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu/</p>'+
			'<p>Producción: https://checkout.payulatam.com/ppp-web-gateway-payu/</p>';
			
			$('#nuevoproveedor_modal .method_description').html(html);
			
		}
	});

	$('#ppago_modal').modal()
	
};

clu_tienda.prototype.consultaRespuestaProvider = function(result) {
	clu_tienda.rowppago.child( clu_tienda.formatppago(clu_tienda.rowppago.data(),result.request)).show();
	//bonton etitar 
	$('.editppago').on('click', function (e) {
		//buscamos los datos seleccionados
		for(var i=0; i<clu_tienda.table_providers.data().length; i++){
			if(this.className.split(' ')[0].split('_')[3]==clu_tienda.table_providers.data()[i].id){
				//encontramos los datos
				
				$('#modal-title-provider').html('Editar Proveedor '+clu_tienda.table_providers.data()[i].name);
				$("#nuevoproveedor_modal input[name='payment_method_id']").val(clu_tienda.table_providers.data()[i].id);
				$('#nuevoproveedor_modal #type_select').val(clu_tienda.table_providers.data()[i].type);
				$('#nuevoproveedor_modal #name').val(clu_tienda.table_providers.data()[i].name);
				$('#nuevoproveedor_modal #description').val(clu_tienda.table_providers.data()[i].description);
				$('#nuevoproveedor_modal #data').val(clu_tienda.table_providers.data()[i].data);
				if(clu_tienda.table_providers.data()[i].active){
					//si se esta activa
					$('#nuevoproveedor_modal input[name=active][value=activa]').attr("checked", "checked");
				}
				if(clu_tienda.table_providers.data()[i].test){
					//si se esta activa
					$('#nuevoproveedor_modal input[name=test][value=produccion]').attr("checked", "checked");
				}

				$('#modal-button-providerpay').html('Editar Proveedor')
				
				//Mostrar Modal
				$('#nuevoproveedor_modal').modal();
				
				//para hacer efectivo el cambio del chossen
				$('#nuevoproveedor_modal #type_select').trigger("chosen:updated");				
				break;
				
			};
		}	    
	});
};

clu_tienda.prototype.formatppago= function(d,r) {
	
	var estado = 'Inactiva';
	if(d.active){estado = 'Activa'}
	var ambiente = 'Pruebas';
	if(d.test){ambiente = 'Producción'}
	


	var html = ''+
	
    '<div class="panel panel-default">'+
    	
    	'<div class="panel-heading">'+

    		'<a href="#" style="text-decoration: none; color: #777">'+
				'<div class="btn_editar_ppago_'+d.id+' editppago" id="btn_editar_ppago" >'+
					'<span class="glyphicon glyphicon-cog" aria-hidden="true" style=""></span>'+
					'<span> Editar este Proveedor de Pago</span>'+
				'</div>'+
			'</a>'+

    	'</div>'+
    	
    	'<div class="panel-body">'+
			'<div class="row">'+
				'<div class="col-md-12">'+
					
					'<div class="col-md-7" style="overflow-wrap: break-word;">'+
						
						'<div class="col-md-12">'+					
							'<label for="name" class="col-md-12 control-label">Nombre de Método</label>'+
							''+d.name+''+
						'</div>'+

						'<div class="col-md-12">'+					
							'<label for="description" class="col-md-12 control-label">Descripciòn</label>'+
							''+d.description+''+
						'</div>'+

						'<div class="col-md-12">'+					
							'<label for="data" class="col-md-12 control-label">Metadatos</label>'+
							''+d.data+''+
						'</div>'+						
						
						'<div class="col-md-12">'+					
							'<label for="data" class="col-md-12 control-label">Estado</label>'+
							''+estado+''+
						'</div>'+	
						'<div class="col-md-12">'+					
							'<label for="data" class="col-md-12 control-label">Ambiente</label>'+
							''+ambiente+''+
						'</div>'+
						
					'</div>'+
					
					'<div class="col-md-5" style="text-align: center;>'+
						
						'<label for="img_product_descrip" class="col-md-12 control-label">Imagen de Proveedor</label>'+
						'<img src="'+r.url+'/images/payprovider/'+d.type+'.png" id="img_ppago" style="width: 100%; border-radius: 0%;" alt="Imagen no disponible">'+
						'<a href="#" class="btn btn-default col-md-12" style="text-decoration: none; color: #777; margin-top: 10px; " >'+
							'<div class="btn_editar_ppago_'+d.id+' editppago" id="btn_editar_ppago" >'+
								'<span class="glyphicon glyphicon-cog" aria-hidden="true" style=""></span>'+
								'<span> Editar este Proveedor</span>'+
							'</div>'+
						'</a>'+						

					'</div>'+
					
				'</div>'+
			'</div>'+
		'</div>'+		
    '</div>';

    //return '<div class="panel panel-default"><div class="panel-heading">Panel Heading</div><div class="panel-body">Panel Content</div></div>';

    return html;
};

var clu_tienda = new clu_tienda();





