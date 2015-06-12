<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class ECalidadSolicitud {

    const Excelente=1;
    const Buena=2;
    const Normal=3;
    const Baja=4;
    const Deficiente=5;

    public static function getCalidadSolicitudArray() {
        return
            array('1'=>'Excelente',
                  '2'=>'Buena',
                  '3'=>'Normal',
                  '4'=>'Mala',
                  '5'=>'Deficiente');
    }
}
?>
