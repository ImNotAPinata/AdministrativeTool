<div class="form-actions">
    <div class="well">
    <?php echo $form->checkBoxRow($tramite, '_opcion_allow',array('id'=>'opallow')); ?>
    <div id="allowPerson" class="modal-header" style="display: none">
    <!--<tt>Seleccionar persona a continuar el proceso:</tt>-->
    <?php echo $form->dropDownListRow($tramite, 'cod_destinatario', CHtml::listData(Persona::getPersonalByUuoo(),'num_registro','fullname','cargo'),array('class'=>'span5','maxlength'=>50,'empty'=>'Elegir ..')); ?>
    </div>
    <?php echo $form->checkBoxRow($tramite, '_opcion_save',array('id'=>'opsave')); ?>
    </div>

    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'type' => 'primary',
        'buttonType' => 'submit',
        'label' => 'Atender',
        'url' => '#', // se puede usar para hacer lo siguiente url --> ..\..\atenderUIT ( logica de uit ) atenderCajaChica (logica de cajachica) etc..
        'htmlOptions'=>array('id'=>'submitForm'),
        ));
    ?>
    
    <br/><br/><br/>
    <br/><br/>
</div>