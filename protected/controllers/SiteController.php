<?php

class SiteController extends Controller
{
        public $layout='column_login';
        //public $perfil='0'; // 0 acceso a todo
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
        
        public function filters()
        {
            return array('accessControl'); // perform access control for CRUD operations
        }
        
        public function accessRules()
        {
            return array(
                    array('allow',  // allow all users to access 'index' and 'view' actions.
                            'actions'=>array('index'),
                            'users'=>array('*'),
                    ),
                    array('allow', // allow authenticated users to access all actions
                            'users'=>array('@'),
                    ),
                    array('deny',  // deny all users
                            'actions'=>array('welcome','logout'),
                            'users'=>array('*'),
			),
            );
        }

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
            if (Yii::app()->user->isGuest) {
                
                $model = new LoginForm();
                // if it is ajax validation request
                if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
                    echo CActiveForm::validate($model);
                    Yii::app()->end();
                }

                // collect user input data
                if (isset($_POST['LoginForm'])) {
                    $model->attributes = $_POST['LoginForm'];

                    if ($model->validate() && $model->login())
                        $this->redirect(Yii::app()->homeUrl. "site/welcome");  // /login/welcome
                }
                    // display the login form
                    $this->render('login',array('model'=>$model));
            }
            else {
                $this->redirect(Yii::app()->user->returnUrl."site/welcome");
            }
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the login page
	 */
	public function actionwelcome() {
            $this->layout='column1';
            $this->render('welcome');
        }

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
        
}
?>