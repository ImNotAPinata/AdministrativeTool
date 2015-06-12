<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'AtenderModal')); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Asignar prioridad a los pedidos</h4>
</div>
 
<div class="modal-body">           
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'atenderForm',
        )); ?>
            <legend style="font-size: small">
                <b>Nota:</b> Los pedidos pasaran a su bandeja de atención.<br/><br/>
            </legend>
            <?php echo $form->hiddenField($tramite, 'selected',array('id'=>'selectedAtendidos')); ?>
            <?php echo $form->dropDownListRow($tramite, 'prioridad', EPrioridadSolicitud::getPrioridadSolicitudArray(),array('class'=>'span5','maxlength'=>50)); ?>

<div class="modal-footer"> 
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'type'=>'primary',
        'buttonType' => 'ajaxSubmit',
        'label'=>'Atender',
        'url'=>'aprobar\atender',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
        'ajaxOptions' => array('success' => 
                                    'function(data){
                                            var obj = $.parseJSON(data);
                                            if(obj!=null)
                                            {
                                              if(confirm("¿Desea ir a su bandeja de atención de solicitudes?"))
                                              {
                                                window.location.href = "atender";
                                              }
                                            }
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

