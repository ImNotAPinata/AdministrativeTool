<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'RechazarModal')); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Rechazar la solicitud </h4>
    <h7 class="hint">Escriba la razón de su rechazo</h7>
</div>
 
<div class="modal-body">
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'rechazarForm',
        )); ?>
            <?php echo $form->hiddenField($tramite, 'fk_solicitud'); ?>
            <?php echo $form->textAreaRow($tramite,'des_observacion', array('class'=>'span5', 'rows'=>4,'title'=>'Ingrese algún comentario adicional')); ?>

<div class="modal-footer"> 
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'type'=>'danger',
        'buttonType' => 'ajaxSubmit',
        'label'=>'Rechazar',
        'url'=> Yii::app()->createUrl("atencion/proceso/opcion/rechazar"),
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