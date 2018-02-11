function seg_user() {
	
	this.btn_editar = 1 ;
    this.cart_store_id;//esta variable de momento no se usara, incapasidad de ser global
    this.cart_products = new Array();
    this.cart_contador = 1;
    this.table_orders = '';
    this.table_senders = '';
    this.table_receiver = '';
    this.datos_productos = [];
    this.datos_pie_orders = [];
    this.colores_pie_orders = [];
    this.datos_pie_resenias = [];
    this.colores_pie_resenias = [];
    //modal de captura de datos
    this.btn_enviar_modal = 0 ;
    //id de refresh carrusel index
    this.refresh_interval_id = 0 ;
    this.refresh_interval = 700 ;
    this.refresh_background = -1 ;
    this.refresh_index = 0 ;  
    this.isMobile;

    //refrescamos el brand del carrito de compras, ante el refresh de seg_user
}
	
seg_user.prototype.onjquery = function() {	
};

seg_user.prototype.validateLogin = function() {
	
	if($("#login :input")[0].value =="" || $("#login :input")[1].value ==""){
		$('#login_modal .alerts-module').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>!Ingreso Fallido!</strong> Faltan campos por diligenciar.</div>');
		return false;
	}
	return true;
};

seg_user.prototype.validateRegistry = function() {
	if($("#registry :input")[0].value =="" || $("#registry :input")[2].value =="" || $("#registry :input")[3].value ==""){
		$('#registry_modal .alerts-module').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>!Registro Fallido!</strong></br> Faltan campos por diligenciar.</div>');
		return false;
	}else{
		if($("#registry :input")[2].value != $("#registry :input")[3].value){	
			$('#registry_modal .alerts-module').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>!Registro Fallido!</strong></br> La Contraseña no coincide.</div>');
			return false;
		}
        if($("input[name='tyc']:checked").length == 0){
            $('#registry_modal .alerts-module').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>!Registro Fallido!</strong></br> Debes aceptar los terminos y condiciones.</div>');
            return false;   
        }
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
    seg_user.spinner = new Spinner(opts).spin(document.getElementsByTagName("body")[0]);	
	return true;
};

seg_user.prototype.validatePassword = function() {
	if($("#cpsw :input")[0].value =="" || $("#cpsw :input")[1].value =="" || $("#cpsw :input")[2].value ==""){
		$('#cpsw_modal .alerts-module').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>!Registro Fallido!</strong></br> Faltan campos por diligenciar.</div>');
		return false;
	}else{
		if($("#cpsw :input")[1].value != $("#cpsw :input")[2].value){	
			$('#cpsw_modal .alerts-module').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>!Registro Fallido!</strong></br> La Nueva contraseña no coincide.</div>');
			return false;
		}
	}	
	return true;
};

seg_user.prototype.validateEditPerfil = function(){

	if($("#cpfep :input")[2].value =="" || $("#cpfep :input")[3].value =="" || $("#cpfep :input")[6].value =="" || $("#cpfep :input")[7].value =="" || $("#cpfep :input")[8].value =="" || $("#municipio").val() =="" || $("#cpfep :input")[10].value ==""){
		$('#cpep_modal .alerts-module').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close close_alert_edit_perfil" data-dismiss="alert">&times;</button><strong>!Envio Fallido!</strong></br> Faltan campos por diligenciar.</div>');
		//pintamos los input faltantes
        for(var i=0; i < $("#cpfep :input").length ; i++){
            if( i==3 || i==6 || i==6 || i==8 || i==9 || i==10) {
                if($("#cpfep :input")[i].value ==""){
                    $($("#cpfep :input")[i]).addClass('input_danger');
                }
            }
        }
        //agregamos funcion a boton cierre
        $(".close_alert_edit_perfil").on('click', function () { $("#cpfep :input").removeClass("input_danger"); });
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
    seg_user.spinner = new Spinner(opts).spin(document.getElementsByTagName("body")[0]);    
	return true;
};

seg_user.prototype.validateCart = function(){
    //verificacmos que se halle logueado, que sea un usuario de la aplicaciòn
    if($('#value_login').val() == "0"){

        //verificamos los inputs
        if( $('#name_invitado').val() && $('#dir_invitado').val() && $('#municipio_invitado').val() && $('#email_invitado').val()){
             //loading
            $($('.btn_invitado_submit')[0].parentElement).hide();
            seg_user.cart_products = new Array();
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
            seg_user.spinner = new Spinner(opts).spin(document.getElementsByTagName("body")[0]);  
            return true;
        }

        if( $('#name_invitado').val() && $('#dir_invitado').val() && $('#municipio_invitado').val() && $('#tel_invitado').val()){
            //loading
            $($('.btn_invitado_submit')[0].parentElement).hide();
            seg_user.cart_products = new Array();
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
            seg_user.spinner = new Spinner(opts).spin(document.getElementsByTagName("body")[0]);  
            return true;
        }

        if(this.btn_enviar_modal){
            $('#invitado_cart_modal .alerts-module').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>!Aún hay campos por diligenciar!</strong></div>');
        }
        this.btn_enviar_modal++;
        
        //desplegamos el modal de captura de información basica
        //$('#invitado_cart_modal .alerts-module').html('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>!Aún no haces parte de ComprarJuntos!</strong> Diligencia el siguiente formulario para continuar con el pedido.</div>');

        $('#invitado_cart_modal').modal();

        //vinculamos los datos
        $("#name_invitado_modal").change(function(e) {
            $("#name_invitado").val(this.value);
        });
        $("#name_invitado_modal").keyup(function(e) {
           $("#name_invitado").val(this.value); 
        });
        $("#municipio_invitado_modal").change(function(e) {
            $("#municipio_invitado").val($("#municipio_invitado_modal").val());
        });
        $("#municipio_invitado_modal").keyup(function(e) {
           $("#municipio_invitado").val($("#municipio_invitado_modal").val()); 
        });

        $("#dir_invitado_modal").change(function(e) {
            $("#dir_invitado").val(this.value);
        });
        $("#dir_invitado_modal").keyup(function(e) {
           $("#dir_invitado").val(this.value); 
        });
        $("#email_invitado_modal").change(function(e) {
            $("#email_invitado").val(this.value);
        });
        $("#email_invitado_modal").keyup(function(e) {
           $("#email_invitado").val(this.value); 
        });
        $("#tel_invitado_modal").change(function(e) {
            $("#tel_invitado").val(this.value);
        });
        $("#tel_invitado_modal").keyup(function(e) {
           $("#tel_invitado").val(this.value); 
        });

        return false;
    } 
    //loading
    $($('.btn_invitado_submit')[0].parentElement).hide();
    seg_user.cart_products = new Array();
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
    seg_user.spinner = new Spinner(opts).spin(document.getElementsByTagName("body")[0]);  

    //bloqueamos el boton, se pone a puntar a otro lado   
    $('#submit_cart_modal').attr("form", "button_block");

    return true;
};

seg_user.prototype.validateFinder = function(){
    return true;
};

seg_user.prototype.validateMessageAdmin = function(){
    return true;
};

seg_user.prototype.lugarRespuesta = function(result) {
	//se evalua la respuesta
	if(result.respuesta){		
		$('.bnt_lugar').toggle();
		//crear alert
		if(result.data.usuario.lugar.active){
			$('.alerts').html('<div class="alert alert-success fade in"><strong>¡Activación de Escritorio!</strong> el escritorio esta activado.<br><br><ul><li>Ahora todos los mudulos consultan directamente a al escritorio</li></ul></div>');
		}else{
			$('.alerts').html('<div class="alert alert-info fade in"><strong>¡Activación de Papelera!</strong> La pepelera esta activada.<br><br><ul><li>Ahora todos los mudulos consultan directamente a la papelera</li></ul></div>');			
		}
		location.reload();
	}else{
		alert('Problemas con el cambio de lugar');		
	}
};
	
seg_user.prototype.edit = function(this_val) {
	if($("#form_user").size()){
		
		this.btn_editar = this.btn_editar*-1;
		var j=0;
		if(this.btn_editar == -1){
			$($(this_val.children).get(1)).html('Deshabilitar edición');
			for(var i=0; i < $("#form_user .panel-body").children().length; i++){
				if($("#form_user .panel-body").children().get(i).classList.contains('input-grp')){
					$($("#form_user .panel-body").children().get(i).children[1]).children().prop("disabled", false);
				}				
			}
			//mostramos el boton
			$($("#form_user").children().get($("#form_user").children().length-1)).children().children().show();
			
		}else{
			$($(this_val.children).get(1)).html('Habilitar edición');
			for(var i=0; i < $("#form_user .panel-body").children().length; i++){
				if($("#form_user .panel-body").children().get(i).classList.contains('input-grp')){
					$($("#form_user .panel-body").children().get(i).children[1]).children().prop("disabled", true)
				}				
			}
			//ocultar el boton
			$($("#form_user").children().get($("#form_user").children().length-1)).children().children().hide()
		}			
	}		
};
	
seg_user.prototype.iniciarDatepiker = function(obj) {
	$( "#"+obj ).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd'
    });
};

