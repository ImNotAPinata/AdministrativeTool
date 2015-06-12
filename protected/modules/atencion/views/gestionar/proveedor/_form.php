<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'proveedor-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Los campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'des_identificacion',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'des_ruc',array('class'=>'span5','maxlength'=>30)); ?>
        
        <?php echo $form->textFieldRow($model,'des_descripcion',array('class'=>'span5','maxlength'=>100)); ?>
        
	<?php echo $form->textFieldRow($model,'des_direccion',array('class'=>'span5','maxlength'=>150)); ?>

	<?php echo $form->textFieldRow($model,'des_telefono_1',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'des_telefono_2',array('class'=>'span5','maxlength'=>50)); ?>

        <?php echo $form->textFieldRow($model,'des_fax',array('class'=>'span5','maxlength'=>50)); ?>
        
	<?php echo $form->textFieldRow($model,'des_celular',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'des_RPM',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'des_RPC',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'des_contacto_1',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'des_contacto_2',array('class'=>'span5','maxlength'=>100)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Crear' : 'Actualizar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
