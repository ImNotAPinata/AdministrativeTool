<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

<div class="span-10">
	<?php echo $form->textFieldRow($model,'cusuario',array('class'=>'span5','maxlength'=>40)); ?>

	<?php echo $form->textFieldRow($model,'cnombre',array('class'=>'span5','maxlength'=>255)); ?>
</div><div class="span-10">
	<?php echo $form->textFieldRow($model,'nombres',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'apellidos',array('class'=>'span5','maxlength'=>255)); ?>
</div><div class="span-10">
	<?php echo $form->textFieldRow($model,'registro',array('class'=>'span5','maxlength'=>4)); ?>

	<?php echo $form->textFieldRow($model,'area',array('class'=>'span5','maxlength'=>11)); ?>
</div>
	<?php echo $form->textFieldRow($model,'estado',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
		    'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
