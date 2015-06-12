<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'FacturaUitModal')); ?>
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Agregar nueva Factura </h4>
    <div style="font-size: small">
        Complete el formulario y haga clic en agregar.
    </div>
</div>
 
<div id="facturauit-form" class="modal-body">   
    <div class="row">
        <div class="span6">
            <?php echo $form->dropDownListRow($facturauit, 'selected', F_Array::getArrayFromArrayObject($uitproveedors,'ToSelect'), array('class' => 'span6', 'maxlength' => 50)); ?><br/><br/>
        </div>
    </div>
    <div class="row">
        <div class="span4">
            <?php echo $form->textFieldRow($facturauit, 'des_factura', array('class' => 'span4')); ?>
            <?php echo $form->dropDownListRow($facturauit, "des_area", EArea::getAreaArray(), array('class' => 'span4', 'maxlength' => 50,)); ?>            
        </div>
        <div class="span2">
            <?php echo $form->labelEx($facturauit,"fec_factura"); ?>
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                                'model' => $facturauit,
                                                'language' => 'es',
                                                'options' => array('changeYear' => true, 'yearRange' => '1950:2050'),
                                                'attribute' => 'fec_factura',
                                                'htmlOptions' => array(
                                                    'class' => 'span2',
                                                ),
                                            )); ?>
            <?php echo $form->textFieldRow($facturauit, 'num_gasto', array('class' => 'span2')); ?>
        </div>
    </div>
    <div class="row">
        <div class="span6">
            <?php echo $form->textAreaRow($facturauit, 'des_descripcion', array('class' => 'span6','rows'=>4)); ?>
        </div>
    </div>
    <div class="modal-footer">
            <?php
            $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType' => 'submit',
                'type' => 'primary',
                'label' => 'Agregar',
                'htmlOptions' => array('id' => 'AddFactura'),
            ));
            ?>
    </div>
</div>
<?php $this->endWidget(); ?>