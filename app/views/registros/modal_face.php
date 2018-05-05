<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
 
 
 $cantidad_puntos="100";

 ?>

	<div class="modal-header felicidadesmodal">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	</div>
	<div class="modal-body felicidadessi">
				<img src="<?php echo base_url()?>img/felicidades.png" style="width:100%">
			
				<?php if  (($total_facebook>=1) ) { ?>
					<fieldset style="display:none;">
				<?php } ?>
						 <button onclick="myFacebookLogin()" style="background-color: transparent; border: none; margin: 0 auto; display: block;">
							<img src="<?php echo base_url()?>img/compartir.png" class="img-responsive" style="margin:3px auto">
						</button> 
						<span class="felic">*al compartir obtendrás 100 puntos extra</span>		
				<?php if  (($total_facebook>=1) ) { ?>
					</fieldset>	
				<?php } ?>


		<div class="alert" id="messagesModal"></div>
	</div>




	<div class="modal-footer">
		
	</div>

<style>
.modal-content{
	background-color: transparent !important;
}
</style>

<!--
	<input type="hidden" id="juego" name="juego" value="<?php echo $juego; ?>">
	<input type="hidden" id="redes" name="redes" value="<?php echo $redes; ?>">
	<input type="hidden" id="tiempo" name="tiempo" value="<?php echo $tiempo; ?>">
	<input type="hidden" id="total_puntos" name="total_puntos" value="<?php echo $total_puntos; ?>">

-->


<script type="text/javascript">

var $cantidad_puntos="1";
   

   window.fbAsyncInit = function() {
	    FB.init({
	      appId      : '2003835493171756',
	      cookie     : false, 
	      status     : true,
	      version    : 'v2.8' // use graph api version 2.8
	    }),


	    FB.getLoginStatus(function(response) {
			
		    if (response.status === 'connected') {  //cuando esta conectado
			    var uid = response.authResponse.userID;
			    var accessToken = response.authResponse.accessToken;
		     		
				FB.ui({
				      method: 'feed',
				      name: 'Al 100 con Mamá y Papá',
				      link: 'https://www.promoscasaley.com.mx',
				      picture: 'https://www.promoscasaley.com.mx/gatorade/img/img_facebook.jpg',
				      caption: 'Vigencia de la promoción: 8 de mayo de 2018 al 22 de junio de 2018.',
				      description: 'Al 100 con Mamá y Papá'
				    },
				    function(response) {
						if (response !=null) { 	
					        // El usuario publico en el muro
							console.log('El usuario publico en el muro');
							window.location.href = 'registrar_facebook/'+($cantidad_puntos);
					      } else {
					        // El usuario cancelo y no publico nada
							console.log('El usuario cancelo y no publico nada');
							window.location.href = 'registrar_facebook/'+($cantidad_puntos);
					      }
				     }
			    );

			    FB.api('/me', function(response) {
			       $("#response").html("Bienvenido "+ response.name +", has iniciado sesión en facebook");
			    });

     		} else if (response.status === 'not_authorized') { //cuando esta conectado pero no por la app
				FB.ui({
					      method: 'feed',
					      name: 'Al 100 con Mamá y Papá',
					      link: 'https://www.promoscasaley.com.mx',
					      picture: 'https://www.promoscasaley.com.mx/gatorade/img/img_facebook.jpg',
					      caption: 'Vigencia de la promoción: 8 de mayo de 2018 al 22 de junio de 2018.',
					      description: 'Al 100 con Mamá y Papá'
				       },
				       function(response) {
							if (response !=null) { 	
						        // El usuario publico en el muro
								console.log('El usuario publico en el muro');
								window.location.href = 'registrar_facebook/'+($cantidad_puntos);
						    } else {
						        // El usuario cancelo y no publico nada
								console.log('El usuario cancelo y no publico nada');
								window.location.href = 'registrar_facebook/'+($cantidad_puntos);
						    }
					    }
				);
			} else {
     			$("#response").html("No hay sesión iniciada en facebook");
				FB.ui({
					      method: 'feed',
					      name: 'Al 100 con Mamá y Papá',
					      link: 'https://www.promoscasaley.com.mx',
					      picture: 'https://www.promoscasaley.com.mx/gatorade/img/img_facebook.jpg',
					      caption: 'Vigencia de la promoción: 8 de mayo de 2018 al 22 de junio de 2018.',
					      description: 'Al 100 con Mamá y Papá'
				      },
				      function(response) {
							if (response !=null) { 	
						        // El usuario publico en el muro
								console.log('El usuario publico en el muro');
								window.location.href = 'registrar_facebook/'+($cantidad_puntos);
						      } else {
						        // El usuario cancelo y no publico nada
								console.log('El usuario cancelo y no publico nada');
								window.location.href = 'registrar_facebook/'+($cantidad_puntos);
						      }
				       }
				);
    		}

     	}); //fin de FB.getLoginStatus(function(response) {
    } //fin de window.fbAsyncInit = function() {
 
    	
   function myFacebookLogin() {  
   	  //console.log('a');
		     (function(d, s, id){
		     var js, fjs = d.getElementsByTagName(s)[0];
		     if (d.getElementById(id)) {return;}
		     js = d.createElement(s); js.id = id;
		     js.src = "//connect.facebook.net/es_LA/all.js";
		     fjs.parentNode.insertBefore(js, fjs);
		      }(document, 'script', 'facebook-jssdk'));
		     
	}     

  </script>


