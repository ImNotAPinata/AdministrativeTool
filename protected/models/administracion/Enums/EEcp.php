<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class EEcp {

    const bases = 1;
    
    
    public static function getEcpArray() {
        $eecp = array(
            '1'  => 'Bases',
        );
        return $eecp;
    }
    
    public static function getSpecificEcp($code) {
        $eecp = EECP::getEcpArray();
        return $eecp[$code];
    }

}

?>
