<?php

class TramiteController extends SolicitudController
{
    /**
     * @return array action filters
     */
   // public $layout='/layouts/column1'; 

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
                'actions'=>array('view'),
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
    
    public function actionView($id)
    {
        $this->disableJavascript();
        $this->disableJs(); // para registrar el bloque de script manualmente debido a que estoy usando ajax
        
        $tramite = new Tramite('search');
        $tramite->fk_solicitud = $id;
        
        if(isset($_GET['render']))
        {
            $render = $_GET['render'];
        }
        
        $this->renderPartial('view',array('tramite'=>$tramite,'render'=>$render));
    }
    
    public function actionMessage() {
        $this->render('message');
    }
    
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
    
}
?>
