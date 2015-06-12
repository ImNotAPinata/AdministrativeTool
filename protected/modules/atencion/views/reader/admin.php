<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$this->menu=array(
     array('label'=>'Subir Documento', 'url'=>array('upload')),
     array('label' => 'Documentos', 'url' => array('index')),
);


Yii::app()->clientScript->registerScript('uploaddocumento', "
$.ajaxSetup({   
    error: function(xhr, status, error) 
    {     
       alert('Un error occurío: ' + status + '. Comuniquese con el Administrador del Sistema. Error: ' + error + ' Response Text:' + xhr.responseText);   
    }       
}); 

$('#title').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
        $.fn.yiiGridView.update('uploadeddocumentos-grid', {
                data: $(this).serialize()
	});
	return false;
});

");
?>

<h1 id="title" style="cursor: default" title="Clic para abrir/ocultar opciones de filtrado avanzado" >Documentos Registrados</h1>
<div class="search-form" style="display:visible">
    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                    'id' => 'report-atencion',
                    'action' => Yii::app()->createUrl($this->route),
                    'method' => 'get',
                        ));
    ?>
    <div class="row">
        <div class="span3">
            <?php echo $form->label($documento, 'des_documento', array('required' => false)); ?>
            <?php echo $form->textField($documento, 'des_documento', array('class' => 'span3', 'maxlength' => 50)); ?>
        </div>
        <div class="span3">
            <?php echo $form->dropDownListRow($documento, 'cod_tipo', EEcp::getEcpArray(), array('class' => 'span3','empty'=>'Elegir..')); ?>
        </div>
    </div>
    <div class="row"><br/>
        <div class="span10">
            <?php
            $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType' => 'submit',
                'type' => 'primary',
                'label' => 'Buscar',
            ));
            ?>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>

<?php 

    $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'uploadeddocumentos-grid',
	'dataProvider'=>$documento->search(),
        'type'=>'condensed bordered',
        'nullDisplay'=>' - ',
        //'filter'=>$model,
	'columns'=>array(
               'des_documento',
               'cod_tipo',
                array(
			'class'=>'CButtonColumn',
                        'template'=>'{view}',
                        
		),
	),
)); 
 
?>