seg_user.prototype.changeImg = function(input){
	if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#nueva_img').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
};

seg_user.prototype.iniciarPie= function(contenedor_id,titulo,datos,colores){	
	if (colores === undefined || colores === null) {
		colores = ['#7cb5ec', '#434348', '#90ed7d', '#f7a35c', '#8085e9','#f15c80', '#e4d354', '#2b908f', '#f45b5b', '#91e8e1']
	}	
	$(contenedor_id).highcharts({
        chart: {
        	renderTo: 'chartcontainer',
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'            
        },
        title: {
            text: titulo
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        lang:{
        	printChart : 'Descargar imagen',
        	downloadPNG : 'Descargar imagen PNG',        	
        	downloadJPEG : 'Descargar imagen JPEG',
        	downloadPDF : 'Descargar imagen PDF',
        	downloadSVG : 'Descargar imagen vectorial SVG',
        },
        
        plotOptions: {        	  
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',                              
                dataLabels: {
                    enabled: true,
                    //format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    format: '<b>{point.name}</b>: {point.percentage:.1f}% - [{point.y}]',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'                      
                    
                    }
                }
            }
        },
        colors: colores,
        series: [{
            name: "Porcentaje",
            colorByPoint: true,
            data: datos,
            point:{
                events:{
                    click: function (event) {
                        //alert(this.x + " " + this.y + " " + this.name);
                    }
                }
            }  
        }]
    });
};

