<table id="factura-grid<?php echo $id; ?>" class="table table-condensed table-bordered" style="background: white;">
    <thead>
        <tr>
            <th>#</th>
            <th style="font-size: x-small"><?php echo CHtml::encode(UitFactura::model()->getAttributeLabel('des_descripcion')) ?></th>
            <th style="font-size: x-small"><?php echo CHtml::encode(UitFactura::model()->getAttributeLabel('des_area')) ?></th>
            <th style="font-size: x-small"><?php echo CHtml::encode(UitFactura::model()->getAttributeLabel('des_factura')) ?></th>
            <th style="font-size: x-small"><?php echo CHtml::encode(UitFactura::model()->getAttributeLabel('fec_factura')) ?></th>
            <th style="font-size: x-small"><?php echo CHtml::encode(UitFactura::model()->getAttributeLabel('num_gasto')) ?></th>
            <th style="font-size: x-small"><?php echo 'Saldo(S/.)'; ?></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $importe = $uitProveedor->num_importe;
        if (is_array($uitProveedor->uitfactura)) {
            if (count($uitProveedor->uitfactura) > 0) {
                foreach ($uitProveedor->uitfactura as $idx => $factura) {
                    ?>
                    <tr>
                        <?php $item = $idx; ?>
                        <?php echo chtml::activeHiddenField($factura, "[$idx]pk_uitfactura"); ?>
                        <?php echo chtml::activeHiddenField($factura, "[$idx]fk_uitproveedor"); ?>
                        <?php echo chtml::activeHiddenField($factura, "[$idx]des_descripcion"); ?>
                        <?php echo chtml::activeHiddenField($factura, "[$idx]des_area"); ?>
                        <?php echo chtml::activeHiddenField($factura, "[$idx]des_factura"); ?>
                        <?php echo chtml::activeHiddenField($factura, "[$idx]num_gasto"); ?>
                        <?php echo chtml::activeHiddenField($factura, "[$idx]fec_factura"); ?>
                        <?php echo chtml::activeHiddenField($factura, "[$idx]selected"); ?>
                        <td><?php echo sprintf('%02d', $item + 1); ?></td>
                        <td><?php echo $factura->des_descripcion; ?></td>
                        <td><?php echo $factura->des_area; ?></td>
                        <td><?php echo $factura->des_factura; ?></td>
                        <td><?php echo $factura->fec_factura; ?></td>
                        <td><?php echo F_Number::FormatoNumeroDecimal($factura->num_gasto); ?></td>
                        <td><?php $importe = $importe - $factura->num_gasto; echo F_Number::FormatoNumeroDecimal($importe); ?></td>
                        <td><a class=delete title=Borrar href="#" itemid="<?php echo $idx; ?>" rel="tooltip"><i class=icon-trash></i></a></td>
                    </tr>
                    <?php
                    Yii::app()->clientScript->registerScript($id . 'facturarowuit', " 
                    $('#factura-grid" . $id . " a.delete').live('click',function(){
                            $('#operation').val('removefactura');
                            var object = $(this).attr('itemid');
                            $('#item').val(object);
                            $('#uit-form').submit();
                            $('#operation').val('');
                            $('#item').val('');
                            return false;
                    });
                    ");
                    ?>
                    <?php
                }
            } else {
                ?>
                <tr><td colspan="9" style="font-style: italic">Proveedor sin facturas</td></tr>
            <?php
            }
        }
        ?>
    </tbody>
</table>