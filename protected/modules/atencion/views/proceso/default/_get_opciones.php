<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'FinalizarAtencionModal')); ?>

<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Antes de terminar...</h4>
    <div style="font-size: small">
        Seleccione una modalidad de atención.
    </div>
</div>
<div class="modal-body">  
    <?php echo $form->radioButtonRow($tramite, '_opcion_allow', array('id' => 'opallow','value'=>'1','uncheckValue'=>null)); ?>
    <?php echo $form->radioButtonRow($tramite, '_opcion_save', array('id' => 'opsave','value'=>'1','uncheckValue'=>null)); ?>
    
    <div id="allowPerson" class="modal-header" style="display: none">
        <?php echo $form->dropDownListRow($tramite, 'cod_destinatario', CHtml::listData(Persona::getPersonalByUuoo(), 'num_registro', 'fullname', 'cargo'), array('class' => 'span5', 'maxlength' => 50, 'empty' => 'Elegir ..')); ?>
        <div style="font-size: x-small">
            <b>Nota:</b> Si no selecciona a nadie la atención se llevará acabo con los elementos pre-configurados.
        </div>
    </div>
    
</div>
<div class="modal-footer"> 
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'type' => 'primary',
        'buttonType' => 'submit',
        'label' => 'Atender',
        //'url' => 'save', // se puede usar para hacer lo siguiente url --> ..\..\atenderUIT ( logica de uit ) atenderCajaChica (logica de cajachica) etc..
        'htmlOptions' => array('id' => 'submitForm'),
    ));
    ?>
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'label' => 'Cerrar',
        'url' => '#',
        'htmlOptions' => array('data-dismiss' => 'modal'),
    ));
    ?>
</div>

<?php $this->endWidget(); ?>
 
    
<?php

Yii::app()->clientScript->registerScript('formOptions'," 
$('#opallow').live('click',function(e){
    $('#opsave').attr('checked',false) ;
    $('#allowPerson').css('display', 'block');
});

$('#opsave').live('click',function(e){
    $('#opallow').attr('checked',false) ;
    $('#allowPerson').css('display', 'none'); 
});
");

?>