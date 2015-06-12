<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class F_Mail {

    public static function sendMailAsAdministracion($asunto, $cuerpo, $idTarea = null, $listaAddress = null, $listaCC = null) {
        //Se usan los parametros establecidos en adminweb para el envio de correos
        Yii::app()->mailer->Host = "150.56.2.1";
        Yii::app()->mailer->IsSMTP();
        Yii::app()->mailer->SMTPAuth = true;
        Yii::app()->mailer->Username = 'administruji';
        Yii::app()->mailer->Password = 'Adminis2012';
        Yii::app()->mailer->From = "PFERNAND@sunat.gob.pe";
        Yii::app()->mailer->FromName = "ADMINWEB";
        Yii::app()->mailer->WordWrap = 50;
        Yii::app()->mailer->IsHTML(true);
        Yii::app()->mailer->Subject = $asunto;
        Yii::app()->mailer->Body = $cuerpo;

        $listaAddress = F_Mail::getFinalAddress($idTarea, $listaAddress);
        $listaCC = F_Mail::getFinalCC($idTarea, $listaCC);
        
        if (is_array($listaAddress)) {
            foreach ($listaAddress as $Address) {
                Yii::app()->mailer->AddAddress($Address);
            }
        }

        if (is_array($listaCC)) {
            foreach ($listaCC as $CC) {
                Yii::app()->mailer->AddCC($CC);
            }
        }
        
        if (!Yii::app()->mailer->Send()) {
            F_MAIL::sendMailAsPFernand('Error al enviar el correo', F_MailBody::ErrorGeneradoBody(Yii::app()->mailer->ErrorInfo, $cuerpo,$listaAddress,$listaCC), null, array(Yii::app()->params->currentWebMasterMail)); 
        }
    }

    public static function sendMailAsPFernand($asunto, $cuerpo, $idTarea = null, $listaAddress = null, $listaCC = null) {
        //Se usan los parametros establecidos en adminweb para el envio de correos
        Yii::app()->mailer->Host = "150.56.2.1";
        Yii::app()->mailer->IsSMTP();
        Yii::app()->mailer->From = "PFERNAND@sunat.gob.pe";
        Yii::app()->mailer->FromName = "ADMINWEB";
        Yii::app()->mailer->WordWrap = 50;
        Yii::app()->mailer->IsHTML(true);
        Yii::app()->mailer->Subject = $asunto;
        Yii::app()->mailer->Body = $cuerpo;

        $listaAddress = F_Mail::getFinalAddress($idTarea, $listaAddress);
        $listaCC = F_Mail::getFinalCC($idTarea, $listaCC);
        
        if (is_array($listaAddress)) {
            foreach ($listaAddress as $Address) {
                Yii::app()->mailer->AddAddress($Address);
            }
        }

        if (is_array($listaCC)) {
            foreach ($listaCC as $CC) {
                Yii::app()->mailer->AddCC($CC);
            }
        }
        
        if (!Yii::app()->mailer->Send()) {
            if($asunto != 'Error al enviar el correo')
            { 
                F_MAIL::sendMailAsPFernand('Error al enviar el correo', F_MailBody::BodyErrorGenerado(Yii::app()->mailer->ErrorInfo, $cuerpo,$listaAddress,$listaCC), null, array(Yii::app()->params->currentWebMasterMail)); 
            }
        }
    }

    public static function sendMailAsOther($othermail, $othername, $asunto, $cuerpo, $idTarea = null, $listaAddress = null, $listaCC = null) {
        //Se usan los parametros establecidos en adminweb para el envio de correos
        Yii::app()->mailer->Host = "150.56.2.1";
        Yii::app()->mailer->IsSMTP();
        Yii::app()->mailer->From = $othermail; //"prac-jsanchezb@sunat.gob.pe";
        Yii::app()->mailer->FromName = $othername;
        Yii::app()->mailer->WordWrap = 50;
        Yii::app()->mailer->IsHTML(true);
        Yii::app()->mailer->Subject = $asunto;
        Yii::app()->mailer->Body = $cuerpo;

        $listaAddress = F_Mail::getFinalAddress($idTarea, $listaAddress);
        $listaCC = F_Mail::getFinalCC($idTarea, $listaCC);
        
        if (is_array($listaAddress)) {
            foreach ($listaAddress as $Address) {
                Yii::app()->mailer->AddAddress($Address);
            }
        }

        if (is_array($listaCC)) {
            foreach ($listaCC as $CC) {
                Yii::app()->mailer->AddCc($CC);
            }
        }

        if (!Yii::app()->mailer->Send()) {
            F_MAIL::sendMailAsPFernand('Error al enviar el correo', F_MailBody::BodyErrorGenerado(Yii::app()->mailer->ErrorInfo, $cuerpo,$listaAddress,$listaCC), null, array(Yii::app()->params->currentWebMasterMail)); 
        }
    }
    
    public static function getFinalAddress($idTarea, $listaAddress) {
        if ($idTarea != null) {
            if ($listaAddress == null) { $listaAddress = array(); }
            $titulares = Responsabletarea::getTitularesFromIdTarea($idTarea);
            foreach ($titulares as $titular) {
                array_push($listaAddress, $titular);
            }
        }
        return $listaAddress;
    }

    public static function getFinalCC($idTarea, $listaCC) {
        if ($idTarea != null) {
            if ($listaCC == null) { $listaCC = array(); }
            $suplentes = Responsabletarea::getSuplentesFromIdTarea($idTarea);
            foreach ($suplentes as $suplente) {
                array_push($listaCC, $suplente);
            }
        }
        return $listaCC;
    }

}

?>
