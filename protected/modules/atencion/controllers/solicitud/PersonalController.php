<?php

class PersonalController extends SolicitudController
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
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('index'),
                'users'=>array('@'), //admin
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    /**
     * Default siempre es INDEX
     */
    public function actionIndex()
    {
        $solicitud=new Solicitud('search');
        $solicitud->unsetAttributes();  // clear any default values
        
        if (isset($_GET['Solicitud']))
            $solicitud->attributes = $_GET['Solicitud'];
        
        if (isset($_GET['pageSize'])) {
            Yii::app()->user->setState('pageSize', (int) $_GET['pageSize']);
            unset($_GET['pageSize']);
        } else {
            Yii::app()->user->setState('pageSize', Yii::app()->params['defaultPageSize']);
        }
        
        $this->render('index',array('solicitud'=>$solicitud));
    }
}
?>


