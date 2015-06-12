<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'DesignarModal')); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Asignar pedido(s) seleccionado(s) a:</h4>
</div>
 
<div class="modal-body">           
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'atenderForm',
        )); ?>
            <?php echo $form->hiddenField($tramite, 'selected',array('id'=>'selectedDesignados')); ?>
            <?php echo $form->dropDownListRow($tramite, 'cod_destinatario', CHtml::listData($personal,'num_registro','fullname','cargo'),array('class'=>'span5','maxlength'=>50,'empty'=>'Elegir ..')); ?>
            <?php echo $form->dropDownListRow($tramite, 'prioridad', EPrioridadSolicitud::getPrioridadSolicitudArray() ,array('class'=>'span5','maxlength'=>50)); ?>

            <?php echo $form->textAreaRow($tramite,'des_observacion', array('class'=>'span5', 'rows'=>4,'title'=>'Ingrese algún comentario adicional')); ?>

<div class="modal-footer"> 
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'type'=>'primary',
        'buttonType' => 'ajaxSubmit',
        'label'=>'Aprobar',
        'url'=>'aprobar\aprobar',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
        'ajaxOptions' => array('success' => 
                                    'function(data){
                                            var obj = $.parseJSON(data);
                                            if(obj!=null)
                                            setTimeout(function(){location.reload(true);},400);
                                            }'),

    )); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Cerrar',
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
</div>
    <?php $this->endWidget(); ?>
 </div>  


<?php $this->endWidget(); ?>

