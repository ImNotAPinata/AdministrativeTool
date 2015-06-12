<?php
$this->breadcrumbs=array(
	'Bien Patrimonials'=>array('index'),
	$model->idbien,
);

$this->menu=array(
	array('label'=>'Listar Bienes','icon'=>'th-list','url'=>array('index')),
	array('label'=>'Crear Bienes','icon'=>'plus-sign','url'=>array('create')),
	array('label'=>'Actualizar Bienes','icon'=>'pencil','url'=>array('update','id'=>$model->idbien)),
	//array('label'=>'Delete Bien','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->idbien),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Gestionar Bienes','icon'=>'book','url'=>array('admin')),
);
?>

<h1>Bien Patrimonial #<?php echo $model->codpatrimonial; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'codpatrimonial',
		'codanterior',
		'descripcion',
		'marca',
		'modelo',
		'serie',
		'estado',
		/*'fingreso',
		'fmigracion',
		'fdigitacion',
		'usuario',*/
	),
)); ?>
