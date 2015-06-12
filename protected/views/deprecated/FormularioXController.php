<?php

class FormularioController extends SolicitudController
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
                'actions'=>array('selected','message'),
                'users'=>array('@'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('createuit'),
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
    public function actionSelected() {
        
        if (isset($_POST["id"])) {
            $selectedForm = $_GET["id"];
            
            switch($selectedForm)
            {
                case '2': $path = $this->createUrl('uit');
                case '1': $path = $this->createUrl('simple');
                default : $path = $this->createUrl('empty');
            }
        }
        
        echo json_encode(array('path'=>$path));
    }
    
    public function actionMessage() {
        $this->render('message');
    }
    
    public function actionCreate() {

        $solicitud = new Solicitud();

        $nform = Yii::app()->session['form'];
        
        // eligo que formulario renderizar
        switch ($nform) {
            case Categoria::uit: $solicitud->fk_categoria = $nform;
                                 $uit = new Uit();
                                 $persona = new Persona();
                                 $form = $this->renderUit($solicitud, $uit, $persona);
                                 break;
            case Categoria::simple: $solicitud->fk_categoria = $nform;
                                 $form = $this->renderDefault($solicitud);
                                 break;
            default : $form = $this->renderDefault($solicitud);
        }

        // verifico si estan haciendo un post de la solicitud y si la accion es crear
        if (isset($_POST['Solicitud']) && $_POST['esaccion'] != 'false') {

            $solicitud->attributes = $_POST['Solicitud'];
            $solicitud = $this->setSolicitudCreated($solicitud);
            $transaction = Yii::app()->db->beginTransaction();
            
            try {
                if ($solicitud->validate()) {

                    switch ($solicitud->fk_categoria) {
                        
                        case Categoria::uit :   $isError = $this->saveUit($solicitud, $uit); break;
                        default:                $isError = $this->saveDefault($solicitud);
                            
                    }
                    
                    unset(Yii::app()->session['form']);
                    $this->setTransaction($isError, $transaction);
                    $this->redirectToOwner($isError);
                }
            } catch (Exception $e) {
                $this->setException($e);
                $this->setFlashError(Yii::App()->params->defaultErrorMessage);
            }
        }
        
        //renderizar
        $this->render('create', array('form' => $form));
    }
    public function actionUpdate($id) {
        $solicitud = $this->loadSolicitudModel($id);
        
        $nform = $solicitud->fk_categoria;
        
        // eligo que formulario renderizar
        switch($nform)
        {
            case Categoria::uit : $uit = $this->loadUit($solicitud);
                                  $persona = new Persona();
                                  $form = $this->renderUit($solicitud,$uit,$persona);break;
            default : $form = $this->renderDefault($solicitud);
        }   
        
        // verifico si estan haciendo un post de la solicitud
        if (isset($_POST['Solicitud'])) {
            $transaction = Yii::app()->db->beginTransaction();
            $solicitud->attributes = $_POST['Solicitud'];
            
            try {
                switch ($solicitud->fk_categoria) {
                    
                       case Categoria::uit :   $isError = $this->updateUit($solicitud, $uit); break;
                       default:                $isError = $this->updateDefault($solicitud);
                            
                }
                
                $this->setTransaction($isError, $transaction);
                $this->redirectToOwner($isError);
            } catch (Exception $e) {
                $this->setException($e);
                $this->setFlashError(Yii::App()->params->defaultErrorMessage);
            }
        }
        
        //renderizar
        $this->render('update', array('form' => $form));
    }
    
    /**
     * other options
     */
    private function renderUit($solicitud,$uit,$persona) {
        $persona->unsetAttributes();
        if (isset($_GET['Persona'])) {
            $persona->attributes = $_GET['Persona'];
        }
        
        //Si estan haciendo un post de la solicitud
        return $this->renderPartial('_formuit', array('solicitud' => $solicitud, 'uit' => $uit, 'persona' => $persona), true);
    }
    
    private function saveUit($solicitud,$uit) {
                        
        $uit->attributes = $_POST['Uit'];
        $solicitud->des_descripcion = $uit->des_uit_descripcion;
        
        $solicitud = $this->setSolicitudCreated($solicitud);
        if ($solicitud->save()) {
            $tramite = $this->setTramiteCreated($solicitud);
            if ($tramite->save()) {
                $saved = $this->setAccion($tramite->pk_tramite, Movimiento::uit_registro);
                if ($saved) {
                    $uit->cod_uit_estado = Uit::Servicio;
                    if ($uit->save()) {
                        
                        $this->setRegistro($solicitud->pk_solicitud, Documento::Menor_3_UIT, $uit->pk_uit, 'uit');
                        //muestro mensaje de exito y envio correo 
                        //$body = F_MAIL::BodyPedidoGenerado(Persona::getJefeByUuoo()->fullname, Yii::app()->user->getUserFullName(), $solicitud->customcod, $solicitud->des_descripcion);
                        //F_MAIL::sendMailAsOther(Yii::app()->user->getUserMail(),'webmaster', 'Solicitud de Atención', $body, array('prac-jsanchezb@sunat.gob.pe'), null);  
                        $this->setFlashSuccess("Se ha creado la <strong>solicitud nro $solicitud->customcod</strong>");
                        $isError = false;
                    }
                }
            }
        }
        return $isError;            
    }
    private function saveDefault($solicitud) {
        if ($solicitud->save()) {
            $tramite = $this->setTramiteCreated($solicitud);
            if ($tramite->save()) {
                $saved = $this->setAccion($tramite->pk_tramite, Movimiento::Registro);
                if ($saved) {
                    //muestro mensaje de exito y envio correo 
                    //$body = F_MAIL::BodyPedidoGenerado(Persona::getJefeByUuoo()->fullname, Yii::app()->user->getUserFullName(), $solicitud->customcod, $solicitud->des_descripcion);
                    //F_MAIL::sendMailAsOther(Yii::app()->user->getUserMail(),'webmaster', 'Solicitud de Atención', $body, array('prac-jsanchezb@sunat.gob.pe'), null);  

                    $this->setFlashSuccess("Se ha creado la <strong>solicitud nro $solicitud->customcod</strong>");
                    $isError = false;
                }
            }
        }
        return $isError;
    }
    
    private function updateUit($solicitud,$uit) {
        $uit->attributes = $_POST['Uit'];
        $uit->des_uit_descripcion = $solicitud->des_descripcion;
        $solicitud->cod_estado = Solicitud::checkIfSolicitudHaveAtencion($solicitud->pk_solicitud, Solicitud::Estado_EnAtención);  // indicamos que regreso para que entre de nuevo a atención

        if ($solicitud->save()) {
            $tramite = new Tramite();
            $tramite->fk_solicitud = $solicitud->pk_solicitud;
            $tramite->cod_remitente = Yii::app()->user->getUserReg();
            $tramite->nom_remitente = Yii::app()->user->getUserFullName();

            $ultimotramite = Tramite::getUltimoRemitente($solicitud->pk_solicitud);
            $tramite->cod_destinatario = $ultimotramite['cod_remitente'];
            $tramite->nom_destinatario = $ultimotramite['nom_remitente'];

            if ($tramite->save()) {
                $saved = $this->setAccion($tramite->pk_tramite, Movimiento::Modifico);
                if ($saved) {
                    if ($uit->save()) {
                        //muestro mensaje de exito y envio correo
                        $this->setFlashSuccess("Se ha actualizado la <strong>solicitud nro $solicitud->customcod</strong>");
                        $isError = false;
                    }
                }
            }
        }
        
        return $isError;            
    }
    private function updateDefault($solicitud) {
        $solicitud->cod_estado = Solicitud::checkIfSolicitudHaveAtencion($solicitud->pk_solicitud, Solicitud::Estado_EnAtención);  // indicamos que regreso para que entre de nuevo a atención
        if ($solicitud->save()) {
            $tramite = new Tramite();
            $tramite->fk_solicitud = $solicitud->pk_solicitud;
            $tramite->cod_remitente = Yii::app()->user->getUserReg();
            $tramite->nom_remitente = Yii::app()->user->getUserFullName();

            $ultimotramite = Tramite::getUltimoRemitente($solicitud->pk_solicitud);
            $tramite->cod_destinatario = $ultimotramite['cod_remitente'];
            $tramite->nom_destinatario = $ultimotramite['nom_remitente'];

            if ($tramite->save()) {
                $saved = $this->setAccion($tramite->pk_tramite, Movimiento::Modifico);
                if ($saved) {

                    //muestro mensaje de exito y envio correo
                    $this->setFlashSuccess("Se ha actualizado la <strong>solicitud nro $solicitud->customcod</strong>");
                    $isError = false;
                }
            }
        }
        return $isError;
    }
    
    private function loadUit($solicitud) {
        foreach($solicitud->registros as $registro)
        {
            if($registro->fk_documento == Documento::Menor_3_UIT)
            {
                $uit = $this->loadUitModel($registro->cod_id);
            }
        }
        return $uit;
    }
    
    private function setSolicitudCreated($solicitud) {
        $solicitud->cod_estado = Solicitud::Estado_Registrado;
        $solicitud->cod_solicitud = Solicitud::getSolicitudCode();
        $solicitud->nom_user = Yii::app()->user->getUserFullName();
        $solicitud->cod_reg = Yii::app()->user->getUserReg();
        $solicitud->cod_area = Yii::app()->user->getUserArea();
        
        return $solicitud;
    }
    private function setTramiteCreated($solicitud) {
        $tramite = new Tramite();
        $tramite->fk_solicitud = $solicitud->pk_solicitud;
        $tramite->cod_remitente = Yii::app()->user->getUserReg();
        $tramite->nom_remitente = Yii::app()->user->getUserFullName();
        $tramite->cod_destinatario = Persona::getJefeByUuoo()->num_registro;
        $tramite->nom_destinatario = Persona::getJefeByUuoo()->FullName;
        
        return $tramite;
    }
    private function redirectToOwner($isError) {
       if ($isError === false) {
            if (isset($_GET['path'])) {
                $this->redirect(array('..\\' . $_GET['path'] . '\\'));
            }
       }
       else
       {
           $this->setFlashError(Yii::App()->params->defaultErrorMessage);
       }
    }
}
?>
