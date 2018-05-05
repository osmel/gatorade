<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $this->load->view( 'header' ); ?>
<?php $this->load->view( 'navbar' ); ?>
 <?php 
 
    if (!isset($retorno)) {
        $retorno ='record/'.$this->session->userdata('id_participante');
        //$retorno =""; //registro_ticket
        //UPDATE `calimax_participantes` SET tarjeta='', tiempo_juego='' WHERE 1
        //http://juman.dev.com/record/9d6a4b86-ddd4-11e7-b76f-a81e846a651f
        //http://juman.dev.com/record/9d6a4b86-ddd4-11e7-b76f-a81e846a651f
    }
 ?>   


  <input type="hidden" id="jgo" name="jgo" value="<?php echo $jgo; ?>">

<div class="container mecanica">


<div class="container text-center">

  <div class="col-md-12">
  <h1>gira la mayor cantidad de BALONES para acumular puntos antes de que se agote el tiempo</h1>
  </div>
  
</div>
<div class="row ocultando">
  <button class="btn btn-danger" name="btn_tiempo" id="btn_tiempo">JUGAR AHORA</button> 
</div>
<div class="row contenedorjuego">
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 tablero" style="pointer-events: none;">  

       
           <?php for ($i = 1; $i <= count($cara); $i++) {

            ?>
                 <div class="col-xs-3 col-sm-2 col-md-1 moneda" style="opacity: 0.5;">
                    <div class="card<?php echo ( substr_count($tarjeta,$i.'+')>=1) ? 's': ''; ?>" valor="<?php echo ( substr_count($tarjeta,$i.'+')>=1) ? 's': 'n'; ?>" posicion="<?php echo $i; ?>" numero="<?php echo $misdatos[$i-1]; ?>" cara="<?php echo $cara[$i-1]; ?>" > 
                          
                          <div class="front" style="padding-bottom: 20px;"> 
                            <?php 
                                $imagen = ( substr_count($tarjeta,$i.'+')>=1) ? 'card'.$cara[$i-1].'.png' : (((($i % 2) ==0) ? 'modena.png' : 'modena2.png' )) ;
                                

                            ?>
                                <img  src="<?php echo base_url()?>img/fichas/<?php echo $imagen; ?>">
                                
                          </div> 
                          <div class="back" style="padding-bottom: 20px; display: <?php echo ( substr_count($tarjeta,$i.'+')>=1) ? 'none': ''; ?>;">
                                
                                <img src="<?php echo base_url().'img/fichas/card'.$cara[$i-1].'.png'; ?>">
                                
                               
                          </div> 
                    </div>      
                </div>
            <?php } ?>

    </div> 
     <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 text-center">
                 <button class="btn btn-danger ocultandono" name="btn_tiempo" id="btn_tiempo">JUGAR AHORA</button> 
                <span class="reloj"  style="display: none;"><i class="fa fa-clock-o" aria-hidden="true"></i><span class="r1 countdown"></span></span>
    
      <div class="monedasvalor">

        <!-- <img src="<?php echo base_url(); ?>img/monedasvalor.png">  --> 

      </div> 
     

    </div>
</div>

</div>


<?php $this->load->view( 'footer' ); ?>

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