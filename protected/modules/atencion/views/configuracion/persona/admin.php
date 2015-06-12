<?php
$this->breadcrumbs=array(
	'Personas'=>array('index'),
	'Manage',
);


$this->menu=array(
	array('label'=>'Listar Personas','icon'=>'th-list','url'=>array('index')),
	array('label'=>'Crear Persona','icon'=>'plus-sign','url'=>array('create')),
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
	$.fn.yiiGridView.update('persona-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1 id="title" style="cursor: default">Gestionar Personas</h1>

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
	'id'=>'persona-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		/*'idpersona',*/
		'num_registro',
		'nom_persona',
		'ape_persona',
		'nom_sobrenombre',
		/*'cod_tipdocumento',*/
		
		'num_docidentidad',
		/*'dir_persona',
		'num_telefono',
		'num_celular',
		'num_anexo',
		'fec_nacimiento',
		'sex_persona',
		'cod_parentesco',
		'nom_apoderado',
		'num_dniapoderado',
		'cod_educacion',
		'nom_universidad',
		'cod_especialidad',
		'cod_uuoo',
		'cod_tipmodalidad',
		'cod_categoria',
		'nom_correo',
		'estado',
		'cod_usumodif',
		'fec_usumodif',
		'maq_usumodif',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
                        'template'=>'{view}{update}'
		),
	),
)); ?>
