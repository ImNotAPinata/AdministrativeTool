<div class="row">
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
<div class="span-10">
	<?php echo $form->textFieldRow($model,'cod_bien',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'nombre',array('class'=>'span5','maxlength'=>100)); ?>
</div><div class="span-10">
	<?php echo $form->textFieldRow($model,'unidad',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'stock',array('class'=>'span5')); ?>
</div><div class="span-10">
	<?php echo $form->textFieldRow($model,'precio',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
		    'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Buscar',
		)); ?>
	</div>
</div>
<?php $this->endWidget(); ?>
</div>