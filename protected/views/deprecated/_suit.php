<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'SUITModal')); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Agregar nuevo bien UIT </h4>
</div>
 
<div class="modal-body">   
    <div class="row">
        <div class="span-12">
            <?php
            $this->widget('bootstrap.widgets.TbGridView', array(
                'id' => 'bienuit-grid',
                'dataProvider' => $bien->search(),
                'filter' => $bien,
                'summaryText' => '',
                'summaryCssClass' => null,
                'loadingCssClass' => null,
                'enableSorting'=> false,
                'htmlOptions' => array('style' => 'padding-top:0'),
                'selectableRows' => 1,
                'selectionChanged'=>"function(id){ $('#selectedBien').val($.fn.yiiGridView.getSelection(id)); }",
                'columns' => array(
                    'des_bien',
                    'des_marca',
                ),
            ));
            ?>
            <?php $this->widget('bootstrap.widgets.TbGridView', array(
                        'id' => 'proveedoruit-grid',
                        'dataProvider' => $proveedor->search(),
                        'filter' => $proveedor,
                        'summaryText' => '',
                        //'ajaxUrl'=>'',
                        'summaryCssClass' => null,
                        'loadingCssClass' => null,
                        //'enableSorting'=> false,
                        'htmlOptions' => array('style' => 'padding-top:0;'),
                        'selectableRows' => 1,
                        'selectionChanged'=>"function(id){ $('#selectedProveedor').val($.fn.yiiGridView.getSelection(id)); }",
                        'columns' => array(
                            'des_razonsocial',
                            'des_ruc',
                        ),
                    ));
            ?>
        </div>
        <div class="span-5 last">
            <?php
            $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id' => 'bienuit-form', // se debe de especificar el id del bien a elegir
                    ));
            ?>
            <?php echo $form->HiddenField($bienuit, 'pk_proveedor',array('id'=>'selectedProveedor')); ?>
            <?php echo $form->HiddenField($bienuit, 'pk_bien',array('id'=>'selectedBien')); ?>
            <?php echo $form->textFieldRow($bienuit, 'des_umedida', array('class' => 'span2', 'maxlength' => 50)); ?>
            <?php echo $form->textFieldRow($bienuit, 'num_cantidad', array('class' => 'span2', 'maxlength' => 50)); ?>
            <?php echo $form->textFieldRow($bienuit, 'num_precio', array('class' => 'span2', 'maxlength' => 50)); ?>
            <?php echo $form->textFieldRow($bienuit, 'cod_temporal', array('class' => 'span2', 'maxlength' => 50)); ?>
            
            <div class="form-actions">
                <?php
                $this->widget('bootstrap.widgets.TbButton', array(
                    'buttonType' => 'submit',
                    'type' => 'primary',
                    'label' => 'Agregar',
                    'htmlOptions' => array('id' => 'AddBien'),
                ));
                ?>
            </div>
         <?php $this->endWidget(); ?>
        </div>
    </div>
</div>

<?php $this->endWidget(); ?>
