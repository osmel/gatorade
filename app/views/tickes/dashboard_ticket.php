<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php  $this->load->view( 'header' ); ?>
<?php $this->load->view( 'navbar' ); ?>
<?php 

	if (!isset($retorno)) {
      	$retorno ="registro_ticket";
    }

  


 $attr = array('class' => 'form-horizontal', 'id'=>'form_registro_ticket','name'=>$retorno,'method'=>'POST','autocomplete'=>'off','role'=>'form');
 echo form_open('/validar_tickets', $attr);
?>		

<input type="hidden" id="id_par" name="id_par" value="<?php echo $this->session->userdata('id_participante'); ?>">

<div class="container ingresar">

		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<!-- <h3 class="text-center"><strong><?php echo $this->session->userdata('c2'); ?></strong></h3> -->
				<h1 class="text-center">REGISTRO DE TICKET</h1>
			</div>
		</div>
		
		<div class="row">
			
			<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 transparenciaformularios registrof" id="formass" style="float:none;margin:0px auto;padding: 32px 100px;">	
					
					
					<div class="form-group">
						
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							
							<input type="text" class="form-control" id="ticket" name="ticket" placeholder="Número de ticket">
							<span class="help-block" style="color:white;" id="msg_ticket"> </span> 
						</div>
					</div>


					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right" style="margin-bottom:15px">
						<a class="ver-ticket">Ver ejemplo de ticket</a>
					</div>

					<div class="form-group">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<input type="text" class="form-control" id="numTienda" name="numTienda" placeholder="Número de tienda">
							<span class="help-block" style="color:white;" id="msg_numTienda"> </span> 
							<!--<span class="help-block" style="color:white;" id="msg_monto"><b>Poner la cantidad exacta con pesos y centavos</b></span> -->
						</div>
					</div>


					<div class="form-group">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="input-group date compra col-lg-12 col-md-12 col-sm-12 col-xs-12">
							  <input id="compra" name="compra" type="text" class="form-control" placeholder="Fecha de compra"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span> 
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<span class="help-block" style="color:white;" id="msg_compra"> </span>
							</div>
						</div>
					</div>



					<!-- Presentaciones de la compra-->
					
						<h1>INDICA LA CANTIDAD Y PRESENTACIÓN DE LA COMPRA</h1>
					
						<?php foreach ( $presentaciones as $key=>$presentacion ){ ?>
								<div>
								   <?php $sepa = (int)(12/count($presentaciones)); ?>
									<div class="col-lg-<?php echo $sepa; ?> col-md-<?php echo $sepa; ?> col-sm-<?php echo $sepa; ?> col-xs-<?php echo $sepa; ?>">
										<label for="<?php echo "pre[$key]"; ?>" class="col-sm-3 col-md-2 control-label"><?php echo $presentacion->nombre; ?></label>
										<div class="col-sm-9 col-md-10">
											<input type="text" class="form-control" id="<?php echo "pre[$key]"; ?>" name="<?php echo "pre[$key]"; ?>" value="0" placeholder="0">
										</div>
									</div>		
								</div>						
							
						<?php } ?>	

					<!--
						<select name="id_perfil" id="id_perfil" class="form-control">
								<?php foreach ( $presentaciones as $presentacion ){ ?>
										<option value="<?php echo $presentacion->id; ?>"><?php echo $presentacion->nombre; ?></option>
									<?php } ?>	
								
								
						</select>
						-->
					
                   


				<div class="form-group" style="display:none;">
					
					<!-- <label for="tipo" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">¿CUANTOS DÍGITOS TIENE TU FOLIO DE PARTICIPACIÓN?</label> -->
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<select id="tipo" name="tipo" class="form-control" style="width:100%;">
						        <option value="folio2">Mi folio tiene 7 dígitos</option>
						        <option value="folio">Mi folio tiene 8 dígitos</option>
						    </select>
					    </div>	
				</div>


				<div class="form-group" id="foliocon2" style="display:none;">
					
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<input type="text" class="form-control" id="folio2" name="folio2" placeholder="Si tu folio es de 7 dígitos regístralo aquí">
						<span class="help-block msg_folio" style="color:white;" id="msg_folio2"> </span> 
					</div>
				</div>
				<div class="form-group"  id="foliocon" style="display:none;">
				 
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<input type="text" class="form-control" id="folio" name="folio" placeholder="Si tu folio es de 8 dígitos regístralo aquí">
						<span class="help-block msg_folio" style="color:white;" id="msg_folio"> </span> 
					</div> 
				</div>

					
					



		<div class="col-lg-4 col-lg-offset-5 col-md-4 col-md-offset-5 col-sm-12 col-xs-12">
           <span class="help-block" style="color:white;" id="msg_general"> </span>
        </div>
					
					
					

				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
				<button type="submit" class="btn btn-info ingresar" value="REGISTRARME"/>
					REGISTRAR
				</button>
		</div>


			
		
		</div>
		
	</div>
</div> 
<?php echo form_close(); ?>
<?php $this->load->view('footer'); ?>


<div class="modal fade bs-example-modal-lg" id="modalMessage"  ventana="redi_ticket" valor="<?php echo $retorno; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>

<div class="ventana-ejemplos">
	<div class="close">
		<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
	</div>
	<div class="img-ticket" style="height:88%;text-align:center">		
		<img src="<?php echo base_url()?>img/ticket.jpg" style="height: 100%;width: auto;">
	</div>

	<div class="text-center" style="color:#fff">
		*Imágen de referencia
	</div>
	<div class="text-center exp">
		<span>Monto de la compra</span> <span>Número de Ticket</span>  <span>Fecha de Compra</span> <span>Folio</span> </div>

</div>

<script type="text/javascript">
ya=0;
function tickets(){
$(".slider").slick({
        dots: false,
        infinite: false,
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: true,
        autoplay: true,
  		autoplaySpeed: 5500,
        responsive: [
        	{
        		breakpoint:768,
        		settings: {
        			dots: false,
			        infinite: false,
			        slidesToShow: 2,
			        slidesToScroll: 1,
			        arrows: true,
			        autoplay: true,
  					autoplaySpeed: 5500,
        		}
        	},
        	{
        		breakpoint:481,
        		settings: {
        			dots: false,
			        infinite: false,
			        slidesToShow: 1,
			        slidesToScroll: 1,
			        arrows: true,
			        autoplay: true,
  					autoplaySpeed: 5500,
        		}
        	},
        	{
        		breakpoint:361,
        		settings: {
        			dots: false,
			        infinite: false,
			        slidesToShow: 1,
			        slidesToScroll: 1,
			        arrows: true,
			        autoplay: true,
  					autoplaySpeed: 5500,
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
