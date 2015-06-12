<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'ProveedorUitModal')); ?>

<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Agregar nuevo Proveedor </h4>
    <div style="font-size: small">
        Seleccione un proveedor y luego haga clic en agregar.
    </div>
</div>

<div class="modal-body">   
    <div class="row">
        <div class="span-15">
            <?php
            $this->widget('bootstrap.widgets.TbGridView', array(
                'id' => 'proveedoruit-grid',
                'dataProvider' => $proveedor->search(),
                'filter' => $proveedor,
                'summaryText' => '',
                'type'=>'striped bordered condensed',
                //'ajaxUrl'=>'',
                'summaryCssClass' => null,
                'loadingCssClass' => null,
                //'enableSorting'=> false,
                'htmlOptions' => array('style' => 'padding-top:0;'),
                'selectableRows' => 1,
                'selectionChanged' => "function(id){ 
                            var rid = $.fn.yiiGridView.getSelection(id);
                            $('#pro_id').val(rid); 
                        }",
                'columns' => array(
                    'des_identificacion',
                    'des_ruc',
                ),
            ));
            ?>
        </div>
        <div class="span-5 last" id="proveedoruit-form"><br/><br/>

            <?php echo $form->HiddenField($proveedoruit, 'fk_proveedor', array('id' => 'pro_id')); ?>
            <?php echo chtml::HiddenField('', '-', array('id' => 'pro_name')); ?>
            <?php echo chtml::HiddenField('', '-', array('id' => 'pro_ruc')); ?>

            <?php echo $form->checkBoxRow($proveedoruit, 'cod_patrimonial_calificacion'); ?><br/>
            <?php echo $form->textFieldRow($proveedoruit, 'num_importe', array('class' => 'span2')); ?>
            <div class="row">
                <div class="form-actions span-3">
                    <?php
                    $this->widget('bootstrap.widgets.TbButton', array(
                        'buttonType' => 'submit',
                        'type' => 'primary',
                        'label' => 'Agregar',
                        'htmlOptions' => array('id' => 'AddProveedor'),
                    ));
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endWidget(); ?>