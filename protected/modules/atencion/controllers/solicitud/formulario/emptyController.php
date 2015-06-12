<?php

class emptyController extends SolicitudController
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
                'actions'=>array('index'),
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
    public function actionIndex() {

        $solicitud = new Solicitud();
        
        if(isset($_POST['Solicitud'])){
          $solicitud->validate();
        }
        //renderizar
        $this->render('create', array('solicitud' => $solicitud));
    }
}
?>