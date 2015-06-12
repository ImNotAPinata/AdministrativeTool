<?php
$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar Usuarios','icon'=>'th-list','url'=>array('index')),
	array('label'=>'Crear Usuario','icon'=>'plus-sign','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$.ajaxSetup({   
    error: function(xhr, status, error) 
    {     
       alert('Un error occurío: ' + status + '. Comuniquese con el Administrador del Sistema. Error: ' + error + ' Response Text:' + xhr.responseText);   
    }       
}); 
$('#title').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('usuario-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1 id="title" style="cursor: default">Gestionar Usuarios</h1>

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
	'id'=>'usuario-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		/*'idusuario',*/
                'registro',
		'cusuario',
		'cpass',
		/*'cnombre',*/
		'nombres',
		'apellidos',
		'area',
		/*
		'ctipo',
		'perfil',
		'estado',
		'fregistro',
		'usuario',
		'estacion',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
                        'template'=>'{view}{update}'
		),
	),
)); ?>
