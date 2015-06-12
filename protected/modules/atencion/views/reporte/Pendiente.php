<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
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
        $.fn.yiiGridView.update('efectividadatencion-grid', {
                data: $(this).serialize()
	});
	return false;
});
");
?>
<h1 id="title" style="cursor: default" title="Clic para abrir/ocultar opciones de filtrado avanzado" >Pendientes de Atención</h1>
<div class="search-form" style="display:visible">
    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                    'action' => Yii::app()->createUrl($this->route),
                    'method' => 'get',
                    ));
    ?>
    
    
    <div class="row">
        <div class="span4">
            <?php echo $form->label($tramite, 'nom_destinatario', array('required' => false)); ?>
            <?php echo $form->textField($tramite, 'nom_destinatario', array('class' => 'span4', 'maxlength' => 50)); ?>
        </div><div class="span2" >
            <?php echo chtml::label('Desde', ''); ?>
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'language' => 'es',
                'model' => $tramite,
                'attribute' => 'report_fdesde',
                'options' => array('changeYear' => true, 'yearRange' => '1950:2050', 'dateFormat' => 'yy-mm-dd'),
                'htmlOptions' => array(
                    'class' => 'span2',
                    'style' => 'height:20px;',
                ),
            ));
            ?>
        </div><div class="span2">
            <?php echo chtml::label('Hasta', ''); ?>
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'language' => 'es',
                'options' => array('changeYear' => true, 'yearRange' => '1950:2050', 'dateFormat' => 'yy-mm-dd'),
                'model' => $tramite,
                'attribute' => 'report_fhasta',
                'htmlOptions' => array(
                    'class' => 'span2',
                    'style' => 'height:20px;',
                ),
            ));
            ?>     
        </div>
        <div class="span3">   
            <?php echo $form->label($tramite, 'fk_movimiento', array('required' => false)); ?>
            <?php echo $form->dropDownList($tramite, 'fk_movimiento', EMovimiento::getMovimientosPendientes(), array('class' => 'span3', 'empty' => 'Elegir...')); ?>
        </div>
    </div>
    
    <div class="row"><br/>
        <div class="span9"><br/>
            <?php
            $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType' => 'submit',
                'type' => 'primary',
                'label' => 'Buscar',
            ));
            ?>
        </div>
        <div class="span2">
            <?php $pageSize = Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']); ?> 
            <?php echo chtml::label('Resultados x página', ''); ?>
            <?php
            echo CHtml::dropDownList('pageSize', $pageSize, array(10 => 10, 50 => 50, 100 => 100, 1000 => 1000), array(
                'onchange' => "$.fn.yiiGridView.update('efectividadatencion-grid',{ data:{pageSize: $(this).val() }})",
                'class' => 'span2'
            ));
            ?>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>

<?php 

    $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'efectividadatencion-grid',
	'dataProvider'=>$tramite->report_Pendientes(),
        'type'=>'condensed bordered',
        'nullDisplay'=>' - ',
        //'filter'=>$model,
	'columns'=>array(
                array(
                      'name'=>'N°',
                      'type' => 'raw',
                      'value'=>'$data->solicitud->customcod',
                      'htmlOptions' => array('width' => '50px'),
                ),
                array(
                    'name' => 'Solicitante',
                    'type' => 'raw',
                    'value' => 'F_String::getUpperStartedLowerFollowedWord($data->solicitud->des_nom_solicitante)',
                    'htmlOptions' => array('width' => '135px'),
                ),
                'solicitud.des_area_solicitante',
                'solicitud.des_descripcion',
                array(
                      'name'=>'Proceso',
                      'type' => 'raw',
                      'value'=>'$data->solicitud->proceso->des_descripcion',
                      'htmlOptions'=>array('width'=>'45px'),
                ),
                array(
                    'name' => 'Remitente',
                    'type' => 'raw',
                    'value' => 'F_String::getUpperStartedLowerFollowedWord($data->nom_remitente)',
                    'htmlOptions' => array('width' => '135px'),
                ),
                array(
                      'name'=>'Acción',
                      'type' => 'raw',
                      'value'=>'$data->movimiento->des_movimiento',
                      'htmlOptions'=>array('width'=>'85px'),
                ),
                array(
                    'name' => 'Ultimo designado',
                    'type' => 'raw',
                    'value' => 'F_String::getUpperStartedLowerFollowedWord($data->nom_destinatario)',
                    'htmlOptions' => array('width' => '135px'),
                ),
                array(
                      'name'=>'Estado',
                      'type' => 'raw',
                      'value'=>'$data->solicitud->estado',
                      'htmlOptions'=>array('width'=>'50px'),
                ),
                array(
                    'name' => 'fec_registro',
                    'type' => 'raw',
                    'value' => '$data->fec_registro',
                    'htmlOptions' => array('width' => '78px'),
                ),
	),
)); 
 
?>