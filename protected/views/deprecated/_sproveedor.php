<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'SProveedorModal')); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Agregar un Proveedor </h4>
</div>
 
<div class="modal-body">           
    <div class="row">
        <div class="span-12">
            <?php $this->widget('bootstrap.widgets.TbGridView', array(
                        'id' => 'proveedor-grid',
                        'dataProvider' => $proveedor->search(),
                        'filter' => $proveedor,
                        'summaryText' => '',
                        'summaryCssClass' => null,
                        'loadingCssClass' => null,
                        'htmlOptions' => array('style' => 'padding-top:0;'),
                        'selectableRows' => 1,
                        'selectionChanged'=>"function(id){ $('#selectedProveedor').val($.fn.yiiGridView.getSelection(id)); }",
                        'columns' => array(
                            'des_razonsocial',
                            'des_ruc',
                            'des_contacto_1'
                        ),
                    ));
            ?>
        </div>
        <div class="span-3 last">
            <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id' => 'proveedor-form', // se debe de especificar el id del bien a elegir
                    ));
            ?>
            <?php echo $form->HiddenField($proveedor, 'pk_proveedor',array('id'=>'selectedProveedor')); ?>
            <?php $this->widget('bootstrap.widgets.TbButton', array(
                        'buttonType' => 'submit',
                        'type' => 'primary',
                        'label' => 'Agregar',
                        'htmlOptions' => array('id' => 'AddProveedor'),
                    ));
            ?>
            <?php $this->endWidget(); ?>

        </div>
    </div>
 </div>  


<?php $this->endWidget(); ?>
