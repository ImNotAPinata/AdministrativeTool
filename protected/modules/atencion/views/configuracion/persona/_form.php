<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'persona-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'num_registro',array('class'=>'span5','maxlength'=>4)); ?>

	<?php echo $form->textFieldRow($model,'nom_persona',array('class'=>'span5','maxlength'=>80)); ?>

	<?php echo $form->textFieldRow($model,'ape_persona',array('class'=>'span5','maxlength'=>80)); ?>

	<?php echo $form->textFieldRow($model,'nom_sobrenombre',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'cod_tipdocumento',array('class'=>'span5','maxlength'=>5)); ?>

	<?php echo $form->textFieldRow($model,'num_docidentidad',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'dir_persona',array('class'=>'span5','maxlength'=>120)); ?>

	<?php echo $form->textFieldRow($model,'num_telefono',array('class'=>'span5','maxlength'=>12)); ?>

	<?php echo $form->textFieldRow($model,'num_celular',array('class'=>'span5','maxlength'=>12)); ?>

	<?php echo $form->textFieldRow($model,'num_anexo',array('class'=>'span5','maxlength'=>12)); ?>

	<?php echo $form->textFieldRow($model,'fec_nacimiento',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'sex_persona',array('class'=>'span5','maxlength'=>1)); ?>

	<?php echo $form->textFieldRow($model,'cod_parentesco',array('class'=>'span5','maxlength'=>5)); ?>

	<?php echo $form->textFieldRow($model,'nom_apoderado',array('class'=>'span5','maxlength'=>80)); ?>

	<?php echo $form->textFieldRow($model,'num_dniapoderado',array('class'=>'span5','maxlength'=>8)); ?>

	<?php echo $form->textFieldRow($model,'cod_educacion',array('class'=>'span5','maxlength'=>5)); ?>

	<?php echo $form->textFieldRow($model,'nom_universidad',array('class'=>'span5','maxlength'=>80)); ?>

	<?php echo $form->textFieldRow($model,'cod_especialidad',array('class'=>'span5','maxlength'=>5)); ?>

	<?php echo $form->textFieldRow($model,'cod_uuoo',array('class'=>'span5','maxlength'=>6)); ?>

	<?php echo $form->textFieldRow($model,'cod_tipmodalidad',array('class'=>'span5','maxlength'=>5)); ?>

	<?php echo $form->textFieldRow($model,'cod_categoria',array('class'=>'span5','maxlength'=>5)); ?>

	<?php echo $form->textFieldRow($model,'nom_correo',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'estado',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'cod_usumodif',array('class'=>'span5','maxlength'=>16)); ?>

	<?php echo $form->textFieldRow($model,'fec_usumodif',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'maq_usumodif',array('class'=>'span5','maxlength'=>16)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
