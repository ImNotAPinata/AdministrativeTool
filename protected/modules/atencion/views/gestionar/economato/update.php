<?php
$this->breadcrumbs=array(
	'Bien Economatos'=>array('index'),
	$model->cod_bien=>array('view','id'=>$model->cod_bien),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar Bienes','icon'=>'th-list','url'=>array('index')),
	array('label'=>'Crear Bienes','icon'=>'plus-sign','url'=>array('create')),
	array('label'=>'Ver Bienes','icon'=>'eye-open','url'=>array('view','id'=>$model->cod_bien)),
	array('label'=>'Gestionar Bienes','icon'=>'book','url'=>array('admin')),
);
?>

<h1>Actualizar Bien de Economato #<?php echo $model->cod_bien; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>