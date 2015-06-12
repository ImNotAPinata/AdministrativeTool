<?php

$this->menu=array(
	array('label'=>'Mis Solicitudes','icon'=>'book','url'=>array('..\registrar\\')),
        array('label'=>'Atender Solicitudes','icon'=>'book','url'=>array('..\atender\\')),
        array('label'=>'Aprobar Solicitudes','icon'=>'book','url'=>array('..\aprobar\\')),
);

// el antiguo
// alert('Un error occurío: ' + status + '. Comuniquese con el Administrador del Sistema. Error: ' + error + ' Response Text:' + xhr.responseText);         
// para abrir en tab ( previa configuracion del IE )
// $(this).target = '_blank';         
// window.open($(this).prop('href')); 
// window.focus();

Yii::app()->clientScript->registerScript('forms'," 
    
// coge todos los errores que ocurran con consultas ajax

$.ajaxSetup({   
    error: function(xhr, status, error) 
    {     
       alert('Aviso: ' + xhr.responseText + ' Comúniquese con el Administrador del Sistema. || debugInfo: ' + error );  
    }       
}); 

var UitScriptRendered = true;

// ***************FORM LOADING*******************

//.ready(function(){});


$('#listForm').change(function(){
    $('#loadingAnimation').toggle(); 
    var selected = $('#listForm').val();
    switch(selected)
    {
        case '1': callFormDefault();break;
        case '2': callFormUit(selected);break;
        default:  $('#contentForm').empty(); $('#loadingAnimation').toggle(); 
    }
});

function callFormUit(selected)
{   
    var uiturl = '".Yii::app()->createUrl("atencion/solicitud/atender/formuit/id/$sid/render")."';
    var url = uiturl+'/'+UitScriptRendered+'/doc/'+selected;
    var request = $.ajax({ url: url,
                           cache: false
                  });
                  
    request.done(function(response) {
        $('#contentForm').empty();
        $('#contentForm').append(response); 
        $('#loadingAnimation').toggle(); 
        UitScriptRendered = false;
    });
}

function callFormDefault()
{
    var request = $.ajax({ url: '".Yii::app()->createUrl("atencion/solicitud/atender/formdefault/id/$sid")."',
                           cache: false
                  });
                  
    request.done(function(response) {
        $('#contentForm').empty();
        $('#contentForm').append(response);
        $('#loadingAnimation').toggle(); 
    });
}

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

// ***************FORM UIT*******************

$('#uit_fsiged').live('click',function(e){
    $('#uit_fsiged').datepicker(jQuery.extend({showMonthAfterYear:false}, jQuery.datepicker.regional['es'], {'changeYear':true})).focus(); 
});

$('#AddBien').live('click',function(){
        var data = $('#uit-form').serialize()+'&&'+$('#bienuit-form').serialize(); // serializo la informacion en una sola variable
        var request = $.ajax({ 
                           url: '".Yii::app()->createUrl("atencion/solicitud/atender/formuit/id/$sid")."',
                           type: 'POST',
                           data: data,
                  });
        
        request.done(function(response) {
            $('#contentForm').empty();
            $('#contentForm').append(response); 
        });
        $('#bienuit-form').each (function(){ this.reset(); }); // limpiamos formulario
        $('#SUITModal').modal('hide');
        return false;
});

$('#bienesuit-grid a.delete').live('click',function(){
               var request = $.ajax({ 
                           url: $(this).attr('href'),
                           type: 'POST',
                           data: $('#uit-form').serialize(),
                  });
        
        request.done(function(response) {
            $('#contentForm').empty();
            $('#contentForm').append(response); 
        });
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

<?php $this->widget('bootstrap.widgets.TbTabs', array(
    'type'=>'tabs', // 'tabs' or 'pills'
    'tabs'=>array(
        array('label'=>'Atencion', 'content'=>$this->renderPartial('_formTab1', array('tramite'=>$tramite,'solicitud'=>$solicitud,'registro'=>$registro),true,false), 'active'=>true),
        array('label'=>'Movimientos', 'content'=>$this->renderPartial('_formTab2', array('tramite'=>$tramite,'solicitud'=>$solicitud),true,false)),
        array('label'=>'Solicitud', 'content'=>$this->renderPartial('_formTab3', array('tramite'=>$tramite,'solicitud'=>$solicitud),true,false)),
        
  ),
)); ?>
<!-- DialogOptionWindow -->
<?php echo $this->renderPartial('_devolver', array('tramite'=>$tramite)); ?>
<?php echo $this->renderPartial('_rechazar', array('tramite'=>$tramite)); ?>