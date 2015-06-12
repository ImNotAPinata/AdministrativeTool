<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class EMovimiento
{
    const gen_registro = 1;
    const gen_aprobadodesignado = 2;
    const gen_devolucion = 3;
    const gen_rechazo = 4;
    const gen_modifico = 5;
    const gen_noseatendio = 6;
    const gen_finalizaatencion = 7;
    const gen_aprobadoatencion = 8;
    const gen_actualizó = 9;
    
    const uit_registro = 10;
    
    public static function getMovimientosPendientes() {
        return 
            array('1' => 'Registro',
                  '2' => 'Aprobado & designado',
                  '3' => 'Devolución',
                  '5' => 'Modificó',
                  '8' => 'Aprueba & atiende',
                  '9' => 'Actualizó',
                 '10' => 'Registro req. <3 UIT',
                );
    }
}
?>
