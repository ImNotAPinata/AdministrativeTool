<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('pk_bien')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->pk_bien),array('view','id'=>$data->pk_bien)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('des_bien')); ?>:</b>
	<?php echo CHtml::encode($data->des_bien); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('des_marca')); ?>:</b>
	<?php echo CHtml::encode($data->des_marca); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cod_tipo')); ?>:</b>
	<?php echo CHtml::encode($data->cod_tipo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fec_registro')); ?>:</b>
	<?php echo CHtml::encode($data->fec_registro); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('val_activo')); ?>:</b>
	<?php echo CHtml::encode($data->val_activo); ?>
	<br />


</div>