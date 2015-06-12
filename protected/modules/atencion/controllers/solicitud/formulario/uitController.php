<?php 

class uitController extends SolicitudController
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
                'users'=>array(Yii::app()->user->getUserInterno()),
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
        $solicitud->fk_proceso = EProcesoSolicitud::uit;
        $uit = new Uit();
        $tramite = new Tramite();
        $persona = new Persona();
        
        $persona->unsetAttributes();
        if (isset($_GET['Persona'])) {
            $persona->attributes = $_GET['Persona'];
        }
        // verifico si estan haciendo un post de la solicitud
        if (isset($_POST['Solicitud']) && isset($_POST['Uit'])) {
            $transaction = Yii::app()->db->beginTransaction();
            $solicitud->attributes = $_POST['Solicitud'];
            $uit->attributes = $_POST['Uit'];

            try {
                $isError = true;
                
                if(isset($_POST['Tramite'])){ 
                    $solicitud->cod_estado = EEstadoSolicitud::EnAtención; 
                    $solicitud->cod_prioridad = $_POST['Tramite']['prioridad'];
                } else { $solicitud->cod_estado = EEstadoSolicitud::Registrado; }
                //$solicitud->cod_estado = EEstadoSolicitud::Registrado;
                $solicitud->cod_solicitud = Solicitud::getSolicitudCode();
                $solicitud->des_nom_solicitante = Yii::app()->user->getUserFullName();
                $solicitud->des_reg_solicitante = Yii::app()->user->getUserReg();
                $solicitud->des_area_solicitante = Yii::app()->user->getUserArea();

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
                    
                    $uit->cod_uit_estado = EEstadoUit::Requerimiento; 
                    $uit->cod_uit_generado = UIT::getUitCode();
                    
                    if(isset($_POST['Tramite'])){ // esto en el caso que sea el jefe el que haga el pedido
                         if($_POST['Tramite']['cod_destinatario']!= ''){
                            $tramite->attributes = $_POST['Tramite'];
                            $persona = Persona::getPersonaByReg($tramite->cod_destinatario);
                            $tramite->nom_destinatario = $persona->fullname;
                            $tramite->es_vigente = ETramiteVigente::si;
                         }
                    }
                    
                    if ($tramite->save() && $uit->save()) {
                            $saved = $this->setRegistro($solicitud->pk_solicitud, EActividad::Menor_3_UIT, $uit->pk_uit, 'uit');
                            if ($saved) {
                                //envio correo 
                                $body = F_MailBody::BodyProcesoUitGenerado($tramite->nom_destinatario, Yii::app()->user->getUserFullName(), $solicitud->customcod, $solicitud->des_descripcion,$uit->num_uit_siged,$uit->fec_uit_siged);
                                F_Mail::sendMailAsPFernand('Solicitud de Atención', $body, ETarea::SolicitudesRealizadas, array(Persona::getPersonaByReg($tramite->cod_destinatario)->nom_correo));  
                                //muestro mensaje de exito
                                $this->setFlashSuccess("Se ha creado la <strong>solicitud nro. $solicitud->customcod</strong>");
                                $isError = false;
                            }
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
        $this->render('create', array('solicitud' => $solicitud, 'uit' => $uit, 'persona' => $persona,'tramite'=>$tramite));
    }
    
    public function actionUpdate($id)
    {
        $solicitud = $this->loadSolicitudModel($id);
        $cod = Registro::searchSpecificActividadinSolcitud($id, EActividad::Menor_3_UIT);
        $uit = $this->loadUitModel($cod);
        
        $persona = new Persona();
        $persona->unsetAttributes();
        if (isset($_GET['Persona'])) {
            $persona->attributes = $_GET['Persona'];
        }
        
        if (isset($_POST['Uit'])) {
            $transaction = Yii::app()->db->beginTransaction();
            $solicitud->cod_estado = Solicitud::checkIfSolicitudHaveAtencion($solicitud->pk_solicitud);  // indicamos que regreso para que entre de nuevo a atención
            $uit->attributes = $_POST['Uit'];
            
            try {
                if ($solicitud->save()) {
                    $tramite = new Tramite();
                    $tramite->des_observacion = $solicitud->des_descripcion;
                    $tramite->fk_solicitud = $solicitud->pk_solicitud;
                    $tramite->cod_remitente = Yii::app()->user->getUserReg();
                    $tramite->nom_remitente = Yii::app()->user->getUserFullName();
                    $tramite->fk_movimiento = EMovimiento::gen_modifico;
                    
                    $ultimotramite = Tramite::getUltimoRemitente($solicitud->pk_solicitud);
                    $tramite->cod_destinatario = $ultimotramite['cod_remitente'];
                    $tramite->nom_destinatario = $ultimotramite['nom_remitente'];
                    Tramite::clearVigentes($tramite->fk_solicitud);
                    $tramite->es_vigente = EBooleano::si;

                    if ($tramite->save() && $uit->save()) {
                           //muestro mensaje de exito y envio correo
                           $body = F_MailBody::BodyProcesoUitGenerado($tramite->nom_destinatario, Yii::app()->user->getUserFullName(), $solicitud->customcod, $solicitud->des_descripcion,$uit->num_uit_siged,$uit->fec_uit_siged,true);
                           F_Mail::sendMailAsPFernand('Actualización de Solicitud', $body, ETarea::SolicitudesRealizadas, array(Persona::getPersonaByReg($tramite->cod_destinatario)->nom_correo));  
                                
                           $this->setFlashSuccess("Se ha actualizado la <strong>solicitud nro. $solicitud->customcod</strong>");
                           $isError = false;
                    }
                }
                
                $this->setTransaction($isError, $transaction);
                if($isError === false) { $this->redirect(array('..\..\personal')); }
                
            } catch (Exception $e) {
                $this->setException($e, $transaction);
                $this->setFlashError(Yii::App()->params->defaultErrorMessage);
            }
        }
        //renderizar
        $this->render('update', array('solicitud' => $solicitud, 'uit' => $uit, 'persona' => $persona));
    }
}   
?>