<?php
$this->breadcrumbs=array(
	'Personas'=>array('index'),
	$model->idpersona=>array('view','id'=>$model->idpersona),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar Personas','icon'=>'th-list','url'=>array('index')),
	array('label'=>'Crear Persona','icon'=>'plus-sign','url'=>array('create')),
	array('label'=>'Ver Persona','icon'=>'eye-open','url'=>array('view','id'=>$model->idpersona)),
	array('label'=>'Gestionar Personas','icon'=>'book','url'=>array('admin')),
);
?>

<h1>Actualizar persona <?php echo $model->num_registro; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>