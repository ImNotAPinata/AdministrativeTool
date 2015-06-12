<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class EEstadoServicio {

    const Pendiente = 0;
    const EnTramite = 1;
    const Atendido = 2;

    public static function getEstadoServicioArray() {
        return
          array('0'=>'Pendiente',
                '1'=>'En Trámite',
                '2'=>'Atendido',);
    }

}
?>