seg_user.prototype.iniciarBar= function(contenedor_id,titulo_uno,titulo_dos,datos,categorias){
	$(contenedor_id).highcharts({
		chart: {
			renderTo: 'chartcontainer',
            type: 'bar'
        },
        title: {
            text: titulo_uno
        },
        xAxis: {
            categories: categorias
        },
        yAxis: {
            min: 0,
            title: {
                text: titulo_dos
            }
        },
        legend: {
            reversed: true
        },
        lang:{
        	printChart : 'Descargar imagen',
        	downloadPNG : 'Descargar imagen PNG',        	
        	downloadJPEG : 'Descargar imagen JPEG',
        	downloadPDF : 'Descargar imagen PDF',
        	downloadSVG : 'Descargar imagen vectorial SVG',
        },
        plotOptions: {
            series: {
                stacking: 'normal'
            }
        },
        series: datos
	});
};

seg_user.prototype.iniciarMultiBar= function(contenedor_id,titulo_uno,titulo_dos,titulo_tres,datos,categorias){
	$(contenedor_id).highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: titulo_uno
        },
        subtitle: {
            text: titulo_dos
        },
        xAxis: {
            categories: categorias,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: titulo_tres
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: datos
    });
};

seg_user.prototype.iniciarPila= function(contenedor_id,titulo_uno,titulo_dos,datos,categorias){
	$(contenedor_id).highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: titulo_uno
        },
        xAxis: {
            categories: categorias
        },
        yAxis: {
            min: 0,
            title: {
                text: titulo_dos
            },
            stackLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                }
            }
        },
        legend: {
            align: 'right',
            x: -30,
            verticalAlign: 'top',
            y: 25,
            floating: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
            borderColor: '#CCC',
            borderWidth: 1,
            shadow: false
        },
        tooltip: {
            headerFormat: '<b>{point.x}</b><br/>',
            pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                    style: {
                        textShadow: '0 0 3px black'
                    }
                }
            }
        },
        series: datos
    });
};

seg_user.prototype.consultaRespuestaCity = function(result) {    

    var list = document.getElementById("municipio");
    fistChild=list.firstChild;
    //limpiamos los hojos
    while (list.hasChildNodes()) {   
        list.removeChild(list.firstChild);
    }
    list.appendChild(fistChild);
    if(result.respuesta){
        if(result.data){            
            //añadimos nuevos elementos         
            for(var i = 0; i < result.data.length; i++){
                var option = document.createElement("option");
                option.value=result.data[i];
                option.textContent = result.data[i];
                list.appendChild(option);
            }
        }
    }
    //reiniciamos en chossen
    //$("#municipio").trigger("liszt:updated");
    $("#municipio").trigger("chosen:updated");
};

