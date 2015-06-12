<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'patrimonial-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'codpatrimonial',array('class'=>'span5','maxlength'=>12)); ?>

	<?php echo $form->textFieldRow($model,'codanterior',array('class'=>'span5','maxlength'=>12)); ?>

	<?php echo $form->textFieldRow($model,'descripcion',array('class'=>'span5','maxlength'=>120)); ?>

	<?php echo $form->textFieldRow($model,'marca',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'modelo',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'serie',array('class'=>'span5','maxlength'=>30)); ?>

	<?php echo $form->textFieldRow($model,'estado',array('class'=>'span5','maxlength'=>6)); ?>

	<?php echo $form->textFieldRow($model,'fingreso',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'migrado',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'fmigracion',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'fdigitacion',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'usuario',array('class'=>'span5','maxlength'=>16)); ?>

	<?php echo $form->textFieldRow($model,'estacion',array('class'=>'span5','maxlength'=>12)); ?>

	<?php echo $form->textFieldRow($model,'eninventario',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Crear' : 'Guardar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
