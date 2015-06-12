<?php
$this->breadcrumbs=array(
	'Uits'=>array('index'),
	$model->pk_uit=>array('view','id'=>$model->pk_uit),
	'Update',
);

$this->menu=array(
	array('label'=>'List Uit','url'=>array('index')),
	array('label'=>'Create Uit','url'=>array('create')),
	array('label'=>'View Uit','url'=>array('view','id'=>$model->pk_uit)),
	array('label'=>'Manage Uit','url'=>array('admin')),
);
?>

<h1>Update Uit <?php echo $model->pk_uit; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>