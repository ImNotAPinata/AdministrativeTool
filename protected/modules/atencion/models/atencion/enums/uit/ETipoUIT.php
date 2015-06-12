<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ETipoUIT {

    const PorDefecto = 0;
    const GastosParciales = 1;

    public static function getTipoUitArray() {
        return
          array('0'=>'Por Defecto',
                '1'=>'Gastos Parciales',);
    }
    
    public static function getEspecificTipoUitArray($code){
        $tipouit = ETipoUIT::getTipoUitArray();
        return $tipouit[$code];
    }
}

?>
