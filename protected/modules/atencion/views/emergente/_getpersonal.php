<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'FindPersonalModal')); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Búsqueda de Personal</h4>
    <div style="font-size: small">
        Seleccione un persona haciendo clic en la fila de la persona.
    </div>
</div>
 
<div class="modal-body">           
        <?php  $this->widget('bootstrap.widgets.TbGridView', array(
                'id'=>'persona-grid',
                'dataProvider'=>$persona->search(),
                'filter'=>$persona,
                'enableSorting'=>false,
                'summaryText'=>'',
                'columns'=>array(
                        'num_registro',
                        array(
                            'name'=>'ape_persona',
                            'type' => 'raw',
                            'value'=>'F_String::getUpperStartedLowerFollowedWord($data->ape_persona)',
                        ),
                        array(
                            'name'=>'nom_persona',
                            'type' => 'raw',
                            'value'=>'F_String::getUpperStartedLowerFollowedWord($data->nom_persona)',
                        ),
                        'cod_uuoo',
                ),
        )); 
        ?>
    
 </div>  
<?php $this->endWidget(); ?>

