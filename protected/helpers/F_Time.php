<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class F_Time {

    public static function setToMYSQLDate($stringfecha, $formato = null) {
        if ($stringfecha != '') {
            if ($formato == null) { $formato = 'd/m/Y'; }

            $value = split('/', $stringfecha);
            $value = $value['2'] . '-' . $value['1'] . '-' . $value['0'];
            return date('Y-m-d', strtotime($value));
        }
        return null;
    }

    public static function getFromMYSQLDate($stringfecha,$formatooutput = null){
        if($stringfecha!=''){
        if($formatooutput == null ) { $formatooutput= 'd/m/Y';}
        
        $fhour = split(' ',$stringfecha);
        return date($formatooutput,strtotime($fhour[0]));
        }
        return null;
    }
    
    public static function addSecondsToDate($amountAdded = 1){
        return date('Y-m-d H:i:s',time()+$amountAdded);
    }
    
    public static function setToDate($stringfecha, $formatooutput='Y-m-d', $separator = '/', $yearposition = 2, $monthposition=1, $dayposition = 0) {
        if ($stringfecha != '') {
            $value = split($separator, $stringfecha);
            $value = $value[$yearposition] . '-' . $value[$monthposition] . '-' . $value[$dayposition];
            return date($formatooutput, strtotime($value));
        }
        return null;
    }
}
?>
