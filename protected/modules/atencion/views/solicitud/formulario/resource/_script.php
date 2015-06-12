<?php
Yii::app()->clientScript->registerScript('loader', "
$.ajaxSetup({   
    error: function(xhr, status, error) 
    {     
       alert('Un error occurío: ' + status + '. Comuniquese con el Administrador del Sistema. Error: ' + error + ' Response Text:' + xhr.responseText);   
    }       
}); 

$('#categoria').change(function(){
    var selectedCategoria = $('#categoria').val();
    
    var url = '".Yii::app()->createUrl("atencion/solicitud/formulario/resource/create")."';
    var request = $.ajax({ url: url,
                           type: 'post',
                           data: {'id' : selectedCategoria},
                           cache: false
                  });
                  
    request.success(function(data){
        var obj = $.parseJSON(data);
        window.location.href=obj.path;
    });         
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
