<?php
$this->breadcrumbs=array(
	'Personas',
);

$this->menu=array(
	array('label'=>'Crear Persona','icon'=>'plus-sign','url'=>array('create')),
	array('label'=>'Gestionar Persona','icon'=>'book','url'=>array('admin')),
);
?>

<h1>Personas</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
