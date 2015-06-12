<?php
$this->breadcrumbs=array(
	'Uits'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Uit','url'=>array('index')),
	array('label'=>'Create Uit','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('uit-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Uits</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'uit-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'pk_uit',
		'cod_uit_generado',
		'cod_uit_estado',
		'cod_uit_tipo',
		'des_area_solicitante',
		'des_registro_solicitante',
		/*
		'des_nombre_solicitante',
		'num_uit_siged',
		'des_uit_descripcion',
		'fec_uit_siged',
		'num_uit_importe',
		'des_proyectado_por',
		'fec_devolucion_siged',
		'fec_recepcion_siged',
		'fec_atencion_siged',
		'fec_asignado_siged',
		'fec_registro',
		'val_activo',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
