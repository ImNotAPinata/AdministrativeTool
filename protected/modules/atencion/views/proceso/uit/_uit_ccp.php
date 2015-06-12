<?php if (is_array($uitproveedors)) { ?>
    <?php if (count($uitproveedors) > 0) { ?>
        <?php foreach ($uitproveedors as $id => $uitProveedor) { ?>
            <div class="row">
                <?php if($id!=0) { echo "<div class='modal-footer span-15'></div>"; } ?>
                <div class="span8">
                    <b style="font-style: italic"><?php echo $uitProveedor->proveedor->des_identificacion." -  RUC:".$uitProveedor->proveedor->des_ruc; ?></b><br/><br/>
                </div>
            </div>
            <div class="row">
                <div class="span-4">
                    <?php echo $form->labelEx($uitProveedor, "[$id]fec_ccp_solicitud"); ?>
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $uitProveedor,
                        'language' => 'es',
                        'options' => array('changeYear' => true, 'yearRange' => '1950:2050'),
                        'attribute' => "[$id]fec_ccp_solicitud",
                        'htmlOptions' => array(
                            'class' => 'span2',
                        ),
                    ));
                    ?>
                </div>  
                <div class="span-4">
                    <?php echo $form->labelEx($uitProveedor, "[$id]fec_ccp_atencion"); ?>
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $uitProveedor,
                        'language' => 'es',
                        'options' => array('changeYear' => true, 'yearRange' => '1950:2050'),
                        'attribute' => "[$id]fec_ccp_atencion",
                        'htmlOptions' => array(
                            'class' => 'span2',
                        ),
                    ));
                    ?>
                </div>
                <div class="span3">
                    <?php echo $form->dropDownListRow($uitProveedor, "[$id]cod_ccp", EEstadoCCP::getEstadoCCPArray(), array('class' => 'span3', 'maxlength' => 50)); ?>
                </div>
            </div>
            <div class="row">
                <div class="span-4">
                    <?php echo $form->textFieldRow($uitProveedor, "[$id]num_ccp", array('class' => 'span2', 'maxlength' => 50)); ?>
                </div>
                <div class="span-4">
                    <?php echo $form->textFieldRow($uitProveedor, "[$id]num_orden", array('class' => 'span2', 'maxlength' => 50)); ?>
                </div>
            </div><br/>
            <?php
        }
    } else {
        ?>
        <label style="font-style: italic">No hay proveedores asignados</label>
    <?php
    }
}
?>
       