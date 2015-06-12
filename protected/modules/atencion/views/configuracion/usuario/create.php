<?php
$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar Usuarios','icon'=>'th-list','url'=>array('index')),
	array('label'=>'Gestionar Usuarios','icon'=>'book','url'=>array('admin')),
);
?>

<h1>Crear usuario</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>