seg_user.prototype.openModalCart = function(result) {
    //se crean los objetos en el form cart
    if(seg_user.cart_products.length){        
        form = document.getElementById("cart_form");
        row = document.createElement("div");
        row.className = "row col-md-12";
        row.style.textAlign = "center";
        div_c1 = document.createElement("div");
        div_c1.className = "col-md-12";

        formgpoup = document.createElement("div");
        formgpoup.className = "form-group";

        titulo1 = document.createElement("div");
        titulo1.className = "col-md-2";

        titulo11 = document.createElement("label");
        titulo11.className = "col-md-2";
        titulo11.innerHTML = "PRODUCTO";

        titulo2 = document.createElement("label");
        titulo2.className = "col-md-2";
        titulo2.innerHTML = "PRECIO";

        titulo3 = document.createElement("label");
        titulo3.className = "col-md-2";
        titulo3.innerHTML = "CANTIDAD";

        titulo4 = document.createElement("label");
        titulo4.className = "col-md-2";
        titulo4.innerHTML = "TOTAL";

        titulo5 = document.createElement("label");
        titulo5.className = "col-md-2";
        titulo5.innerHTML = "";

        div = document.createElement("div");
        div.className = "col-md-12";
        div.appendChild(titulo1);
        div.appendChild(titulo11);
        div.appendChild(titulo2);
        div.appendChild(titulo3);
        div.appendChild(titulo4);
        div.appendChild(titulo5);

        formgpoup.appendChild(div);

        fondo_bandera = -1;
        cantidad_total = 0;
        precio_total = 0;

        for(var i=0;i<seg_user.cart_products.length;i++){

            div = document.createElement("div");
            div.className = "col-md-12";
            div.setAttribute("id", "producto_"+seg_user.cart_contador);
            if(fondo_bandera==1){
                div.style.backgroundColor = "#e7e7e7";
            }
            //div.style.height = "85px";

            //caracteristicas
            crtcs = document.createElement("input");
            crtcs.setAttribute("type", "hidden");
            crtcs.setAttribute("name", "prod_crtrcs_"+seg_user.cart_products[i][0]+"_"+seg_user.cart_contador);
            crtcs.value = ""+seg_user.cart_products[i][3]+","+seg_user.cart_products[i][4]+","+seg_user.cart_products[i][5]+","+seg_user.cart_products[i][6]+",";

            img = document.createElement("img");
            img.className = "col-md-2";
            img.src = seg_user.cart_products[i][9];
            img.style.height = "85px";
            //img.style.borderRadius = "50%";

            descripcion_div = document.createElement("div");
            descripcion_div.className = "col-md-2";
            label = document.createElement("label");
            label.className = "col-md-12";
            label.innerHTML = seg_user.cart_products[i][7];
            descripcion = document.createElement("div");
            //descripcion.innerHTML = seg_user.cart_products[i][8] + crtcs.value;
            descripcion.innerHTML =  crtcs.value.replace(/,,/g, '');
            descripcion_div.appendChild(label);
            descripcion_div.appendChild(descripcion); 

            nprod = document.createElement("input");
            nprod.setAttribute("type", "hidden");
            nprod.setAttribute("name", "prod_nprod_"+seg_user.cart_products[i][0]+"_"+seg_user.cart_contador);
            nprod.value =  seg_user.cart_products[i][7];

            precio = document.createElement("div");
            precio.className = "col-md-2";
            precio.innerHTML = "$"+seg_user.cart_products[i][1];
            precio.style.marginTop = "2%";

            //caracteristicas
            in_precio = document.createElement("input");
            in_precio.setAttribute("type", "hidden");
            in_precio.setAttribute("name", "prod_precio_"+seg_user.cart_products[i][0]+"_"+seg_user.cart_contador);
            in_precio.value = seg_user.cart_products[i][1];

            volumen = document.createElement("div");
            volumen.className = "col-md-2";
            volumen.style.marginTop = "2%";

            cantidad = document.createElement("input");
            cantidad.setAttribute("type", "number");
            cantidad.setAttribute("min", "0");
            cantidad.className = "form-control solo_numeros volumen_cart";
            cantidad.setAttribute("id", "volumen_cart_"+seg_user.cart_products[i][0]+"_"+seg_user.cart_contador);
            cantidad.setAttribute("name", "prod_volume_"+seg_user.cart_products[i][0]+"_"+seg_user.cart_contador);
            cantidad.value = seg_user.cart_products[i][2];
            volumen.appendChild(cantidad);

            total = document.createElement("div");
            total.className = "col-md-2";
            total.style.marginTop = "2%";    
            total.setAttribute("id", "total_"+seg_user.cart_products[i][0]+"_"+seg_user.cart_contador);
            total.innerHTML = "$"+( parseInt(seg_user.cart_products[i][1]) * parseInt(seg_user.cart_products[i][2]) );

            boton = document.createElement("button");
            boton.className = "btn btn-default remove";
            boton.style.marginTop = "2%";
            boton.innerHTML = "Remover";
            boton.setAttribute("id", "prod_"+seg_user.cart_contador);
            boton.setAttribute("form", "null_form");

            div.appendChild(img);
            div.appendChild(descripcion_div);
            div.appendChild(nprod);
            div.appendChild(precio);
            div.appendChild(in_precio);
            div.appendChild(volumen);
            div.appendChild(crtcs);
            div.appendChild(total);
            div.appendChild(boton);

            formgpoup.appendChild(div);

            fondo_bandera = fondo_bandera*-1;
            seg_user.cart_products[i][11] = seg_user.cart_contador;
            cantidad_total = parseInt(cantidad_total) + parseInt(seg_user.cart_products[i][2]);
            precio_total = parseInt(precio_total) + (parseInt(seg_user.cart_products[i][1])*parseInt(seg_user.cart_products[i][2]));

            seg_user.cart_contador = seg_user.cart_contador+1;


        }

        $('#cantidad_cart').html(cantidad_total);
        $('#precio_total').html("$"+precio_total);

        div_c1.appendChild(formgpoup);
        row.appendChild(div_c1);

        hr = document.createElement("hr");
        hr.className = "col-md-12";

        div_c2 = document.createElement("div");
        div_c2.className = "col-md-6 col-md-offset-0";

        div_c2_t = document.createElement("div");
        div_c2_t.innerHTML = "Indicaciones o Sugerencias";
        div_c2_t.style.textAlign = "left";
        
        descript = document.createElement("textarea");
        descript.className = "form-control";
        descript.setAttribute("name", "description");
        descript.setAttribute("row", 5);
        descript.setAttribute("placeholder", "Ingresa, las sugerencias o indicaciones que el tendero deba tener encuenta con tu pedido. Ejemplo: mejor fecha de entrega, dirección alternativa, número de contacto, metodo de pago, etc.");

        div_c2.appendChild(div_c2_t);
        div_c2.appendChild(descript);

        row.appendChild(hr);
        row.appendChild(div_c2);

        //construimos el input para descripcion

        //construimos los inputs para los invitados
        inputs = document.getElementById("inputs_info");
        inputs.innerHTML = "";
        if($('#value_login').val() == "0"){
            nombre = document.createElement("input");
            nombre.setAttribute("type", "hidden");
            nombre.setAttribute("name", "name_invitado");
            nombre.setAttribute("id", "name_invitado");

            municipio = document.createElement("input");
            municipio.setAttribute("type", "hidden");
            municipio.setAttribute("name", "municipio_invitado");
            municipio.setAttribute("id", "municipio_invitado");

            dir = document.createElement("input");
            dir.setAttribute("type", "hidden");
            dir.setAttribute("name", "dir_invitado");
            dir.setAttribute("id", "dir_invitado");

            email = document.createElement("input");
            email.setAttribute("type", "hidden");
            email.setAttribute("name", "email_invitado");
            email.setAttribute("id", "email_invitado");

            tel = document.createElement("input");
            tel.setAttribute("type", "hidden");
            tel.setAttribute("name", "tel_invitado");
            tel.setAttribute("id", "tel_invitado");

            inputs.appendChild(nombre);
            inputs.appendChild(municipio);
            inputs.appendChild(dir);
            inputs.appendChild(email);
            inputs.appendChild(tel);

            form.appendChild(inputs);        
        }

        form.appendChild(row);

       
        $('#cart_modal').modal();

        //eventos
        $(".remove").on('click', function (e) {
            //remover de objeto, corremos el objeto
            for(var i=0;i<seg_user.cart_products.length;i++){
                if(seg_user.cart_products[i][11] == this.id.split('_')[1])
                {                
                    seg_user.cart_products.splice( i, 1 );
                }
            }
            //remover de modal
            this.parentNode.remove();

            //reducir el brage del carrito
            $('#bange_cart').html(parseInt($('#bange_cart').html())-1);
            $('#bange_cart_b').html(parseInt($('#bange_cart_b').html())-1);

            //recalculamos los totales
            cantidad_total = 0;
            precio_total = 0;
            for(var i=0;i<seg_user.cart_products.length;i++){
                cantidad_total = cantidad_total + parseInt(seg_user.cart_products[i][2]);
                precio_total = precio_total + (parseInt(seg_user.cart_products[i][1]) * parseInt(seg_user.cart_products[i][2]) );
            }
            $('#cantidad_cart').html(cantidad_total);
            $('#precio_total').html("$"+precio_total);

            var datos = new Array();
            for(i=0;i<seg_user.cart_products.length;i++){
                seg_user.cart_products[i][8]=seg_user.cart_products[i][8].replace(",", ";");
                contador = seg_user.cart_products[i][11];
                seg_user.cart_products[i][11] = "";
                datos[i] = seg_user.cart_products[i].toString();
                seg_user.cart_products[i][11] = contador;
            }
            datos['datos'] = seg_user.cart_products.length;                 
            //seg_ajaxobject.peticionajax($('#form_remove_product_session').attr('action'),datos,"seg_user.consultaRespuestaAddCartSession");
            seg_ajaxobject.peticionajax($('#form_add_product_session').attr('action'),datos,"seg_user.consultaRespuestaAddCartSession");    

        });
        

        $(".volumen_cart").keyup(function(e) {              
            if(this.value == ""){
                cantidad = 0;
            }else{
                cantidad = this.value;
            }
             var j = -1;//para halalr los datos del producto
           for(var i=0;i<seg_user.cart_products.length;i++){
                if(seg_user.cart_products[i][11] == this.name.split('_')[3])
                {                
                   seg_user.cart_products[i][2] = cantidad;
                   j=i;
                   break;
                }
            }

            //recalculamos los totales
            cantidad_total = 0;
            precio_total = 0;
            for(var i=0;i<seg_user.cart_products.length;i++){
                cantidad_total = cantidad_total + parseInt(seg_user.cart_products[i][2]);
                precio_total = precio_total + (parseInt(seg_user.cart_products[i][1]) * parseInt(seg_user.cart_products[i][2]) );
            }
            $('#cantidad_cart').html(cantidad_total);
            $('#precio_total').html("$"+precio_total);

            //cambiamos el total de la fila
            $('#total_'+this.name.split('_')[2]+'_'+this.name.split('_')[3]).text((parseInt(seg_user.cart_products[j][1]) * parseInt(seg_user.cart_products[j][2]) ));

            var datos = new Array();
            for(i=0;i<seg_user.cart_products.length;i++){
                seg_user.cart_products[i][8]=seg_user.cart_products[i][8].replace(",", ";");
                contador = seg_user.cart_products[i][11];
                seg_user.cart_products[i][11] = "";
                datos[i] = seg_user.cart_products[i].toString();
                seg_user.cart_products[i][11] = contador;
            }
            datos['datos'] = seg_user.cart_products.length;                 
            seg_ajaxobject.peticionajax($('#form_add_product_session').attr('action'),datos,"seg_user.consultaRespuestaAddCartSession");    

            
        });

        $(".volumen_cart").change(function(e) {              
            if(this.value == ""){
                cantidad = 0;
            }else{
                cantidad = this.value;
            }
            var j = -1;//para halalr los datos del producto
           for(var i=0;i<seg_user.cart_products.length;i++){
                if(seg_user.cart_products[i][11] == this.name.split('_')[3])
                {                
                   seg_user.cart_products[i][2] = cantidad;
                    j=i;
                    break;
                }
            }

            //recalculamos los totales
            cantidad_total = 0;
            precio_total = 0;
            for(var i=0;i<seg_user.cart_products.length;i++){
                cantidad_total = cantidad_total + parseInt(seg_user.cart_products[i][2]);
                precio_total = precio_total + (parseInt(seg_user.cart_products[i][1]) * parseInt(seg_user.cart_products[i][2]) );
            }
            $('#cantidad_cart').html(cantidad_total);
            $('#precio_total').html("$"+precio_total);

            //cambiamos el total de la fila
            $('#total_'+this.name.split('_')[2]+'_'+this.name.split('_')[3]).text((parseInt(seg_user.cart_products[j][1]) * parseInt(seg_user.cart_products[j][2]) ));

            var datos = new Array();
            for(i=0;i<seg_user.cart_products.length;i++){
                seg_user.cart_products[i][8]=seg_user.cart_products[i][8].replace(",", ";");
                contador = seg_user.cart_products[i][11];
                seg_user.cart_products[i][11] = "";
                datos[i] = seg_user.cart_products[i].toString();
                seg_user.cart_products[i][11] = contador;
            }
            datos['datos'] = seg_user.cart_products.length;                 
            seg_ajaxobject.peticionajax($('#form_add_product_session').attr('action'),datos,"seg_user.consultaRespuestaAddCartSession");    

            
        });

        $(".solo_numeros" ).keypress(function(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        });
        
    }
};

