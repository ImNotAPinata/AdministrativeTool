<?php

Yii::app()->clientScript->registerScript('search', "
$.ajaxSetup({   
    error: function(xhr, status, error) 
    {     
       alert('Un error occurío: ' + status + '. Comuniquese con el Administrador del Sistema. Error: ' + error + ' Response Text:' + xhr.responseText);   
    }       
}); 

var firstView = false;

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

<div class="row">
    <div class="span-20">
        <h1 id="title" style="cursor: default" title="Clic para abrir/ocultar opciones de búsqueda avanzada" >Mis Solicitudes</h1>
    </div>
</div>
<div class="search-form" style="display:visible">
<?php $this->renderPartial('_search',array( 'solicitud'=>$solicitud,)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'solicitud-grid',
	'dataProvider'=>$solicitud->misPedidos(),
        'type'=>'condensed bordered',
        'nullDisplay'=>' - ',
        //'filter'=>$model,
	'columns'=>array(
                array(
                      'name'=>'N°',
                      'type' => 'raw',
                      'value'=>'$data->customcod',
                      'htmlOptions' => array('width' => '40px'),
                ),
                array(
                      'name'=>'Proceso',
                      'type' => 'raw',
                      'value'=>'$data->proceso->des_descripcion',
                      'htmlOptions'=>array('width'=>'45px'),
                ),
                'des_descripcion',
                /*array(
                      'name'=>'Proceso General',
                      'type' => 'raw',
                      'value'=>'$data->proceso->des_proceso',
                      'htmlOptions'=>array('width'=>'45px'),
                ),*/
		array(
                      'name'=>'Estado',
                      'type' => 'raw',
                      'value'=>'$data->estado',
                      'htmlOptions'=>array('width'=>'50px'),
                ),
                array(
                      'name'=>'fec_registro',
                      'type' => 'raw',
                      'value'=>'$data->fec_registro',
                      'htmlOptions'=>array('width'=>'80px'),
                ),
                /*'estado',*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
                        'template'=>'{view}{update}',
                        'htmlOptions'=>array('width'=>'10'),
                        'headerHtmlOptions'=>array('width'=>'10'),
                        'buttons' => array(
                             'update' => array
                                (
                                    'label'=>'Editar Pedido',
                                    'url'=>'Yii::app()->createUrl("atencion/solicitud/formulario/resource/update", array("id"=>$data->pk_solicitud))',
                                    'visible'=>'$data->cod_estado==EEstadoSolicitud::AModificar', 
                                    'click'=>'function(){
                                                var editurl = $(this).attr("href");
                                                var request = $.ajax({ 
                                                    url: editurl,
                                                    cache: false
                                                });
                                                
                                                request.success(function(data) {
                                                    var obj = $.parseJSON(data);
                                                    window.location.href=obj.path;
                                                });
                                                return false;
                                                }',  
                                ),
                             'view' => array
                                (
                                    'label'=>'Ver Movimientos',
                                    'url'=>'Yii::app()->createUrl("atencion/solicitud/tramite/view", array("id"=>$data->pk_solicitud))',
                                    'options'=>array('data-target'=>'#viewMovimientoModal'),    
                                    'click'=>'function(){
                                                $("#loadingAnimation").toggle(); 
                                                var viewurl = $(this).attr("href")+"/render/"+firstView;
                                                var request = $.ajax({ 
                                                    url: viewurl,
                                                    cache: false
                                                });
                                                
                                                request.done(function(response) {
                                                    $("#currentMovimiento").empty();
                                                    $("#viewMovimientoModal").modal("show");
                                                    $("#currentMovimiento").append(response); 
                                                    $("#loadingAnimation").toggle(); 
                                                    firstView = true;
                                                });
                                                
                                                return false;
                                                }',   
                                ),
                        )
		),
	),
)); ?>

<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'viewMovimientoModal')); ?>
<div id="loadingAnimation" class="grid-view-loading" style="display: none"><br/>cargando...</div>
<div id="currentMovimiento">
    <!--//contenido de la consulta ajax-->
</div> 
<?php $this->endWidget(); ?>

