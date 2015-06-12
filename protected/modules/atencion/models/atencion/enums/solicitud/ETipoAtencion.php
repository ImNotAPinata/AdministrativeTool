<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ETipoAtencion {

    const dias=1;
    const horas=2;

    public static function getTipoAtencionArray() {
        return
            array('1'=>'Días',
                  '2'=>'Horas:Minutos:Segundos',);
    }
}


?>


