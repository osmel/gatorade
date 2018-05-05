<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
		</div>

	
	</div>

<footer>
	
	<div class="row blanco blanco123">
	<div class="container" style="margin-top:0px !important;">
		

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 blanco">
				<div class="slider">
					<div>
						<img src="<?php echo base_url()?>img/4.png">
					</div>
					<div>
						<img src="<?php echo base_url()?>img/5.png">
					</div>
					<div>
						<img src="<?php echo base_url()?>img/6.png">
					</div>
					<div>
						<img src="<?php echo base_url()?>img/7.png">					
					</div>
					<div>
						<img src="<?php echo base_url()?>img/8.png">
					</div>
					<div>
						<img src="<?php echo base_url()?>img/9.png">
					</div>
					<div>
						<img src="<?php echo base_url()?>img/10.png">
					</div>
					<div>
						<img src="<?php echo base_url()?>img/11.png">
					</div>
					<div>
						<img src="<?php echo base_url()?>img/12.png">
					</div>
					<div>
						<img src="<?php echo base_url()?>img/13.png">
					</div>
					<div>
						<img src="<?php echo base_url()?>img/14.png">
					</div>
					<div>
						<img src="<?php echo base_url()?>img/15.png">
					</div>
				</div>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 copy text-center blanco">				
				<p class="vigencia">Vigencia de la promoción: 08 de mayo de 2018 al 22 de junio de 2018. Para mayor información consulta bases, términos y condiciones. </p>
			</div>			
		</div>
	</div>
</footer>
	<!-- SCRIPTS -->
	<?php  echo link_tag('css/estilos.css');  ?>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	 

	<!-- componente fecha simple -->
	<?php echo link_tag('css/bootstrap-datepicker.css'); ?>
	
	<!-- componente rango fecha -->
	<?php echo link_tag('css/daterangepicker-bs3.css'); ?>
	
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.form.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/spin.min.js"></script>

	<!-- componente fecha simple -->
	<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap-datepicker.js"></script>

	<!-- componente rango fecha -->
	<script type="text/javascript" src="<?php echo base_url(); ?>js/moment.js"></script>		
	<script type="text/javascript" src="<?php echo base_url(); ?>js/daterangepicker.js"></script>		




	<!-- componente fecha simple -->
	<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js"></script>
	
	
	<script src="<?php echo base_url(); ?>js/base64/jquery.base64.js" type="text/javascript"></script>
	
	
	<!--para conversion a base64.encode y base64.decode 
	<script src="<?php echo base_url(); ?>js/base64/jquery.base64.min.js" type="text/javascript"></script>
	
	<script src="<?php echo base_url(); ?>js/base64/jquery.base64_actualizado.js" type="text/javascript"></script>
	-->
	
	<!-- Juego -->	
	<script type="text/javascript" src="<?php echo base_url(); ?>js/juego/jquery.slotmachine.js"></script>

	<!-- mask -->	
  <script src="<?php echo base_url(); ?>js/assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js" type="text/javascript"></script>
  <!--
  <script src="<?php echo base_url(); ?>js/assets/global/plugins/jquery.input-ip-address-control-1.0.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>js/assets/pages/scripts/form-input-mask.min.js" type="text/javascript"></script>
  -->



  <!-- checkbox -->	
  <script src="<?php echo base_url(); ?>js/assets/global/plugins/icheck/icheck.min.js" type="text/javascript"></script>
  <!-- <script src="<?php echo base_url(); ?>js/assets/global/scripts/app.min.js" type="text/javascript"></script>
  -->	


 	 <!-- Mostrar ticket de muestra  -->
		<script type="text/javascript" src="<?php echo base_url(); ?>js/slick.js"></script>

  <!-- Fecha Dropdowns  -->

	<script src="<?php echo base_url(); ?>js/fechaDropdowns/jquery.date-dropdowns.js"></script>

  <!-- Juego de flipear tarjetas -->
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.flip.js"></script>

  <!-- nuestro js principal -->

	<script type="text/javascript" src="<?php echo base_url(); ?>js/sistema.js"></script>

	<script type="text/javascript">
ya=0;
function tickets(){
$(".slider").slick({
        dots: false,
        infinite: true,
        slidesToShow:9,
        slidesToScroll: 1,
        arrows: false,
        autoplay: true,
  		autoplaySpeed: 1500,
        responsive: [
        	{
        		breakpoint:768,
        		settings: {
        			dots: false,
			        infinite: true,
			        slidesToShow: 6,
			        slidesToScroll: 1,
			        arrows: false,
			        autoplay: true,
  					autoplaySpeed: 1500,
        		}
        	},
        	{
        		breakpoint:481,
        		settings: {
        			dots: false,
			        infinite: true,
			        slidesToShow: 2,
			        slidesToScroll: 1,
			        arrows: false,
			        autoplay: true,
  					autoplaySpeed: 1500,
        		}
        	},
        	{
        		breakpoint:361,
        		settings: {
        			dots: false,
			        infinite: true,
			        slidesToShow: 2,
			        slidesToScroll: 1,
			        arrows: false,
			        autoplay: true,
  					autoplaySpeed: 1500,
        		}
        	}
        ]
      });
ya=1;
}
function cerrar(){	
	$('.ventana-ejemplos').animate({'opacity':0}, 1000, function(){
		$('.ventana-ejemplos').css({'z-index':'-100'});
	});
}
function abrir() {
	$('.ventana-ejemplos').css({'z-index':'1000'});
	$('.ventana-ejemplos').animate({'opacity':1}, 1000, function(){
		if (ya == 0) {
			tickets();
		};		
	});
}

$('a.ver-ticket').click(function() {
	abrir();
});

$('.ventana-ejemplos .close').click(function() {
	cerrar();
});

$(document).ready(function() {
	tickets();
});

</script>

</body>
</html>