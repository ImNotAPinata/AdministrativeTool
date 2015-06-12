<?php if (is_array($uitproveedors)) { ?>
    <?php if (count($uitproveedors) > 0) { ?>
        <?php foreach ($uitproveedors as $id => $uitProveedor) { ?>
            <div class="row">
                <?php if($id!=0) { echo "<div class='modal-footer span-15'></div>"; } ?>
                <div class="span7">
                    <b style="font-style: italic">
                        <?php
                        $item = $id;
                        $orden = $uitProveedor->num_orden != '' ? $uitProveedor->num_orden : "#".($item+1) ;
                        echo "Orden de Compra/Servicio: " . $orden;
                        ?><br/><br/>
                    </b>
                </div>
                <div class="span2"><?php ?>
                    <?php echo $form->labelEx($uitProveedor, "[$id]fec_servicio_orden"); ?>
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $uitProveedor,
                        'language' => 'es',
                        'options' => array('changeYear' => true, 'yearRange' => '1950:2050'),
                        'attribute' => "[$id]fec_servicio_orden",
                        'htmlOptions' => array(
                            'class' => 'span2',
                        ),
                    ));
                    ?>
                </div>
                <div class="span2">
                    <?php echo $form->labelEx($uitProveedor, "[$id]fec_servicio_atencion"); ?>
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $uitProveedor,
                        'language' => 'es',
                        'options' => array('changeYear' => true, 'yearRange' => '1950:2050'),
                        'attribute' => "[$id]fec_servicio_atencion",
                        'htmlOptions' => array(
                            'class' => 'span2',
                        ),
                    ));
                    ?>
                    <br/><br/>
                </div>
                <div class="span2">
                    <?php echo $form->labelEx($uitProveedor, "[$id]fec_servicio_usuario"); ?>
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $uitProveedor,
                        'language' => 'es',
                        'options' => array('changeYear' => true, 'yearRange' => '1950:2050'),
                        'attribute' => "[$id]fec_servicio_usuario",
                        'htmlOptions' => array(
                            'class' => 'span2',
                        ),
                    ));
                    ?>
                </div>
                <div class="span2">
                    <?php echo $form->dropDownListRow($uitProveedor, "[$id]cod_servicio_estado", EEstadoServicio::getEstadoServicioArray(), array('class' => 'span2', 'maxlength' => 50,)); ?>
                </div>
            </div>
            <?php if($uitProveedor->uitfactura == null) { $uitProveedor->uitfactura = array(new UitFactura()); } ?>
            <?php foreach ($uitProveedor->uitfactura as $idx => $factura) { ?>    
            <div class="row">
                <div class="span4">
                   <?php echo $form->hiddenfield($factura, "[$id][$idx]pk_uitfactura"); ?>
                   <?php echo $form->textFieldRow($factura, "[$id][$idx]des_factura", array('class' => 'span4')); ?>
                </div>   
                <div class="span2">
                   <?php echo $form->labelEx($factura, "[$id][$idx]fec_factura"); ?>
                   <?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'model' => $factura,
                            'language' => 'es',
                            'options' => array('changeYear' => true, 'yearRange' => '1950:2050'),
                            'attribute' => "[$id][$idx]fec_factura",
                            'htmlOptions' => array(
                                'class' => 'span2',
                            ),
                        ));
                  ?>
                </div>
                <div class="span2">
                    <?php echo $form->textFieldRow($factura, "[$id][$idx]num_gasto", array('class' => 'span2')); ?>
                </div>
            </div>
            <div class="row">
                <div class="span4">
                   <?php echo $form->textAreaRow($factura, "[$id][$idx]des_descripcion", array('class' => 'span4', 'rows' => 3)); ?>
                </div>
                <div class="span4">
                    <?php echo $form->dropDownListRow($factura, "[$id][$idx]des_area", EArea::getAreaArray(), array('class' => 'span4', 'maxlength' => 50,)); ?>
                </div>
            </div><br/>
            <?php
            }
        }
    } else {
        ?>
        <label style="font-style: italic">No hay servicios asignados</label>
        <?php
    }
}
?>
