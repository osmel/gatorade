<?php if(! defined('BASEPATH')) exit('No tienes permiso para acceder a este archivo');

	class registros extends CI_Model{
		
		private $key_hash;
		private $timezone;

		function __construct(){
			parent::__construct();
			$this->load->database("default");
			$this->key_hash    = $_SERVER['HASH_ENCRYPT'];
			$this->timezone    = 'UM1';

				//usuarios
		      $this->usuarios             = $this->db->dbprefix('usuarios');
          $this->perfiles             = $this->db->dbprefix('perfiles');

          $this->configuraciones      = $this->db->dbprefix('catalogo_configuraciones');
          
          $this->proveedores          = $this->db->dbprefix('catalogo_empresas');
          $this->historico_acceso     = $this->db->dbprefix('historico_acceso');

          $this->catalogo_estados      = $this->db->dbprefix('catalogo_estados');
          $this->catalogo_litraje      = $this->db->dbprefix('catalogo_litraje');

          $this->participantes      = $this->db->dbprefix('participantes');
          $this->bitacora_participante     = $this->db->dbprefix('bitacora_participante');
          $this->catalogo_imagenes         = $this->db->dbprefix('catalogo_imagenes');
          
          $this->registro_participantes         = $this->db->dbprefix('registro_participantes');

          $this->catalogo_preguntas         = $this->db->dbprefix('catalogo_preguntas');
          $this->catalogo_presentaciones         = $this->db->dbprefix('catalogo_presentaciones');
          

		}



//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////USUARIOS////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////


    public function listado_presentaciones(){
            $this->db->select( 'id, nombre, variable' );
            $presentacion = $this->db->get($this->catalogo_presentaciones );
            if ($presentacion->num_rows() > 0 )
               return $presentacion->result();
            else
               return FALSE;
            $presentacion->free_result();
        }   


    //checar si nick existe
    public function check_nick_existente($data){
      $this->db->select("AES_DECRYPT(nick,'{$this->key_hash}') AS nick", FALSE);      
      $this->db->from($this->participantes);
      $this->db->where('nick', "AES_ENCRYPT('{$data['nick']}','{$this->key_hash}')", FALSE); 
      $login = $this->db->get();
      if ($login->num_rows() > 0)
        return FALSE;
      else
        return TRUE;
      $login->free_result();
    }

         //checar el loguin y recoger datos de usuario registrado
    public function check_login_nick($data){
          $this->db->select("id", FALSE);           
          $this->db->select("AES_DECRYPT(p.email,'{$this->key_hash}') AS email", FALSE);      
          $this->db->select("AES_DECRYPT(p.nombre,'{$this->key_hash}') AS nombre", FALSE);      
          $this->db->select("AES_DECRYPT(p.apellidos,'{$this->key_hash}') AS apellidos", FALSE);      
          $this->db->select("AES_DECRYPT(p.celular,'{$this->key_hash}') AS celular", FALSE);      
          $this->db->select("AES_DECRYPT(p.contrasena,'{$this->key_hash}') AS contrasena", FALSE);
          $this->db->select("AES_DECRYPT(p.nick,'{$this->key_hash}') AS nick", FALSE);

          $this->db->from($this->participantes.' as p');
            
          $this->db->where('p.nick', "AES_ENCRYPT('{$data['nick']}','{$this->key_hash}')", FALSE); 
          $this->db->where('p.contrasena', "AES_ENCRYPT('{$data['contrasena']}','{$this->key_hash}')", FALSE);
          $login = $this->db->get();

          if ($login->num_rows() > 0)
            return $login->result();
          else 
            return FALSE;
          $login->free_result();
    }      


       //agregar participante
    public function anadir_registro( $data ){
            $timestamp = time();

            //$this->db->set( 'total', "AES_ENCRYPT(0,'{$this->key_hash}')", FALSE );  //total comienza en 0
           // $this->db->set( 'tarjeta', "AES_ENCRYPT('','{$this->key_hash}')", FALSE );  //total comienza en 0
           // $this->db->set( 'juego', "AES_ENCRYPT('','{$this->key_hash}')", FALSE );  //total comienza en 0


            $this->db->set( 'id_perfil', $data['id_perfil']);
            $this->db->set( 'creacion',  gmt_to_local( $timestamp, $this->timezone, TRUE) );
            $this->db->set( 'fecha_pc',  gmt_to_local( $timestamp, $this->timezone, TRUE) );  //fecha cdo se registro
            $this->db->set( 'id', "UUID()", FALSE); //id

            $this->db->set( 'nombre', "AES_ENCRYPT('{$data['nombre']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'apellidos', "AES_ENCRYPT('{$data['apellidos']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'email', "AES_ENCRYPT('{$data['email']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'fecha_nac', strtotime(date( "d-m-Y", strtotime($data['fecha_nac']) )) ,false);
            $this->db->set( 'calle', "AES_ENCRYPT('{$data['calle']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'numero', $data['numero']);
            $this->db->set( 'colonia', "AES_ENCRYPT('{$data['colonia']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'municipio', "AES_ENCRYPT('{$data['municipio']}','{$this->key_hash}')", FALSE );


            $this->db->set( 'cp', "AES_ENCRYPT('{$data['cp']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'ciudad', $data['ciudad']);
            $this->db->set( 'celular', "AES_ENCRYPT('{$data['celular']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'telefono', "AES_ENCRYPT('{$data['telefono']}','{$this->key_hash}')", FALSE );

            $this->db->set( 'contrasena', "AES_ENCRYPT('{$data['contrasena']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'id_estado', $data['id_estado_compra']);
            $this->db->set( 'nick', "AES_ENCRYPT('{$data['nick']}','{$this->key_hash}')", FALSE );


            $this->db->insert($this->participantes );

            if ($this->db->affected_rows() > 0){
                  return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();
            
        }


    


      //agregar a la bitacora de participante sus accesos  
       public function anadir_historico_acceso($data){
            $timestamp = time();
            $ip_address = $this->input->ip_address();
            $user_agent= $this->input->user_agent();

            $this->db->set( 'id_usuario', $data->id); // luego esta se compara con la tabla participante
            $this->db->set( 'email', "AES_ENCRYPT('{$data->email}','{$this->key_hash}')", FALSE );
            $this->db->set( 'fecha_pc',  gmt_to_local( $timestamp, $this->timezone, TRUE) );  //fecha cdo se registro
            $this->db->set( 'ip_address',  $ip_address, TRUE );
            $this->db->set( 'user_agent',  $user_agent, TRUE );
            $this->db->insert($this->bitacora_participante );
            if ($this->db->affected_rows() > 0){
                    return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();

        }


    //Recuperar contraseña  del participante
      public function recuperar_contrasena($data){
        $this->db->select("id", FALSE);           
        $this->db->select("AES_DECRYPT(p.email,'{$this->key_hash}') AS email", FALSE);            
        $this->db->select("AES_DECRYPT(p.nombre,'{$this->key_hash}') AS nombre", FALSE);      
        $this->db->select("AES_DECRYPT(p.apellidos,'{$this->key_hash}') AS apellidos", FALSE);      
      //$this->db->select("AES_DECRYPT(p.nick,'{$this->key_hash}') AS nick", FALSE);      
      //$this->db->select("AES_DECRYPT(p.telefono,'{$this->key_hash}') AS telefono", FALSE);      
        $this->db->select("AES_DECRYPT(p.contrasena,'{$this->key_hash}') AS contrasena", FALSE);
        $this->db->from($this->participantes.' as p');
        $this->db->where('p.email',"AES_ENCRYPT('{$data['email']}','{$this->key_hash}')",FALSE);
        $login = $this->db->get();
        if ($login->num_rows() > 0)
          return $login->result();
        else 
          return FALSE;
        $login->free_result();    
      } 


//----------------**************catalogos-------------------************------------------
  public function listado_estados(){
            $this->db->select( 'id, nombre' );
            $estados = $this->db->get($this->catalogo_estados );
            if ($estados->num_rows() > 0 )
               return $estados->result();
            else
               return FALSE;
            $estados->free_result();
        }   




//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////tickets///////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////

        //checar si el tickets ya fue registrado
        public function check_tickets_existente($data){
            $this->db->from($this->registro_participantes);
            $this->db->where('ticket',"AES_ENCRYPT('{$data['ticket']}','{$this->key_hash}')",FALSE);
            $this->db->where('folio',"AES_ENCRYPT('{$data['folio']}','{$this->key_hash}')",FALSE);
            $login = $this->db->get();
            if ($login->num_rows() > 0)
                return FALSE;
            else
                return TRUE;
            $login->free_result();
        }

         //checar si el tickets ya fue registrado
        public function check_tickets_existente_cero($data){
            

             $segundo_num=substr($data["folio"],  -4); ////los 4ultimos

             $cantidad_comparar = intval( ltrim(substr($segundo_num, 0, 3),'0') ); //los 3 primeros los convierte en cero y se queda con el ultimo

             //$cantidad_comparar = (int)substr($segundo_num, 3, 1);
             
             //si el ultimo numero es cero, entonces que sea 1
             $cantidad_comparar = ($cantidad_comparar==0) ? 1 : $cantidad_comparar;

            $this->db->from($this->registro_participantes);
            $this->db->where('ticket',"AES_ENCRYPT('{$data['ticket']}','{$this->key_hash}')",FALSE);
            $this->db->where('folio',"AES_ENCRYPT('{$data['folio']}','{$this->key_hash}')",FALSE);
            
            $cant = $this->db->count_all_results();   //cantidad de registro

            //return $cantidad_comparar;
            //if ($login->num_rows() > 0)
            if ($cant < $cantidad_comparar) {
                
               
                //primero elimina y luego envia la misma cantidad nuevamente

              $this->db->where('ticket',"AES_ENCRYPT('{$data['ticket']}','{$this->key_hash}')",FALSE);
              $this->db->where('folio',"AES_ENCRYPT('{$data['folio']}','{$this->key_hash}')",FALSE);
              $this->db->delete( $this->registro_participantes );


                return $cantidad_comparar;
            }                
            else
                return FALSE;
            $login->free_result();
        }

          //agregar tickets
        public function anadir_tickets( $data ){
            $timestamp = time();

            $this->db->set( 'fecha_pc',  gmt_to_local( $timestamp, $this->timezone, TRUE) );  //fecha cdo se registro
            
            $id_participante = $this->session->userdata('id_participante');
            $this->db->set( 'id_participante', '"'.$id_participante.'"',false); // id del usuario que se registro
            
            $this->db->set( 'ticket', "AES_ENCRYPT('{$data['ticket']}','{$this->key_hash}')", FALSE );
            //$this->db->set( 'monto', "AES_ENCRYPT('{$data['monto']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'numTienda', "AES_ENCRYPT('{$data['numTienda']}','{$this->key_hash}')", FALSE );
            
            $this->db->set( 'compra', strtotime(date( "d-m-Y", strtotime($data['compra']) )) ,false);
            $this->db->set( 'folio', "AES_ENCRYPT('{$data['folio']}','{$this->key_hash}')", FALSE );

            
            
            $this->db->set( 'presentacion', '"'.$data['presentacion'].'"', FALSE );              
            

            $this->db->insert($this->registro_participantes );


            if ($this->db->affected_rows() > 0){
                    return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();
            
        }  



////////////////////////////////////////////////////////////////////////////////////
/////////////////////////juegos/////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
        public function listado_imagenes(){

            $this->db->select('c.id, c.nombre, c.valor, c.activo, c.puntos, c.porciento');
            $this->db->from($this->catalogo_imagenes.' as c');
            $this->db->where('c.activo',0);
            $result = $this->db->get();
            
            if ( $result->num_rows() > 0 )
               return $result->result();
            else
               return False;
            $result->free_result();
        }     




     
        //agregar las caras para un ticket y un folio de un determinado usuario
        public function agregar_datos($data){

             $timestamp = time();

             $this->db->set( 'fecha_pc',  gmt_to_local( $timestamp, $this->timezone, TRUE) );  
             $this->db->set( 'cara', "AES_ENCRYPT('{$data['cara']}','{$this->key_hash}')", FALSE );
             $this->db->set( 'misdatos', "AES_ENCRYPT('{$data['misdatos']}','{$this->key_hash}')", FALSE );
              
              $this->db->where("id_participante", '"'.$this->session->userdata('id_participante').'"',false);  
              $this->db->where('ticket',"AES_ENCRYPT('{$this->session->userdata('new_ticket')}','{$this->key_hash}')",FALSE);
              $this->db->where('folio',"AES_ENCRYPT('{$this->session->userdata('new_folio')}','{$this->key_hash}')",FALSE);
            
              //Actualizar solo el ultimo
              //ORDER BY id DESC
              $this->db->order_by("id", "DESC");
              $this->db->limit(1,0); //$largo,$inicio


             $this->db->update($this->registro_participantes );
  
              if ($this->db->affected_rows() > 0){
                    return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();

        }


        public function get_datos(){
            
            $this->db->select("AES_DECRYPT(cara,'{$this->key_hash}') AS cara", FALSE);      
            $this->db->select("AES_DECRYPT(misdatos,'{$this->key_hash}') AS misdatos", FALSE);      
            $this->db->select("AES_DECRYPT(tarjeta,'{$this->key_hash}') AS tarjeta", FALSE);      
            $this->db->select("AES_DECRYPT(juego,'{$this->key_hash}') AS juego", FALSE);      
            $this->db->select("AES_DECRYPT(tiempo_juego,'{$this->key_hash}') AS tiempo_juego", FALSE);      
            $this->db->select("AES_DECRYPT(redes,'{$this->key_hash}') AS redes", FALSE);      
            

            $this->db->from($this->registro_participantes);
            $this->db->where("id_participante", '"'.$this->session->userdata('id_participante').'"',false);  
            $this->db->where('ticket',"AES_ENCRYPT('{$this->session->userdata('new_ticket')}','{$this->key_hash}')",FALSE);
            $this->db->where('folio',"AES_ENCRYPT('{$this->session->userdata('new_folio')}','{$this->key_hash}')",FALSE);

              //Actualizar solo el ultimo
              //ORDER BY id DESC
              $this->db->order_by("id", "DESC");
              $this->db->limit(1,0); //$largo,$inicio


            $preg = $this->db->get();
            if ($preg->num_rows() > 0)
              return $preg->row();
            else
              return TRUE;
            $login->free_result();
        }




 

//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////        


public function actualizar_ptos_ticket($data){

           $timestamp = time();

            //Actualizar la tarjeta
            $this->db->set( 'fecha_pc',  gmt_to_local( $timestamp, $this->timezone, TRUE) );  
            $this->db->set( 'puntos', "AES_ENCRYPT(' {$data["puntos"]}  ','{$this->key_hash}')", FALSE );
            
            $this->db->where("id_participante", '"'.$this->session->userdata('id_participante').'"',false);  
            $this->db->where('ticket',"AES_ENCRYPT('{$this->session->userdata('new_ticket')}','{$this->key_hash}')",FALSE);
            $this->db->where('folio',"AES_ENCRYPT('{$this->session->userdata('new_folio')}','{$this->key_hash}')",FALSE);

              //Actualizar solo el ultimo
              //ORDER BY id DESC
              $this->db->order_by("id", "DESC");
              $this->db->limit(1,0); //$largo,$inicio


            $this->db->update($this->registro_participantes );
  
            if ($this->db->affected_rows() > 0){
                  return true; //json_encode($data["formato"]);
              } else {
                  return FALSE;
              }
              $result->free_result();
        }


        //cada vez que vire la tarjeta pues que guarde la "cadena [tarjeta] y el [tiempo]", 
      public function actualizar_respuesta_tarjeta($data){

            //leer la tarjeta
            $this->db->select("AES_DECRYPT(tarjeta,'{$this->key_hash}') AS tarjeta", FALSE);      
            $this->db->from($this->registro_participantes);
            $this->db->where("id_participante", '"'.$this->session->userdata('id_participante').'"',false);  
            $this->db->where('ticket',"AES_ENCRYPT('{$this->session->userdata('new_ticket')}','{$this->key_hash}')",FALSE);
            $this->db->where('folio',"AES_ENCRYPT('{$this->session->userdata('new_folio')}','{$this->key_hash}')",FALSE);
              
              //Actualizar solo el ultimo
              //ORDER BY id DESC
              $this->db->order_by("id", "DESC");
              $this->db->limit(1,0); //$largo,$inicio

             //Actualizar solo el ultimo
              //ORDER BY id DESC
            $this->db->order_by("id", "DESC");
            $this->db->limit(1,0); //$largo,$inicio

            $preg = $this->db->get();
            $data["formato"] =trim($preg->row()->tarjeta).trim($data["formato"]);
            $timestamp = time();
            

            //Actualizar la tarjeta
            $this->db->set( 'fecha_pc',  gmt_to_local( $timestamp, $this->timezone, TRUE) );  
            $this->db->set( 'tarjeta', "AES_ENCRYPT(' {$data["formato"]}  ','{$this->key_hash}')", FALSE );
            $this->db->set( 'tiempo_juego', "AES_ENCRYPT('{$data['tiempo']}','{$this->key_hash}')", FALSE );  
            
            $this->db->where("id_participante", '"'.$this->session->userdata('id_participante').'"',false);  
            $this->db->where('ticket',"AES_ENCRYPT('{$this->session->userdata('new_ticket')}','{$this->key_hash}')",FALSE);
            $this->db->where('folio',"AES_ENCRYPT('{$this->session->userdata('new_folio')}','{$this->key_hash}')",FALSE);

              //Actualizar solo el ultimo
              //ORDER BY id DESC
              $this->db->order_by("id", "DESC");
              $this->db->limit(1,0); //$largo,$inicio


            $this->db->update($this->registro_participantes );
  
            if ($this->db->affected_rows() > 0){
                  return json_encode($data["formato"]);
              } else {
                  return FALSE;
              }
              $result->free_result();
        }


     

        //este es cuando el tiempo se agota a 0:00
        public function actualizar_tiempo($data){

             $timestamp = time();

             $this->db->set( 'fecha_pc',  gmt_to_local( $timestamp, $this->timezone, TRUE) );  
             $this->db->set( 'tiempo_juego', "AES_ENCRYPT('{$data['tiempo']}','{$this->key_hash}')", FALSE );  
            
            $this->db->where("id_participante", '"'.$this->session->userdata('id_participante').'"',false);  
            $this->db->where('ticket',"AES_ENCRYPT('{$this->session->userdata('new_ticket')}','{$this->key_hash}')",FALSE);
            $this->db->where('folio',"AES_ENCRYPT('{$this->session->userdata('new_folio')}','{$this->key_hash}')",FALSE);
            
              //Actualizar solo el ultimo
              //ORDER BY id DESC
              $this->db->order_by("id", "DESC");
              $this->db->limit(1,0); //$largo,$inicio

            $this->db->update($this->registro_participantes );
  
              if ($this->db->affected_rows() > 0){
                    return true;
                } else {
                    return false;
                }
                $result->free_result();

        }        







 

//////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////las preguntas/////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////        


    //listado de todas las preguntas
        public function listado_preguntas(){
            $this->db->select( 'id' );
            $this->db->from($this->catalogo_preguntas);
            //$this->db->where('fig',(int)$i);
            $preguntas = $this->db->get();
            if ($preguntas->num_rows() > 0 )
                 

               return $preguntas->result();
            else
               return FALSE;
            $estados->free_result();
        }   


       //tomar la pregunta por el id pasado
        public function get_preguntas(){
            $this->db->select( 'id,  pregunta, a, b, c, respuesta' );
            $this->db->from($this->catalogo_preguntas);
            $this->db->where('id', $this->session->userdata('pregunta'));
            $preg = $this->db->get();
            if ($preg->num_rows() > 0)
              return $preg->row();
            else
              return TRUE;
            $login->free_result();
        }        


   //poner la respuesta del juego 
        public function actualizar_respuesta_juego($data){

            //$this->db->set( 'responder', "AES_ENCRYPT('{$data['responder']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'responder', $data['responder'] );
            $this->db->set("id_pregunta", (int)$this->session->userdata( 'pregunta'));  
            $this->db->set( 'respuesta', "AES_ENCRYPT('{$data['respuesta']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'acumulado_pto', "AES_ENCRYPT('{$data['acumulado_pto']}','{$this->key_hash}')", FALSE );
            

            $this->db->where("id_participante", '"'.$this->session->userdata('id_participante').'"',false);  
            $this->db->where('ticket',"AES_ENCRYPT('{$this->session->userdata('new_ticket')}','{$this->key_hash}')",FALSE);
            $this->db->where('folio',"AES_ENCRYPT('{$this->session->userdata('new_folio')}','{$this->key_hash}')",FALSE);
            
              //Actualizar solo el ultimo
              //ORDER BY id DESC
              $this->db->order_by("id", "DESC");
              $this->db->limit(1,0); //$largo,$inicio

            $this->db->update($this->registro_participantes );






  
              if ($this->db->affected_rows() > 0){
                    return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();

        }        



      public function acumulado_puntos(){

          $this->db->select("p.fecha_pc");   
          $this->db->select("AES_DECRYPT(r.ticket, '{$this->key_hash}') AS ticket", FALSE);
          $this->db->select("AES_DECRYPT(r.folio, '{$this->key_hash}') AS folio", FALSE);

          $this->db->select("sum( (LENGTH(  AES_DECRYPT(r.tarjeta, '{$this->key_hash}')  ) - LENGTH(REPLACE(  AES_DECRYPT(r.tarjeta, '{$this->key_hash}'), '1;', '')) ) /2 )  AS  cant1", FALSE);
          $this->db->select("sum( (LENGTH(  AES_DECRYPT(r.tarjeta, '{$this->key_hash}')  ) - LENGTH(REPLACE(  AES_DECRYPT(r.tarjeta, '{$this->key_hash}'), '2;', '')) ) /2 )  AS  cant2", FALSE);
          $this->db->select("sum( (LENGTH(  AES_DECRYPT(r.tarjeta, '{$this->key_hash}')  ) - LENGTH(REPLACE(  AES_DECRYPT(r.tarjeta, '{$this->key_hash}'), '3;', '')) ) /2 )  AS  cant3", FALSE);
          $this->db->select("sum( (LENGTH(  AES_DECRYPT(r.tarjeta, '{$this->key_hash}')  ) - LENGTH(REPLACE(  AES_DECRYPT(r.tarjeta, '{$this->key_hash}'), '4;', '')) ) /2 )  AS  cant4", FALSE);
          $this->db->select("sum( (LENGTH(  AES_DECRYPT(r.tarjeta, '{$this->key_hash}')  ) - LENGTH(REPLACE(  AES_DECRYPT(r.tarjeta, '{$this->key_hash}'), '5;', '')) ) /2 )  AS  cant5", FALSE);



          $this->db->from($this->participantes.' as p');
          $this->db->join($this->registro_participantes.' as r', 'p.id = r.id_participante');

            //$this->db->where("p.id", '"'.$this->session->userdata('id_participante').'"',false);  
            
            $this->db->where("r.id_participante", '"'.$this->session->userdata('id_participante').'"',false);  
            $this->db->where('r.ticket',"AES_ENCRYPT('{$this->session->userdata('new_ticket')}','{$this->key_hash}')",FALSE);
            $this->db->where('r.folio',"AES_ENCRYPT('{$this->session->userdata('new_folio')}','{$this->key_hash}')",FALSE);
            

 
          $this->db->group_by("p.id, r.ticket, r.folio");

            $result = $this->db->get();
            
            if ( $result->num_rows() > 0 )
               return $result->result();
            else
               return False;
            $result->free_result();


      }  


////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////

 public function total_facebook(){

            

              $this->db->select("sum( (AES_DECRYPT(r.redes, '{$this->key_hash}')=1)*100) AS total", FALSE); 


          $this->db->from($this->registro_participantes.' as r');
          $this->db->where("r.id_participante", '"'.$this->session->userdata('id_participante').'"',false);  
        

          $result = $this->db->get();
            
            if ( $result->num_rows() > 0 )
               return  (int) ($result->row()->total);
            else
               return False;
            $result->free_result();


         } 


 //agregar participante
        public function actualizar_facebook( $data ){
            $timestamp = time();

            $this->db->set( 'fecha_pc',  gmt_to_local( $timestamp, $this->timezone, TRUE) );  //fecha cdo se registro
            $this->db->set( 'redes', "AES_ENCRYPT('{$data['redes']}','{$this->key_hash}')", FALSE );
            $this->db->where("id_participante", '"'.$this->session->userdata('id_participante').'"',false);  
            $this->db->where('ticket',"AES_ENCRYPT('{$this->session->userdata('new_ticket')}','{$this->key_hash}')",FALSE);
            $this->db->where('folio',"AES_ENCRYPT('{$this->session->userdata('new_folio')}','{$this->key_hash}')",FALSE);
            
              //Actualizar solo el ultimo
              //ORDER BY id DESC
              $this->db->order_by("id", "DESC");
              $this->db->limit(1,0); //$largo,$inicio

            $this->db->update($this->registro_participantes );

            if ($this->db->affected_rows() > 0){
                    return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();
        }        








////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
 

      public function record_personal(){

          $this->db->select("p.fecha_pc");   
          $this->db->select("AES_DECRYPT(p.nombre, '{$this->key_hash}') AS nombre", FALSE);
          $this->db->select("AES_DECRYPT(p.Apellidos, '{$this->key_hash}') AS Apellidos", FALSE);
          $this->db->select("AES_DECRYPT(p.nick, '{$this->key_hash}') AS nick", FALSE);


         

          $this->db->select("sum( AES_DECRYPT(r.puntos, '{$this->key_hash}')) AS puntos", FALSE);
            


         $this->db->select("sum( (AES_DECRYPT(r.redes, '{$this->key_hash}')=1)*100) AS total_redes", FALSE); 



          //$this->db->select("AES_DECRYPT(r.tarjeta, '{$this->key_hash}') AS tarjeta", FALSE);
             


          $this->db->from($this->participantes.' as p');
          $this->db->join($this->registro_participantes.' as r', 'p.id = r.id_participante');

          $this->db->where("p.id", '"'.$this->session->userdata('id_participante').'"',false);  
          //$this->db->where('ticket',"AES_ENCRYPT('{$this->session->userdata('new_ticket')}','{$this->key_hash}')",FALSE);
          //$this->db->where('folio',"AES_ENCRYPT('{$this->session->userdata('new_folio')}','{$this->key_hash}')",FALSE);

          
          $this->db->group_by("p.id");

            $result = $this->db->get();
            
            if ( $result->num_rows() > 0 )
               return $result->row();
            else
               return False;
            $result->free_result();


      }  



 public function record_detalle(){

          $this->db->select("p.fecha_pc");   
          $this->db->select("AES_DECRYPT(r.ticket, '{$this->key_hash}') AS ticket", FALSE);
          $this->db->select("AES_DECRYPT(r.folio, '{$this->key_hash}') AS folio", FALSE);
          $this->db->select("r.responder responder", FALSE);

        
        $this->db->select("sum( AES_DECRYPT(r.puntos, '{$this->key_hash}')) AS puntos", FALSE);


         $this->db->select("sum( (AES_DECRYPT(r.redes, '{$this->key_hash}')=1)*100) AS total_redes", FALSE); 

          //$this->db->select("AES_DECRYPT( max(r.acumulado_pto), '{$this->key_hash}') AS acumulado_pto", FALSE);


          $this->db->from($this->participantes.' as p');
          $this->db->join($this->registro_participantes.' as r', 'p.id = r.id_participante');

          $this->db->where("p.id", '"'.$this->session->userdata('id_participante').'"',false);  
 
          $this->db->group_by("p.id, r.ticket, r.folio");

            $result = $this->db->get();
            
            if ( $result->num_rows() > 0 )
               return $result->result();
            else
               return False;
            $result->free_result();


      }  


//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////  
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////



//////////////////////////////////////////////////////////////////////////////////////////         
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////  
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////         


   //agregar participante
        public function actualizar_tickets( $data ){
            $timestamp = time();

            $this->db->set( 'fecha_pc',  gmt_to_local( $timestamp, $this->timezone, TRUE) );  //fecha cdo se registro
            
            $id_participante         = $this->session->userdata('id_participante');
            $num_ticket_participante = $this->session->userdata('num_ticket_participante');
            

            $this->db->set( 'redes', 1, FALSE );
            $this->db->where('id_participante', $id_participante);  
            $this->db->where("AES_DECRYPT(ticket,'{$this->key_hash}')", '"'.$num_ticket_participante.'"',false);  

    
              //Actualizar solo el ultimo
              //ORDER BY id DESC
              $this->db->order_by("id", "DESC");
              $this->db->limit(1,0); //$largo,$inicio
                          
            $this->db->update($this->registro_participantes );


            if ($this->db->affected_rows() > 0){
                    self::registro_total_tickets2($data);
                    return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();
            
        }  


        public function registro_total_tickets2( $data ){


            $id_participante = $this->session->userdata('id_participante');

            
            
            $this->db->set( 'total', "AES_ENCRYPT( (CASE WHEN ( ISNULL (CONVERT(AES_DECRYPT(total,'{$this->key_hash}') , decimal) ) =1 )  THEN 0 else (CONVERT(AES_DECRYPT(total,'{$this->key_hash}') , decimal) ) END ) +".$data['total']." , '{$this->key_hash}')", false);


              $this->db->where('id', $id_participante);   
            $this->db->update($this->participantes );
            

        }           






        public function registro_total_tickets( $data ){


            $id_participante = $this->session->userdata('id_participante');

            
            
            $this->db->set( 'total', "AES_ENCRYPT( (CASE WHEN ( ISNULL (CONVERT(AES_DECRYPT(total,'{$this->key_hash}') , decimal) ) =1 )  THEN 0 else (CONVERT(AES_DECRYPT(total,'{$this->key_hash}') , decimal) ) END ) +".$data['total']." , '{$this->key_hash}')", false);


              $this->db->where('id', $id_participante);   
            //$this->db->where('id', '"'.$id_participante.'"',false); // id del usuario que se registro

            $this->db->update($this->participantes );
            

        }    

      
    


//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////









    



////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////


       public function record_general(){

          $largo = 20;
          $inicio =0; 
          $this->db->select("CONVERT(AES_DECRYPT(p.total,'{$this->key_hash}'),decimal) AS total", FALSE);
          $this->db->select("AES_DECRYPT(p.nick,'{$this->key_hash}') AS nick", FALSE);      
          $this->db->from($this->participantes.' as p');
          $this->db->order_by("total", "DESC");

          $this->db->limit($largo,$inicio); 

            $result = $this->db->get();
            
            if ( $result->num_rows() > 0 )
               return $result->result();
            else
               return False;
            $result->free_result();


      }  




/*

INSERT INTO calimax_participantes (`tarjeta`, `juego`)  
values (
AES_ENCRYPT('pana','gtg5igLZasUC3xNfDlvTGBxxkoMuR6FaCYw5'), 
AES_ENCRYPT('osmel','gtg5igLZasUC3xNfDlvTGBxxkoMuR6FaCYw5')
    )


SELECT
 AES_DECRYPT(nombre, 'gtg5igLZasUC3xNfDlvTGBxxkoMuR6FaCYw5') AS nombre,
AES_DECRYPT(Apellidos, 'gtg5igLZasUC3xNfDlvTGBxxkoMuR6FaCYw5') AS Apellidos,
AES_DECRYPT(juego, 'gtg5igLZasUC3xNfDlvTGBxxkoMuR6FaCYw5') AS juego,
AES_DECRYPT(tiempo_juego, 'gtg5igLZasUC3xNfDlvTGBxxkoMuR6FaCYw5') AS tiempo_juego,
AES_DECRYPT(tarjeta, 'gtg5igLZasUC3xNfDlvTGBxxkoMuR6FaCYw5') AS tarjeta,
AES_DECRYPT(email, 'gtg5igLZasUC3xNfDlvTGBxxkoMuR6FaCYw5') AS email,
AES_DECRYPT(contrasena, 'gtg5igLZasUC3xNfDlvTGBxxkoMuR6FaCYw5') AS contrasena,

AES_DECRYPT(puntos, 'gtg5igLZasUC3xNfDlvTGBxxkoMuR6FaCYw5') AS puntos,
redes

   FROM calimax_participantes

*/

    

/*
select 
  AES_DECRYPT( email,'gtg5igLZasUC3xNfDlvTGBxxkoMuR6FaCYw5') AS email,
  AES_DECRYPT( email_invitado,'gtg5igLZasUC3xNfDlvTGBxxkoMuR6FaCYw5') AS email_invitado,
  AES_DECRYPT( tarjeta,'gtg5igLZasUC3xNfDlvTGBxxkoMuR6FaCYw5') AS tarjeta
from 
  calimax_participantes

*/

 

////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                                      //no se usan
////////////////////////////////////////////////////////////////////////////////////////////////////////////////



    //checar si el correo ya fue registrado
    public function check_correo_existente($data){
      $this->db->select("AES_DECRYPT(email,'{$this->key_hash}') AS email", FALSE);      
      $this->db->from($this->participantes);
      $this->db->where('email',"AES_ENCRYPT('{$data['email']}','{$this->key_hash}')",FALSE);
      $login = $this->db->get();
      if ($login->num_rows() > 0)
        return FALSE;
      else
        return TRUE;
      $login->free_result();
    }


    //checar el login del participante
    public function check_loginconemail($data){
      $this->db->select("id", FALSE);           
      $this->db->select("AES_DECRYPT(p.email,'{$this->key_hash}') AS email", FALSE);      
      $this->db->select("AES_DECRYPT(p.nombre,'{$this->key_hash}') AS nombre", FALSE);      
      $this->db->select("AES_DECRYPT(p.apellidos,'{$this->key_hash}') AS apellidos", FALSE);      
      $this->db->select("AES_DECRYPT(p.nick,'{$this->key_hash}') AS nick", FALSE);      
      $this->db->select("AES_DECRYPT(p.telefono,'{$this->key_hash}') AS telefono", FALSE);      
      $this->db->select("AES_DECRYPT(p.contrasena,'{$this->key_hash}') AS contrasena", FALSE);

      $this->db->select("p.premiado,p.id_premio");
      
      $this->db->from($this->participantes.' as p');
      
      $this->db->where('p.contrasena', "AES_ENCRYPT('{$data['contrasena']}','{$this->key_hash}')", FALSE);
      $this->db->where('p.email',"AES_ENCRYPT('{$data['email']}','{$this->key_hash}')",FALSE);

      $login = $this->db->get();

      if ($login->num_rows() > 0)
        return $login->result();
      else 
        return FALSE;
      $login->free_result();
    }



     //checar el login del participante
        public function check_login($data){
          $this->db->select("id", FALSE);           
          $this->db->select("AES_DECRYPT(p.email,'{$this->key_hash}') AS email", FALSE);      
          $this->db->select("AES_DECRYPT(p.nombre,'{$this->key_hash}') AS nombre", FALSE);      
          $this->db->select("AES_DECRYPT(p.apellidos,'{$this->key_hash}') AS apellidos", FALSE);      
          $this->db->select("AES_DECRYPT(p.celular,'{$this->key_hash}') AS celular", FALSE);      
          $this->db->select("AES_DECRYPT(p.contrasena,'{$this->key_hash}') AS contrasena", FALSE);

          $this->db->from($this->participantes.' as p');
            
          $this->db->where('p.email', "AES_ENCRYPT('{$data['email']}','{$this->key_hash}')", FALSE); 
          $this->db->where('p.contrasena', "AES_ENCRYPT('{$data['contrasena']}','{$this->key_hash}')", FALSE);
          $login = $this->db->get();

          if ($login->num_rows() > 0)
            return $login->result();
          else 
            return FALSE;
          $login->free_result();
        }        







	} 
?>
