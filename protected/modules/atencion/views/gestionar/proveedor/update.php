<?php
$this->breadcrumbs=array(
	'Proveedors'=>array('index'),
	$model->pk_proveedor=>array('view','id'=>$model->pk_proveedor),
	'Update',
);

$this->menu=array(
	array('label'=>'List Proveedor','url'=>array('index')),
	array('label'=>'Create Proveedor','url'=>array('create')),
	array('label'=>'View Proveedor','url'=>array('view','id'=>$model->pk_proveedor)),
	array('label'=>'Manage Proveedor','url'=>array('admin')),
);
?>

<h1>Actualizar Proveedor <?php echo $model->pk_proveedor; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>