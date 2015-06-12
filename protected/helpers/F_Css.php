<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class F_Css {

    public static function getBootstrapColorNamebyCode($code){
        switch($code)
        {
            case '1' : $code = 'important';break;
            case '2' : $code = 'warning';break;
            case '3' : $code = 'default';break;
            case '4' : $code = 'info';break;
            case '5' : $code = 'success';break;
        }
        return $code;
    }
    
    public static function getPrioridadLabel($prioridad) {
        switch($prioridad)
        {
            case '1' : return '<span class="label label-important">Muy alta</span>';
            case '2' : return '<span class="label label-warning">Alta</span>';
            case '3' : return '<span class="label">Normal</span>';
            case '4' : return '<span class="label label-info">Baja</span>';
            case '5' : return '<span class="label label-success">Muy Baja</span>';
            default  : return '#error#';
        }
    }
}
?>
