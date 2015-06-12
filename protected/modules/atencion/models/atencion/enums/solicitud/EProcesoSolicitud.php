<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class EProcesoSolicitud {

    const simple = 1;
    const uit = 2;

    public static function getProcesoArray() {
        return
            array('1' => 'Simple',
                  '2' => 'Uit',);
    }

}
?>
