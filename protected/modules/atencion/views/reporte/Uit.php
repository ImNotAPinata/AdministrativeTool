<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
Yii::app()->clientScript->registerScript('reportpendiente', "
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
        $.fn.yiiGridView.update('reportuit-grid', {
                data: $(this).serialize()
	});
	return false;
});

");
?>

<h1 id="title" style="cursor: default" title="Clic para abrir/ocultar opciones de filtrado avanzado" >UIT</h1>
<div class="search-form" style="display:visible">
    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                    'id' => 'report-uit',
                    'action' => Yii::app()->createUrl($this->route),
                    'method' => 'get',
                    ));
    ?>
    
    <div class="row">
        <div class="span3">
            <?php echo $form->label($uit, 'des_nombre_solicitante', array('required' => false)); ?>
            <?php echo $form->textField($uit, 'des_nombre_solicitante', array('class' => 'span3', 'maxlength' => 50)); ?>
        </div><div class="span4">
            <?php echo $form->label($uit, 'des_area_solicitante', array('required' => false)); ?>
            <?php echo $form->dropDownList($uit, 'des_area_solicitante', EArea::getAreaArray(), array('class' => 'span4', 'empty' => 'Elegir..')); ?>
        </div><div class="span4">
            <?php echo $form->dropDownListRow($uit, 'cod_uit_estado', EEstadoUit::getEstadoUitArray(), array('class' => 'span4', 'empty' => 'Elegir..')); ?>
        </div>
    </div>
    
    <div class="row">
        <div class="span3">
            <?php echo $form->label($uit, 'num_uit_siged', array('required' => false)); ?>
            <?php echo $form->textField($uit, 'num_uit_siged', array('class' => 'span3', 'maxlength' => 50)); ?>
        </div>
         <div class="span2">
            <?php echo $form->label($uit, 'des_uit_descripcion', array('required' => false)); ?>
            <?php echo $form->textField($uit, 'des_uit_descripcion', array('class' => 'span2', 'maxlength' => 200)); ?>
        </div>
        <div class="span2">
            <?php echo $form->dropDownListRow($uit, 'cod_uit_tipo', ETipoUIT::getTipoUitArray(), array('class' => 'span2', 'empty' => 'Elegir..')); ?>
        </div>
        <div class="span2">
            <?php echo chtml::label('Desde', ''); ?>
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'language' => 'es',
                'model' => $uit,
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
                'model' => $uit,
                'attribute' => 'report_fhasta',
                'htmlOptions' => array(
                    'class' => 'span2',
                    'style' => 'height:20px;',
                ),
            ));
            ?>     
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
	'id'=>'reportuit-grid',
	'dataProvider'=>$uit->report_uit(),
        'type'=>'condensed bordered',
        'nullDisplay'=>' - ',
        'columns' => array(
                array(
                    'name' => 'N°',
                    'type' => 'raw',
                    'value' => '$data->customcod',
                    'htmlOptions' => array('width' => '30px'),
                ),
                array(
                    'name' => 'Solicitante',
                    'type' => 'raw',
                    'value' => '$data->des_nombre_solicitante',
                    'htmlOptions' => array('width' => '80px'),
                ),
                array(
                    'name' => 'Area',
                    'type' => 'raw',
                    'value' => '$data->des_area_solicitante',
                    'htmlOptions' => array('width' => '30px'),
                ),
                array(
                    'name' => 'Proyectado por',
                    'type' => 'raw',
                    'value' => '$data->des_proyectado_por',
                    'htmlOptions' => array('width' => '30px'),
                ),
                array(
                    'name' => 'Número de Siged',
                    'type' => 'raw',
                    'value' => '$data->num_uit_siged',
                    'htmlOptions' => array('width' => '50px'),
                ),
                array(
                    'name' => 'Descripción de Uit',
                    'type' => 'raw',
                    'value' => '$data->des_uit_descripcion',
                ),
                array(
                    'name' => 'Estado de la Uit',
                    'type' => 'raw',
                    'value' => 'EEstadoUit::getEspecificEstadoUitArray($data->cod_uit_estado)',
                    'htmlOptions' => array('width' => '50px'),
                ),
                array(
                    'name' => 'Tipo de la Uit',
                    'type' => 'raw',
                    'value' => 'ETipoUIT::getEspecificTipoUitArray($data->cod_uit_tipo)',
                    'htmlOptions' => array('width' => '50px'),
                ),
                array(
                    'name' => 'Importe Total',
                    'type' => 'raw',
                    'value' => 'F_Number::FormatoNumeroDecimal($data->report_pimporte)',
                    'htmlOptions' => array('width' => '50px'),
                ),
                array(
                    'name' => 'Porcentaje de Avance',
                    'type' => 'raw',
                    'value' => '$data->PorcentajeAvanceUit',
                    'htmlOptions' => array('width' => '50px'),
                ),
                array(
                    'name' => 'Importe de Facturas',
                    'type' => 'raw',
                    'value' => 'F_Number::FormatoNumeroDecimal($data->report_fimporte)',
                    'htmlOptions' => array('width' => '50px'),
                ),
                array(
                    'name' => 'Saldo',
                    'type' => 'raw',
                    'value' => '$data->SaldoDisponible',
                    'htmlOptions' => array('width' => '50px'),
                ),
    ),
)); 
 
?>