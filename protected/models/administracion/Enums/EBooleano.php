<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class EBooleano
{
    const no = 0;
    const si = 1;
    
    public static function getBooleanoArray() {
        return 
            array('0' => 'No',
                  '1' => 'Si',);
    }        
    
    public static function getBooleanobyCode($id) {
        if ($id == '0') {
            return 'No';
        } else {
            return 'Si';
        }
    }
   
}
?>
