<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class SolicitudController extends AtencionController
{
    public $layout='/layouts/column_solicitud'; 
    /*
     * $attribute -> pk_atencion,pk_movimiento,etc..
     * $value -> id,cualquier campo
     * 
     * Funcion implementa findAllByAttributes
     */
    public function loadTramiteModel($attribute,$value)
    {
        $model=Tramite::model()->findAllByAttributes(array($attribute=>$value));    
        if($model===null)
            throw new CHttpException(404,Yii::app()->params->defaultErrorPageMessage);
        return $model;
    }
    
    public function loadSolicitudModel($id)
    {
        $model=Solicitud::model()->findByPk($id);   
        if($model===null)
            throw new CHttpException(404,Yii::app()->params->defaultErrorPageMessage);
        return $model;
    }
    
    public function loadUitProveedorModel($id)
    {
        $model=  UitProveedor::model()->findByPk($id);   
        if($model===null) { return new UitProveedor(); }
        return $model;
    }
    
    public function loadUitBienModel($id)
    {
        $model= UitBien::model()->findByPk($id);   
        if($model===null) { return new UitBien(); }
        return $model;
    }
    
    public function loadUitFacturaModel($id)
    {
        $model= UitFactura::model()->findByPk($id);   
        if($model===null) { return new UitFactura(); }
        return $model;
    }
    
    public function loadRegistroModel($id)
    {
        $model=Registro::model()->findByPk($id);   
        if($model===null)
            throw new CHttpException(404,Yii::app()->params->defaultErrorPageMessage);
        return $model;
    }
    
    public function loadUitModel($id)
    {
        $model= Uit::model()->findByPk($id);   
        if($model===null)
            throw new CHttpException(404,Yii::app()->params->defaultErrorPageMessage);
        return $model;
    }
    
    public function setRegistro($pksolicitud,$selecteddoc,$id,$tabla) {
        try {
            $registro = new Registro();
            $registro->fk_solicitud = $pksolicitud;
            $registro->fk_actividad = intval($selecteddoc);
            $registro->cod_id = $id;
            $registro->des_controller = $tabla;
            $registro->des_name = Yii::app()->user->getUserFullName();   
            $registro->des_reg = Yii::app()->user->getUserReg();
            //$registro->des_descripcion = 
            if( !$registro->save() ) { $this->setErrorInfo($registro->geterrors()); return false; }
        } catch (Exception $e) {
            $this->setException($e);
            return false;
        }
        return true;
    }
    /*
    public function setAccion($pktramite,$pkmovimiento)
    {
        try {
            $accion = new Accion();
            $accion->pk_tramite = $pktramite;
            $accion->pk_movimiento = $pkmovimiento;
            if (!$accion->save()) { $this->setErrorInfo($accion->geterrors()); return false; }
        } catch (Exception $e) {
            $this->setException($e);
        }
        return true;
    }*/
}
?>