seg_user.prototype.consultaRespuestaAddCart = function(result) {
    $('#id_store_cart_modal').val(result.data[0].store_id);
    $('#id_product_cart_modal').val(result.data[0].id);       
    $('#add_cart_modal .modal-title').html('Agregar '+result.request.name+' al Carrito de Compras');
    $("label[for='prod_cart_modal_for']").html(result.request.name);
    $('#prod_img_cart_modal').attr('src',$('#prod_img_cart_modal').attr('src').replace($('#prod_img_cart_modal').attr('src').split('/')[$('#prod_img_cart_modal').attr('src').split('/').length-1],result.data[0].image1));
    $("#price_cart_modal_span").html(result.data[0].price);
    if(result.data[0].description != ''){
        $('#div_cart_description').show();
        $('#dercription_cart_modal').html(result.data[0].description);
    }
    if(result.data[0].models != ''){
        $('#div_cart_model').show();
        $('#model_cart_modal').html(result.data[0].models);
    }
    
    $('#unity_cart_modal').html('Unidad de venta: '+result.data[0].unity_measure);
    
    //mostramos los div en caso de ser aplicables
    var options;
    var opt;
    var list;

    if(result.data[0].colors != ''){
        //construimos el select        
        list = document.getElementById("colores_cart_select");
        fistChild=list.firstChild;        
        while (list.hasChildNodes()) {   
            list.removeChild(list.firstChild);
        }        
        list.appendChild(fistChild);

        options = result.data[0].colors.split(',');
        
        for(var i=0;i<options.length;i++){
            opt = document.createElement("option");
            opt.value = options[i];
            opt.textContent = options[i];
            list.appendChild(opt);
        }
        $('#div_cart_colors').show();
    }

    if(result.data[0].sizes != ''){
        //construimos el select        
        list = document.getElementById("sizes_cart_select");
        fistChild=list.firstChild;        
        while (list.hasChildNodes()) {   
            list.removeChild(list.firstChild);
        }        
        list.appendChild(fistChild);

        options = result.data[0].sizes.split(',');
        
        for(var i=0;i<options.length;i++){
            opt = document.createElement("option");
            opt.value = options[i];
            opt.textContent = options[i];
            list.appendChild(opt);
        }
        $('#div_cart_sizes').show();
    }

    if(result.data[0].flavors != ''){
        //construimos el select        
        list = document.getElementById("flavors_cart_select");
        fistChild=list.firstChild;        
        while (list.hasChildNodes()) {   
            list.removeChild(list.firstChild);
        }        
        list.appendChild(fistChild);

        options = result.data[0].flavors.split(',');
        
        for(var i=0;i<options.length;i++){
            opt = document.createElement("option");
            opt.value = options[i];
            opt.textContent = options[i];
            list.appendChild(opt);
        }
        $('#div_cart_flavors').show();
    }

    if(result.data[0].materials != ''){
        //construimos el select        
        list = document.getElementById("materials_cart_select");
        fistChild=list.firstChild;        
        while (list.hasChildNodes()) {   
            list.removeChild(list.firstChild);
        }        
        list.appendChild(fistChild);

        options = result.data[0].materials.split(',');
        
        for(var i=0;i<options.length;i++){
            opt = document.createElement("option");
            opt.value = options[i];
            opt.textContent = options[i];
            list.appendChild(opt);
        }
        $('#div_cart_materials').show();
    }

    $('#add_cart_modal').modal();
};

