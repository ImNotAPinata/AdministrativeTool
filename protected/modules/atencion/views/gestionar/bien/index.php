<?php
$this->breadcrumbs=array(
	'Biens',
);

$this->menu=array(
	array('label'=>'Create Bien','url'=>array('create')),
	array('label'=>'Manage Bien','url'=>array('admin')),
);
?>

<h1>Biens</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
