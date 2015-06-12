<?php
$this->breadcrumbs=array(
	'Uits',
);

$this->menu=array(
	array('label'=>'Crear Uit','url'=>array('create')),
	array('label'=>'Gestionar Uit','url'=>array('admin')),
);
?>

<h1>Uits</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
