<?php
$this->breadcrumbs=array(
	'Bien Patrimonials'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar Bien','icon'=>'th-list','url'=>array('index')),
	array('label'=>'Gestionar Bienes','icon'=>'book','url'=>array('admin')),
);
?>

<h1>Crear Bien Patrimonial</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>