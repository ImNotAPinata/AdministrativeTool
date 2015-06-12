<?php

class F_MailBody {

    public static function BodyProcesoSimpleGenerado($destinatario, $solicitante, $nroSolicitud, $detalle, $esActualización = false) {
        if($esActualización) { $tipoAtencion = 'actualizado'; } 
        else { $tipoAtencion = 'realizado'; }
        
        return
         "Estimado $destinatario,
         <br/><br/> 
         El presente es para informarle que $solicitante ha " . $tipoAtencion . " el siguiente pedido. 
         <br/><br/>
         <table width='300' style='margin-left: 15px' border='1'>
	    <tr>
		<th bgcolor='#d2e7c0'>Solicitud Nro. $nroSolicitud</th>
            </tr>
            <tr>
                <td bgcolor='#ccccff' align='center'>Detalle de lo solicitiado</td>
            </tr>
            <tr>
                <td bgcolor='#eef0f0' align='left'>" . $detalle . "</td>
             </tr>
         </table>
         " . F_MailBody::BodyFooter('Atención->Solicitud->Aprobar Solicitudes');
    }
    public static function BodyProcesoUitGenerado($destinatario, $solicitante, $nroSolicitud, $detalle, $nrosiged, $fechasiged, $esActualización = false) {
        if($esActualización) { $tipoAtencion = 'actualizado'; } 
        else { $tipoAtencion = 'realizado'; }
        
        return
         "Estimado $destinatario,
         <br/><br/> 
         El presente es para informarle que $solicitante ha " . $tipoAtencion . " el siguiente pedido. 
         <br/><br/>
         <table width='300' style='margin-left: 15px' border='1'>
	    <tr>
		<th bgcolor='#d2e7c0' colspan='3'>Solicitud Nro. $nroSolicitud</th>
            </tr>
            <tr>
                <td bgcolor='#ccccff' align='center'>Detalle de lo solicitiado</td>
                <td bgcolor='#ccccff' align='center'>Nro. de Siged</td>
                <td bgcolor='#ccccff' align='center'>Fecha de Siged</td>
            </tr>
            <tr>
                <td bgcolor='#eef0f0' align='left'>" . $detalle . "</td>
                <td bgcolor='#eef0f0' align='left'>" . $nrosiged . "</td>
                <td bgcolor='#eef0f0' align='left'>" . $fechasiged . "</td>
             </tr>
         </table>
         " . F_MailBody::BodyFooter('Atención->Solicitud->Aprobar Solicitudes');
    }
    
    public static function BodyActividadObservacionGenerado($destinatario, $remitente, $nroSolicitud, $observacion ) {
        return
         "Estimado $destinatario,
         <br/><br/> 
         El presente es para informarle que $remitente ha hecho una observación y le ha asignado la solicitud <b>Nro. $nroSolicitud</b>. 
         ".F_MailBody::BodyHaveObservacion($observacion) . F_MailBody::BodyFooter('Atención->Solicitud->Atender Solicitudes');
    }
    public static function BodyActividadUitGenerado($destinatario, $remitente, $nroSolicitud, $observacion ) {
        return
         "Estimado $destinatario,
         <br/><br/> 
         El presente es para informarle que $remitente ha actualizado la información del registro de UIT de la solicitud <b>Nro. $nroSolicitud</b> y le ha asignado su continuación. 
         ".F_MailBody::BodyHaveObservacion($observacion) . F_MailBody::BodyFooter('Atención->Solicitud->Atender Solicitudes');
    }
    
    public static function BodyAtencionTermino($destinatario, $remitente, $nroSolicitud,$observacion) {
        
        
        return
         "Estimado $destinatario,
         <br/><br/> 
         El presente es para informarle que $remitente ha dado por termino la atención de la solicitud <b>Nro. $nroSolicitud</b>.
         ".F_MailBody::BodyHaveObservacion($observacion) . F_MailBody::BodyFooter('Atención->Solicitud->Aprobar Solicitudes');
    }

