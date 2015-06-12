    <!--<label class="badge-important" style="color: white; padding: 2px 0px 0px 1px" >
        <ul><li id="movimientoHeader" title="Ocultar/Mostrar" style="cursor: pointer" type="square">Movimientos</li></ul>
    </label>-->

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
                      'value'=>'$data->PersonaRemitente',
                      'htmlOptions'=>array('width'=>'150'),
                ),
                array(
                      'name'=>'Destinatario',
                      'type' => 'raw',
                      'value'=>'$data->PersonaDestinatario',
                      'htmlOptions'=>array('width'=>'150'),
                ),
                array(
                      'name'=>'des_observacion',
                      'type' => 'raw',
                      'value'=>'$data->des_observacion',
                      'htmlOptions'=>array('width'=>'300'), 
                ),//'des_observacion',
                'movimiento',
                'fec_registro',
                
	),
        ));
        ?> 
    </div>