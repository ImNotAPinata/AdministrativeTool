<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'JefeDesignaModal')); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Asignar pedido(s) seleccionado(s) a:</h4>
</div>
<div class="modal-body">    
    <?php echo chtml::activeLabelEx($tramite, 'cod_destinatario'); ?>
    <?php echo chtml::activedropDownList($tramite, 'cod_destinatario', CHtml::listData(Persona::getPersonalByUuoo(),'num_registro','fullname','cargo'),array('class'=>'span5','maxlength'=>50,'empty'=>'Elegir ..')); ?>
    <br/><br/>
    <?php if($tramite->prioridad == '') { $tramite->prioridad = EPrioridadSolicitud::Normal; }?>
    <?php echo chtml::activeLabelEx($tramite, 'prioridad'); ?>
    <?php echo chtml::activedropDownList($tramite, 'prioridad', EPrioridadSolicitud::getPrioridadSolicitudArray() ,array('class'=>'span5','maxlength'=>50)); ?>
    <br/><br/>
    <?php echo chtml::activeLabelEx($tramite, 'des_observacion'); ?>
    <?php echo chtml::activeTextArea($tramite,'des_observacion', array('class'=>'span5', 'rows'=>4,'title'=>'Ingrese algún comentario adicional')); ?>
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

