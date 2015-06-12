<?php
$this->breadcrumbs=array(
	'Bien Economatos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar Bienes','icon'=>'th-list','url'=>array('index')),
	array('label'=>'Gestionar Bienes','icon'=>'book','url'=>array('admin')),
);
?>

<h1>Crear Bien de Economato</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>