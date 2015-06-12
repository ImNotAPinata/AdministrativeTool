<?php
$this->breadcrumbs=array(
	'Proveedors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar Proveedor','icon'=>'th-list','url'=>array('index')),
	array('label'=>'Gestionar Proveedores','icon'=>'book','url'=>array('admin')),
);
?>

<h1>Crear Proveedor</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>