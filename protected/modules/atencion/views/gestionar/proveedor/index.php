<?php
$this->breadcrumbs=array(
	'Proveedors',
);

$this->menu=array(
	array('label'=>'Crear Proveedor','icon' => 'plus-sign','url'=>array('create')),
	array('label'=>'Gestionar Proveedor','icon' => 'book','url'=>array('admin')),
);
?>

<h1>Proveedores</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
