<?php

class AtenderController extends SolicitudController
{
    /**
     * @return array action filters
     */
    public $layout='/layouts/column1'; 

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
                'actions'=>array('index','formulario',
                                 'formdefault','formuit',
                                 'saveuit','savedefault',
                                 'loadregistro',
                                 'devolver','rechazar','option','redirect'),
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

    public function actionIndex() {
        $solicitud = new Solicitud('search');
        
        $solicitud->unsetAttributes();  // clear any default values
        if (isset($_GET['Solicitud']))
            $solicitud->attributes = $_GET['Solicitud'];
        
        $this->render('index', array('solicitud' => $solicitud));
    }
    
    public function actionOption($id) {
        
        $this->disableJavascript();
        $this->disableJs(); // para registrar el bloque de script manualmente debido a que estoy usando ajax
        
        $registro = new Registro();
        $registro->unsetAttributes();  // clear any default values
        if (isset($_GET['Registro']))
            $registro->attributes = $_GET['Registro'];
        
        $registro->fk_solicitud = $id;
        
        if(isset($_GET['render']))
        {
            $render = $_GET['render'];
        }
        
        $this->renderPartial('_chooser', array('registro'=>$registro,'render'=>$render,'selectedid'=>$id));
    }
    public function actionFormulario($id) {
        $solicitud = $this->loadSolicitudModel($id);
        
        $tramite = new Tramite();
        $tramite->selectedRechazados = $id;
        $tramite->selectedSolicitudes = $id;
        $tramite->fk_solicitud = $id;
        
        $registro = new Registro();
        $registro->fk_solicitud = $id;
        
        $this->loadScripts();
        $this->render('formulario', array('solicitud' => $solicitud, 'tramite' => $tramite,'sid' => $id,'registro'=>$registro));
    }

    /*Formularios*/
    public function actionFormDefault($id) {
        $tramite = new Tramite();
        $tramite->fk_solicitud = $id;
        $this->renderPartial('formdefault', array('tramite' => $tramite));
    }
    public function actionFormUIT($id) {
        $tramite = new Tramite();
        $tramite->fk_solicitud = $id;
        if (isset($_POST['Tramite'])) {
            $tramite->attributes = $_POST['Tramite'];
        }
        
        $uit = new Uit();
        if (isset($_POST['Uit'])) {
            $uit->attributes = $_POST['Uit'];
        }

        $bienesArray = array();
        if (isset($_POST['BienUit'])) {
           $hasclass = false;
           foreach ($_POST['BienUit'] as $bien) {
               if (is_array($bien)) {
                   $obienuit = new BienUit();
                   $obienuit->attributes = $bien;
                   $obienuit->pk_bien = intval($bien['pk_bien']);
                   $obienuit->pk_proveedor = intval($bien['pk_proveedor']);
                   array_push($bienesArray, $obienuit);
               }
               else{ $hasclass = true;}
           }
           
           if($hasclass){
            $bienuit = new BienUit();
            $bienuit->attributes = $_POST['BienUit'];
            $bienuit->pk_bien = intval($_POST['BienUit']['pk_bien']);
            $bienuit->pk_proveedor = intval($_POST['BienUit']['pk_proveedor']);

            array_push($bienesArray,$bienuit);
           }
        }
        
        if (isset($_GET['bienuitid'])) {
            unset($bienesArray[$_GET['bienuitid']]);
        }
        //consigo informacion anterior
        $solicitud = $this->loadSolicitudModel($id);
        $uit->cod_reg = $solicitud->cod_reg;
        $uit->cod_area = $solicitud->cod_area;
        $uit->bienUits = $bienesArray;
        
        // buscador de bien
        $bien = new Bien();
        $bien->unsetAttributes();
        if (isset($_GET['Bien'])) {
            $bien->attributes = $_GET['Bien'];
        }
        // buscador de proveedor
        $proveedor = new Proveedor();
        $proveedor->unsetAttributes();
        if (isset($_GET['Proveedor'])) {
            $proveedor->attributes = $_GET['Proveedor'];
        }
        // instancia de bienuit
        $bienuit = new BienUit();

        $this->disableJavascript();
        $this->disableJs();
        // renderizamos el script?
        if (isset($_GET['render'])) {
            $renderizar = $_GET['render'];
        }
        if (isset($_GET['doc'])) {
            $tramite->selectedDocumento = $_GET['doc'];
        }
        $this->renderPartial('formuit', array(
            'tramite' => $tramite, 'uit' => $uit, 'bienuit' => $bienuit,
            'bien' => $bien, 'proveedor' => $proveedor,
            'sid'=>$id,'renderizar' => $renderizar), false, true);
    }
    
