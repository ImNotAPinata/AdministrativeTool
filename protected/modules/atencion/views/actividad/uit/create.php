<?php
$this->breadcrumbs=array(
	'Uits'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Uit','url'=>array('index')),
	array('label'=>'Manage Uit','url'=>array('admin')),
);
?>

<h1>Create Uit</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>