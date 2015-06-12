<?php
$this->breadcrumbs=array(
	'Bien Economatos'=>array('index'),
	$model->cod_bien,
);

$this->menu=array(
	array('label'=>'Listar Bienes','icon'=>'th-list','url'=>array('index')),
	array('label'=>'Crear Bienes','icon'=>'plus-sign','url'=>array('create')),
	array('label'=>'Actualizar Bienes','icon'=>'pencil','url'=>array('update','id'=>$model->cod_bien)),
	//array('label'=>'Delete Bien','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->cod_bien),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Gestionar Bienes','icon'=>'book','url'=>array('admin')),
);
?>

<h1>Bien de Economato #<?php echo $model->cod_bien; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'cod_bien',
		'nombre',
		'unidad',
		'stock',
		'precio',
	),
)); ?>