    public function actionLoadRegistro($id)
    {
        $registro=$this->loadRegistroModel($id);
        $sid = $registro->fk_solicitud;
        
        if (isset($_GET['render'])) {
            $renderizar = $_GET['render'];
        }
        
        switch ($registro->des_tabla)
        {
            case 'UIT': $uit = $this->loadUitModel($registro->cod_id); 
                        $selectDoc = $registro->fk_documento ; 
                        
                        $tramite = new Tramite();
                        $proveedor = new Proveedor();
                        $bien = new Bien();
                        
                        $tramite->fk_solicitud = $sid;
                        $tramite->selectedDocumento = $selectDoc;
                        
                        $this->disableJavascript();
                        $this->disableJs();
                        
                        $jsonarray = array();
                        $jsonarray['selectedDoc'] = $selectDoc;
                        $jsonarray['form'] = $this->renderPartial('formuit', array( 'tramite' => $tramite, 'uit' => $uit, 'bienuit' => $bienuit,
                                                                             'bien' => $bien, 'proveedor' => $proveedor,
                                                                             'sid' => $sid, 'renderizar' => $renderizar),true);
                        break;
            default: throw new CHttpException(404,'The requested page does not exist.');
        }
        
        $json = CJSON::encode($jsonarray);
        echo $json;
    }
    
