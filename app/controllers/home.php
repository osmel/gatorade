<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller { 

	public function __construct(){ 
		parent::__construct();

		$this->load->model('admin/modelo', 'modelo'); 
		$this->load->model('admin/catalogo', 'catalogo');  
		$this->load->model('registros', 'modelo_registro'); 
		$this->load->library(array('email')); 
		$this->total_fichas = 90;
	}



///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
///////////juego//////////////////////////////////////////////////////////////////////////////////
  
   function futbol(){ //presentacion del juego, cdo refresque 
   		
   		//si esta la session activa y esta registrado ticket
		if ( ($this->session->userdata( 'session_participante' ) == TRUE ) && ($this->session->userdata( 'registro_ticket' ) == TRUE )  ) { 

			$preg = $this->modelo_registro->get_datos();


			$mitarjeta = $preg->tarjeta;	
			$mitiempo=$preg->tiempo_juego;
			$data['jgo'] =1;


			//sino tiene todavía el total de fichas y el tiempo todavía no ha concluido(0:00)
			if ( ( substr_count($mitarjeta,';') < $this->total_fichas) && ($mitiempo!='0:00') ) {
				
				 $data['tarjeta'] = $mitarjeta;   //todas las tarjetas viradas
				 
				 $preg_cara= str_replace("[", "", $preg->cara);  //esto para quitar [
				 $preg_cara= str_replace("]", "", $preg_cara);   //esto para quitar ]

				 $data['cara'] = explode(",", $preg_cara);   // todas las cara


				 $preg_misdatos= str_replace("[", "", $preg->misdatos); //esto para quitar [
				 $preg_misdatos= str_replace("]", "", $preg_misdatos);  //esto para quitar ]

				 $data['misdatos'] = explode(",", $preg_misdatos); // todas misdatos

				//print_r($data);die;

				 $this->load->view( 'juegos/futbol', $data);
			} else {

				if ($this->session->userdata('abriendo_face')) {
						redirect('record/'.$this->session->userdata('id_participante'));	
				} else {

	 				 $data['tarjeta'] = $mitarjeta;   //todas las tarjetas viradas
					 
					 $preg_cara= str_replace("[", "", $preg->cara);  //esto para quitar [
					 $preg_cara= str_replace("]", "", $preg_cara);   //esto para quitar ]

					 $data['cara'] = explode(",", $preg_cara);   // todas las cara


					 $preg_misdatos= str_replace("[", "", $preg->misdatos); //esto para quitar [
					 $preg_misdatos= str_replace("]", "", $preg_misdatos);  //esto para quitar ]

					 $data['misdatos'] = explode(",", $preg_misdatos); // todas misdatos



					$this->load->view( 'juegos/futbol', $data);
				}
			}	 

			 
		} else {
			redirect('');
		}

	}

/*

select 
        AES_DECRYPT( cara,'gtg5igLZasUC3xNfDlvTGBxxkoMuR6FaCYw5') AS cara,
        AES_DECRYPT( misdatos,'gtg5igLZasUC3xNfDlvTGBxxkoMuR6FaCYw5') AS misdatos,
        AES_DECRYPT( tarjeta,'gtg5igLZasUC3xNfDlvTGBxxkoMuR6FaCYw5') AS tarjeta
      from 
        calimax_registro_participantes


select 
        
SUBSTR_COUNT( AES_DECRYPT( tarjeta,'gtg5igLZasUC3xNfDlvTGBxxkoMuR6FaCYw5') , '2;') +1,

SELECT 
(LENGTH(AES_DECRYPT( tarjeta,'gtg5igLZasUC3xNfDlvTGBxxkoMuR6FaCYw5')) - LENGTH(REPLACE(AES_DECRYPT( tarjeta,'gtg5igLZasUC3xNfDlvTGBxxkoMuR6FaCYw5'), '2;', '')) ) /2 AS occurrences,
AES_DECRYPT( tarjeta,'gtg5igLZasUC3xNfDlvTGBxxkoMuR6FaCYw5') AS tarjeta
      from 
        calimax_registro_participantes


*/

	//formato  fig+resp-tiempo;
	//cada vez que vire la tarjeta pues que guarde la "cadena [tarjeta] y el [tiempo]", 
	function felicidades(){ 
		  if ( $this->session->userdata('session_participante') !== TRUE ) {
		      redirect('');
		    } else {
		    	$this->session->set_userdata('abriendo_face', true );
		    	$data['total_facebook'] = $this->modelo_registro->total_facebook();
               $this->load->view( 'juegos/felicidades',$data );
		   }   			


	}	

	function respuesta_tarjeta(){ 

		$data['puntos'] =  $this->input->post( 'puntos' );  //total de puntos con este ticket
		//if guarda bien entonces
		$data 		  		= $this->security->xss_clean( $data );
		$guardar	 		= $this->modelo_registro->actualizar_ptos_ticket( $data );
		
		$data['redireccion']= 'felicidades'; //'record/'.$this->session->userdata('id_participante');	
		echo json_encode($data);        
	}



	//este es cuando el tiempo se agota a 0:00
	function tiempo_juego(){ 
			$data['tiempo'] =  $this->input->post( 'tiempo' );
			$data 		  		= $this->security->xss_clean( $data );
			
			$this->modelo_registro->actualizar_tiempo( $data );
			$data['redireccion']= (int)$this->session->userdata( 'cant_repetir' );
			echo json_encode($data);

	}	







////////////////////////////////////////////////////////////////////////////////////
/////////////////////////juegos/////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////





///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////


	public function index(){
		$this->dashboard();
	}

	/////////////presentacion, filtro y paginador////////////	
	function dashboard(){ 
		//print_r($this->session->userdata( 'id_participante' ));die;
		self::configuraciones();
		$data['nodefinido_todavia']        = '';
		$this->load->view( 'dashboard/dashboard',$data );

	}


	function mecanica(){ 
		$this->load->view( 'dashboard/mecanica' );
	}





	function facebook(){ 
		
		$this->load->view( 'facebook' );

	}


	function aviso(){ 
		
		$this->load->view( 'dashboard/aviso' );

	}	
function legales(){ 
		
		$this->load->view( 'dashboard/legales' );

	}	

	function eleccion_premio(){ 
		if (( $this->session->userdata( 'session_participante' ) == TRUE ) && ($this->session->userdata('premiado_participante') == 1)  && ($this->session->userdata('id_premio_participante') == 0) ) {

			$data['premios']   = $this->catalogo->listado_premios();
			

			$this->load->view( 'premios/premios' ,$data);
		}	else {
			redirect('');
		}
	}	



////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
	public function configuraciones(){
			    $configuraciones = $this->modelo->listado_configuraciones();
				
				if ( $configuraciones != FALSE ){

					if (is_array($configuraciones))
						foreach ($configuraciones as $configuracion) {
							$this->session->set_userdata('c'.$configuracion->id, $configuracion->valor);
							$this->session->set_userdata('a'.$configuracion->id, $configuracion->activo);
						}
					
				} 

	}






/////////////////validaciones/////////////////////////////////////////	


	public function valid_cero($str)
	{
		return (  preg_match("/^(0)$/ix", $str)) ? FALSE : TRUE;
	}

	function nombre_valido( $str ){
		 $regex = "/^([A-Za-z ñáéíóúÑÁÉÍÓÚ]{2,60})$/i";
		//if ( ! preg_match( '/^[A-Za-zÁÉÍÓÚáéíóúÑñ \s]/', $str ) ){
		if ( ! preg_match( $regex, $str ) ){			
			$this->form_validation->set_message( 'nombre_valido','<b class="requerido">*</b> La información introducida en <b>%s</b> no es válida.' );
			return FALSE;
		} else {
			return TRUE;
		}
	}

	function valid_phone( $str ){
		if ( $str ) {
			if ( ! preg_match( '/\([0-9]\)| |[0-9]/', $str ) ){
				$this->form_validation->set_message( 'valid_phone', '<b class="requerido">*</b> El <b>%s</b> no tiene un formato válido.' );
				return FALSE;
			} else {
				return TRUE;
			}
		}
	}

	function valid_option( $str ){
		if ($str == 0) {
			$this->form_validation->set_message('valid_option', '<b class="requerido">*</b> Es necesario que selecciones una <b>%s</b>.');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	function valid_date( $str ){

		$arr = explode('-', $str);
		if ( count($arr) == 3 ){
			$d = $arr[0];
			$m = $arr[1];
			$y = $arr[2];
			if ( is_numeric( $m ) && is_numeric( $d ) && is_numeric( $y ) ){
				return checkdate($m, $d, $y);
			} else {
				$this->form_validation->set_message('valid_date', '<b class="requerido">*</b> El campo <b>%s</b> debe tener una fecha válida con el formato DD-MM-YYYY.');
				return FALSE;
			}
		} else {
			$this->form_validation->set_message('valid_date', '<b class="requerido">*</b> El campo <b>%s</b> debe tener una fecha válida con el formato DD/MM/YYYY.');
			return FALSE;
		}
	}

	public function valid_email($str)
	{
		return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
	}

	////Agregado por implementacion de registro insitu para evento/////
	public function opcion_valida( $str ){
		if ( $str == '0' ){
			$this->form_validation->set_message('opcion_valida',"<b class='requerido'>*</b>  Selección <b>%s</b>.");
			return FALSE;
		} else {
			return TRUE;
		}
	}


}

/* End of file main.php */
/* Location: ./app/controllers/main.php */