    public static function BodyPedidoAprobado($solicitante, $jefe, $nroSolicitud) {
        return
         "Estimado $solicitante,
         <br/><br/> 
         El presente es para informarle que $jefe ha aprobado su pedido <b>Nro. $nroSolicitud</b>. 
         <br/><br/>
         Puede hacer seguimiento haciendo clic en el icono <0> para ver los movimientos que su solicitud ha generado.
         ". F_MailBody::BodySimpleFooter();
    }
    public static function BodyPedidoAsignado($destinatario, $asignador, $nroSolicitud,$observacion) {
        return
         "Estimado $destinatario,
         <br/><br/> 
         El presente es para comunicarle que $asignador, le ha asignado la solicitud <b>Nro. $nroSolicitud</b>.
         ".F_MailBody::BodyHaveObservacion($observacion).F_MailBody::BodyFooterAtencion('Atención->Solicitud->Atender Solicitudes');
    }
    public static function BodyPedidoRechazado($destinatario, $asignador, $nroSolicitud,$observacion) {
        return
         "Estimado $destinatario,
         <br/><br/> 
         El presente es para comunicarle que $asignador, acaba de rechazar la solicitud <b>Nro. $nroSolicitud</b>.  
         ".F_MailBody::BodyHaveObservacion($observacion). F_MailBody::BodySimpleFooter();
    }
    public static function BodyPedidoAModificar($destinatario, $asignador, $nroSolicitud, $observacion) {
        return
         "Estimado $destinatario,
         <br/><br/> 
         El presente es para comunicarle que $asignador, le ha solicitado que modifique el contenido de la solicitud <b>Nro. $nroSolicitud</b>.  
         ".F_MailBody::BodyHaveObservacion($observacion). F_MailBody::BodyFooter('Atención->Solicitud->Mis Solicitudes');
    }

    public static function BodyErrorGenerado($error, $body,$listaAddress,$listaCC) {
        foreach($listaAddress as $id=>$titular)
        {
            if($id == 0) { $titulares .= $titular; }
            else { $titulares .= " | ".$titular; }
        }
        
        foreach($listaCC as $idx=>$suplente)
        {
            if($idx == 0) { $suplentes .= $suplente; }
            else { $suplentes .= " | ".$suplente; }
        }
        
        $content =
         "Se encontro un error al enviar el mensaje. 
         <br/><br/>
         Detalle del Error: '<b>" . $error . "</b>'
         <br/><br/>
         El mensaje original fue:
         <br/><br/>" . $body."
         <br/><br/><br/>
         Titulares: $titulares <br/>
         Suplentes: $suplentes";
        
        return $content;
    }
    
    //Funciones de Soporte a los cuerpos de correo generados
    private static function BodyFooter($ruta) {
        return
         "<br/><br/>
         Para realizar la revisión respectiva puede acceder al sgte. link: <a href='" . Yii::app()->params->defaultWebLocation . "'>Aplicativo de Atención</a>, accediendo a $ruta.
         <br/><br/>
         Atte.<br/>
         Oficina de Administración y Almacén";
    }
    private static function BodyFooterAtencion($ruta) {
        return
         "<br/><br/>
         Seguir y proceder. Para acceder al sistema, hacer clic en el sgte. link: <a href='" . Yii::app()->params->defaultWebLocation . "'>Aplicativo de Atención</a>, accediendo a $ruta.
         <br/><br/>
         Atte.<br/>
         Oficina de Administración y Almacén";
    }
    private static function BodySimpleFooter() {
        return
         "<br/><br/>
         Atte.<br/>
         Oficina de Administración y Almacén";
    }
    private static function BodyHaveObservacion($observacion) {
        if ($observacion != '') {
            return
                    "<br/><br/>
         <table width='300' style='margin-left: 15px' border='1'>
	    <tr>
		<th bgcolor='#d2e7c0' align='center'>Observación</th>
            </tr>
            <tr>
                <td bgcolor='#eef0f0' align='left'>" . $observacion . "</td>
             </tr>
         </table>";
        } else { return ""; }
    }

}
?>