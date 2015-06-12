<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'RechazarModal')); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Esta seguro de rechazar el pedido?</h4>
    <h7 class="hint">Tambien puede indicar a los usuarios que lo modifiquen</h7>
</div>
 
<div class="modal-body">           
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'rechazarForm',
        )); ?>
        <?php echo $form->hiddenField($tramite, 'selected',array('id'=>'selectedRechazados')); ?>
        <?php echo $form->textAreaRow($tramite,'des_observacion', array('class'=>'span5', 'rows'=>4)); ?>

<div class="modal-footer"> 
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'type'=>'danger',
        'buttonType' => 'ajaxSubmit',
        'label'=>'Rechazar',
        'url'=>'aprobar/rechazar',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
        'ajaxOptions' => array('success' => 
                                    'function(data){
                                            var obj = $.parseJSON(data);
                                            if(obj!=null)
                                            setTimeout(function(){location.reload(true);},400);
                                            }'),

    )); ?>
    
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'type'=>'warning',
        'buttonType' => 'ajaxSubmit',
        'label'=>'Modificar',
        'url'=>'aprobar/modificar',
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

