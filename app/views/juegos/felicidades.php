<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $this->load->view( 'header' ); ?>

 <?php 
 
    if (!isset($retorno)) {
        $retorno ='record/'.$this->session->userdata('id_participante');
        
    }
 ?>   




<?php $this->load->view( 'footer' ); ?>



<div class="modal fade bs-example-modal-lg" data-backdrop="static" data-keyboard="false" id="modalMessage_face" ventana="facebook" valor="<?php echo $retorno; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>