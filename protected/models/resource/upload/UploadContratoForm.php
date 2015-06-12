<?php

class UploadContratoForm extends CFormModel {
    
    public $doc_name;
    public $split_info;
    public $cod_estado;
    public $archivo;
 
    public function rules() {
        return array(
            array('archivo', 'file', 'types' => 'htm,html,rtf,txt'),
            array('split_info,archivo,cod_estado,doc_name','safe'),
        );
    }
}

?>
