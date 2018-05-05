<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $this->load->view( 'header_futbol' ); ?>

 <?php 
 
    if (!isset($retorno)) {
        $retorno ='record/'.$this->session->userdata('id_participante');
        
    }
 ?>   


<input type="hidden" id="jgo" name="jgo" value="<?php echo $jgo; ?>">

<div class="container mecanica">
      
        <div style="position: fixed; background-color: transparent; top: 0px; left: 0px; width: 100%; height: 100%"></div>
        
            
            <script type="text/javascript" src="<?php echo base_url(); ?>js/vivo_futbol/js/juego.js"></script>

        
       <div class="check-fonts">
            <p class="check-font-1">Prueba 1</p>
        </div> 
        
        <canvas id="canvas" class='ani_hack' width="1360" height="640"> </canvas>
        <div data-orientation="landscape" class="orientation-msg-container"><p class="orientation-msg-text">Please rotate your device</p></div>
        <div id="block_game" style="position: fixed; background-color: transparent; top: 0px; left: 0px; width: 100%; height: 100%; display:none"></div>     

</div>


<?php $this->load->view( 'footer_futbol' ); ?>

<div class="modal fade bs-example-modal-lg" data-backdrop="static" data-keyboard="false" id="modalMessage_preg" ventana="pregunta" valor="<?php echo $retorno; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>

<div class="modal fade bs-example-modal-lg" id="modalMessage2" ventana="redi_reintentar" valor="<?php echo $retorno; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
        <div class="modal-content modal-instrucciones"></div>
    </div>
</div>


<div class="modal fade bs-example-modal-lg" data-backdrop="static" data-keyboard="false" id="modalMessage_face" ventana="facebook" valor="<?php echo $retorno; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>