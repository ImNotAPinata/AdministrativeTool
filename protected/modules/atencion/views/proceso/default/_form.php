<fieldset>
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'atenderForm',
        'type' => 'vertical',
        //'action' => Yii::app()->createUrl("atencion/proceso/default/save"),
        'enableAjaxValidation' => false,
            ));
    ?>
    <?php echo $form->errorSummary($tramite); ?>
    <?php echo $form->hiddenField($tramite, 'fk_solicitud'); ?>
    <div class="row"><br/>
        <div class="span7">
            <?php echo chtml::label('Observaciones:', ''); ?>
            <?php echo $form->textArea($tramite, 'des_observacion', array('class' => 'span7', 'rows' => 4, 'title' => 'Ingrese sus observaciones')); ?>
            <label style="font-size: small"><b>Nota:</b> El presente registro no se adjunta a la solicitud pues solo sirve para notificar</label>
        </div>
        
        <div class="btn-toolbar span7"><br/>
            <?php
            $this->widget('bootstrap.widgets.TbButton', array(
                'label' => 'Atender',
                'type' => 'primary',
                'htmlOptions' => array(
                    'data-toggle' => 'modal',
                    'data-target' => '#FinalizarAtencionModal',
                ),
            ));
            ?>  
            <?php $this->renderPartial('../opcion/_menu'); ?>
        </div>
    </div>
    <?php echo $this->renderPartial('_get_opciones',array('tramite'=>$tramite,'form'=>$form)); ?>  

<?php $this->endWidget(); ?>

</fieldset>


        