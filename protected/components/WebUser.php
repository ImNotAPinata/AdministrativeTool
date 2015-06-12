<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * Aqui van todos los recursos de YII::APP()->user
 * Aqui debe de ir toda funcion y logica que involucre al perfil del usuario y sus accesos.
 * 
 */
class WebUser extends CWebUser
{
    private $_user;
    private $_persona;
    
    // Esta para optimizar
    
    // Load user model.
    protected function CargarUsuario($id=null)
    {
        if($this->_user===null)
        {
            if($id!==null)
                $this->_user = usuario::getUsuariobyUsername($id);
        }
        return $this->_user;
    }
    // Load persona model.
    protected function CargarPersona($reg=null)
    {
        if($this->_persona===null)
        {
            if($reg!==null)
                $this->_persona = Persona::getPersonaByReg($reg);
        }
        return $this->_persona;
    }
    // Esta permitido
    /* protected function puedeAprobar()
    {
        $aprobadores = array();
        array_push($aprobadores, Yii::app()->params->currentWebMaster);
        array_push($aprobadores, Persona::getJefeByUuoo());
        return $aprobadores;
    }*/
    
    // Opciones son visibles?
    function esAtenderVisible()
    {
        $this->CargarUsuario(Yii::app()->user->id);  
        $this->CargarPersona($this->_user->registro);
        if($this->_persona->cod_uuoo == Yii::app()->params->defaultArea) {
            return true;
        } else {
            return false;
        }
    }
    
    function esAdministrador()
    {
        $this->CargarUsuario(Yii::app()->user->id);
        if ($this->_user != null) {
            $perfilcode = intval($this->_user->perfil);
            if ($perfilcode == 5) {   // es administrador del sistema
                return true;
            }
        }
        return false;         
    }
    
    function esJefeAdministracion()
    {
        $this->CargarUsuario(Yii::app()->user->id);
        $this->CargarPersona($this->_user->registro);
        if ($this->_user != null) {
            $perfilcode = intval($this->_user->perfil);
            if (($perfilcode == 5 || $perfilcode == 2) && $this->_persona->cod_uuoo == Yii::app()->params->defaultArea) {   // es administrador del sistema
                return true;
            }
        }
        return false;         
    }
    
    function esGestionarVisible()
    {
        $this->CargarUsuario(Yii::app()->user->id);  
        $this->CargarPersona($this->_user->registro);
        if($this->_persona->cod_uuoo == Yii::app()->params->defaultArea) {
            return true;
        } else {
            return false;
        }
    }
    
    function puedenAtender()
    {
        return Persona::getUsuariosFromArea();
    }
    
    function tieneFullAcceso()
    {
        if(Yii::app()->params->currentWebMaster == Yii::app()->user->id ||
           Yii::app()->params->currentJefeAdministracion == Yii::app()->user->id)
        { return true; } else { return false; }
    }
    
    
    // get LoggedUser Information
    function getUserReg() {
        $this->CargarUsuario(Yii::app()->user->id);  
        return $this->_user->registro;
    }
    function getUserArea() {
        $this->CargarUsuario(Yii::app()->user->id);  
        return $this->_user->area;
    }
    function getUserMail() {
        $this->CargarUsuario(Yii::app()->user->id);  
        $this->CargarPersona($this->_user->registro);
        return $this->_persona->nom_correo;
    }
    function getUserFullName() {
        $this->CargarUsuario(Yii::app()->user->id);
        return $this->_user->usuariofullname;
    }
    
    function getUserAnexo() {
        $this->CargarUsuario(Yii::app()->user->id);  
        $this->CargarPersona($this->_user->registro);
        return $this->_persona->num_anexo;
    }
    
    function getUserCategoriasDisponibles() {
        $this->CargarUsuario(Yii::app()->user->id);
        switch ($this->_user->area) {
            case Yii::app()->params->defaultArea : return 'Interno'; break;
            default : return 'Externo';
        }
    }
    
    function getUserInterno() {
        $this->CargarUsuario(Yii::app()->user->id);
        if ($this->_user->area == Yii::app()->params->defaultArea) {
            return Yii::app()->user->id;
        } else {
            return null;
        }
    }
    
    function getUserModel() {
        $this->CargarUsuario(Yii::app()->user->id);  
        if ($this->_user != null) {
            return $this->_user;
        } else {
            return null;
        }
    }
    
    function getUserPicPath() {
        $this->CargarUsuario(Yii::app()->user->id);  
        if ($this->_user != null) {
            $fotofile = $this->_user->registro . ".jpg";

            $validpic = Yii::app()->params->currentFotoPath . $fotofile;
            $notvalid = Yii::app()->params->currentFotoPath . "sinfoto.jpg";

            if (file_exists($validpic))
                return $validpic;
            else
                return $notvalid;
        }
    }
    
    function esGestionVisible()
    {
        
    }
    
    function esConfiguracionVisible()
    {
        
    }
    


    
}
?>
