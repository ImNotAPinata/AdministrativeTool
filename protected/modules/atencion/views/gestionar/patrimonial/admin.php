<?php
$this->breadcrumbs=array(
	'Bien Patrimonials'=>array('index'),
	'Gestionar',
);

$this->menu=array(
	array('label'=>'Listar Bien','icon'=>'th-list','url'=>array('index')),
	array('label'=>'Crear Bien','icon'=>'plus-sign','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('#title').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('bien-patrimonial-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1 id="title" style="cursor: default">Gestionar Bienes Patrimoniales</h1>

<p>
Opcionalmente usted puede utilizar los siguientes caracteres (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
o <b>=</b>) al principio de cada uno de los valores buscados para indicar la comparativa a usar.
</p>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'bien-patrimonial-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		/*'idbien',*/
		'codpatrimonial',
		'codanterior',
		'descripcion',
		'marca',
		'modelo',
		'serie',
		'estado',
                /*
		'fingreso',
		'migrado',
		'fmigracion',
		'fdigitacion',
		'usuario',
		'estacion',
		'eninventario',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
                        'template'=>'{view}{update}'
		),
	),
)); ?>
