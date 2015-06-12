<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class EDia
{
    const Lunes = 1;
    const Martes = 2;
    const Miercoles = 3;
    const Jueves = 4;
    const Viernes = 5;
    const Sabado = 6;
    const Domingo = 7;
    
    public static function getDiasArray() {
        return 
            array('1' => 'Lunes',
                  '2' => 'Martes',
                  '3' => 'Miercoles',
                  '4' => 'Jueves',
                  '5' => 'Viernes',
                  '6' => 'Sabado',
                  '7' => 'Domingo',                  
                  );
    }   
    
    /*
     * Días por defecto Lunes
     */
    public static function getSpecificDay($day = '1')
    {
        $dias = EDias::getDiasArray();
        return $dias[$day];
    }
}



?>

