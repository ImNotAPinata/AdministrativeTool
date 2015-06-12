<?php

Yii::app()->clientScript->registerScript('uit'," 
$.ajaxSetup({   
    error: function(xhr, status, error) 
    {     
       alert('Aviso: ' + xhr.responseText + ' Comúniquese con el Administrador del Sistema. || debugInfo: ' + error );  
    }       
}); 

// ***************ALL FORMS*******************

$('#submitForm').live('click',function(e){
    if($('#opsave').is(':checked')){
        if(!confirm('Se notificará al solicitante que ya termino la atención de su pedido.  '+
                    '¿Dar por finalizada la solicitud?'))
        { return false; }
    }
});

// **************PROVEEDOR********************

$('#uit_tipo').change('click',function(){
        $('#operation').val('tipechange');
        $('#uit-form').submit();
        
        $('#operation').val('');
        return false;
});

$('#AddProveedor').live('click',function(){
        $('#operation').val('addproveedor');
        $('#uit-form').submit();
        
        $('#proveedoruit-grid table tbody tr').attr('class','odd'); // quitamos la seleccion del grid
        $('#ProveedorUitModal').modal('hide');
        $('#operation').val('');
        return false;
});

$('#proveedores-grid a.delete').live('click',function(){
        if(confirm('¿Esta seguro de dar de baja a este proveedor?')){
            $('#operation').val('removeproveedor');
            var object = $(this).attr('itemid');
            $('#item').val(object);
            $('#uit-form').submit();
            $('#operation').val('');
            $('#item').val('');
        }
        return false;
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