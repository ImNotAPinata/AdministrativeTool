<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class AtencionController extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
         * Cuando se usa unicamente de esta manera '/' y no '//' se esta refiriendo a la direccion local (la del modulo en este caso)
	 */
	public $layout='/layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
        
        
        public function setFlash($key, $value, $defaultValue=NULL)
        {
            Yii::app()->user->setFlash($key, $value, $defaultValue);
        }

        public function setFlashSuccess($value, $defaultValue = null)
        {
            $this->setFlash('success', $value, $defaultValue);
        }
        public function setFlashError($value, $defaultValue = null)
        {
            $this->setFlash('error', $value, $defaultValue);
        }
        public function setFlashInfo($value, $defaultValue = null)
        {
            $this->setFlash('info', $value, $defaultValue);
        }
        public function setFlashWarning($value, $defaultValue = null)
        {
            $this->setFlash('warning', $value, $defaultValue);
        }
        public function setTransaction($isError,$transaction)
        {
            if($isError === false && $transaction!=null )  { $transaction->commit(); } else { $transaction->rollBack(); }
        }
        public function setException($e,$transaction = null)
        {
            if(Yii::App()->params->showDebugInfo) $this->setFlashWarning($e->getMessage());
                
            if($transaction != null)
            {
                $transaction->rollBack();
            }     
            return true;
        }
        public function setErrorInfo($errorInfo) 
        {
            if (Yii::App()->params->showDebugInfo) $this->setFlashWarning($errorInfo);
        }
        
        public function loadScripts() {
            /* Debido a que los formularios van a cargarse dinamicamente, los scripts deben de cargarse primero */
            Yii::app()->clientScript->registerScriptFile(Yii::app()->getClientScript()->getCoreScriptUrl() . '/jui/js/jquery-ui.min.js');
            Yii::app()->clientScript->registerScriptFile(Yii::app()->getClientScript()->getCoreScriptUrl() . '/jui/js/jquery-ui-i18n.min.js');
            Yii::app()->clientScript->registerCssFile(Yii::app()->clientScript->getCoreScriptUrl() . '/jui/css/base/jquery-ui.css');
        }

        public function disableJs() {
            Yii::app()->clientscript->scriptMap['jquery.yiigridview.js'] = false;
            Yii::app()->clientscript->scriptMap['jquery.js'] = false;
            Yii::app()->clientscript->scriptMap['jquery.ba-bbq.js'] = false;
            Yii::app()->clientscript->scriptMap['bootstrap.js'] = false;
            Yii::app()->clientscript->scriptMap['jquery-ui-i18n.min.js'] = false;
            Yii::app()->clientscript->scriptMap['jquery-ui.min.js'] = false;
        }

        public function disableJavascript() {
            // indico que el script generado para los grids no se renderizen, pues yo lo voy a hacer manual
            Yii::app()->clientScript->enableJavaScript = false;
        }
    

}
?>