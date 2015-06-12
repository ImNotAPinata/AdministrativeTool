<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Actividades de atención</h4>
    <input type="hidden" id="selected" value="<?php echo $selectedid; ?>">
</div>
 
<div class="modal-body">           
    <h8>Actividades:<br/> <?php echo CHtml::dropDownList('forms','0', CHtml::listData(Actividad::load(), 'pk_actividad', 'des_actividad', 'des_tipo'), array('class' => 'span4', 'maxlength' => 50, 'id' => 'listForm', 'empty' => 'Elegir..'));  ?>
    </h8><br/><br/>
    
    <h8>Cargue una actividad ya iniciada:</h8>
    <?php $this->widget('bootstrap.widgets.TbGridView', array(
                    'id' => 'docssolicitud-grid',
                    'type'=>'condensed',
                    'summaryText' => '',
                    'showTableOnEmpty'=>false,
                    'enablePagination'=>false,
                    'emptyText'=>'La solicitud no tiene atencion adjunta',
                    'dataProvider' => $registro->searchActividades(),
                    'columns' => array(
                        'actividad.des_actividad',
                         array(
                            'class'=>'bootstrap.widgets.TbButtonColumn',
                            'template'=>'{update}',
                            'updateButtonIcon'=>'share-alt',
                            'buttons' => array(
                                'update' => array
                                    (
                                        'label'=>'Cargar Actividad',
                                        'url'=>'Yii::app()->createUrl("atencion/proceso/".$data->des_controller."/update/", array("id"=>$data->cod_id,"sid"=>$data->fk_solicitud))', 
                                    )),
                        ),
                    ),
                ));
            ?> 
 </div>  
