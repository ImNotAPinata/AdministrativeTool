<fieldset>
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'uit-form',
        'type' => 'vertical',
        //'action' => Yii::app()->createUrl("atencion/proceso/uit/save"),
        'enableAjaxValidation' => false,
            ));
    ?>
    
    <div class="row">
        <div class="span-12" style="font-style: italic">Seguimiento Req. <3 UIT</div>
        <div class="span-3"><a id="expandaccordion" style="cursor: pointer;vertical-align: bottom">Mostrar/Ocultar</a></div>
    </div>
    <?php echo $form->errorSummary(array($uit,$tramite)); ?>
    
    <div id="notaccordion">
        <?php if ($uit->cod_uit_estado >= Uit::Requerimiento) { ?>
        <h6><a id="onReq" href="#"><b>Del requerimiento</b></a></h6>
            <div>
                <?php echo $this->renderPartial('_uit_requerimiento', array('form' => $form, 'uit' => $uit, 'tramite' => $tramite, 'personal'=>$personal), true); ?>
            </div>
        <?php } ?>
        <?php if ($uit->cod_uit_estado >= Uit::Anexo) { ?>    
        <h6><a id="onCot"  href="#"><b>De la cotización y elaboración de anexo 2</b></a></h6>
        <div>
            <?php echo $this->renderPartial('_uit_cotizacionanexo2', array('form' => $form, 'uit' => $uit, 'tramite' => $tramite), true); ?>
        </div>
        <?php } ?>
        <?php if ($uit->cod_uit_estado >= Uit::Ccp) { ?>    
        <h6><a id="onCcp" href="#"><b>De la CCP</b></a></h6>
        <div>
            <?php echo $this->renderPartial('_uit_ccp', array('form' => $form, 'uitProveedors' => $uit->uitProveedors), true); ?>
        </div>
        <?php } ?>
        <?php if ($uit->cod_uit_estado >= Uit::Servicio) { ?>    
        <h6><a id="onCS" href="#"><b>De la compra o prestación del servicio</b></a></h6>
        <div>
            <?php echo $this->renderPartial('_uit_compraservicio', array('form' => $form, 'uit' => $uit, 'tramite' => $tramite), true); ?>
        </div>
        <?php } ?>
        <?php if ($uit->cod_uit_estado >= Uit::BienesPatrimoniales) { ?>    
        <h6><a id="onBP" href="#"><b>Biens patrimoniales</b></a></h6>
        <div>
            <?php echo $this->renderPartial('_uit_bienespatrimoniales', array('form' => $form, 'uit' => $uit, 'tramite' => $tramite), true); ?>
        </div>
        <?php } ?> 
    </div><br/>
    
    <div class="row">
        <div class="span-16">
            <?php echo $this->renderPartial('..\opcion\_formOpcion', array('tramite' => $tramite, 'form' => $form)); //array('label'=>'Atender','path'=>'..\..\atender')  ?>  
        </div>
    </div>
    <br/>
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'type' => 'primary',
        'buttonType' => 'submit',
        'label' => 'Atender',
        'url' => 'update', // se puede usar para hacer lo siguiente url --> ..\..\atenderUIT ( logica de uit ) atenderCajaChica (logica de cajachica) etc..
        'htmlOptions'=>array('id'=>'submitForm'),
        ));
    ?>
<?php $this->endWidget(); ?>
</fieldset>