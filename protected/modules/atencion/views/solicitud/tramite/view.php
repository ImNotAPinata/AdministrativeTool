<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h1 id="title" style="cursor: default">Movimientos de Solicitud Nro. <?php echo $tramite->solicitud->customcod;?></h1>
</div>
 
<div class="modal-body">           
    <?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'solicituddetail-grid',
	'summaryText'=>'',
        'dataProvider'=>$tramite->searchOverview(),
        'enablePagination'=>true,
        'type'=>'condensed',
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
                      'htmlOptions'=>array('width'=>'250'), 
                ),
                array(
                      'name'=>'Movimiento',
                      'type' => 'raw',
                      'value'=>'$data->movimiento->des_movimiento',
                      'htmlOptions'=>array('width'=>'100'), 
                ),
                array(
                      'name'=>'fec_registro',
                      'type' => 'raw',
                      'value'=>'$data->fec_registro',
                      'htmlOptions'=>array('width'=>'100'), 
                ),
                
	),
    )); ?> 
</div>

<?php if($render == 'false') { ?>
<script>
/*<![CDATA[*/
jQuery('a[rel="tooltip"]').tooltip();
jQuery('a[rel="popover"]').popover();
jQuery('#solicituddetail-grid').yiiGridView({'ajaxUpdate':['solicituddetail-grid'],'ajaxVar':'ajax','pagerClass':'pagination','loadingClass':'grid-view-loading','filterClass':'filters','tableClass':'items table table-condensed','selectableRows':1,'pageVar':'Tramite_page','afterAjaxUpdate':function() {
			jQuery('.popover').remove();
			jQuery('a[rel="popover"]').popover();
			jQuery('.tooltip').remove();
			jQuery('a[rel="tooltip"]').tooltip();
		}});
/*]]>*/
</script>
<?php } ?>