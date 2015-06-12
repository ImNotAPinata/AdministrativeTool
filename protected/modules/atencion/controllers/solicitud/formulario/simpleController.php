<?php 

class simpleController extends SolicitudController
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
                'actions'=>array('create','update'),
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
     * Create & update
     */
    public function actionCreate() {

        $solicitud = new Solicitud();
        $solicitud->fk_proceso = EProcesoSolicitud::simple;
        $tramite = new Tramite();
        
        if (isset($_POST['Solicitud'])) {
            $solicitud->attributes = $_POST['Solicitud'];
            $transaction = Yii::app()->db->beginTransaction();

            try {
                $isError = true;
                
                if(isset($_POST['Tramite'])){ 
                    $solicitud->cod_estado = EEstadoSolicitud::EnAtención; 
                    $solicitud->cod_prioridad = $_POST['Tramite']['prioridad'];
                } else { $solicitud->cod_estado = EEstadoSolicitud::Registrado; }
                
                $solicitud->cod_solicitud = Solicitud::getSolicitudCode();
                $solicitud->des_nom_solicitante = Yii::app()->user->getUserFullName();
                $solicitud->des_reg_solicitante = Yii::app()->user->getUserReg();
                $solicitud->des_area_solicitante = Yii::app()->user->getUserArea();
                //$model = $solicitud->attributes; en caso de que se quiera ver los atributos de los modelos por xdebug
                if ($solicitud->save()) {
                    
                    $jefe = Persona::getJefeByUuoo();
                    
                    $tramite->des_observacion = $solicitud->des_descripcion;
                    $tramite->fk_solicitud = $solicitud->pk_solicitud;
                    $tramite->fk_movimiento = EMovimiento::gen_registro;
                    $tramite->cod_remitente = Yii::app()->user->getUserReg();
                    $tramite->nom_remitente = Yii::app()->user->getUserFullName();
                    $tramite->cod_destinatario = $jefe->num_registro;
                    $tramite->nom_destinatario = $jefe->FullName;
                    $tramite->es_vigente = EBooleano::si;
                    
                    if(isset($_POST['Tramite'])){ // esto en el caso que sea el jefe el que haga el pedido
                         if($_POST['Tramite']['cod_destinatario']!= ''){
                            $tramite->attributes = $_POST['Tramite'];
                            $persona = Persona::getPersonaByReg($tramite->cod_destinatario);
                            $tramite->nom_destinatario = $persona->fullname;
                            $tramite->es_vigente = ETramiteVigente::si;
                         }
                    }
                    
                    if ($tramite->save()) {
                        //envio correo 
                        $body = F_MailBody::BodyProcesoSimpleGenerado($tramite->nom_destinatario, Yii::app()->user->getUserFullName(), $solicitud->customcod, $solicitud->des_descripcion);
                        F_Mail::sendMailAsPFernand('Solicitud de Atención', $body, ETarea::SolicitudesRealizadas, array(Persona::getPersonaByReg($tramite->cod_destinatario)->nom_correo));
                        //muestro mensaje de exito
                        $this->setFlashSuccess("Se ha creado la <strong>solicitud nro. $solicitud->customcod</strong>");
                        $isError = false;
                        
                    }
                }
                
                $this->setTransaction($isError, $transaction);
                if($isError === false) { $this->redirect(array('..\..\personal')); }
            } catch (Exception $e) {
                $this->setException($e);
                $this->setFlashError(Yii::App()->params->defaultErrorMessage);
            }
        }
        
        //renderizar
        $this->render('create', array('solicitud' => $solicitud,'tramite'=>$tramite));
    }
    
    public function actionUpdate($id)
    {
        $solicitud = $this->loadSolicitudModel($id);
        $tramite = new Tramite();
        
        if (isset($_POST['Solicitud'])) {
            $transaction = Yii::app()->db->beginTransaction();
            $solicitud->attributes = $_POST['Solicitud'];

            try {
                $solicitud->cod_estado = Solicitud::checkIfSolicitudHaveAtencion($solicitud->pk_solicitud, EEstadoSolicitud::EnAtención);  // indicamos que regreso para que entre de nuevo a atención
                if ($solicitud->save()) {
                    $tramite->des_observacion = $solicitud->des_descripcion;
                    $tramite->fk_solicitud = $solicitud->pk_solicitud;
                    $tramite->fk_movimiento = EMovimiento::gen_modifico;
                    $tramite->cod_remitente = Yii::app()->user->getUserReg();
                    $tramite->nom_remitente = Yii::app()->user->getUserFullName();

                    $ultimotramite = Tramite::getUltimoRemitente($solicitud->pk_solicitud);
                    $tramite->cod_destinatario = $ultimotramite['cod_remitente'];
                    $tramite->nom_destinatario = $ultimotramite['nom_remitente'];
                    Tramite::clearVigentes($tramite->fk_solicitud);
                    $tramite->es_vigente = EBooleano::si;
                    
                    if ($tramite->save()) {
                        //envio correo
                        $body = F_MailBody::BodyProcesoSimpleGenerado($tramite->nom_destinatario, Yii::app()->user->getUserFullName(), $solicitud->customcod, $solicitud->des_descripcion,true);
                        F_Mail::sendMailAsPFernand('Actualización de Solicitud', $body, ETarea::SolicitudesRealizadas, array(Persona::getPersonaByReg($tramite->cod_destinatario)->nom_correo));  
                        //muestro mensaje de exito
                        $this->setFlashSuccess("Se ha actualizado la <strong>solicitud nro. $solicitud->customcod</strong>");
                        $isError = false;
                    }
                }
                $this->setTransaction($isError, $transaction);
                if($isError === false) { $this->redirect(array('..\..\personal')); }
            } catch (Exception $e) {
                $this->setException($e);
                $this->setFlashError(Yii::App()->params->defaultErrorMessage);
            }
        }
        
        //renderizar
        $this->render('update', array('solicitud' => $solicitud,'tramite'=>$tramite));
    }
}   
?>