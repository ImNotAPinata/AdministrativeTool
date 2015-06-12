<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class EEstadoUit {

    const Requerimiento = 0;
    const Anexo = 1;
    const Ccp = 2;
    const Servicio = 3;
    const BienesPatrimoniales = 4;

    public static function getEstadoUitArray() {
        return
          array('0'=>'Del Requerimiento',
                '1'=>'Cotización y Elaboración del anexo 2',
                '2'=>'CCP',
                '3'=>'Orden de Compra/Servicio',
                '4'=>'Bienes Patrimoniales',);
    }
    
    public static function getEspecificEstadoUitArray($code){
        $estadouit = EEstadoUit::getEstadoUitArray();
        return $estadouit[$code];
    }

}
?>
