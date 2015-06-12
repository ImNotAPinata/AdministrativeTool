<?php

class UitController extends SolicitudController
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
                'actions'=>array('index','create','update','proveedoruit','addfactura','removefactura','selectproveedor'),
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
    public function actionCreate() {
        $tramite = new Tramite();
        
        $uit = new Uit();
        
        if(isset($_GET['sid']))
        {
            $pksolicitud = $_GET['sid'];
        }
        
        $persona = new Persona();
        $persona->unsetAttributes();
        if (isset($_GET['Persona'])) {
            $persona->attributes = $_GET['Persona'];
        }
        $proveedor = new Proveedor();
        $uitProveedor = new UitProveedor();
        //consigo informacion anterior
        $solicitud = $this->loadSolicitudModel($pksolicitud);
        
        $uit->des_registro_solicitante = $solicitud->des_reg_solicitante;
        $uit->des_area_solicitante = $solicitud->des_area_solicitante;
        $uit->des_nombre_solicitante = $solicitud->des_nom_solicitante;
        
        $tramite->fk_solicitud = $pksolicitud;
        
        if (isset($_POST['Tramite']) && isset($_POST['Uit']) && $_POST['op']!='tipechange') {
            $tramite->attributes = $_POST['Tramite'];
            $uit->attributes = $_POST['Uit'];
            $transaction = Yii::app()->db->beginTransaction();
            
            try {
                $noGenerarMovimiento = false;
                
                if ($tramite->_opcion_allow == 1) { // indico si escogio la opcion de permitir que otro continue con esto
                    // primero registro lo que hizo el usuario
                    $tramite->fk_movimiento = EMovimiento::uit_registro;
                    $tramite->nom_destinatario = Persona::getPersonaByReg($tramite->cod_destinatario)->fullname;
                    $body = F_MailBody::BodyActividadUitGenerado($tramite->nom_destinatario, Yii::app()->user->getUserFullName(), $solicitud->customcod, $tramite->des_observacion);
                } else {
                    // se graba este paso pero puede continuar atendiendo con otros formularios
                    $noGenerarMovimiento = true;
                }
                $tramite->cod_remitente = Yii::app()->user->getUserReg();
                $tramite->nom_remitente = Yii::app()->user->getUserFullName();
                $tramite->es_vigente = ETramiteVigente::si;
                
                $uit->cod_uit_estado = EEstadoUit::Requerimiento; 
                $uit->cod_uit_generado = UIT::getUitCode();
                
                if($noGenerarMovimiento!=true) { $tramite->save(); }
                if($solicitud->save() && $uit->save() && $_POST['op'] == '') {
                    $saved = $this->setRegistro($solicitud->pk_solicitud, EActividad::Menor_3_UIT, $uit->pk_uit, 'uit');
                    if ($saved) {  
                        if($noGenerarMovimiento != true) F_Mail::sendMailAsPFernand('Solicitud de Atención', $body, ETarea::SolicitudesRealizadas, array(Persona::getPersonaByReg($tramite->cod_destinatario)->nom_correo));
                        $isError = false; 
                    }
                }

                $this->setTransaction($isError, $transaction);
                if ($isError === false) { $this->setAtencionMessage($tramite); }
            } catch (Exception $e) {
                $this->setException($e, $transaction);
                $this->setFlashError(Yii::App()->params->defaultErrorMessage);
            }
        }
        
        
        $this->render('create', array('solicitud' => $solicitud, 'tramite' => $tramite, 'uit' => $uit, 'proveedor' => $proveedor, 'proveedoruit' => $uitProveedor, 'persona' => $persona, 'sid' => $pksolicitud));
    }
    
    public function actionUpdate($id) {
        $uit = $this->loadUitModel($id);
        $uit->cod_uit_estado = $this->getEstadoUit($uit->cod_uit_estado);
        
        if (isset($_GET['sid'])) {
            $pksolicitud = $_GET['sid'];
        }
        
        $proveedor = new Proveedor();
        $uitProveedor = new UitProveedor();
        $uitfactura = new UitFactura();
        
        $tramite = new Tramite();
        $tramite->fk_solicitud = intval($pksolicitud);
        $solicitud = $this->loadSolicitudModel($pksolicitud);

        $persona = new Persona();
        $persona->unsetAttributes();
        if (isset($_GET['Persona'])) {
            $persona->attributes = $_GET['Persona'];
        }
        
        if (isset($_POST['Tramite']) && isset($_POST['Uit'])) {
            $tramite->attributes = $_POST['Tramite'];
            $uit->attributes = $_POST['Uit'];
            if($_POST['op']!='tipechange'){
            $transaction = Yii::app()->db->beginTransaction();

            try {
                $noGenerarMovimiento = false;
                
                if ($tramite->_opcion_allow == 1) { // indico si escogio la opcion de permitir que otro continue con esto
                    // primero registro lo que hizo el usuario
                    $tramite->fk_movimiento = EMovimiento::gen_actualizó;
                    $tramite->nom_destinatario = Persona::getPersonaByReg($tramite->cod_destinatario)->fullname;
                    $body = F_MailBody::BodyActividadUitGenerado($tramite->nom_destinatario, Yii::app()->user->getUserFullName(), $solicitud->customcod, $tramite->des_observacion);
                } else if ($tramite->_opcion_save == 1) {  // Si se va a dar de baja
                    $tramite->fk_movimiento = EMovimiento::gen_finalizaatencion;
                    $tramite->cod_destinatario = $solicitud->des_reg_solicitante;
                    $tramite->nom_destinatario = $solicitud->des_nom_solicitante;
                    $solicitud->cod_estado = EEstadoSolicitud::Atendido;
                    $body = F_MailBody::BodyAtencionTermino($tramite->nom_destinatario, Yii::app()->user->getUserFullName(), $solicitud->customcod, $tramite->des_observacion);
                } else {
                    // se graba este paso pero puede continuar atendiendo con otros formularios
                    $noGenerarMovimiento = true;
                } 
                $tramite->cod_remitente = Yii::app()->user->getUserReg();
                $tramite->nom_remitente = Yii::app()->user->getUserFullName();
                $tramite->es_vigente = ETramiteVigente::si;
                if($noGenerarMovimiento!=true) {  Tramite::clearVigentes($tramite->fk_solicitud); $tramite->save(); }
                if($solicitud->save() && $uit->save() && $_POST['op'] == '') {
                    $isError = false;
                }
                
                $uitProarray = $this->getUitProveedores($uit);
                if($uitProarray != null) { $isError = false; } 
                $uit->uitproveedors = F_Array::reordenarKeys($uitProarray);
                
                $this->setTransaction($isError, $transaction);
                if ($isError === false && $_POST['op']=='') { 
                    
                    if($noGenerarMovimiento != true) F_Mail::sendMailAsPFernand('Actualización de Atención', $body, ETarea::SolicitudesRealizadas, array(Persona::getPersonaByReg($tramite->cod_destinatario)->nom_correo));
                    $this->setAtencionMessage($tramite); 
                }
                if ($_POST['op']=='addfactura') { $uitfactura->selected = $_POST['UitFactura']['selected']; }
            } catch (Exception $e) {
                $this->setException($e, $transaction);
                $this->setFlashError(Yii::App()->params->defaultErrorMessage);
            }
            
            }
        }

        $this->render('update', array('solicitud' => $solicitud, 'tramite' => $tramite, 'uit' => $uit, 'proveedor' => $proveedor, 'proveedoruit' => $uitProveedor, 'facturauit'=> $uitfactura, 'persona' => $persona, 'sid' => $pksolicitud));
    }
    
    private function getUitBien($id, $ouitpro) {
        if (isset($_POST['UitBien'])) {
            if (is_array($_POST['UitBien'][$id])) {
                $uitbk = $_POST['UitBien'][$id]['pk_uitbien'];
                $bienpatrimonial = $this->loadUitBienModel($uitbk);
                $bienpatrimonial->attributes = $_POST['UitBien'][$id];
                if ($_POST['op'] == '') {
                    $bienpatrimonial->fk_uitproveedor = $ouitpro->pk_uitproveedor;
                    $bienpatrimonial->save();
                }
            }
        }
        
        return $bienpatrimonial;
    }
    
    private function getUitProveedores($uit) {
        if (isset($_POST['UitProveedor']) && isset($_POST['op'])) {
            $uitProarray = array();
            $hasclass = false;
            foreach ($_POST['UitProveedor'] as $id => $uitproveedor) {
                if (is_array($uitproveedor)) {
                    $uitpk = $uitproveedor['pk_uitproveedor'];
                    $ouitpro = $this->loadUitProveedorModel($uitpk);
                    $ouitpro->attributes = $uitproveedor;
                    if ($_POST['op'] == '') {
                        $ouitpro->fk_uit = $uit->pk_uit;
                        $ouitpro->save();
                    }
                        
                    $uitFacarray = $this->getUitFacturas($id,$ouitpro);
                    $ouitpro->uitfactura = F_Array::reordenarKeys($uitFacarray);
                    $ouitpro->uitbien = $this->getUitBien($id,$ouitpro);
                    
                    array_push($uitProarray, $ouitpro);
                } else {
                    $hasclass = true;
                }
            }

            if ($hasclass && $_POST['op'] == 'addproveedor') {
                $proveedoruit = new UitProveedor();
                $proveedoruit->attributes = $_POST['UitProveedor'];
                array_push($uitProarray, $proveedoruit);
            }

            if (isset($_POST['item']) && $_POST['op'] == 'removeproveedor') {
                $pk = $uitProarray[$_POST['item']]->pk_uitproveedor;
                $deletedItem = $this->loadUitProveedorModel($pk);
                if (!$deletedItem->isNewRecord) {
                    $deletedItem->val_activo = 0;
                    $deletedItem->save();
                }
                unset($uitProarray[$_POST['item']]);
            }
        }
        
        return $uitProarray;
    }
    
    private function getUitFacturas($id,$ouitpro) {
        
        $uitFacarray = array();
        
        if (isset($_POST['UitFactura'])) {
            $fachasclass = false;
            if (array_key_exists('selected', $_POST['UitFactura'])) {
                if ($_POST['UitFactura']['selected'] != null) {
                    foreach ($_POST['UitFactura'] as $facturauit) {
                        if (is_array($facturauit)) {
                            if ($id == $_POST['UitFactura']['selected']) {
                                $uitfk = $facturauit['pk_uitfactura'];
                                $ouitfac = $this->loadUitFacturaModel($uitfk);
                                $ouitfac->attributes = $facturauit;
                                if ($_POST['op'] == '') {
                                    $ouitfac->fk_uitproveedor = $ouitpro->pk_uitproveedor;
                                    $ouitfac->save();
                                }
                                array_push($uitFacarray, $ouitfac);
                            }
                        } else {
                            $fachasclass = true;
                        }
                    }
                }

                if ($fachasclass && $_POST['op'] == 'addfactura' && $id == $_POST['UitFactura']['selected']) {
                    $factura = new UitFactura();
                    $factura->attributes = $_POST['UitFactura'];
                    array_push($uitFacarray, $factura);
                }

                if (isset($_POST['item']) && $_POST['op'] == 'removefactura') {
                    $pk = $uitFacarray[$_POST['item']]->pk_uitfactura;
                    $deletedItem = $this->loadUitFacturaModel($pk);
                    if (!$deletedItem->isNewRecord) {
                        $deletedItem->val_activo = 0;
                        $deletedItem->save();
                    }
                    unset($uitFacarray[$_POST['item']]);
                }

                if ($_POST['UitFactura']['selected'] == null) {
                    $uitfk = $_POST['UitFactura'][$id][0]['pk_uitfactura'];
                    $ouitfac = $this->loadUitFacturaModel($uitfk);
                    $ouitfac->attributes = $_POST['UitFactura'][$id][0];
                    if ($_POST['op'] == '') {
                        $ouitfac->fk_uitproveedor = $ouitpro->pk_uitproveedor;
                        $ouitfac->save();
                    }
                    array_push($uitFacarray, $ouitfac);
                }
            }
        }

        return $uitFacarray;
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
            $this->refresh();
        }
    }
    
    private function getEstadoUit($estadoUit) {
        switch ($estadoUit) {
            case EEstadoUit::BienesPatrimoniales : break;
            case EEstadoUit::Servicio : $estadoUit = EEstadoUit::BienesPatrimoniales;
                break;
            case EEstadoUit::Ccp : $estadoUit = EEstadoUit::Servicio;
                break;
            case EEstadoUit::Anexo : $estadoUit = EEstadoUit::Ccp;
                break;
            case EEstadoUit::Requerimiento : $estadoUit = EEstadoUit::Anexo;
                break;
            default : $estadoUit = EEstadoUit::Requerimiento;
        }
        return $estadoUit;
    }
}
?>
