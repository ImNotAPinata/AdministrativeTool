<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'vmovimientoModal')); ?>

<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h1 id="title" style="cursor: default">Movimientos de Solicitud Nro. <?php echo $tramite->solicitud->customcod;?></h1>
</div>
 
<div class="modal-body">           
    <?php
        $this->widget('bootstrap.widgets.TbGridView', array(
            'id' => 'solicituddetail-grid',
            'type'=>'condensed',
            'summaryText' => '',
            'dataProvider' => $tramite->searchOverview(),
            'columns'=>array(
                array(
                      'name'=>'Remitente',
                      'type' => 'raw',
                      'value'=>'$data->nom_remitente',
                      'htmlOptions'=>array('width'=>'150'),
                ),
                array(
                      'name'=>'Destinatario',
                      'type' => 'raw',
                      'value'=>'$data->nom_destinatario',
                      'htmlOptions'=>array('width'=>'150'),
                ),
                array(
                      'name'=>'des_observacion',
                      'type' => 'raw',
                      'value'=>'$data->des_observacion',
                      'htmlOptions'=>array('width'=>'300'), 
                ),
                array(
                      'name'=>'des_movimiento',
                      'type' => 'raw',
                      'value'=>'$data->movimiento->des_movimiento',
                      'htmlOptions'=>array('width'=>'100'), 
                ),
                'fec_registro',
                
	),
        ));
        ?> 
</div>
<?php $this->endWidget(); ?>