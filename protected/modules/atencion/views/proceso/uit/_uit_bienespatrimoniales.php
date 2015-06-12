<?php $currentview = 0; ?>
<?php if (is_array($uitproveedors)) { ?>
    <?php if (count($uitproveedors) > 0) { ?>
        <?php foreach ($uitproveedors as $id => $uitProveedor) { ?>
            <?php if($uitProveedor->cod_patrimonial_calificacion == EBooleano::si) { ?>
            
            <div class="row">
                <?php if($currentview!=0) echo "<br/>"; ?>
                <?php if($currentview!=0) { echo "<div class='modal-footer span-15'></div>"; } ?>
                <div class="span7">
                    <b style="font-style: italic">
                        <?php
                        $item = $id;
                        $orden = $uitProveedor->num_orden != '' ? $uitProveedor->num_orden : "#" . ($item + 1);
                        echo "Orden de Compra/Servicio: " . $orden;
                        ?>
                    </b>
                </div>
            </div>
            <br/>
            <div id="EsBienPatrimonial<?php echo $id;?>" class="row">

                <?php if ($uitProveedor->uitbien == null) {
                    $uitProveedor->uitbien = new UitBien();
                } ?>
                    <?php echo $form->hiddenfield($uitProveedor->uitbien, "[$id]pk_uitbien"); ?>    
                <div class="span2">
                    <br/>
                    <?php echo $form->checkBox($uitProveedor->uitbien, "[$id]cod_patrimonial_solicitado"); ?>    
                    <?php echo CHtml::encode(UitBien::model()->getAttributeLabel('cod_patrimonial_solicitado')); ?>
                </div>
                <div class="span2">
                    <?php echo $form->labelEx($uitProveedor->uitbien, "[$id]fec_patrimonial_solicitud"); ?>
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $uitProveedor->uitbien,
                        'language' => 'es',
                        'options' => array('changeYear' => true, 'yearRange' => '1950:2050'),
                        'attribute' => "[$id]fec_patrimonial_solicitud",
                        'htmlOptions' => array(
                            'class' => 'span2',
                        ),
                    ));
                    ?>  
                </div>
                <div class="span2">
                    <br/>
                    <?php echo $form->checkBox($uitProveedor->uitbien, "[$id]cod_patrimonial_recepcionado"); ?>    
                    <?php echo CHtml::encode(UitBien::model()->getAttributeLabel('cod_patrimonial_recepcionado')); ?>
                </div>
                <div class="span2">

                    <?php echo $form->labelEx($uitProveedor->uitbien, 'fec_patrimonial_recepcionado'); ?>
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $uitProveedor->uitbien,
                        'language' => 'es',
                        'options' => array('changeYear' => true, 'yearRange' => '1950:2050'),
                        'attribute' => "[$id]fec_patrimonial_recepcionado",
                        'htmlOptions' => array(
                            'class' => 'span2',
                        ),
                    ));
                    ?>  
                </div>
            </div>
            <?php
            $currentview ++;
            }
        }
    } else {
        ?>
        <label style="font-style: italic">No hay ordenes de compra</label>
        <?php
    }
}
?>