<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h1 id="title" style="cursor: default">Movimientos de Solicitud Nro. <?php echo $evento->solicitud->cod_solicitud;?></h1>
</div>
 
<div class="modal-body">           
    <?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'solicituddetail-grid',
	'dataProvider'=>$evento->search(),
	//'filter'=>$model,
	'columns'=>array(
                'persona',
                'movimiento',
                'fec_registro',
	),
    )); ?> 
</div>