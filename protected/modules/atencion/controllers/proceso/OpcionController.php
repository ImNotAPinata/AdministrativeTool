<?php

class OpcionController extends SolicitudController
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
                'actions'=>array('devolver','rechazar'),
                'users'=>Yii::app()->user->puedenAtender(),
            ),
            /*array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('formulario'),
                'users'=>array('admin'),
            ),*/
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }
    
    public function actionRechazar() {
        if (isset($_POST['Tramite'])) {
            $transaction = Yii::app()->db->beginTransaction();

            try {

                $tramite = new Tramite();
                $tramite->attributes = $_POST['Tramite'];
                $tramite->cod_remitente = Yii::app()->user->getUserReg();
                $tramite->nom_remitente = Yii::app()->user->getUserFullName();
                $tramite->fk_movimiento = EMovimiento::gen_rechazo;
                
                $solicitud = $this->loadSolicitudModel($tramite->fk_solicitud);
                $solicitud->cod_estado = EEstadoSolicitud::Rechazado;

                $tramite->cod_destinatario = $solicitud->des_reg_solicitante;
                $tramite->nom_destinatario = $solicitud->des_nom_solicitante;

                if ($tramite->save() && $solicitud->save()) {
                    $isError = false;
                }

                $this->setTransaction($isError, $transaction);
            } catch (Exception $e) {
                $isError = $this->setException($e, $transaction);
            }

            if ($isError === false) {
                $op = array('operacion' => 'success');
                $this->setFlashInfo('Se rechazo la solicitud.');
            } else {
                $op = array('operacion' => 'error');
                $this->setFlashError(Yii::App()->params->defaultErrorMessage);
            }
            $json = json_encode($op);
            echo $json;
        }
    }
    
    public function actionDevolver() {
        if (isset($_POST['Tramite'])) {
            $transaction = Yii::app()->db->beginTransaction();

            try {
                $tramite = new Tramite();
                $tramite->attributes = $_POST['Tramite'];
                $tramite->cod_remitente = Yii::app()->user->getUserReg();
                $tramite->nom_remitente = Yii::app()->user->getUserFullName();
                $tramite->fk_movimiento = EMovimiento::gen_devolucion;
                
                $solicitud = $this->loadSolicitudModel($tramite->fk_solicitud);                
                $solicitud->cod_estado = EEstadoSolicitud::AModificar;
                
                $tramite->cod_destinatario = $solicitud->des_reg_solicitante;
                $tramite->nom_destinatario = $solicitud->des_nom_solicitante;

                if ($tramite->save() && $solicitud->save()) {
                    $isError = false;
                }
               
                $this->setTransaction($isError, $transaction);
            } catch (Exception $e) {
                $isError = $this->setException($e, $transaction);
            }
            
            if ($isError === false) {
                $array = array('operacion' => 'success');
                $this->setFlashInfo('Se devolvieron las solicitudes para su modificación.');
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


