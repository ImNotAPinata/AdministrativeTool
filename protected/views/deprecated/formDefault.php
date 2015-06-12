<fieldset>
    
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id' => 'atenderForm',
                'type' => 'vertical',
                'action'=>Yii::app()->createUrl("atencion/solicitud/atender/savedefault"),
                'enableAjaxValidation' => false,
        ));
?>
    <legend style="font-size: small"><b>Nota:</b> El presente registro no se adjunta a la solicitud pues solo sirve para notificar</legend>
    
    <?php echo $form->errorSummary($tramite); ?>
    <?php echo $form->hiddenField($tramite, 'fk_solicitud'); ?>
    <?php echo $form->textAreaRow($tramite,'des_observacion', array('class'=>'span8', 'rows'=>7,'title'=>'Ingrese sus observaciones')); ?>
    
    <?php echo $this->renderPartial('_formOpcion',array('tramite'=>$tramite,'form'=>$form)); //array('label'=>'Atender','path'=>'..\..\atender') ?>  
     

<?php $this->endWidget(); ?>

<fieldset>