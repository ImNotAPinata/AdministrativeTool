<?php
$this->breadcrumbs=array(
	'Personas'=>array('index'),
	$model->idpersona,
);

$this->menu=array(
	array('label'=>'Listar Personas','icon'=>'th-list','url'=>array('index')),
	array('label'=>'Crear Persona','icon'=>'plus-sign','url'=>array('create')),
	array('label'=>'Actualizar Persona','icon'=>'pencil','url'=>array('update','id'=>$model->idpersona)),
	//array('label'=>'Eliminar Persona','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->idpersona),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Gestionar Personas','icon'=>'book','url'=>array('admin')),
);
?>

<h1>View persona #<?php echo $model->idpersona; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		/*'idpersona',*/
		'num_registro',
		'nom_persona',
		'ape_persona',
		'nom_sobrenombre',
		'cod_tipdocumento',
		'num_docidentidad',
		'dir_persona',
		'num_telefono',
		'num_celular',
		'num_anexo',
		'fec_nacimiento',
		/*'sex_persona',
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
		'maq_usumodif',*/
	),
)); ?>
