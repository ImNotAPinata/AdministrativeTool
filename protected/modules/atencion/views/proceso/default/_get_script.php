<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

Yii::app()->clientScript->registerScript('default'," 
    
// coge todos los errores que ocurran con consultas ajax

$.ajaxSetup({   
    error: function(xhr, status, error) 
    {     
       alert('Aviso: ' + xhr.responseText + ' Comúniquese con el Administrador del Sistema. || debugInfo: ' + error );  
    }       
}); 


// ***************ALL FORMS*******************

$('#opallow').live('click',function(e){
    $('#allowPerson').toggle();
    $('#opsave').attr('checked',false) ;
});

$('#opsave').live('click',function(e){
    $('#allowPerson').css('display', 'none'); 
    $('#opallow').attr('checked',false) ;
});

$('#submitForm').live('click',function(e){
    if($('#opsave').is(':checked')){
        if(!confirm('Se notificará al solicitante que ya termino la atención de su pedido.  '+
                    '¿Dar por finalizada la solicitud?'))
        { return false; }
    }
});

");
?>

<?php $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
            'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'),
            'info'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'),
            'warning'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'),
        ),
        'htmlOptions'=>array('id'=>'alertMessage'),
)); ?>