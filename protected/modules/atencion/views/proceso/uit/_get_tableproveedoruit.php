<table id="proveedores-grid" class="table table-condensed table-bordered" style="background: white;">
    <?php if (is_array($uitproveedors)) { ?>
        <?php if ((count($uitproveedors) <= 0 && $uit->cod_uit_tipo == ETipoUIT::GastosParciales) || $uit->cod_uit_tipo == ETipoUIT::PorDefecto) { ?>
            <div class="span7">
                <a title="Agregar Proveedor" data-target="#ProveedorUitModal" class="view" data-toggle="modal" href="#"><i class="icon-plus"></i> Agregar Proveedor</a>
            </div>
        <?php } ?>
    <?php } ?>
    <thead>
        <tr>
            <th>#</th>
            <th><?php echo CHtml::encode(Proveedor::model()->getAttributeLabel('des_descripcion')); ?></th>
            <th><?php echo CHtml::encode(Proveedor::model()->getAttributeLabel('des_ruc')); ?></th>
            <th><?php echo CHtml::encode(UitProveedor::model()->getAttributeLabel('num_importe')); ?></th>
            <th><?php echo CHtml::encode(UitProveedor::model()->getAttributeLabel('cod_patrimonial_calificacion')); ?></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php if (is_array($uitproveedors)) { ?>
            <?php if (count($uitproveedors) > 0) { ?>
                <?php foreach ($uitproveedors as $id => $uitProveedor) { ?>
                    <tr>
                        <?php // los pongo ocultos para que se vea bonito ?>
                        <?php echo chtml::activeHiddenField($uitProveedor, "[$id]pk_uitproveedor"); ?>
                        <?php echo chtml::activeHiddenField($uitProveedor, "[$id]fk_proveedor"); ?>
                        <?php echo chtml::activeHiddenField($uitProveedor, "[$id]num_importe"); ?>
                        <?php echo chtml::activeHiddenField($uitProveedor, "[$id]cod_patrimonial_calificacion"); ?>
                        <?php $item = $id; ?>
                        <td><?php echo sprintf('%02d', $item + 1); ?></td>
                        <td><?php echo $uitProveedor->proveedor->des_identificacion; ?></td>
                        <td><?php echo $uitProveedor->proveedor->des_ruc; ?></td>
                        <td><?php echo F_Number::FormatoNumeroDecimal($uitProveedor->num_importe); ?></td>
                        <td><?php echo EBooleano::getBooleanobyCode($uitProveedor->cod_patrimonial_calificacion); ?></td>
                        <td><a class=delete title=Borrar href="#" itemid="<?php echo $id; ?>" rel=tooltip><i class=icon-trash></i></a></td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr><td colspan="5" style="font-style: italic">Solicitud sin proveedores</td></tr>
            <?php }
        }
        ?>
    </tbody>
</table>