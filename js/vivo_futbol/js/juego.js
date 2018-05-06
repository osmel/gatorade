jQuery(document).ready(function($) {

    
// Localización: puede cambiar fácilmente el texto del juego para diferentes idiomas, cambiando la cadena en CLang.js
    
TEXT_GAMEOVER = "Juego Terminado";
TEXT_OF = "/";
TEXT_SCORE = "Puntos ";
TEXT_BEST_SCORE = "Mejor Ptos";
TEXT_MULTIPLIER = "x";

TEXT_ARE_SURE = "¿Estás seguro?";
TEXT_BALL_OUT = "Fuera";
TEXT_PAUSE = "Pausa";
TEXT_CONGRATULATION = ["Bueno!", "Estupendo!", "EXCELENTE!!!"];
TEXT_SAVED = "SALVADO";
TEXT_HELP = "Golpee fuerte a la bola";
 
TEXT_SHARE_IMAGE = "200x200.jpg";
TEXT_SHARE_TITLE = "Felicitaciones!";
TEXT_SHARE_MSG1 = "Usted recolectó <strong>";
TEXT_SHARE_MSG2 = " ptos</strong>!<br><br>Comparte tu record con amigos!";
TEXT_SHARE_SHARE1 = "Mi record es ";
TEXT_SHARE_SHARE2 = " ¡puntos! ¿Puedes hacerlo mejor?";


/*
    -- Este juego tiene la "etiqueta canvas" en el body. 
    -- El evento ready en el body llama a la función principal del juego: CMain(). 
    --La sección head declara todas las funciones de JavaScript del juego.
    -- Todo el proyecto usa un enfoque típico orientado a objetos. 
    -- En la función init hay 8 eventos mapeados que pueden ser útiles eventualmente para las estadísticas
*/

                var pp = 100;  //ptos que se le va asignar a cada gol
                var oMain = new CMain({
                    
                    
                    area_goal:   // puedes personalizar fácilmente la configuración del juego cuando creas una nueva instancia del juego
                        
                        [

                       {id: 0, probability: 100}
                       
                        ], 

                        //Objetivo del area de probabilidades comienza de la izquierda superior, hasta la derecha inferior
                        //son 14 areas de goles
                        //PROBABILITY AREA GOALS START TO LEFT UP TO RIGHT DOWN 

                        /*{id: 0, probability: 100}, {id: 1, probability: 80}, {id: 2, probability: 60},
                        {id: 3, probability: 80}, {id: 4, probability: 100}, {id: 5, probability: 75},
                        {id: 6, probability: 60}, {id: 7, probability: 50}, {id: 8, probability: 60},
                        {id: 9, probability: 75}, {id: 10, probability: 80}, {id: 11, probability: 65},
                        {id: 12, probability: 70}, {id: 13, probability: 65}, {id: 14, probability: 80}
                        */

                    //0 1 2 3 4
                    //5 6 7 8 9
                    //10 11 12 13 14
                    num_of_penalty: jQuery('#goles').val(), //Numero maximo de penalty para finalizar el juego(o nivel)
                    multiplier_step: 0, //0.1, //Incrementar el multiplicador de cada gol, en funcion de la calidad creo
                    fullscreen: true, //false para no MOSTRAR EL BOTÓN DE PANTALLA COMPLETA(FULLSCREEN)
                    num_levels_for_ads: 2//NÚMERO DE VUELTAS JUGADAS ANTES DE AD SHOWING. Quien define cdo salir "evento show_interlevel_ad"

                            //////// THIS FEATURE  IS ACTIVATED ONLY WITH CTL ARCADE PLUGIN./////////////////////////// 
                            /////////////////// YOU CAN GET IT AT: ///////////////////////////////////////////////////////// 
                            // http://codecanyon.net/item/ctl-arcade-wordpress-plugin/13856421 ///////////
                });
                
                
                //ESTE EVENTO SE dispara CUANDO SE HACE CLIC EN EL "BOTÓN DE play" DE LA PANTALLA DEL MENÚ
                jQuery(oMain).on("start_session", function (evt) {

                    if (getParamValue('ctl-arcade') === "true") {  //aqui si se usa wordpress
                        parent.__ctlArcadeStartSession();
                    }
                });

                //ESTE EVENTO SE dispara CUANDO SE HACE CLIC EN EL "BOTÓN DE SALIDA y se confirma q si saldra".
                //despues del evento "show_interlevel_ad"
                jQuery(oMain).on("end_session", function (evt) {
                    //alert('1');
                    if (getParamValue('ctl-arcade') === "true") {
                        parent.__ctlArcadeEndSession();
                    }
                });

                // ESTE EVENTO SE dispara CUANDO EL "JUEGO COMIENZA", despues del evento start_session
                jQuery(oMain).on("start_level", function (evt, iLevel) {
                    if (getParamValue('ctl-arcade') === "true") {
                        parent.__ctlArcadeStartLevel({level: iLevel});
                    }
                });


                // NO lo vi ESTE EVENTO SE dispara CUANDO EL JUEGO SE REINICIA
                jQuery(oMain).on("restart_level", function (evt, iLevel) {
                   // alert('reiniciar');
                    if (getParamValue('ctl-arcade') === "true") {
                        parent.__ctlArcadeRestartLevel({level: iLevel});
                    }
                });

                // ESTE EVENTO SE dispara CUANDO finaliza todas las tiradas y concluye ese nivel, despues del "evento save_score" 
                jQuery(oMain).on("end_level", function (evt, iLevel) {
                    //alert('end_level');

                    if (getParamValue('ctl-arcade') === "true") {
                        parent.__ctlArcadeEndLevel({level: iLevel});
                    }
                });


                //ESTE EVENTO SE dispara CUANDO EL JUEGO TERMINÓ. PUEDE SER ÚTIL PARA LLAMAR un script de php
                // (NO PROPORCIONADOS EN EL PAQUETE) QUE GUARDEN LA PUNTUACIÓN.
                jQuery(oMain).on("save_score", function (evt, iScore, szMode) {
                    //alert('save_score');
                    
                    console.log(evt);
                    console.log(iScore);
                    console.log(szMode);
                    
                    
                    jQuery.ajax({ //guardar en la cookie el conteo
                            url : '/gatorade/respuesta_tarjeta',
                            data : { 
                                
                                puntos:iScore,
                                
                            },
                            type : 'POST',
                            dataType : 'json',
                            success : function(datos) {  

                                window.location.href = '/gatorade/'+datos.redireccion;    
                                /*
                                var url = "/gatorade/proc_modal_pregunta";
                                        jQuery('#modalMessage_preg').modal({
                                              show:'true',
                                            remote:url,
                                        }); 
                                 */

                               // return false;   
                            }
                    });             
                    


                    //window.location.href = '/gatorade/'; //+data.redireccion;    
                    
                    if (getParamValue('ctl-arcade') === "true") {
                        parent.__ctlArcadeSaveScore({score: iScore, mode: szMode});
                    }
                });

                // ESTE EVENTO SE dispara CUANDO EL JUEGO TERMINÓ. PUEDE SER ÚTIL LLAMAR ADS SCRIPT.
                jQuery(oMain).on("show_interlevel_ad", function (evt) {
                    //alert('show_interlevel_ad');


                    if (getParamValue('ctl-arcade') === "true") {
                        parent.__ctlArcadeShowInterlevelAD();
                    }
                });

                // ESTE EVENTO SE DISPARA CUANDO SE MUESTRA EL cartel "GAME OVER", juego ganado
                jQuery(oMain).on("share_event", function (evt, iScore) {
                    //console.log(iScore);
                    if (getParamValue('ctl-arcade') === "true") {
                        parent.__ctlArcadeShareEvent({img: TEXT_SHARE_IMAGE,
                            title: TEXT_SHARE_TITLE,
                            msg: TEXT_SHARE_MSG1 + iScore + TEXT_SHARE_MSG2,
                            msg_share: TEXT_SHARE_SHARE1 + iScore + TEXT_SHARE_SHARE1});
                    }
                });


                if (isIOS()) {
                    setTimeout(function () {
                        sizeHandler();
                    }, 200);
                } else {

                    sizeHandler();
                }




    });