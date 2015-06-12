<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class EDB {

    const gen_proveedor = 1;
    const gen_proveedorservicio = 2;
    
    const atn_proceso = 1;
    const atn_documento = 2;
    const atn_solicitud = 3;
    const atn_registro = 4;
    const atn_tramite = 5;
    const atn_movimiento = 6;
    const atn_uit = 7;
    const atn_uitproveedor = 8;
    const atn_uitbien = 9;
    const atn_uitfactura = 10;
    
    
    public static function getGendb($code) {
        $gendb = array(
            '1' => 't000gen_proveedor',
            '2' => 't000gen_proveedorservicio',
        );

        return $gendb[$code];
    }

    public static function getAtenciondb($code) {
        $atenciondb = array(
            '1'  => 't009atn_proceso',
            '2'  => 't010atn_actividad',
            '3'  => 't011atn_solicitud',
            '4'  => 't012atn_registro',
            '5'  => 't013atn_tramite',
            '6'  => 't014atn_movimiento',
            '7'  => 't015atn_uit',
            '8'  => 't016atn_uitproveedor',
            '9'  => 't017atn_uitbien',
            '10' => 't018atn_uitfactura',
        );
        return $atenciondb[$code];
    }

}
?>

