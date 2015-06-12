<?php
$this->breadcrumbs=array(
	'Uits'=>array('index'),
	$model->pk_uit,
);

$this->menu=array(
	array('label'=>'List Uit','url'=>array('index')),
	array('label'=>'Create Uit','url'=>array('create')),
	array('label'=>'Update Uit','url'=>array('update','id'=>$model->pk_uit)),
	array('label'=>'Delete Uit','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->pk_uit),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Uit','url'=>array('admin')),
);
?>

<h1>View Uit #<?php echo $model->pk_uit; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'pk_uit',
		'cod_uit_generado',
		'cod_uit_estado',
		'cod_uit_tipo',
		'des_area_solicitante',
		'des_registro_solicitante',
		'des_nombre_solicitante',
		'num_uit_siged',
		'des_uit_descripcion',
		'fec_uit_siged',
		'num_uit_importe',
		'des_proyectado_por',
		'fec_devolucion_siged',
		'fec_recepcion_siged',
		'fec_atencion_siged',
		'fec_asignado_siged',
		'fec_registro',
		'val_activo',
	),
)); ?>
