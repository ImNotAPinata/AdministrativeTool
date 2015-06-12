<?php
$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	$model->idusuario,
);

$this->menu=array(
	array('label'=>'Listar Usuarios','icon'=>'th-list','url'=>array('index')),
	array('label'=>'Crear Usuario','icon'=>'plus-sign','url'=>array('create')),
	array('label'=>'Actualizar Usuario','icon'=>'pencil','url'=>array('update','id'=>$model->idusuario)),
	//array('label'=>'Delete usuario','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->idusuario),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Gestionar Usuarios','icon'=>'book','url'=>array('admin')),
);
?>

<h1>Ver usuario <?php echo $model->registro; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		/*'idusuario',*/
		'cusuario',
		'cpass',
		'cnombre',
		'nombres',
		'apellidos',
		'registro',
		/*'ctipo',*/
		'area',
		/*'perfil',*/
		/*'estado',
		'fregistro',
		'usuario',
		'estacion',*/
	),
)); ?>
