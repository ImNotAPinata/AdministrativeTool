<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class EMes
{
    const Enero = 1;
    const Febrero = 2;
    const Marzo = 3;
    const Abril = 4;
    const Mayo = 5;
    const Junio = 6;
    const Julio = 7;
    const Agosto = 8;
    const Septiembre = 9;
    const Octubre = 10;
    const Noviembre = 11;
    const Diciembre = 12;
    
    public static function getMesArray() {
        return 
            array('1' => 'Enero',
                  '2' => 'Febrero',
                  '3' => 'Marzo',
                  '4' => 'Abril',
                  '5' => 'Mayo',
                  '6' => 'Junio',
                  '7' => 'Julio',
                  '8' => 'Agosto',
                  '9' => 'Septiembre',
                  '10' => 'Octubre',
                  '11' => 'Noviembre',
                  '12' => 'Diciembre',
                  );
    }
    
    /*
     * Días por defecto Enero
     */
    public static function getSpecificMes($mes = '1')
    {
        $años = EMes::getAñosArray();
        return $años[$mes];
    }
}
?>
