<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

<div class="span-10">
	<?php echo $form->textFieldRow($model,'num_registro',array('class'=>'span5','maxlength'=>4)); ?>

	<?php echo $form->textFieldRow($model,'nom_persona',array('class'=>'span5','maxlength'=>80)); ?>
</div><div class="span-10">
	<?php echo $form->textFieldRow($model,'ape_persona',array('class'=>'span5','maxlength'=>80)); ?>

	<?php echo $form->textFieldRow($model,'nom_sobrenombre',array('class'=>'span5','maxlength'=>50)); ?>
</div><div class="span-10">
	<?php echo $form->textFieldRow($model,'num_docidentidad',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'num_anexo',array('class'=>'span5','maxlength'=>12)); ?>
</div><div class="span-10">
	<?php echo $form->textFieldRow($model,'fec_nacimiento',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'sex_persona',array('class'=>'span5','maxlength'=>1)); ?>
</div><div class="span-10">
	<?php echo $form->textFieldRow($model,'cod_uuoo',array('class'=>'span5','maxlength'=>6)); ?>

	<?php echo $form->textFieldRow($model,'estado',array('class'=>'span5')); ?>
</div>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
		    'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
