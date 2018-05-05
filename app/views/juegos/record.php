<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view( 'header' ); ?>
<?php $this->load->view( 'navbar' ); ?>

<?php 
	//print_r((trim($record->tarjeta)));
	//die;
?>

<div class="container intro">

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h1 class="text-center">@<?php echo $this->session->userdata( 'nick_participante' ); ?></h1>
		</div>
	</div>

	<div class="">								
		<div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12 mimarcador">


		<div class="col-md-12">
			
							<div class="col-md-6 col-sm-6"><span class="textosmarcador">Ticket</span></div>
							<!-- <div class="col-md-2 col-sm-2 ocultarsi"><span class="textosmarcador">Folio</span></div> -->

							<!--<div class="col-md-2 col-sm-2 ocultarsi"><span class="textosmarcador">Folio</span></div> -->

							<div class="col-md-2 col-sm-2 ocultarsi"><span class="textosmarcador">Puntos</span></div>
							<!-- <div class="col-md-2 col-sm-2 ocultarsi"><span class="textosmarcador">Pregunta</span></div> -->
							<div class="col-md-2 col-sm-2 ocultarsi"><span class="textosmarcador">Redes</span></div>

						

				<?php 
						$total_con_doble =0;
					 	if (($detalles)) {	
				 		foreach ($detalles as $key => $value) {
				 			//print_r($value->cant1);
				 			
				 			$suma_detalle = ((int)$value->puntos);

							
							

							echo '<div class="col-md-12">';
							echo		'<div class="col-md-6 col-sm-6"><span class="textosmarcador">'.$value->ticket.'</span></div>';

							echo		'<div class="col-md-2 col-sm-2 ocultarsi"><span class="textosmarcador">'.$suma_detalle .'</span></div>';
							
							if ($value->total_redes<>100) {
								echo '<div class="col-md-2 col-sm-2 ocultarsi"><span class="textosmarcador">NO</span></div>';
							}else{
								echo '<div class="col-md-2 col-sm-2 ocultarsi"><span class="textosmarcador">SI</span></div>';
							}

							echo  '</div>';		
							echo '<br/>'	;

				 			
				 		}

				 	}	

			?>
		</div>

			<?php 	
				$suma_total =0;
				$suma_actual =0;
				$total_redes = 0;

				
		

		if (($record)) {					
				$suma_total 
						= ((int)$record->puntos);

				$total_redes = $record->total_redes ;		
			
				echo '<div class="col-md-12 text-center"><span class="textosmarcador" style="margin-top:50px;font-size: 35px;">TOTAL:'.($total_redes+$suma_total).'</span></div>';
				
	 }	






			?>
			
			
			

		</div>



	</div>	


	
</div>


<?php $this->load->view( 'footer' ); ?>

