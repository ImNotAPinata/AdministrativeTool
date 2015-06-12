<?php
$this->breadcrumbs=array(
	'Bien Patrimonials'=>array('index'),
	$model->idbien=>array('view','id'=>$model->idbien),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar Bienes','icon'=>'th-list','url'=>array('index')),
	array('label'=>'Crear Bienes','icon'=>'plus-sign','url'=>array('create')),
	array('label'=>'Ver Bienes','icon'=>'eye-open','url'=>array('view','id'=>$model->idbien)),
	array('label'=>'Gestionar Bienes','icon'=>'book','url'=>array('admin')),
);
?>

<h1>Actualizar Bien Patrimonial #<?php echo $model->idbien; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>