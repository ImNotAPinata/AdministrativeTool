<?php

class ResourceController extends SolicitudController
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
                'actions'=>array('create','update','message'),
                'users'=>array('@'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }
    
    public function actionCreate() {
        
        if (isset($_POST["id"])) {
            $selected = intval($_POST["id"]);
            
            switch($selected)
            {
                case EProcesoSolicitud::uit: $path = $this->createUrl('solicitud/formulario/uit/create');break;
                case EProcesoSolicitud::simple: $path = $this->createUrl('solicitud/formulario/simple/create');break;
                default :  $path = $this->createUrl('solicitud/formulario/empty');break;
            }
        }
        
        echo json_encode(array('path'=>$path));
    }
    
    public function actionUpdate($id) {
        
        $solicitud = $this->loadSolicitudModel($id);
            
        switch($solicitud->fk_proceso)
        {
            case EProcesoSolicitud::uit: $path = $this->createUrl('solicitud/formulario/uit/update',array('id'=>$solicitud->pk_solicitud));break;
            case EProcesoSolicitud::simple: $path = $this->createUrl('solicitud/formulario/simple/update',array('id'=>$solicitud->pk_solicitud));break;
            default : $path = $this->createUrl('solicitud/formulario/empty');break;
        }
        
        echo json_encode(array('path'=>$path));
    }
    
    
    
    public function actionMessage() {
        $this->render('blank');
    }
}
?>