seg_user.prototype.consultaRespuestaAddCartSession = function(result) {

};

seg_user.prototype.consultaRespuestaListarProductos = function(result) {
    //borramos el contnido del div
    list = document.getElementsByClassName("listado_productos")[0];
    list.textContent="";
    //agregamos los nuevos productos
    var html = "";
    var p=0;
    var j=1;
    for(var i =0; i<result.data.length;i++){
        if(p%4 == 0){
            html += '<div class="col-md-12 col-md-offset-0">';
        }

        html += '<div class="col-md-3 col-mx-offset-1" style="text-align: center;">';
        html +=     '<div class="panel panel-default">';
        html +=         '<div class="panel-body">';
        html +=             '<div class="row">';
        
        html +=                 '<div class="col-md-12 option_add_product" id ="'+result.data[i].name+'_'+result.data[i].id+'">';
        html +=                     '<img src="'+$('#url_app').text()+'/users/'+$('#user_name').text()+'/products/'+result.data[0].image1+'" style="width: 90%;height: 200px;border-radius: 0%;" alt="Imagen no disponible">';
        html +=                 '</div>';
        html +=                 '<div class="col-md-12 panel-footer"  style="background-color:'+$('#color_one').text()+'; color: '+$('#color_two').text()+'; border-color:'+$('#color_two').text()+';padding: 2px;">';
        html +=                     '<div class="col-md-4 col-mx-offset-0" style="font-size: 14px;">';
        html +=                         ''+result.data[i].name;
        html +=                     '</div>';
        html +=                     '<div class="col-md-4 col-mx-offset-0 option_store" data-toggle="popover" title="'+result.data[i].name+'" data-placement="bottom" data-content="<div>'+result.data[i].description+'</div><div>Nº de veces comprado: '+result.data[i].ventas+'</div>" data-html="true">';
        html +=                         '<span class="glyphicon glyphicon-signal option_store_icon" aria-hidden="true"></span>';
        html +=                         '<div style="font-size: 10px;">Descripciòn</div>';
        html +=                     '</div>';
        html +=                     '<div class="col-md-4 col-mx-offset-0 option_store option_add_product" id ="'+result.data[i].name+'_'+result.data[i].id+'">';
        html +=                         '<span class="glyphicon glyphicon-shopping-cart option_store_icon" aria-hidden="true"></span>';
        html +=                         '<div style="font-size: 10px;">Al Carrito</div>';
        html +=                     '</div>';
        html +=                 '</div>';

        html +=             '</div>';
        html +=         '</div>';
        html +=     '</div>';
        html += '</div>';

        if(j%4 == 0){
            html += '</div>';
        }else{
            if(p == result.data.length-1){
                html += '</div>';
            }
        }
        p++;
        j++;
    }

    list.innerHTML=html;

    $('.option_add_product').on('click', function (e) {
        var datos = new Array();
        datos['id'] = this.id.split('_')[1];
        datos['name'] = this.id.split('_')[0];
        seg_ajaxobject.peticionajax($('#form_add_product').attr('action'),datos,"seg_user.consultaRespuestaAddCart");                   
    });

    //actualizamos los datos del paginador. pagina actual
    $('#pagina_actual').text(result.request.pagina_solicitada);
    $('.paginador-btn').removeClass('btn-paginatorslc');
    $('.paginador-btn').removeClass('btn-paginator');
    $('.paginador-btn').addClass('btn-paginator');
    //actualizamos el actual
    var paginas = $('.paginador-btn');
    for(var i=0;i<paginas.length;i++){
        if(paginas[i].textContent == result.request.pagina_solicitada){
            $(paginas[i]).addClass('btn-paginatorslc');
        }
    }

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
        /*
        //redirecciòn de subcategorias
        $('.popover-content ul li').on('click', function(e) {               
            window.location=$('#form_home').attr('action')+"/"+this.textContent;
        });

        //redirecciòn de categorias
        $('.popover-title').on('click', function(e) {               
            window.location=$('#form_home').attr('action')+"/"+this.textContent;
        });
        */
    });

    //asignamos el valor al input buscador
    $('[name=finder_store]').val(result.request.finder_store);    
};

