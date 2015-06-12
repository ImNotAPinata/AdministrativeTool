<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'DevolverModal')); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Devolver a usuario la solicitud </h4>
    <h7 class="hint">Pedir al usuario que modifique la solicitud realizada</h7>
</div>
 
<div class="modal-body">           
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'devolverForm',
        )); ?>
        <?php echo $form->hiddenField($tramite,'selectedRechazados'); ?>
        <?php echo $form->textAreaRow($tramite,'des_observacion', array('class'=>'span5', 'rows'=>4)); ?>

<div class="modal-footer">    
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'type'=>'warning',
        'buttonType' => 'ajaxSubmit',
        'label'=>'Devolver',
        'url'=>'..\..\devolver',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
        'ajaxOptions' => array('success' => 
                                    'function(data){
                                            var obj = $.parseJSON(data);
                                            if(obj!=null)
                                                if(obj.operacion="success"){
                                                        history.go(-1);
                                                    }
                                                else
                                                    {
                                                        setTimeout(function(){location.reload(true);},400);
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
