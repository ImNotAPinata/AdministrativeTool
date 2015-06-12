<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class EEstadoSolicitud
{
    const Registrado=1;
    const EnAtención=2;
    const Atendido=3;
    const NoSeAtendió=4;
    const Rechazado=5;
    const AModificar=6;
    const Modificado=7;
    
    public static function getEstadoSolicitudArray() {
        return 
          array('1' => 'Registrado',
                '2' => 'En atención',
                '3' => 'Atendido',
                '4' => 'No se atendió',
                '5' => 'Rechazado',
                '6' => 'A modificar',
                '7' => 'Modificado');
    }
    
    public static function getEstadoSolicitudAprobadoArray() {
        return 
          array('1' => 'Registrado',
                '7' => 'Modificado');
    }
    
    public static function getEstadoFromSolicitudArray($code) {
         $array = array('1' => 'Registrado',
                '2' => 'En atención',
                '3' => 'Atendido',
                '4' => 'No se atendió',
                '5' => 'Rechazado',
                '6' => 'A modificar',
                '7' => 'Modificado');
         return $array[$code];
    }
}
?>
