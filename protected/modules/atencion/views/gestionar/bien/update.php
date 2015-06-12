<?php
$this->breadcrumbs=array(
	'Biens'=>array('index'),
	$model->pk_bien=>array('view','id'=>$model->pk_bien),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar Bien','icon'=>'th-list','url'=>array('index')),
	array('label'=>'Create Bienes','icon'=>'plus-sign','url'=>array('create')),
	array('label'=>'Ver Bien','icon'=>'eye-open','url'=>array('view','id'=>$model->pk_bien)),
	array('label'=>'Gestionar Bienes','icon'=>'book','url'=>array('admin')),
);
?>

<h1>Update Bien <?php echo $model->pk_bien; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>