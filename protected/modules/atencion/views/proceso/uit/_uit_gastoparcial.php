<div class="row">
    <?php if (is_array($uitproveedors)) { ?>
        <?php if (count($uitproveedors) > 0) { ?>
            <div class="span7">
                <a title="Agregar Nueva Factura" data-target="#FacturaUitModal" class="view" data-toggle="modal" href="#" rel="tooltip"><i class="icon-plus"></i>Nueva Factura</a><br/><br/>
            </div>
            <?php if (is_array($uitproveedors)) { ?>
                <?php if (count($uitproveedors) > 0) { ?>
                    <?php foreach ($uitproveedors as $id => $uitProveedor) { ?>
                        <?php if($id!=0) { echo "<div class='modal-footer span-15'></div>"; } ?>
                        <div class="span8">
                            <b style="font-style: italic"><?php echo $uitProveedor->proveedor->des_identificacion . " -  RUC:" . $uitProveedor->proveedor->des_ruc; ?></b><br/><br/>
                            <?php echo $form->dropDownListRow($uitProveedor, "[$id]cod_servicio_estado", EEstadoServicio::getEstadoServicioArray(), array('class' => 'span8', 'maxlength' => 50,)); ?><br/><br/>
                        </div>
                        <div class="span8">
                            <?php $this->renderPartial('_get_tablefactura', array('id' => $id, 'uitProveedor' => $uitProveedor)); ?><br/><br/>
                        </div>
                        <?php
                    }
                }
            }
            ?>
            <?php
        }else {
        ?>
        <div class="span7">
        <label style="font-style: italic">No hay facturas registradas</label>
        </div>
        <?php }
    } 
    ?>
</div>
<?php
Yii::app()->clientScript->registerScript($id . 'facturauit', " 
$('#AddFactura').live('click',function(){
        $('#operation').val('addfactura');
        $('#uit-form').submit();
        
        $('#FacturaUitModal').modal('hide');
        $('#operation').val('');
        return false;
});
");
?>