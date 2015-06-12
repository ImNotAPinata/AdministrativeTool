<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'JefeAtenderModal')); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Asignar prioridad a los pedidos</h4>
</div>
 
<div class="modal-body">   
    <b>Nota:</b> Los pedidos pasaran a su bandeja de atención.<br/><br/>
    
    <?php if($tramite->prioridad == '') { $tramite->prioridad = EPrioridadSolicitud::Normal; }?>
    <?php echo chtml::activeLabelEx($tramite, 'prioridad'); ?>
    <?php echo chtml::ActivedropDownList($tramite, 'prioridad', EPrioridadSolicitud::getPrioridadSolicitudArray(),array('class'=>'span5','maxlength'=>50)); ?>
    <br/><br/>

    <div class="modal-footer"> 
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'type'=>'primary',
            'buttonType' => 'submit',
            'label'=>'Solicitar',
        )); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label'=>'Cerrar',
            'url'=>'#',
            'htmlOptions'=>array('data-dismiss'=>'modal'),
        )); ?>
    </div>
</div>  

<?php $this->endWidget(); ?>


