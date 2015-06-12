<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'form',
        'type'=>'horizontal',
        'enableAjaxValidation'=>false,
)); ?>
        <p class="help-block">Campos con <span class="required">*</span> son requeridos.</p><br/>
        
	<fieldset>
        <legend></legend>
	<?php echo $form->errorSummary($solicitud); ?>
        
    	<div class="row">
            <div class="span7">
                <?php echo $form->dropDownListRow($solicitud, 'fk_categoria', 
                                                  CHtml::listData(Categoria::Load(), 'pk_categoria', 'des_descripcion', 'des_categoria'),
                                                  array('disabled'=> $solicitud->isNewRecord ? false : true,
                                                        'class' => 'span7', 
                                                        'maxlength' => 50, 
                                                        'id' => 'categoria',
                                                        'empty'=>'Elegir..')); ?>
            </div>
        </div>
        <div class="row">
            <div class="span7">
        <?php echo $form->textAreaRow($solicitud,'des_descripcion', array('class'=>'span7', 'rows'=>5,'title'=>'Ingrese el detalle de la solicitud')); ?>
            </div>
        </div>

	<div class="form-actions">
                <?php echo chtml::hiddenfield('esaccion', null ,array('id'=>'esaccion')); ?>
		<?php $this->widget('bootstrap.widgets.TbButton', array(
                        'id'=>'submitbutton',
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$solicitud->isNewRecord ? 'Solicitar' : 'Actualizar',
		)); ?>
	</div>
        </fieldset>

<?php $this->endWidget(); ?>
