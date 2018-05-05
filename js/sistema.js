jQuery(document).ready(function($) {

 

 

	var opts = {
		lines: 13, 
		length: 20, 
		width: 10, 
		radius: 30, 
		corners: 1, 
		rotate: 0, 
		direction: 1, 
		color: '#E8192C',
		speed: 1, 
		trail: 60,
		shadow: false,
		hwaccel: false,
		className: 'spinner',
		zIndex: 2e9, 
		top: '50%', // Top position relative to parent
		left: '50%' // Left position relative to parent		
	};


	/////////////////validaciones///////////////////////////

	var hash_url = window.location.pathname;


  	jQuery("#ticket").inputmask("9999 9999 9999 9999 9999 999", {
            placeholder: " ",
            clearMaskOnLostFocus: true
    });


  	jQuery("#folio").inputmask("99999999", {
            placeholder: " ",
            clearMaskOnLostFocus: true
    });
 	jQuery("#folio2").inputmask("9999999", {
            placeholder: " ",
            clearMaskOnLostFocus: true
    });

 	jQuery("#tipo").on('change',function(){
	    if( jQuery(this).val()==="folio"){    
		    jQuery("#foliocon2").hide();
		    jQuery("#foliocon").show();
		    jQuery("#folio2").prop( "disabled", true ); 
		    jQuery("#folio").prop( "disabled", false );
		    jQuery("#folio").val("");
	    }
	    else{
		    jQuery("#foliocon").hide();
		    jQuery("#folio").prop( "disabled", true );
		    jQuery("#folio2").prop( "disabled", false );
		    jQuery("#folio2").val("");
		    jQuery("#foliocon2").show();
	    }
	});


	jQuery(".navigacion").change(function()	{
	    document.location.href = jQuery(this).val();
	});

   	var target = document.getElementById('foo');


		jQuery("#fecha_nac").dateDropdowns({
					submitFieldName: 'fecha_nac', //Especificar el "atributo name" para el campo que esta oculto
					submitFormat: "dd-mm-yyyy", //Especificar el formato que la fecha tendra para enviar
					displayFormat:"dmy", //orden en que deben ser prestados los campos desplegables. "dia, mes, año"
					//initialDayMonthYearValues:['Día', 'Mes', 'Año'],
					yearLabel: 'Año', //Identifica el menú desplegable "Año"
					monthLabel: 'Mes', //Identifica el menú desplegable "Mes"
					dayLabel: 'Día', //Identifica el menú desplegable "Día"
					monthLongValues: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
					monthShortValues: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
					daySuffixes: false,  //que no tengan sufijo
					//minAge:18, //edad minima
					//maxAge:150, //edad maxima
					minYear: 1900,
					maxYear: 2001,

				});

	jQuery('.input-group.date.compra').datepicker({
		//startView: 2,
		
		format: "mm/dd/yy",
		startDate: "3/15/2018", //"-2d"
		endDate: "+0d", 
	    language: "es",
	    autoclose: true,
	    todayHighlight: true

	});



	////////////////////////////////////////////




    //creacion de usuarios 
	jQuery('body').on('submit','#form_reg_participantes', function (e) {	

		jQuery('#foo').css('display','block');
		var spinner = new Spinner(opts).spin(target);

		jQuery(this).ajaxSubmit({
			dataType : 'json',
			success: function(data){
				
				if(data.exito != true){
					console.log(data);	
					spinner.stop();
					jQuery('#foo').css('display','none');
					
					jQuery('#msg_nombre').html(data.nombre);
					jQuery('#msg_apellidos').html(data.apellidos);
					jQuery('#msg_email').html(data.email);
					jQuery('#msg_fecha_nac').html(data.fecha_nac);	

					jQuery('#msg_calle').html(data.calle);
					jQuery('#msg_numero').html(data.numero);
					jQuery('#msg_colonia').html(data.colonia);
					jQuery('#msg_municipio').html(data.municipio);
					jQuery('#msg_cp').html(data.cp);	

					jQuery('#msg_ciudad').html(data.ciudad);
					jQuery('#msg_celular').html(data.celular);					
					jQuery('#msg_telefono').html(data.telefono);
 				    jQuery('#msg_id_estado_compra').html(data.id_estado_compra);  
					jQuery('#msg_nick').html(data.nick);
					
					
					jQuery('#msg_pass_1').html(data.pass_1);
					jQuery('#msg_pass_2').html(data.pass_2);					

					
					
					jQuery('#msg_coleccion_id_aviso').html(data.coleccion_id_aviso);					
					jQuery('#msg_coleccion_id_base').html(data.coleccion_id_base);					
									
					jQuery('#msg_general').html(data.general);
				

				}else{
						//$catalogo = e.target.name;
						spinner.stop();
						jQuery('#foo').css('display','none');
						window.location.href = '/gatorade/'+data.redireccion;    //$catalogo;						

						/*
						//new ok 
						var url = "/gatorade/proc_modal_instrucciones";
						//alert(url);
						jQuery('#modalInstrucciones').modal({
							  show:'true',
							remote:url,
						}); 									        	
						*/


				}
			} 
		});
		return false;
	});	




  //logueo y recuperar contraseña
	jQuery("#form_logueo_participante").submit(function(e){
		jQuery('#foo').css('display','block');

		var spinner = new Spinner(opts).spin(target);

		jQuery(this).ajaxSubmit({
			dataType : 'json',
			success: function(data){
				
				if(data.exito != true){
					spinner.stop();
					jQuery('#foo').css('display','none');

		
					jQuery('#msg_email').html(data.nick);
					jQuery('#msg_contrasena').html(data.contrasena);
  				    jQuery('#msg_general').html(data.general);
				

					
				}else{
						//$catalogo = e.target.name;
						spinner.stop();
						jQuery('#foo').css('display','none');
						window.location.href = '/gatorade/'+data.redireccion;    //$catalogo;				

						//new ok 
						//alert(data.jugo);
						/*
						if (data.jugo!= true) {
								var url = "/gatorade/proc_modal_instrucciones";
								//alert(url);
								jQuery('#modalInstrucciones').modal({
									  show:'true',
									remote:url,
								}); 	
						} else {
							window.location.href = '/gatorade/';    
						}
						*/
				}
			} 
		});
		return false;
	});




//////////////////////////////////////////////////////////
/////////////////////registro de ticket/////////////////////////////////////
//////////////////////////////////////////////////////////

//gestion de usuarios (crear, editar y eliminar )
	jQuery('body').on('submit','#form_registro_ticket', function (e) {	


		jQuery('#foo').css('display','block');
		var spinner = new Spinner(opts).spin(target);

		jQuery(this).ajaxSubmit({
			dataType : 'json',
			success: function(data){
				if(data != true){
					
					spinner.stop();
					jQuery('#foo').css('display','none');
					
					jQuery('#msg_numTienda').html(data.numTienda);
					jQuery('#msg_ticket').html(data.ticket);
					jQuery('#msg_compra').html(data.compra);
					jQuery('.msg_folio').html(data.folio);
  				    jQuery('#msg_general').html(data.general);
					jQuery('.btnregistro').css('pointer-events','auto');


				}else{


						spinner.stop();
						jQuery('#foo').css('display','none');
						jQuery('.btnregistro').css('pointer-events','auto');

						var url = "/gatorade/proc_modal_instrucciones";	
						

						jQuery('#modalMessage').modal({
						  	show:'true',
							remote:url,
						}); 	

						/*
						$catalogo = e.target.name;
						spinner.stop();
						jQuery('#foo').css('display','none');
						window.location.href = '/gatorade/'+$catalogo;				
						*/

				}
			} 
		});
		return false;
	});	

//cuando se oculta la ventana de instrucciones 
jQuery("body").on('hide.bs.modal','#modalMessage[ventana="redi_ticket"]',function(e){	
			$catalogo = jQuery(this).attr('valor'); //$catalogo="registro_ticket"
			window.location.href = '/gatorade/'+$catalogo;						    


});


/////////////////////////////////////////////////////////////////////////////////
///////////////////////////////JUEGO//////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////


         //$(document).bind("contextmenu",function(e){ return false; });

//caso en que cierren la modal_preg
//console.log(localStorage.getItem('modal_preg'));


///////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////
                                          
     //si cancela el facebook  entonces va a record, pero esta quizas no va a funcionar porq no se debe cancelar
    jQuery("body").on('hide.bs.modal','#modalMessage_face[ventana="facebook"]',function(e){  
        localStorage.clear();  //quitar las variables del localStorage
        $catalogo = jQuery(this).attr('valor'); //e.target.name;
        window.location.href = '/gatorade/'+$catalogo;                           
        
    }); 





  



		////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
	


	//reintentar el juego
	jQuery("body").on('hide.bs.modal','#modalMessage2[ventana="redi_reintentar"]',function(e){	
		location.reload();
	});

 	

	jQuery('body').on('submit','#form_registrar_ticket', function (e) {	


		jQuery('#foo').css('display','block');
		var spinner = new Spinner(opts).spin(target);

		jQuery(this).ajaxSubmit({
			dataType : 'json',
			success: function(data){
				if(data != true){

					
					spinner.stop();
					jQuery('#foo').css('display','none');
					jQuery('#msg_general').html(data.general);
					/*
					jQuery('#messages').css('display','block');
					jQuery('#messages').addClass('alert-danger');
					jQuery('#messages').html(data);
					jQuery('html,body').animate({
						'scrollTop': jQuery('#messages').offset().top
					}, 1000);*/
				}else{
					
						$catalogo = e.target.name;
						spinner.stop();
						jQuery('#foo').css('display','none');
						window.location.href = '/gatorade/'+$catalogo;				
				}
			} 
		});
		return false;
	});	

	if (hash_url=='/gatorade/felicidades') {
	    var url = "/gatorade/proc_modal_facebook";  
	        jQuery('#modalMessage_face').modal({
	            show:'true',
	            remote:url,
	        });
	}

	
    


});	

