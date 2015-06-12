<?php

class AtenderController extends SolicitudController
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
        
        if (isset($_GET['pageSize'])) {
            Yii::app()->user->setState('pageSize', (int) $_GET['pageSize']);
            unset($_GET['pageSize']);
        } else {
            Yii::app()->user->setState('pageSize', Yii::app()->params['defaultPageSize']);
        }
        
        $this->render('index', array('solicitud' => $solicitud));
    }
    
    public function actionOption($id) {

        $this->disableJavascript();
        $this->disableJs(); // para registrar el bloque de script manualmente debido a que estoy usando ajax

        $registro = new Registro();
        $registro->unsetAttributes();  // clear any default values
        if (isset($_GET['Registro'])) {
            $registro->attributes = $_GET['Registro'];
        }
        $registro->fk_solicitud = $id;

        if (isset($_GET['render'])) {
            $render = $_GET['render'];
        }
        $this->renderPartial('_chooser', array('registro' => $registro, 'render' => $render, 'selectedid' => $id));
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


