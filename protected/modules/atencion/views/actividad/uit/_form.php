<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'uit-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'cod_uit_generado',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'cod_uit_estado',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'cod_uit_tipo',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'des_area_solicitante',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'des_registro_solicitante',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'des_nombre_solicitante',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'num_uit_siged',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textAreaRow($model,'des_uit_descripcion',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'fec_uit_siged',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'num_uit_importe',array('class'=>'span5','maxlength'=>18)); ?>

	<?php echo $form->textFieldRow($model,'des_proyectado_por',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'fec_devolucion_siged',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'fec_recepcion_siged',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'fec_atencion_siged',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'fec_asignado_siged',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'fec_registro',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'val_activo',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
