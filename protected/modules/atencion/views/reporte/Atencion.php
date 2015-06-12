<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
Yii::app()->clientScript->registerScript('reportsearch', "
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
<h1 id="title" style="cursor: default" title="Clic para abrir/ocultar opciones de filtrado avanzado" >Efectividad de Atención</h1>
<div class="search-form" style="display:visible">
    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                    'id' => 'report-atencion',
                    'action' => Yii::app()->createUrl($this->route),
                    'method' => 'get',
                        ));
    ?>
    
    
    <div class="row">
        <div class="span3">
            <?php echo $form->label($solicitud, 'des_nom_solicitante', array('required' => false)); ?>
            <?php echo $form->textField($solicitud, 'des_nom_solicitante', array('class' => 'span3', 'maxlength' => 50)); ?>
        </div>
        <div class="span4">
            <?php echo $form->dropDownListRow($solicitud, 'des_area_solicitante', EArea::getAreaArray(), array('class' => 'span4', 'empty' => 'Elegir..')); ?>
        </div><div class="span4">
            <?php echo $form->dropDownListRow($solicitud, 'report_formato', ETipoAtencion::getTipoAtencionArray(), array('class' => 'span4')); ?>
        </div>
    </div>
    
    <div class="row">
        <div class="span3">
            <?php echo $form->label($solicitud, 'des_descripcion', array('required' => false)); ?>
            <?php echo $form->textField($solicitud, 'des_descripcion', array('class' => 'span3', 'maxlength' => 50)); ?>
        </div>
        <div class="span2" >
            <?php echo chtml::label('Desde', ''); ?>
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'language'=>'es',
                'model' => $solicitud,
                'attribute' => 'report_fdesde',
                'options' => array('changeYear' => true, 'yearRange' => '1950:2050','dateFormat' => 'yy-mm-dd'),
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
                'language'=>'es',
                'options' => array('changeYear' => true, 'yearRange' => '1950:2050','dateFormat' => 'yy-mm-dd'),
                'model' => $solicitud,
                'attribute' => 'report_fhasta',
                'htmlOptions' => array(
                    'class' => 'span2',
                    'style' => 'height:20px;',
                ),
            ));
            ?>     
        </div>
        <div class="span2">
                <?php echo $form->label($solicitud, 'cod_estado'); ?>
                <?php echo $form->dropDownList($solicitud, 'cod_estado', EEstadoSolicitud::getEstadoSolicitudArray(), array('class' => 'span2', 'maxlength' => 50, 'empty' => 'Elegir...')); ?>
        </div><div class="span2">   
                <?php echo $form->label($solicitud, 'fk_proceso',array('required'=>false)); ?>
                <?php echo $form->dropDownList($solicitud, 'fk_proceso', CHtml::listData(Proceso::Load(), 'pk_proceso', 'des_descripcion', 'des_proceso'), array('class' => 'span2','empty' => 'Elegir...')); ?>
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
	'dataProvider'=>$solicitud->report_DiasAtencion(),
        'type'=>'condensed bordered',
        'nullDisplay'=>' - ',
        //'filter'=>$model,
	'columns'=>array(
                array(
                      'name'=>'N°',
                      'type' => 'raw',
                      'value'=>'$data->customcod',
                      'htmlOptions' => array('width' => '50px'),
                ),
                array(
                    'name' => 'Solicitante',
                    'type' => 'raw',
                    'value' => 'F_String::getUpperStartedLowerFollowedWord($data->des_nom_solicitante)',
                    'htmlOptions' => array('width' => '135px'),
                ),
                'des_area_solicitante',
                'des_descripcion',
                array(
                      'name'=>'Proceso',
                      'type' => 'raw',
                      'value'=>'$data->proceso->des_descripcion',
                      'htmlOptions'=>array('width'=>'45px'),
                ),
                array(
                      'name'=>'Estado',
                      'type' => 'raw',
                      'value'=>'$data->estado',
                      'htmlOptions'=>array('width'=>'50px'),
                ),
                array(
                    'name' => 'fec_registro',
                    'type' => 'raw',
                    'value' => '$data->fec_registro',
                    'htmlOptions' => array('width' => '74px'),
                ),
                array(
                      'name'=> 'Demora',
                      'type' => 'raw',
                      'value'=>'$data->report_fdemora',
                      'htmlOptions'=>array('width'=>'50px'),
                ),
	),
)); 
 
?>