    /*Registrar*/
    public function actionSaveDefault() {
        if (isset($_POST['Tramite'])) {
            try {
                $isError = false;
                $transaction = Yii::app()->db->beginTransaction();
                
                $tramite = new Tramite();
                $tramite->attributes = $_POST['Tramite'];
                Tramite::clearVigentes($tramite->fk_solicitud); // limpio los vigentes
                
                if($tramite->_opcion_allow == 1) // indico si escogio la opcion de permitir que otro continue con esto
                {   
                    // primero registro lo que hizo el usuario
                    $tramite->cod_movimiento = Tramite::Movimiento_SolicitudBasic;
                    $tramite->cod_remitente = Yii::app()->user->getUserReg();
                    if($tramite->_opcion_save != 1) $tramite->es_vigente = Tramite::Vigente_si;
                    if(!$tramite->save()) { $isError = true; } 
                }
                else 
                {
                    // se graba este paso pero puede continuar atendiendo con otros formularios
                    $tramite->cod_movimiento = Tramite::Movimiento_SolicitudBasic;
                    $tramite->cod_remitente = Yii::app()->user->getUserReg();
                    if($tramite->_opcion_save != 1) $tramite->es_vigente = Tramite::Vigente_si;
                    if(!$tramite->save()) { $isError = true; } 
                }
                
                if($tramite->_opcion_save == 1) // indico si escogio la opcion para dar de alta la solicitud
                {
                    // grabo que ya termino
                    $tramite->cod_remitente = Yii::app()->user->getUserReg();
                    $tramite->cod_movimiento = Tramite::Movimiento_Terminada;
                    $tramite->es_vigente = Tramite::Vigente_si;
                    
                    // actualizo la solicitud
                    $solicitud = $this->loadSolicitudModel($tramite->fk_solicitud);
                    $solicitud->cod_estado = Solicitud::Estado_Atendido;    
                    $tramite->cod_destinatario = Yii::app()->user->getUserReg();
                    
                    if (!$tramite->save()) { $isError = true; }
                    if (!$solicitud->save()) { $isError = true; }
                }
                $this->setTransaction($isError, $transaction);
                
            } catch (Exception $e) {
                $isError = $this->setException($e, $transaction);
            }
        }
        
        $this->setAtencionMessage($isError, $tramite, $tramite->fk_solicitud); 
    }
    public function actionSaveUit() {
        if (isset($_POST['Uit']) && isset($_POST['Tramite'])) {
            try {
                $isError = false;
                $transaction = Yii::app()->db->beginTransaction();
                
                $tramite = new Tramite();
                $tramite->attributes = $_POST['Tramite'];
                
                Tramite::clearVigentes($tramite->fk_solicitud); // limpio los vigentes
                
                if($tramite->_opcion_allow == 1) // indico si escogio la opcion de permitir que otro continue con esto
                {   
                    // primero registro lo que hizo el usuario
                    $tramite->cod_movimiento = Tramite::Movimiento_SolicitudUIT;
                    $tramite->cod_remitente = Yii::app()->user->getUserReg();
                    if($tramite->_opcion_save != 1) $tramite->es_vigente = Tramite::Vigente_si;
                    if(!$tramite->save()) { $isError = true; } 
                }
                else // se graba este paso pero puede continuar atendiendo con otros formularios
                {
                    // se graba este paso pero puede continuar atendiendo con otros formularios
                    $tramite->cod_movimiento = Tramite::Movimiento_SolicitudUIT;
                    $tramite->cod_remitente = Yii::app()->user->getUserReg();
                    if($tramite->_opcion_save != 1) $tramite->es_vigente = Tramite::Vigente_si;
                    if(!$tramite->save()) { $isError = true; } 
                }
                
                if($tramite->_opcion_save == 1) // indico si escogio la opcion para dar de alta la solicitud
                {
                    // grabo que ya termino
                    $tramite->cod_remitente = Yii::app()->user->getUserReg();
                    $tramite->cod_movimiento = Tramite::Movimiento_Terminada;
                    $tramite->es_vigente = Tramite::Vigente_si;
                    
                    // actualizo la solicitud
                    $solicitud = $this->loadSolicitudModel($tramite->fk_solicitud);
                    $solicitud->cod_estado = Solicitud::Estado_Atendido;    
                    $tramite->cod_destinatario = Yii::app()->user->getUserReg();
                    
                    if (!$tramite->save()) { $isError = true; }
                    if (!$solicitud->save()) { $isError = true; }
                }
                
                $uit = new Uit();
                $uit->attributes = $_POST['Uit'];
                if (!$uit->save()) { $isError = true; }
                
                if (isset($_POST['BienUit'])) {
                    foreach ($_POST['BienUit'] as $bienuit) {
                        $buit = new BienUit();
                        $buit->attributes = $bienuit;
                        $buit->pk_uit = $uit->pk_uit;
                        $buit->save();
                    }
                }
                
                $this->setRegistro($tramite->fk_solicitud, $tramite->selectedDocumento , $uit->pk_uit, 'UIT');
                $this->setTransaction($isError, $transaction);
                
            } catch (Exception $e) {
                $isError = $this->setException($e, $transaction);
            }
        }
        
        $this->setAtencionMessage($isError, $tramite, $tramite->fk_solicitud);   
    }
        
