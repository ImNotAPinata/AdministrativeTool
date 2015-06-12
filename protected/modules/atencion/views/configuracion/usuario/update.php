<?php
$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	$model->idusuario=>array('view','id'=>$model->idusuario),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar usuarios','icon'=>'th-list','url'=>array('index')),
	array('label'=>'Crear usuario','icon'=>'plus-sign','url'=>array('create')),
	array('label'=>'Ver usuario','icon'=>'eye-open','url'=>array('view','id'=>$model->idusuario)),
	array('label'=>'Gestionar usuarios','icon'=>'book','url'=>array('admin')),
);
?>

<h1>Actualizar usuario <?php echo $model->cusuario; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>