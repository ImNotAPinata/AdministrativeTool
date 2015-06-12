<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
        <?php/*
	<?php echo $form->textFieldRow($model,'idbien',array('class'=>'span5','maxlength'=>15)); ?>
        */?>
<div class="span-10">
	<?php echo $form->textFieldRow($model,'codpatrimonial',array('class'=>'span5','maxlength'=>12)); ?>

	<?php echo $form->textFieldRow($model,'codanterior',array('class'=>'span5','maxlength'=>12)); ?>
</div><div class="span-10">
	<?php echo $form->textFieldRow($model,'descripcion',array('class'=>'span5','maxlength'=>120)); ?>

	<?php echo $form->textFieldRow($model,'marca',array('class'=>'span5','maxlength'=>20)); ?>
</div><div class="span-10">
	<?php echo $form->textFieldRow($model,'modelo',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'serie',array('class'=>'span5','maxlength'=>30)); ?>
</div><div class="span-10">
	<?php echo $form->textFieldRow($model,'estado',array('class'=>'span5','maxlength'=>6)); ?>
        <?php/*
	<?php echo $form->textFieldRow($model,'fingreso',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'migrado',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'fmigracion',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'fdigitacion',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'usuario',array('class'=>'span5','maxlength'=>16)); ?>

	<?php echo $form->textFieldRow($model,'estacion',array('class'=>'span5','maxlength'=>12)); ?>

	<?php echo $form->textFieldRow($model,'eninventario',array('class'=>'span5')); ?>
        */?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
		    'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>
</div>
<?php $this->endWidget(); ?>
