<?php
$this->breadcrumbs=array(
	'Biens'=>array('index'),
	$model->pk_bien,
);

$this->menu=array(
	array('label'=>'List Bien','url'=>array('index')),
	array('label'=>'Create Bien','url'=>array('create')),
	array('label'=>'Update Bien','url'=>array('update','id'=>$model->pk_bien)),
	array('label'=>'Delete Bien','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->pk_bien),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Bien','url'=>array('admin')),
);
?>

<h1>View Bien #<?php echo $model->pk_bien; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'pk_bien',
		'des_bien',
		'des_marca',
		'cod_tipo',
		'fec_registro',
		'val_activo',
	),
)); ?>
