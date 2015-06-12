<?php

class AtencionModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application
                
		// import the module-level models and components
		$this->setImport(array(
			'atencion.models.atencion.*',
                        'atencion.models.atencion.enums.solicitud.*',
                        'atencion.models.atencion.enums.atencion.*',
                        'atencion.models.atencion.enums.tramite.*',
                        //'atencion.models.atencion.enums.general.*',
                        'atencion.models.atencion.enums.uit.*',
			'atencion.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
                        //var_dump( Yii::app()->clientscript->scriptMap);
                        //Yii::app()->clientscript->scriptMap['jquery.js'] = false;
                        //Yii::app()->clientscript->scriptMap['bootstrap.js'] = false;
                        //Yii::app()->clientscript->scriptMap['jquery.yiilistview.js'] = false;
                        //Yii::app()->clientscript->scriptMap['jquery.ba-bbq.js'] = false;
                        // this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
