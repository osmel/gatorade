<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
 	
 ?>

	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	</div>
	<div class="modal-body" style="clear:both">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
			<h4 class="inst text-center">¡Excelente trabajo!</h4	>
			<?php if ($this->session->userdata('cant_repetir') >= 0) { ?>
				<h2 class="inst text-center">Todavia te quedan <?php echo $this->session->userdata('cant_repetir')+1;?> oportunidad(es) </h2>
			<?php } ?>

		</div>

		<button type="button" class="close btnconti" data-dismiss="modal" aria-label="Close">

				CONTINUAR

		</button>
			
		<div class="alert" id="messagesModal"></div>
	</div>
	<div class="modal-footer">
	</div>
	

	
