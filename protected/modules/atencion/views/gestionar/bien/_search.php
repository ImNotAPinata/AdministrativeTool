<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'pk_bien',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'des_bien',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'des_marca',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'cod_temporal',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'cod_tipo',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'fec_registro',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'val_activo',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
		    'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
