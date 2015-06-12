<?php

$this->menu=array(
	array('label'=>'Mis Solicitudes','icon'=>'book','url'=>array('..\personal\\')),
        array('label'=>'Atender Solicitudes','icon'=>'book','url'=>array('..\atender\\'),'visible'=>Yii::app()->user->esAtenderVisible()),
        array('label'=>'Aprobar Solicitudes','icon'=>'book','url'=>array('..\aprobar\\'),'visible'=>Yii::app()->user->esAdministrador()),
);

Yii::app()->clientScript->registerScript('create', "
$.ajaxSetup({   
    error: function(xhr, status, error) 
    {     
       alert('Un error occurío: ' + status + '. Comuniquese con el Administrador del Sistema. Error: ' + error + ' Response Text:' + xhr.responseText);   
    }       
}); 

$('#categoria').live('change',function(){
    var selectedCategoria = $('#categoria').val();
    $('#solicitud').empty();
    
    var url = '".Yii::app()->createUrl("atencion/solicitud/formulario/form")."';
    var request = $.ajax({ url: url,
                           type: 'post',
                           data: {'id' : selectedCategoria, 'path':'".$_GET['path']."'},
                           cache: false
                  });
                  
    request.success(function(data){
        var obj = $.parseJSON(data);
        window.location.href=obj.redirect; 
    });         
});

");
?>