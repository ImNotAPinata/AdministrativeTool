<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'ModalidadModal')); ?>
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Cambiar modalidad de atención</h4>
</div>
 
<div class="modal-body">           
    <h8>modalidades:<br/> <?php echo CHtml::dropDownList('forms','0', CHtml::listData(Documento::load(), 'pk_documento', 'des_documento', 'des_tipo'), array('class' => 'span4', 'maxlength' => 50, 'id' => 'listForm', 'empty' => 'Elegir..'));  ?>
    </h8><br/><br/>
    
    <h8>Cargue una modalidad ya comenzada:</h8>
    <?php $this->widget('bootstrap.widgets.TbGridView', array(
                    'id' => 'docssolicitud-grid',
                    'type'=>'condensed',
                    'summaryText' => '',
                    'showTableOnEmpty'=>false,
                    'enablePagination'=>false,
                    'emptyText'=>'La solicitud no tiene atenciones previas',
                    'dataProvider' => $registro->searchDocumentos(),
                    'columns' => array(
                        'documento.des_documento',
                         array(
                            'class'=>'bootstrap.widgets.TbButtonColumn',
                            'template'=>'{update}',
                            'updateButtonIcon'=>'share-alt',
                            'buttons' => array(
                                'update' => array
                                    (
                                        'label'=>'Cargar Documento',
                                        'url'=>'Yii::app()->createUrl("atencion/solicitud/atender/loadregistro/", array("id"=>$data->pk_registro))', 
                                    )),
                        ),
                    ),
                ));
            ?> 
</div>  

<?php $this->endWidget(); ?>

<?php 
Yii::app()->clientScript->registerScript('chooser', "
$('#listForm').change(function(){
    $('#loadingAnimation').toggle(); 
    var selectedSolicitud = $id; 
    var selectedOption = $('#listForm').val();

    var url = '".Yii::app()->createUrl("atencion/solicitud/atender/redirect/id")."'+'/'+selectedOption+'/solicitud/'+selectedSolicitud;
    var request = $.ajax({ url: url,
                           cache: false
                  });
                  
    request.success(function(data){
        var obj = $.parseJSON(data);
        window.location.href=obj.redirect; 
    });         
});

");
?>

