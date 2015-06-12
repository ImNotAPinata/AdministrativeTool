<?php
$this->breadcrumbs=array(
	'Bien Economatos',
);

$this->menu=array(
	array('label'=>'Crear Bien','icon'=>'plus-sign','url'=>array('create')),
	array('label'=>'Gestionar Bienes','icon'=>'book', 'url'=>array('admin')),
);
?>

<h1>Bienes de Economato</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
