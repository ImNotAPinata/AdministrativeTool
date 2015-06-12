<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'usuario-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'cusuario',array('class'=>'span5','maxlength'=>40)); ?>

	<?php echo $form->textFieldRow($model,'cpass',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'cnombre',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'nombres',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'apellidos',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'registro',array('class'=>'span5','maxlength'=>4)); ?>

	<?php echo $form->textFieldRow($model,'ctipo',array('class'=>'span5','maxlength'=>4)); ?>

	<?php echo $form->textFieldRow($model,'area',array('class'=>'span5','maxlength'=>11)); ?>

	<?php echo $form->textFieldRow($model,'perfil',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'estado',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'fregistro',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'usuario',array('class'=>'span5','maxlength'=>15)); ?>

	<?php echo $form->textFieldRow($model,'estacion',array('class'=>'span5','maxlength'=>15)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
