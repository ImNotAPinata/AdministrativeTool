<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


$this->menu = array(
    array('label'=>'Subir Documento', 'url'=>array('upload')),
    array('label' => 'Documentos', 'url' => array('index')),
);
?>

<h1>Subir Documento</h1>

<?php 

$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'type' => 'horizontal',
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'post',
    'htmlOptions' => array('enctype'=>'multipart/form-data')
        ));
?>

<fieldset>
    <br/>
    <?php echo $form->fileFieldRow($uploadform, 'archivo'); ?>
    <?php echo $form->textFieldRow($uploadform, 'doc_name'); ?>
    <?php echo $form->dropDownListRow($uploadform, 'cod_estado', EECP::getEcpArray(), array('class' => 'span3', 'empty' => 'Elegir..')); ?>
    <?php echo $form->textAreaRow($uploadform, 'split_info', array('class' => 'span5', 'rows' => 12)); ?>
</fieldset>
<div class="form-actions">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'label' => 'Subir',
    ));
    ?>
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'reset',
        'label' => 'Limpiar'));
    ?>
</div>
<?php $this->endWidget(); ?>
