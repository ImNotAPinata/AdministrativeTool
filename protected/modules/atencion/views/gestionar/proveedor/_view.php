<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('pk_proveedor')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->pk_proveedor),array('view','id'=>$data->pk_proveedor)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('des_identificacion')); ?>:</b>
	<?php echo CHtml::encode($data->des_identificacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('des_ruc')); ?>:</b>
	<?php echo CHtml::encode($data->des_ruc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('des_direccion')); ?>:</b>
	<?php echo CHtml::encode($data->des_direccion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('des_telefono_1')); ?>:</b>
	<?php echo CHtml::encode($data->des_telefono_1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('des_telefono_2')); ?>:</b>
	<?php echo CHtml::encode($data->des_telefono_2); ?>
	<br />
        
        <b><?php echo CHtml::encode($data->getAttributeLabel('des_fax')); ?>:</b>
	<?php echo CHtml::encode($data->des_celular); ?>
	<br />
        
	<b><?php echo CHtml::encode($data->getAttributeLabel('des_celular')); ?>:</b>
	<?php echo CHtml::encode($data->des_celular); ?>
	<br />
	 
	<b><?php echo CHtml::encode($data->getAttributeLabel('des_RPM')); ?>:</b>
	<?php echo CHtml::encode($data->des_RPM); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('des_RPC')); ?>:</b>
	<?php echo CHtml::encode($data->des_RPC); ?>
	<br />

</div>