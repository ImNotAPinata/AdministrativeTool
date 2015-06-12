<?php
$this->breadcrumbs=array(
	'Personas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar Personas','icon'=>'th-list','url'=>array('index')),
	array('label'=>'Gestionar Personas','icon'=>'book','url'=>array('admin')),
);
?>

<h1>Crear Persona</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>