<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'ModalidadModal')); ?>
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Cambiar actividad de atención</h4>
</div>
 
<div class="modal-body">           
    <h8>Actividades:<br/> <?php echo CHtml::dropDownList('forms','0', CHtml::listData(Actividad::load(), 'pk_actividad', 'des_actividad', 'des_tipo'), array('class' => 'span4', 'maxlength' => 50, 'id' => 'listForm', 'empty' => 'Elegir..'));  ?>
    </h8><br/><br/>
        
    <h8>Cargue una actividad ya iniciada:</h8>
    <br/><br/>
    <table id="atencion-grid" class="table table-condensed">
        <thead>
            <tr>
                <th>Actividades en Atención</th>
            </tr>
        </thead>
        <tbody>
            <?php if (is_array($solicitud->registros)) { ?>
                <?php foreach ($solicitud->registros as $id => $registro) { ?>
                    <tr>
                        <?php echo chtml::activeHiddenField($registro, "[$id]fk_actividad", array('class' => 'mycustomrow', 'maxlength' => 100)); ?>
                        <td>
                            <?php echo $registro->actividad->des_actividad; ?>
                        </td>
                        <td class="button-column">
                            <a class=delete title='Cargar Actividad' href="<?php echo Yii::app()->createUrl("atencion/proceso/".$registro->des_controller."/update/", array("id"=>$registro->cod_id,"sid"=>$registro->fk_solicitud)); ?>" rel=tooltip><i class="icon-share-alt"></i></a>
                        </td>
                    </tr>
                <?php }
            } else {
                ?>
                <tr>
                    <td><tt>La solicitud no tiene atenciones previas</tt></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>  

<?php $this->endWidget(); ?>

<?php 
Yii::app()->clientScript->registerScript('chooser', "
$('#listForm').live('change',function(){
    var selectedSolicitud = $solicitud->pk_solicitud; 
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

