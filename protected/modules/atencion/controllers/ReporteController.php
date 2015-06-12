<?php

class ReporteController extends ReportController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='column1';

	/**
	 * @return array action filters
	 */
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
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionAtencion()
	{
            
            $solicitud = new Solicitud();
            
            if(isset($_GET['Solicitud']))
            {
                $solicitud->attributes = $_GET['Solicitud'];
            }
            
            if (isset($_GET['pageSize'])) {
                Yii::app()->user->setState('pageSize', (int) $_GET['pageSize']);
                unset($_GET['pageSize']);
            } else {
                Yii::app()->user->setState('pageSize', Yii::app()->params['defaultPageSize']);
            }
            
            $this->render('Atencion',array('solicitud'=>$solicitud)); 
	}
        
        public function actionUit()
	{
            $uit = new Uit();
            $uit->cod_uit_estado = null;
            $uit->cod_uit_tipo = null;
            
            if(isset($_GET['Uit']))
            {
                $uit->attributes = $_GET['Uit'];
            }
            
            if (isset($_GET['pageSize'])) {
                Yii::app()->user->setState('pageSize', (int) $_GET['pageSize']);
                unset($_GET['pageSize']);
            } else {
                Yii::app()->user->setState('pageSize', Yii::app()->params['defaultPageSize']);
            }
            
            $this->render('Uit',array('uit'=>$uit));
        }
        
        public function actionPendiente()
	{
            $tramite = new Tramite();
            
            if(isset($_GET['Tramite']))
            {
                $tramite->attributes = $_GET['Tramite'];
            }
            
            if (isset($_GET['pageSize'])) {
                Yii::app()->user->setState('pageSize', (int) $_GET['pageSize']);
                unset($_GET['pageSize']);
            } else {
                Yii::app()->user->setState('pageSize', Yii::app()->params['defaultPageSize']);
            }
            
            $this->render('Pendiente',array('tramite'=>$tramite));
        }
        
}
?>