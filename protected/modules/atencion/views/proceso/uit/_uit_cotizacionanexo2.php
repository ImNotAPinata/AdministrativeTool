<div class="row">
    <div class="span2">
        <?php echo $form->labelEx($uit, 'fec_asignado_siged'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $uit,
            'language' => 'es',
            'options' => array('changeYear' => true, 'yearRange' => '1950:2050'),
            'attribute' => 'fec_asignado_siged',
            'htmlOptions' => array(
                'class' => 'span2',
            ),
        ));
        ?>        
        <?php echo $form->error($uit, 'fec_asignado_siged'); ?>
    </div>
    <div class="span2">
        <?php echo $form->labelEx($uit, 'fec_devolucion_siged'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $uit,
            'language' => 'es',
            'options' => array('changeYear' => true, 'yearRange' => '1950:2050'),
            'attribute' => 'fec_devolucion_siged',
            'htmlOptions' => array(
                'class' => 'span2',
            ),
        ));
        ?>        
        <?php echo $form->error($uit, 'fec_devolucion_siged'); ?>
    </div>
    <div class="span2">
        <?php echo $form->labelEx($uit, 'fec_atencion_siged'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $uit,
            'language' => 'es',
            'options' => array('changeYear' => true, 'yearRange' => '1950:2050'),
            'attribute' => 'fec_atencion_siged',
            'htmlOptions' => array(
                'class' => 'span2',
            ),
        ));
        ?>        
        <?php echo $form->error($uit, 'fec_atencion_siged'); ?>
    </div>
    <div class="span2">
        <?php echo $form->labelEx($uit, 'fec_recepcion_siged'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $uit,
            'language' => 'es',
            'options' => array('changeYear' => true, 'yearRange' => '1950:2050'),
            'attribute' => 'fec_recepcion_siged',
            'htmlOptions' => array(
                'class' => 'span2',
            ),
        ));
        ?>        
        <?php echo $form->error($uit, 'fec_recepcion_siged'); ?>
    </div>
</div>
<br/><br/>
<div class="row">
    <div class="span8">
        <?php $this->renderPartial('_get_tableproveedoruit', array('uit' => $uit, 'uitproveedors' => $uit->uitproveedors)); ?>
    </div>
</div>
<?php
//$('#proveedoruit-form').each (function(){ this.reset(); }); // limpiamos formulario
?>