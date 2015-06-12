<?php

class DefaultController extends SolicitudController
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
                'actions'=>array('save','create'),
                'users'=>array('@'),
            ),
            /*array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('admin','delete'),
                'users'=>array('admin'),
            ),*/
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }
    
    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {        
        if(isset($_GET['sid'])){
            
            $sid = $_GET['sid'];
        
            $solicitud = $this->loadSolicitudModel($sid);
            $tramite = new Tramite();
            $tramite->fk_solicitud = $sid;
        }
        
        if (isset($_POST['Tramite'])) {
            try {
                $transaction = Yii::app()->db->beginTransaction();
                
                $tramite = new Tramite();
                $tramite->attributes = $_POST['Tramite'];
                Tramite::clearVigentes($tramite->fk_solicitud); // limpio los vigentes
                
                if ($tramite->_opcion_allow == 1) { // indico si escogio la opcion de permitir que otro continue con esto
                    // primero registro lo que hizo el usuario
                    $tramite->fk_movimiento = EMovimiento::gen_actualizó;
                    $tramite->nom_destinatario = Persona::getPersonaByReg($tramite->cod_destinatario)->fullname;
                    // cargo la info del mail
                    $body = F_MailBody::BodyActividadObservacionGenerado($tramite->nom_destinatario, Yii::app()->user->getUserFullName(), $solicitud->customcod, $tramite->des_observacion);
                    
                } else if ($tramite->_opcion_save == 1) {  // Si se va a dar de baja
                    $tramite->fk_movimiento = EMovimiento::gen_finalizaatencion;
                    $tramite->cod_destinatario = $solicitud->des_reg_solicitante;
                    $tramite->nom_destinatario = $solicitud->des_nom_solicitante;
                    $solicitud->cod_estado = EEstadoSolicitud::Atendido;
                    //cargo la info del mail
                    $body = F_MailBody::BodyAtencionTermino($tramite->nom_destinatario, Yii::app()->user->getUserFullName(), $solicitud->customcod, $tramite->des_observacion);
                    
                } else {
                    // se graba este paso pero puede continuar atendiendo con otros formularios
                    $tramite->fk_movimiento = EMovimiento::gen_actualizó;
                    $tramite->cod_destinatario = Yii::app()->user->getUserReg();
                    $tramite->nom_destinatario = Yii::app()->user->getUserFullName();
                }
                $tramite->cod_remitente = Yii::app()->user->getUserReg();
                $tramite->nom_remitente = Yii::app()->user->getUserFullName();
                $tramite->es_vigente = ETramiteVigente::si;
                
                if ($tramite->save() && $solicitud->save()) {
                    F_Mail::sendMailAsPFernand('Actualización de Atención', $body, ETarea::SolicitudesRealizadas, array(Persona::getPersonaByReg($tramite->cod_destinatario)->nom_correo));
                    $isError = false; 
                }
                
                $this->setTransaction($isError, $transaction);
                $this->setAtencionMessage($tramite); 
                
            } catch (Exception $e) {
                $isError = $this->setException($e, $transaction);
            }
        }
        
        $this->render('formdefault', array('tramite' => $tramite,'solicitud'=>$solicitud));
    }
    
    private function setAtencionMessage($tramite) {
        if ($tramite->_opcion_save == 1) {
            // muestra el mensaje en el caso que se de alta la solicitud
            $this->setFlashSuccess('Se dio termino a la atención de la solicitud.');
            $this->redirect(Yii::app()->createUrl("atencion/solicitud/atender"));
        } else if ($tramite->_opcion_allow == 1) {
            // muestra el mensaje en el caso que se complete el formulario y se asigne a otra persona
            $this->setFlashSuccess('Se registro el formulario y se envio un correo a la persona asignada.');
            $this->redirect(Yii::app()->createUrl("atencion/solicitud/atender"));
        } else {
            // carga la misma solicitud en caso de no derivar a nadie y solo 'generar' el evento
            $this->setFlashSuccess('Se registro el formulario.');
        }
    }

}
?>