<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'form',
        'type'=>'horizontal',
        //'action'=>Yii::app()->createUrl("atencion/solicitud/detalle/create/path/".$path),
	'enableAjaxValidation'=>false,
)); ?>
        <p class="help-block">Campos con <span class="required">*</span> son requeridos.</p><br/>
        
	<fieldset>
        <legend></legend>
	<?php echo $form->errorSummary($solicitud,$uit); ?>
        <div class="row">
            <div class="span7">
                <?php echo $form->dropDownListRow($solicitud, 'fk_categoria', 
                                                  CHtml::listData(Categoria::Load(), 'pk_categoria', 'des_descripcion', 'des_categoria'),
                                                  array('disabled'=> $solicitud->isNewRecord ? false : true,
                                                        'class' => 'span7', 
                                                        'maxlength' => 50, 
                                                        'id' => 'categoria',
                                                        'empty'=>'Elegir..')); ?>
                <?php echo $form->hiddenfield($solicitud, 'des_descripcion'); ?>
            </div>
        </div>
        <div class="row">
            <div class="span5">
                <?php echo $form->hiddenfield($uit, 'des_registro_solicitante',array('id'=>'solreg')); ?>
                <?php echo $form->textFieldRow($uit, 'des_nombre_solicitante', array('id'=>'solname','class' => 'span4')); ?>
            </div>
            <div class="span3">
                <?php echo $form->textFieldRow($uit, 'des_area_solicitante', array('id'=>'solarea','class' => 'span1')); ?>
            </div>
            <div class="span-1">
                <?php echo chtml::link('buscar','#',array('data-target'=>'#FindPersonalModal','data-toggle'=>'modal'));?>
            </div>
        </div>
        
        <div class="row">
            <div class="span7">
                <?php echo $form->textFieldRow($uit, 'num_uit_siged', array('class' => 'span7', 'maxlength' => 50)); ?>
            </div>
            <div class="span7">
                <?php echo $form->textAreaRow($uit, 'des_uit_descripcion', array('rows' => 6, 'cols' => 50, 'class' => 'span7')); ?>
            </div>
        </div>
        <div class="row">
            <div class="span2">
                <?php echo $form->labelEx($uit, 'fec_uit_siged',array('style'=>'text-align: right')); ?>
            </div>
            <div class="span3">
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'name' => 'uit_fsiged',
                    'model' => $uit,
                    'language' => 'es',
                    'options' => array('changeYear' => true, 'yearRange' => '1950:2050'),
                    'attribute' => 'fec_uit_siged',
                    'htmlOptions' => array(
                        'class' => 'span3',
                    ),
                ));
                ?>        
            </div>
            <div class="span2">
                <?php echo $form->textFieldRow($uit, 'num_uit_importe', array('class' => 'span2', 'maxlength' => 50)); ?>
            </div>
        </div>
        <div class="row">
            <div class="span2">
                <?php echo $form->labelEx($uit, 'des_proyectado_por',array('style'=>'text-align: right')); ?>
            </div>
            <div class="span3">
                <?php echo $form->dropDownList($uit,'des_proyectado_por', Persona::getResponsablesUIT(), array('class' => 'span3', 'maxlength' => 50, 'id' => 'listForm', 'empty' => 'Elegir..'));?>
            </div>
        </div>
        
	<div class="form-actions">
                <?php echo chtml::hiddenfield('esaccion', null,array('id'=>'esaccion')); ?>
		<?php $this->widget('bootstrap.widgets.TbButton', array(
                        'id'=>'submitbutton',
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$solicitud->isNewRecord ? 'Solicitar' : 'Actualizar',
		)); ?>
	</div>
        </fieldset>

<?php $this->endWidget(); ?>

<?php 
Yii::app()->clientScript->registerScript('formuit', "
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

<?php echo $this->renderPartial('..\..\emergente\_getpersonal', array('persona' => $persona)); ?>
