<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view( 'header' ); ?>
<?php $this->load->view( 'navbar' ); ?>
<style>
.logoderecha{
	display: none;
}
.vigencia{
	color: red !important;
}
.slider {
	display: block !important;
}
.gira{
  display: block !important;
}
body{
	background-color: #d8e6f0 !important;
	background-image: none;
            background-position: center center;
}
footer{

}
footer .blanco{
	background-color: #ffffff !important;
}
footer .row .blanco{
	background-color: white !important;

}
.blanco123{
	padding: 28px 0px;
}
.navbar-brand{
	display: none;
}
@media screen and (max-width: 767px){
body {
   margin-top: 0px !important;
}
.home2img{
	margin-top: 60px;
	margin-bottom: 60px;
}

 }
 @media screen and (max-width: 1024px){
body {
   margin-top: 0px !important;
}
form#form_registrar_ticket{
	margin-top: 53px !important;
}
footer{
	margin-top: 0px !important;
}
 }
</style>
 <?php 
	 if ($this->session->userdata('session_participante') == true) { 
      	$retorno ="registro_ticket";
    } else {
        $retorno ="registro_usuario";
    }


 $attr = array('class' => 'form-horizontal', 'id'=>'form_registrar_ticket','name'=>$retorno,'method'=>'POST','autocomplete'=>'off','role'=>'form');
 echo form_open('/validar_registrar_ticket', $attr);
?>	

		
			<div class="" style="    display: flex;
    flex-wrap: wrap;">		
				<div class="col-md-8 col-sm-8 row-eq-height" style="padding:0px">		
					<img src="<?php echo base_url()?>img/home1.png" style="width:100%">
				</div>
				<div class="col-md-4 col-sm-4 row-eq-height" style="padding:0px; display: flex;
    align-items: center;
    flex-wrap: wrap;">		
					<a href="<?php echo base_url(); ?>ingresar_usuario" class=""><img src="<?php echo base_url()?>img/home2.png" class="home2img" style="max-width: 95%;"></a>
				</div>
				
				














				
			</div>				  
			

<?php echo form_close(); ?>




<?php $this->load->view( 'footer' ); ?>



<div class="modal fade bs-example-modal-lg" id="modalMessage"  ventana="redi_ticket" valor="<?php echo $retorno; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>



