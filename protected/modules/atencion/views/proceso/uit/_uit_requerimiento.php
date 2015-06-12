<?php echo $form->hiddenField($tramite, 'fk_solicitud'); ?>
<?php echo $form->hiddenField($tramite, 'selected'); ?>

<div class="row">
    <div class="span4">
        <?php echo $form->hiddenfield($uit, 'pk_uit'); ?>
        <?php echo $form->hiddenfield($uit, 'des_registro_solicitante',array('id'=>'solreg')); ?>
        <?php echo $form->textFieldRow($uit, 'des_nombre_solicitante', array('id'=>'solname','class' => 'span4')); ?>
    </div>
    <div class="span3">
        <?php echo $form->textFieldRow($uit, 'des_area_solicitante', array('id'=>'solarea','class' => 'span3')); ?>
    </div>
    <div class="span-1"><br/>
        <?php echo chtml::link('buscar','#',array('data-target'=>'#FindPersonalModal','data-toggle'=>'modal'));?>
    </div>
</div>
<div class="row">
    <div class="span7">
        <?php echo $form->textFieldRow($uit, 'num_uit_siged', array('class' => 'span7', 'maxlength' => 50)); ?>
    </div>
    <div class="span7">
        <?php echo $form->textAreaRow($uit, 'des_uit_descripcion', array('rows' => 6, 'cols' => 50, 'class' => 'span7')); ?>
    </div>
    <div class="span4">
        <?php echo $form->labelEx($uit, 'fec_uit_siged'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'uit_fsiged',
            'model' => $uit,
            'language' => 'es',
            'options' => array('changeYear' => true, 'yearRange' => '1950:2050'),
            'attribute' => 'fec_uit_siged',
            'htmlOptions' => array(
                'class' => 'span4',
            ),
        ));
        ?>        
    </div>
    <div class="span3">
        <?php echo $form->textFieldRow($uit, 'num_uit_importe', array('class' => 'span3', 'maxlength' => 50)); ?>
    </div>
    <div class="span4">
        <?php echo $form->labelEx($uit, 'des_proyectado_por'); ?>
        <?php echo $form->dropDownList($uit,'des_proyectado_por', Persona::getResponsablesUIT(), array('class' => 'span4', 'maxlength' => 50, 'empty' => 'Elegir..'));?>
    </div><div class="span3">
        <?php echo $form->dropDownListRow($uit, "cod_uit_tipo", ETipoUIT::getTipoUitArray(), array('class' => 'span3', 'maxlength' => 50,'id'=>'uit_tipo')); ?>
    </div>
</div>
<?php 
Yii::app()->clientScript->registerScript('uitreq', "
$('#persona-grid table tbody tr').live('click',function(e) 
{ 
        var reg=$(this).children(':nth-child(1)').text(); 
        var name=$(this).children(':nth-child(2)').text()+', '+$(this).children(':nth-child(3)').text(); 
        var area=$(this).children(':nth-child(4)').text(); 
        
        $('#solreg').val(reg);
        $('#solname').val(name);
        $('#solarea').val(area);
        $('#FindPersonalModal').modal('hide');
}); 

");
?>

<?php echo $this->renderPartial('..\..\emergente\_getpersonal', array('persona' => $persona)); ?>