seg_user.prototype.controllerCarruselIndex = function(frecuency) {
    //realizamos la consulta del producto (objeto, tienda, tendero, veces vendido, comentarios)
    var datos = new Array();    
    seg_ajaxobject.peticionajax($('#form_consult_item').attr('action'),datos,"seg_user.consultaRespuestaItem");

    //llamamos la funcion nuevamente
    if(frecuency < 13000){        
        seg_user.refresh_interval_id  = setTimeout(function(){ 
            seg_user.controllerCarruselIndex((frecuency+500))
        }, (frecuency) );        
    }

    //un item mas
    seg_user.refresh_index++;
};

seg_user.prototype.consultaRespuestaItem = function(result) {

    //creacion de div carrusel_index_font hijo de contenedor_carrusel_index
    var cont_carr_index = document.getElementsByClassName("contenedor_carrusel_index")[0];
    var div = document.createElement("div");
    div.setAttribute("class", "carrusel_index_back");
    div.setAttribute("style", "height: 100%;width: 96%;display: none;position: absolute;z-index:0;");
    seg_user.refresh_background = seg_user.refresh_background*-1;
    div.style.backgroundColor = '#faf9f5';    
    if(seg_user.refresh_background === 1){
        div.style.backgroundColor = '#faf9f5';    
    }    
    var div2 = document.createElement("div");
    div2.setAttribute("class", "col-md-12 col-md-offset-0");

    /*descripcion*/
    var div2_1 = document.createElement("div");
    div2_1.setAttribute("class", "col-md-6 col-md-offset-0");
    div2_1.setAttribute("style", "height: 285px;text-align: center;padding: 1%;");
    var div2_1_1 = document.createElement("div");
    div2_1_1.setAttribute("class", "col-md-12 col-md-offset-0");
    div2_1_1.setAttribute("style", "margin-bottom: 2%");
    div2_1_1.innerHTML = "<b>"+result.data.producto[0].name+"</b>";    
    var div2_1_3 = document.createElement("div");
    div2_1_3.setAttribute("class", "col-md-12 col-md-offset-0");
    div2_1_3.innerHTML = result.data.producto[0].description.slice(0,100);
    var div2_1_4 = document.createElement("div");
    div2_1_4.setAttribute("class", "col-md-12 col-md-offset-0");
    div2_1_4.setAttribute("style", "font-size: 20px;margin-bottom: 8%");
    div2_1_4.innerHTML = "<b>Precio: $"+result.data.producto[0].price+"</b>";   

    //tienda
    var div2_1_tienda = document.createElement("div");
    div2_1_tienda.setAttribute("class", "col-md-10 col-md-offset-2");    
    //div2_1_tienda.setAttribute("style", "display: flex;text-align: center;");

    var div2_1_tienda_conten = document.createElement("div");
    div2_1_tienda_conten.setAttribute("style", "display: flex;");

    var div2_1_logo = document.createElement("div");
    div2_1_logo.setAttribute("class", "");
    div2_1_logo.setAttribute("style", "margin-right: 10%;display:none");
    var div2_1_a = document.createElement("a");
    div2_1_a.setAttribute("href", $('#form_home').attr('action')+"/"+result.data.producto[0].store_name);
    var div2_1_img = document.createElement("img");
    div2_1_img.setAttribute("src", $('#form_home').attr('action')+"/users/"+result.data.producto[0].user_name+"/stores/"+result.data.producto[0].store_image);
    div2_1_img.setAttribute("style", "width: auto; height: 75px;border-radius: 0%;");
    div2_1_img.setAttribute("alt", "Imagen no disponible");
    div2_1_a.appendChild(div2_1_img);
    div2_1_logo.appendChild(div2_1_a);

    var div2_1_descrip = document.createElement("div");
    div2_1_descrip.setAttribute("class", "");
    div2_1_descrip.setAttribute("style", "display:none");
    var div2_1_descrip1 = document.createElement("div");    
    div2_1_descrip1.setAttribute("style", "font-size: 22px");
    div2_1_descrip1.innerHTML = ""+result.data.producto[0].store_name.charAt(0).toUpperCase() + result.data.producto[0].store_name.slice(1)+"";
    var div2_1_descrip2 = document.createElement("div");    
    div2_1_descrip2.setAttribute("style", "font-size: 16px");
    div2_1_descrip2.innerHTML = result.data.producto[0].store_city;
    var div2_1_descrip3 = document.createElement("div");    
    div2_1_descrip3.setAttribute("style", "font-size: 16px");
    div2_1_descrip3.innerHTML = result.data.producto[0].store_adress;
    div2_1_descrip.appendChild(div2_1_descrip1);
    div2_1_descrip.appendChild(div2_1_descrip2);
    div2_1_descrip.appendChild(div2_1_descrip3);
    
    div2_1_tienda_conten.appendChild(div2_1_logo);
    div2_1_tienda_conten.appendChild(div2_1_descrip);
    //div2_1_tienda_conten.appendChild(div2_1_tendero);
    div2_1_tienda.appendChild(div2_1_tienda_conten);
    
    $(div2_1_descrip).delay( 3000 ).show( 'fade',{ direction: "left" },1000);    
    $(div2_1_logo).delay( 2500 ).show( 'fade',{ direction: "left" },1000);
    //$(div2_1_tendero).delay( 3500 ).show( 'fade',{ direction: "left" },1000);


    div2_1.appendChild(div2_1_1);
    //div2_1.appendChild(div2_1_2);
    div2_1.appendChild(div2_1_3);
    div2_1.appendChild(div2_1_4);

    /*caracteristicas*/
    /*
    if(result.data.producto[0].colors != ""){
        var div2_1_5 = document.createElement("div");
        div2_1_5.setAttribute("class", "col-md-12 col-md-offset-0");
        div2_1_5.setAttribute("style", "font-size: 14px;display:none");
        div2_1_5.innerHTML = "Colores: "+result.data.producto[0].colors+"";
        div2_1.appendChild(div2_1_5);
        $(div2_1_5).delay( 200 ).show( 'drop',{ direction: "left" },1000);
    }
    if(result.data.producto[0].sizes != ""){
       var div2_1_6 = document.createElement("div");
       div2_1_6.setAttribute("class", "col-md-12 col-md-offset-0");
       div2_1_6.setAttribute("style", "font-size: 14px;display:none");
       div2_1_6.innerHTML = "Tallas: "+result.data.producto[0].sizes+"";
       div2_1.appendChild(div2_1_6);
       $(div2_1_6).delay( 500 ).show( 'drop',{ direction: "left" },1000);
    }
    */

    div2_1.appendChild(div2_1_tienda);
    div2.appendChild(div2_1);

    /*Imagen de producto*/
    var div2_2 = document.createElement("div");
    div2_2.setAttribute("class", "col-md-6 col-md-offset-0");
    div2_2.setAttribute("style", "height: 285px;");
    var div2_2_a = document.createElement("a");
    div2_2_a.setAttribute("href", $('#form_home').attr('action')+"/"+result.data.producto[0].store_name);
    var div2_2_img = document.createElement("img");
    div2_2_img.setAttribute("src", $('#form_home').attr('action')+"/users/"+result.data.producto[0].user_name+"/products/"+result.data.producto[0].image1);
    div2_2_img.setAttribute("style", "width: 100%;height: 100%;border-radius: 0%;display:none");
    div2_2_img.setAttribute("alt", "Imagen no disponible");

    div2_2_a.appendChild(div2_2_img);
    div2_2.appendChild(div2_2_a);
    div2.appendChild(div2_2);


    div.appendChild(div2);
    cont_carr_index.appendChild(div);

    //show    
    //$( ".carrusel_index_back" ).show( 'drop',{ direction: "right" },500);
    $( ".carrusel_index_back" ).show( 'clip',800);
    $(div2_2_img).show( 'drop',{ direction: "right" },1600);
};


var seg_user = new seg_user();