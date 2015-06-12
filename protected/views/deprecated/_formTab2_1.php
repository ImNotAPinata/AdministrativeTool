    <div  id="movimientosInformation"> 
        <!--<h6>Solo mostrar mis movimientos</h6>-->
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
                      'value'=>'$data->movimientosrealizados',
                      'htmlOptions'=>array('width'=>'100'), 
                ),
                'fec_registro',
                
	),
        ));
        ?> 
    </div>