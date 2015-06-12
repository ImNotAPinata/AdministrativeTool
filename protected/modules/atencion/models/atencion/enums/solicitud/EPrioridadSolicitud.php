<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class EPrioridadSolicitud {

    const MuyAlta=1;
    const Alta=2;
    const Normal=3;
    const Baja=4;
    const MuyBaja=5;

    public static function getPrioridadSolicitudArray() {
        return
            array('1' => 'Muy alta',
                  '2' => 'Alta',
                  '3' => 'Normal',
                  '4' => 'Baja',
                  '5' => 'Muy baja',);
    }
    
    public static function getPrioridadFromSolicitudArray($code) {
        $array = EPrioridadSolicitud::getPrioridadSolicitudArray();
        return $array[$code];
    }

}

?>
