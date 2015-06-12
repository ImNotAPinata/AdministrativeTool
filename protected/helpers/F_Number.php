<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class F_Number
{
    public static function FormatoNumeroDecimal($number, $decimales = 2, $separador = '.', $separadorMiles = ',') {
        return number_format((float) $number, $decimales, $separador, $separadorMiles);
    }
    
    public static function RemoveFormatoNumero($number, $separadorMiles = ',')
    {
        $number = str_replace($separadorMiles,'', $number);
        return $number;
    }
    
    
}

?>
