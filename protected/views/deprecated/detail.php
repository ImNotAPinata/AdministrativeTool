<?php
$this->menu=array(
	array('label'=>'Mis Solicitudes','icon'=>'book','url'=>array('index')),
);

Yii::app()->clientScript->registerScript('search', "
$.ajaxSetup({   
    error: function(xhr, status, error) 
    {     
       alert('Un error occurío: ' + status + '. Comuniquese con el Administrador del Sistema. Error: ' + error + ' Response Text:' + xhr.responseText);   
    }       
}); 

");
?>


<h1 id="title" style="cursor: default">Movimientos de Solicitud Nro. <?php echo $evento->solicitud->cod_solicitud;?></h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'solicituddetail-grid',
	'dataProvider'=>$evento->search(),
	//'filter'=>$model,
	'columns'=>array(
                'persona',
                'movimiento',
                /*'pedidos.cod_pedido',*/
                'fec_registro',
		/*'estado',*/
		/*array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
                        'template'=>'{view}'
		),*/
	),
)); ?>
