<?php
$this->breadcrumbs=array(
	'Proveedors'=>array('index'),
	$model->pk_proveedor,
);

$this->menu=array(
	array('label'=>'Listar Proveedores','icon'=>'th-list','url'=>array('index')),
	array('label'=>'Crear Proveedor','icon'=>'plus-sign','url'=>array('create')),
	array('label'=>'Actualizar Proveedor','icon'=>'pencil','url'=>array('update','id'=>$model->pk_proveedor)),
	//array('label'=>'Delete Proveedor','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->pk_proveedor),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Gestionar Proveedor','icon'=>'book','url'=>array('admin')),
);
?>

<h1>Ver Proveedor #<?php echo $model->pk_proveedor; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'pk_proveedor',
		'des_identificacion',
		'des_ruc',
		'des_direccion',
		'des_telefono_1',
		'des_telefono_2',
		'des_celular',
		'des_RPM',
		'des_RPC',
		'des_contacto_1',
		'des_contacto_2',
	),
)); ?>
