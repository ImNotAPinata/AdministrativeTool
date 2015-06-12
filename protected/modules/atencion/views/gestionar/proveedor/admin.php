<?php
$this->breadcrumbs = array(
    'Proveedors' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'Listar Proveedores', 'icon' => 'th-list', 'url' => array('index')),
    array('label' => 'Crear Proveedores', 'icon' => 'plus-sign', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('proveedor-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Gestionar Proveedores</h1>

<?php echo CHtml::link('Búsqueda Avanzada', '#', array('class' => 'search-button btn')); ?>
<div class="search-form" style="display:none">
    <p>Ingrese los siguientes valores comparativos (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
       or <b>=</b>) al principio de la los valores de búsqueda para especificar como debe de comparar.
    </p><br/>
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'proveedor-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        //'pk_proveedor',
        'des_identificacion',
        'des_ruc',
        'des_direccion',
        'des_telefono_1',
        'des_telefono_2',
        'des_fax',
        'des_celular',
        'des_RPM',
        'des_RPC',
        /* 'des_contacto_1',
          'des_contacto_2',
          'fec_registro',
          'val_activo',
         */
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
));
?>
