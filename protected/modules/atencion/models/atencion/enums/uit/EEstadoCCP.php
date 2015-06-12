<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class EEstadoCCP {

    const PorRequerir = 0;
    const Requerido = 1;
    const Otorgado = 2;
    const Ampliado = 3;
    const Cambiado = 4;

    public static function getEstadoCCPArray() {
        return
          array('0'=>'Por Requerir',
                '1'=>'Requerido',
                '2'=>'Otorgado',
                '3'=>'Ampliado',
                '4'=>'Cambiado',);
    }

}

?>
