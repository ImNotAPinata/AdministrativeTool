<?php

class AprobarController extends SolicitudController
{
    /**
     * @return array action filters
     */
    //public $layout='/layouts/column1'; 
    
    
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('Index'),
                'users'=>array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('aprobar','rechazar','modificar','atender'),
                'users'=>array(Yii::app()->params->currentWebMaster,Yii::app()->params->currentJefeAdministracion), // solo percy y el administrador de ahi se podria hacer consulta para traer a todos los jefes autorizados, etc.
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }
    
    /**
     * Default siempre es INDEX
     */
    public function actionIndex()
    {
        $solicitud = new Solicitud('search');
        $tramite = new Tramite();
        
        $tramite->prioridad = Yii::app()->params->defaultPrioridad;
        $personal = Persona::getPersonalByUuoo();
            
        $solicitud->unsetAttributes();  // clear any default values
        if (isset($_GET['Solicitud'])) {
            $solicitud->attributes = $_GET['Solicitud'];
        }
        
        if (isset($_GET['pageSize'])) {
            Yii::app()->user->setState('pageSize', (int) $_GET['pageSize']);
            unset($_GET['pageSize']);
        } else {
            Yii::app()->user->setState('pageSize', Yii::app()->params['defaultPageSize']);
        }
        
        $this->render('index', array('solicitud' => $solicitud, 'tramite' => $tramite,'personal' => $personal));
    }
    /*
     * Esta funcion es medio pendeja porque el jefe toma el rol de usuario por lo que el se estaria diciendo
     * Yo lo apruebo, Yo lo atiendo
     */
    public function actionAtender()
    {
        if (isset($_POST['Tramite'])) {
            
            $selectedSolicitudes = $_POST['Tramite']['selected'];
            $prioridad = $_POST['Tramite']['prioridad'];
            $Solicitudes = explode(',', $selectedSolicitudes);
            $transaction = Yii::app()->db->beginTransaction();

            try{
                
                foreach($Solicitudes as $pksolicitud) // xcada solicitud en el registro
                {
                    $tramite = new Tramite();
                    $tramite->attributes = $_POST['Tramite'];
                    $tramite->fk_solicitud = $pksolicitud;
                    $tramite->cod_remitente = Yii::app()->user->getUserReg();
                    $tramite->nom_remitente = Yii::app()->user->getUserFullName();
                    $tramite->fk_movimiento = EMovimiento::gen_aprobadoatencion;
                    $tramite->cod_destinatario = Yii::app()->user->getUserReg();
                    $tramite->nom_destinatario = Yii::app()->user->getUserFullName();
                    
                    Tramite::clearVigentes($pksolicitud);
                    $tramite->es_vigente = true;

                    $solicitud = $this->loadSolicitudModel($pksolicitud);
                    $solicitud->cod_estado = EEstadoSolicitud::EnAtención;
                    $solicitud->cod_prioridad = $prioridad;
                    
                    if ($tramite->save() && $solicitud->save()) {
                            $isError = false;
                    } else { $this->setErrorInfo($solicitud->getErrors()." || ".$tramite->getErrors()); }
                }
                $this->setTransaction($isError, $transaction);
            } catch (Exception $e) {
               $isError = $this->setException($e, $transaction);
            }
            
            if ($isError === false) {
                $op = array('operacion' => 'success');
            } else {
                $op = array('operacion' => 'error');
                $this->setFlashError(Yii::App()->params->defaultErrorMessage);
            }

            $json = json_encode($op);
            echo $json;
        }
    }
    
    public function actionAprobar()
    {
        if (isset($_POST['Tramite'])) {
            
            $selectedSolicitudes = $_POST['Tramite']['selected'];
            $prioridad = $_POST['Tramite']['prioridad'];
            $Solicitudes = explode(',', $selectedSolicitudes);
            $transaction = Yii::app()->db->beginTransaction();

            try{
                
                foreach($Solicitudes as $pksolicitud) // xcada solicitud en el registro
                {
                    $tramite = new Tramite();
                    $tramite->attributes = $_POST['Tramite'];
                    $tramite->fk_solicitud = $pksolicitud;
                    $tramite->cod_remitente = Yii::app()->user->getUserReg();
                    $tramite->nom_remitente = Yii::app()->user->getUserFullName();
                    $persona = Persona::getPersonaByReg($tramite->cod_destinatario);
                    $tramite->nom_destinatario = $persona->fullname;
                    $tramite->fk_movimiento = EMovimiento::gen_aprobadodesignado;
                    
                    Tramite::clearVigentes($pksolicitud);
                    $tramite->es_vigente = true;
                    
                    $solicitud = $this->loadSolicitudModel($pksolicitud);
                    $solicitud->cod_estado = EEstadoSolicitud::EnAtención;
                    $solicitud->cod_prioridad = $prioridad;
                    
                    if ($tramite->save() && $solicitud->save()) {
                        
                        $body = F_MailBody::BodyPedidoAprobado($solicitud->des_nom_solicitante, Yii::app()->user->getUserFullName(), $solicitud->customcod);
                        F_Mail::sendMailAsPFernand('Aprobación de Solicitud', $body, ETarea::SolicitudesRealizadas, array(Persona::getPersonaByReg($solicitud->des_reg_solicitante)->nom_correo));
                        $body = F_MailBody::BodyPedidoAsignado($tramite->nom_destinatario, Yii::app()->user->getUserFullName(), $solicitud->customcod,$tramite->des_observacion);
                        F_Mail::sendMailAsPFernand('Asignación de Solicitud', $body, ETarea::SolicitudesRealizadas, array(Persona::getPersonaByReg($tramite->cod_destinatario)->nom_correo));
                        
                        $this->setFlashSuccess('Las solicitudes se aprobaron e asignaron correctamente.'); 
                        $isError = false;
                    } else { $this->setErrorInfo($tramite->getErrors()." || ".$solicitud->getErrors()); }
                }
                $this->setTransaction($isError, $transaction);
            } catch (Exception $e) {
               $isError = $this->setException($e, $transaction);
            }
            
            if ($isError === false) {
                $op = array('operacion' => 'success');
            } else {
                $op = array('operacion' => 'error');
                $this->setFlashError(Yii::App()->params->defaultErrorMessage);
            }
            
            $json = json_encode($op);
            echo $json;
        }
    }
    
    public function actionRechazar()
    {
        if (isset($_POST['Tramite'])) {
            $selectedSolicitudes = $_POST['Tramite']['selected'];
            $Solicitudes = explode(',', $selectedSolicitudes);
            $transaction = Yii::app()->db->beginTransaction();
                
            try{
                foreach($Solicitudes as $pksolicitud) // xcada solicitud en el registro
                {
                    $tramite = new Tramite();
                    $tramite->attributes = $_POST['Tramite']; 
                    $tramite->fk_solicitud = $pksolicitud;
                    $tramite->cod_remitente = Yii::app()->user->getUserReg();
                    $tramite->nom_remitente = Yii::app()->user->getUserFullName();
                    $tramite->fk_movimiento = EMovimiento::gen_rechazo;
                    
                    $solicitud = $this->loadSolicitudModel($pksolicitud);
                    $solicitud->cod_estado = EEstadoSolicitud::Rechazado;
                    
                    $tramite->cod_destinatario = $solicitud->des_reg_solicitante;
                    $tramite->nom_destinatario = $solicitud->des_nom_solicitante;
                    
                    Tramite::clearVigentes($pksolicitud);
                    $tramite->es_vigente = true;
                    
                    if ($tramite->save() && $solicitud->save()) {
                            $body = F_MailBody::BodyAtencionTermino($solicitud->des_nom_solicitante, Yii::app()->user->getUserFullName(), $solicitud->customcod,$tramite->des_observacion);
                            F_Mail::sendMailAsPFernand('Rechazó de Solicitud', $body, ETarea::SolicitudesRealizadas, array(Persona::getPersonaByReg($solicitud->des_reg_solicitante)->nom_correo));
                            
                            $isError = false;
                            $this->setFlashInfo('Solicitudes rechazadas correctamente.'); 
                    } else { $this->setErrorInfo($tramite->getErrors()." || ".$solicitud->getErrors()); }
                }
                $this->setTransaction($isError, $transaction);
            } catch (Exception $e) {
                $isError = $this->setException($e, $transaction);
            }
            
            if ($isError === false) {
                $op = array('operacion' => 'success');
            } else {
                $op = array('operacion' => 'error');
                $this->setFlashError(Yii::App()->params->defaultErrorMessage);
            }
            $json = json_encode($op);
            echo $json;
        }
    }
    
    public function actionModificar()
    {
        if (isset($_POST['Tramite'])) {
            $selectedSolicitudes = $_POST['Tramite']['selected'];
            $Solicitudes = explode(',', $selectedSolicitudes);
            
            try{
                $transaction = Yii::app()->db->beginTransaction();
                foreach($Solicitudes as $pksolicitud) // xcada solicitud en el registro
                {
                    $tramite = new Tramite();
                    $tramite->attributes = $_POST['Tramite']; 
                    $tramite->fk_solicitud = $pksolicitud;
                    $tramite->cod_remitente = Yii::app()->user->getUserReg();
                    $tramite->nom_remitente = Yii::app()->user->getUserFullName();
                    $tramite->fk_movimiento = EMovimiento::gen_devolucion;
                    
                    $solicitud = $this->loadSolicitudModel($pksolicitud);
                    $solicitud->cod_estado = EEstadoSolicitud::AModificar;
                    
                    $tramite->cod_destinatario = $solicitud->des_reg_solicitante;
                    $tramite->nom_destinatario = $solicitud->des_nom_solicitante;
                    
                    Tramite::clearVigentes($pksolicitud);
                    $tramite->es_vigente = true;
                    
                    if ($tramite->save() && $solicitud->save()) {
                            $body = F_MailBody::BodyPedidoAModificar($solicitud->des_nom_solicitante, Yii::app()->user->getUserFullName(), $solicitud->customcod,$tramite->des_observacion);
                            F_Mail::sendMailAsPFernand('Modificar Solicitud Realizada', $body, ETarea::SolicitudesRealizadas, array(Persona::getPersonaByReg($solicitud->des_reg_solicitante)->nom_correo));
                            
                            $isError = false;
                            $this->setFlashInfo('Se devolvieron las solicitudes para su modificación.'); 
                    } else { $this->setErrorInfo($tramite->getErrors()." || ".$solicitud->getErrors()); }
                }
                
                $this->setTransaction($isError, $transaction);
                
            } catch (Exception $e) {
                $isError = $this->setException($e, $transaction);
            }
            
            if ($isError === false) {
                $array = array('operacion' => 'success');
            } else {
                $array = array('operacion' => 'error');
                $this->setFlashError(Yii::App()->params->defaultErrorMessage);
            }
            $json = json_encode($array);
            echo $json;
        }
    }

}
?>