    /* Otras Opciones */
    public function actionDevolver() {
        $isError = false;
        
        if (isset($_POST['Tramite'])) {
            $selected = $_POST['Tramite']['selectedRechazados']; // en este caso solo es uno!
             try{
                $transaction = Yii::app()->db->beginTransaction();
                $tramite = new Tramite();
                $tramite->attributes = $_POST['Tramite'];
                $tramite->cod_movimiento = Tramite::Movimiento_DevueltoSolicitante;
                $tramite->cod_remitente = Yii::app()->user->getUserReg();
                $tramite->fk_solicitud = $selected;
                
                $solicitud = $this->loadSolicitudModel($selected);
                $solicitud->cod_estado = Solicitud::Estado_AModificar;
                $tramite->cod_destinatario = $solicitud->cod_reg;
                if (!$tramite->save()) { $isError = true; }
                if (!$solicitud->save()) { $isError = true;}

                $this->setTransaction($isError, $transaction);
            } catch (Exception $e) {
                $isError = $this->setException($e, $transaction);
            }
            
            if (!$isError) { $array = array('operacion' => 'success'); $this->setFlashInfo('Se regreso solicitud a usuario para su modificación.'); } 
            else { $array = array('operacion' => 'error'); $this->setFlashError(Yii::App()->params->defaultErrorMessage); }
            $json = json_encode($array);
            echo $json;
        }
    }
    public function actionRechazar() {
        $isError = false;
        
        if (isset($_POST['Tramite'])) {
            $selected = $_POST['Tramite']['selectedRechazados']; // en este caso solo es uno!
            
            try{
                $transaction = Yii::app()->db->beginTransaction();
                $tramite = new Tramite();
                $tramite->attributes = $_POST['Tramite'];
                $tramite->cod_movimiento = Tramite::Movimiento_Rechazada;
                $tramite->cod_remitente = Yii::app()->user->getUserReg();
                $tramite->fk_solicitud = $selected;
                
                $solicitud = $this->loadSolicitudModel($selected);
                $solicitud->cod_estado = Solicitud::Estado_Rechazado;
                $tramite->cod_destinatario = $solicitud->cod_reg;
                if (!$tramite->save()) { $isError = true; }
                if (!$solicitud->save()) { $isError = true;}

                $this->setTransaction($isError, $transaction);
            } catch (Exception $e) {
                $isError = $this->setException($e, $transaction);
            }
            
            if (!$isError) { $array = array('operacion' => 'success'); $this->setFlashInfo('Se rechazo la solicitud.'); } 
            else { $array = array('operacion' => 'error'); $this->setFlashError(Yii::App()->params->defaultErrorMessage.'sol:'.$selected); }
            $json = json_encode($array);
            echo $json;
        }
    }
    public function setAtencionMessage($isError,$tramite,$id) {
        if (!$isError) 
        { 
            if($tramite->_opcion_save == 1)
            {
                // muestra el mensaje en el caso que se de alta la solicitud
                $this->setFlashSuccess('Se dio termino a la atención de la solicitud.'); 
                $this->redirect('index'); 
            }
            else if($tramite->_opcion_allow == 1)
            {
                // muestra el mensaje en el caso que se complete el formulario y se asigne a otra persona
                $this->setFlashSuccess('Se registro el formulario y se envio un correo a la persona asignada.');   
                $this->redirect('index'); 
            }
            else
            {
                // carga la misma solicitud en caso de no derivar a nadie y solo 'generar' el evento
                $this->setFlashSuccess('Se registro el formulario.'); 
                $this->redirect('formulario/id/'.$id); 
            }
        } 
        else 
        { 
            // si hay error carga el formulario denuevo
            $this->setFlashError(Yii::App()->params->defaultErrorMessage);
            $this->redirect('formulario/id/'.$id); 
        }
    }
    
    public function actionredirect($id)
    {
        if (isset($_GET['solicitud'])) {
            $idSolicitud = $_GET['solicitud'];
        }
        
        switch($id)
        {
            case '2': $redirectedUrl = $this->createUrl('proceso/uit/create',array('sid'=>$idSolicitud));break;
            default : $redirectedUrl = $this->createUrl('proceso/default/create',array('sid'=>$idSolicitud));break;
        }
        
        echo json_encode(array('redirect'=>$redirectedUrl)); 

    }
    
}
?>


