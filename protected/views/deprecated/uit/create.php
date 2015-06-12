<?php $this->renderPartial('option\_loader',true); ?>
<?php 

Yii::app()->clientScript->registerScript('search', "
$.ajaxSetup({   
    error: function(xhr, status, error) 
    {     
       alert('Un error occurío: ' + status + '. Comuniquese con el Administrador del Sistema. Error: ' + error + ' Response Text:' + xhr.responseText);   
    }       
}); 


$('#persona-grid table tbody tr').live('click',function(e) 
{ 
        var reg=$(this).children(':nth-child(1)').text(); 
        var name=$(this).children(':nth-child(2)').text()+', '+$(this).children(':nth-child(3)').text(); 
        var area=$(this).children(':nth-child(4)').text(); 
        
        $('#solreg').val(reg);
        $('#solname').val(name);
        $('#solarea').val(area);
        $('#FindPersonalModal').modal('hide');
}); 

");
?>

<h1>Crear Solicitud</h1>

<?php echo $this->renderPartial('uit\_formuit', array('solicitud' => $solicitud, 'uit' => $uit)); ?>

<?php echo $this->renderPartial('..\..\emergente\_getpersonal', array('persona' => $persona)); ?>
