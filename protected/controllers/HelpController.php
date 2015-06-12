<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class HelpController extends Controller
{
        public $layout='column1';
        
        public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}
       
        public function accessRules()
        {
            return array(
                    array('allow', // allow authenticated users to access all actions
                            'users'=>array('@'),
                    ),
                    array('deny',  // deny all users
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
            $this->render('manual_general');
	}
}
?>