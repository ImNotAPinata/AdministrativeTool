<?php
Yii::app()->clientScript->registerScript('search', "
$.ajaxSetup({   
    error: function(xhr, status, error) 
    {     
       alert('Un error occurío: ' + status + '. Comuniquese con el Administrador del Sistema. Error: ' + error + ' Response Text:' + xhr.responseText);   
    }       
}); 
$('#title').click(function(){
	$('.search-form').toggle();
	return false;
});

$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('solicitud-grid', {
                data: $(this).serialize()
	});
	return false;
});

// *************** OPTIONS ********************

var firstView = false;
var firstOption = false;

$('#listForm').live('change',function(){
    $('#loadingAnimation').toggle(); 
    var selectedSolicitud = $('#selected').val(); 
    var selectedOption = $('#listForm').val();

    var url = '" . Yii::app()->createUrl("atencion/solicitud/atender/redirect/id") . "'+'/'+selectedOption+'/solicitud/'+selectedSolicitud;
    var request = $.ajax({ url: url,
                           cache: false
                  });
                  
    request.success(function(data){
        var obj = $.parseJSON(data);
        window.location.href=obj.redirect; 
    });
                  
});

");
?>

<?php
$this->widget('bootstrap.widgets.TbAlert', array(
    'block' => true, // display a larger alert block?
    'fade' => true, // use transitions?
    'closeText' => '&times;', // close link text - if set to false, no close link is displayed
    'alerts' => array(// configurations per alert type
        'success' => array('block' => true, 'fade' => true, 'closeText' => '&times;'), // success, info, warning, error or danger
        'error' => array('block' => true, 'fade' => true, 'closeText' => '&times;'),
        'info' => array('block' => true, 'fade' => true, 'closeText' => '&times;'),
        'warning' => array('block' => true, 'fade' => true, 'closeText' => '&times;'),
    ),
    'htmlOptions' => array('id' => 'alertMessage'),
));
?>

<h1 id="title" style="cursor: default" title="Clic para abrir/ocultar opciones de búsqueda avanzada" >Atender Solicitudes</h1>
<div class="search-form" style="display:visible">
<?php $this->renderPartial('_search', array('solicitud' => $solicitud,)); ?>
</div><!-- search-form -->

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'solicitud-grid',
    'dataProvider' => $solicitud->pedidosEsDesignado(),
    'type' => 'condensed bordered',
    'nullDisplay' => ' - ',
    'columns' => array(
        array(
            'name'=>'N°',
            'type' => 'raw',
            'value' => '$data->customcod',
            'htmlOptions' => array('width' => '40px'),
        ),
        array(
            'name' => 'Solicitante',
            'type' => 'raw',
            'value' => 'F_String::getUpperStartedLowerFollowedWord($data->des_nom_solicitante)',
            'htmlOptions' => array('width' => '135px'),
        ),
        array(
            'name' => 'Proceso',
            'type' => 'raw',
            'value' => '$data->proceso->des_descripcion',
            'htmlOptions' => array('width' => '50px'),
        ),
        'des_descripcion',
        array(
            'name' => 'Prioridad',
            'type' => 'raw',
            'value' => 'F_Css::getPrioridadLabel($data->cod_prioridad)',
            'htmlOptions' => array('width' => '50px'),
        ),
        array(
            'name' => 'Estado',
            'type' => 'raw',
            'value' => '$data->estado',
            'htmlOptions' => array('width' => '50px'),
        ),
        array(
            'name' => 'fec_registro',
            'type' => 'raw',
            'value' => '$data->fec_registro',
            'htmlOptions' => array('width' => '74px'),
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{view}{update}',
            'updateButtonIcon' => 'edit',
            'htmlOptions' => array('width' => '10'),
            'headerHtmlOptions' => array('width' => '10'),
            'buttons' => array(
                'update' => array
                    (
                    'label' => 'Atender Pedido',
                    'url' => 'Yii::app()->createUrl("atencion/solicitud/atender/option", array("id"=>$data->pk_solicitud))',
                    'options' => array('data-target' => '#viewOptionModal'),
                    'click' => 'function(){
                                                $("#loadingOptionAnimation").toggle();
                                                var optionurl = $(this).attr("href")+"/render/"+firstOption;
                                                var request = $.ajax({ 
                                                    url: optionurl,
                                                    cache: false
                                                });
                                                
                                                request.done(function(response) {
                                                    $("#currentOption").empty();
                                                    $("#viewOptionModal").modal("show");
                                                    $("#currentOption").append(response);
                                                    $("#loadingOptionAnimation").toggle();
                                                    firstOption = true;
                                                });
                                                return false;
                                                }',
                ),
                'view' => array
                    (
                    'label' => 'Ver Movimientos',
                    'url' => 'Yii::app()->createUrl("atencion/solicitud/tramite/view", array("id"=>$data->pk_solicitud))',
                    'options' => array('data-target' => '#viewMovimientoModal'),
                    'click' => 'function(){
                                                $("#loadingMovimientoAnimation").toggle(); 
                                                var viewurl = $(this).attr("href")+"/render/"+firstView;
                                                var request = $.ajax({ 
                                                    url: viewurl,
                                                    cache: false
                                                });
                                                
                                                request.done(function(response) {
                                                    $("#currentMovimiento").empty();
                                                    $("#viewMovimientoModal").modal("show");
                                                    $("#currentMovimiento").append(response); 
                                                    $("#loadingMovimientoAnimation").toggle(); 
                                                    firstView = true;
                                                });
                                                return false;
                                                }',
                ),
            )
        ),
    ),
));
?>

<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'viewOptionModal')); ?>
<div id="loadingOptionAnimation" class="grid-view-loading" style="display: none"><br/>cargando...</div>
<div id="currentOption">
    <!--//contenido de la consulta ajax-->
</div> 
<?php $this->endWidget(); ?>


<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'viewMovimientoModal')); ?>
<div id="loadingMovimientoAnimation" class="grid-view-loading" style="display: none"><br/>cargando...</div>
<div id="currentMovimiento">
    <!--//contenido de la consulta ajax-->
</div> 
<?php $this->endWidget(); ?>