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

var firstView = false; // o esto o copiar el codigo generado al principio je

$('#atenderOption').click(function(){
	var selected = $.fn.yiiGridView.getChecked('solicitud-grid','solicitud-grid_c8');
        if(selected.length>0)
        {
            $('#selectedAtendidos').val(selected);
        }
        else
        {
            alert('Seleccione las solicitudes a aprobar!');
            return false;
        }
});

$('#designarOption').click(function(){
	var selected = $.fn.yiiGridView.getChecked('solicitud-grid','solicitud-grid_c8');
        if(selected.length>0)
        {
            $('#selectedDesignados').val(selected);
        }
        else
        {
            alert('Seleccione las solicitudes a aprobar!');
            return false;
        }
});

$('#rechazarOption').click(function(){
        var selected = $.fn.yiiGridView.getChecked('solicitud-grid','solicitud-grid_c8');
        if(selected.length>0)
        {
            $('#selectedRechazados').val(selected);
        }
        else
        {
            alert('Seleccione las solicitudes a rechazar!');
            return false;
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

<h1 id="title" style="cursor: default" title="Clic para abrir/ocultar opciones de búsqueda avanzada" >Aprobar Solicitudes</h1>
<div class="search-form" style="display:visible">
<?php $this->renderPartial('_search',array( 'solicitud'=>$solicitud,)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'solicitud-grid',
	'dataProvider'=>$solicitud->pedidosNoAprobados(),
	'nullDisplay'=>' - ',
        'type'=>'condensed bordered',
	'columns'=>array(
                array(
                      'name'=>'N°',
                      'type' => 'raw',
                      'value'=>'$data->customcod',
                      'htmlOptions'=>array('width'=>'40px'),
                ),
                array(
                    'name' => 'Solicitante',
                    'type' => 'raw',
                    'value' => 'F_String::getUpperStartedLowerFollowedWord($data->des_nom_solicitante)',
                    'htmlOptions' => array('width' => '135px'),
                ),
                'des_descripcion',
                'proceso.des_descripcion',
                'proceso.des_proceso',
		array(
                      'name'=>'Estado',
                      'type' => 'raw',
                      'value'=>'$data->estado',
                ),
                array(
                      'name'=>'fec_registro',
                      'type' => 'raw',
                      'value'=>'$data->fec_registro',
                      'htmlOptions'=>array('width'=>'80'),
                ),
                /*'estado',*/
                array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
                        'template'=>'{view}',
                        'htmlOptions'=>array('width'=>'10'),
                        'headerHtmlOptions'=>array('width'=>'10'),
                        'buttons' => array(
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
                                                    firstView = true;
                                                    $("#loadingAnimation").toggle(); 
                                                });
                                                
                                                return false;
                                                }',   
                                ),
                        )
		),
                array(
                        'class'=>'zii.widgets.grid.CCheckBoxColumn',
                        'selectableRows'=>2,
		),
                 
		
	),
)); 
?>

<?php echo $this->renderPartial('_atender', array('tramite'=>$tramite,'personal'=>$personal)); ?>
<?php echo $this->renderPartial('_designar', array('tramite'=>$tramite,'personal'=>$personal)); ?>
<?php echo $this->renderPartial('_rechazar', array('tramite'=>$tramite,'personal'=>$personal)); ?>

<div class="btn-toolbar">
    <?php $this->widget('bootstrap.widgets.TbButtonGroup', array(
        'type'=>'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'buttons'=>array(
            array('label'=>'Aprobar', 'items'=>array(
                array('label'=>'& atender',
                      'url'=>'#',
                      'linkOptions'=>array('id'=>'atenderOption',
                                           'data-toggle'=>'modal',
                                           'data-target'=>'#AtenderModal')),
                array('label'=>'& designar', 
                      'url'=>'#',
                      'linkOptions'=>array('id'=>'designarOption',
                                           'data-toggle'=>'modal',
                                           'data-target'=>'#DesignarModal')),
            )),
        ),
    )); ?>
    
    <?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Rechazar',
    'type'=>'danger',
    'htmlOptions'=>array(
        'id'=>'rechazarOption',
        'data-toggle'=>'modal',
        'data-target'=>'#RechazarModal',
    ),
    )); ?>
</div>

<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'viewMovimientoModal')); ?>
<div id="loadingAnimation" class="grid-view-loading" style="display: none"><br/>cargando...</div>
<div id="currentMovimiento">
    <!--//contenido de la consulta ajax-->
</div>
<?php $this->endWidget(); ?>

