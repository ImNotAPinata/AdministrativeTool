<div id="leftContent"  class="span-16" >
    <h3>Atender Solicitud Nro. <?php echo $solicitud->customcod; ?></h3>
    
    <h5>Prioridad: <?php $this->widget('bootstrap.widgets.TbLabel', array(
                    'type'=>F_Css::getBootstrapColorNamebyCode($solicitud->cod_prioridad), // 'success', 'warning', 'important', 'info' or 'inverse'
                    'label'=>$solicitud->prioridad,
                )); ?>
    </h5><br/> 
    
    <h8>Seleccione el tipo de atención:  <?php echo chtml::dropDownList('forms', $selectedForm, CHtml::listData(Documento::load(), 'pk_documento', 'des_documento', 'des_tipo'), array('class' => 'span2', 'maxlength' => 50, 'id' => 'listForm', 'empty' => 'Elegir..'));  ?>
        o cargue un registro adjunto a la solicitud
    </h8><br/><br/>
    <div id="loadingAnimation" class="grid-view-loading" style="display: none"><br/>cargando...</div>
    <div id="contentForm">
            <!-- ajax content -->
    </div>
</div>

<div id="rightContent" class="span-5 last">
    <div class="row">
    <?php $this->widget('bootstrap.widgets.TbButtonGroup', array(
                'buttonType' => 'submit',
                'type' => 'default', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                'buttons' => array(
                    array('label' => 'Opciones', 'items' => array(
                            array('label' => 'Devolver a solicitante',
                                  'url' => '#',
                                  'linkOptions'=>array('id'=>'devolverOption',
                                                       'data-toggle'=>'modal',
                                                       'data-target'=>'#DevolverModal')),
                            array('label' => 'Rechazar la solicitud', 
                                  'url' => '#', 
                                  'linkOptions'=>array('id'=>'rechazarSolicitud',
                                                       'data-toggle'=>'modal',
                                                       'data-target'=>'#RechazarModal')),
                    )),
                ),
            ));
     ?>
    </div>
    <div class="row"><br/>
    <?php
                //$documento->id_solicitud = $solicitud->pk_solicitud;
                $this->widget('bootstrap.widgets.TbGridView', array(
                    'id' => 'docssolicitud-grid',
                    'type'=>'condensed',
                    'summaryText' => '',
                    'showTableOnEmpty'=>false,
                    'enablePagination'=>false,
                    'emptyText'=>'La solicitud no tiene documentos adjuntos',
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
                                        'click'=>'function(){
                                                $("#loadingAnimation").toggle(); 
                                                var rurl = $(this).attr("href");
                                                var urltoload = rurl+"/render/"+UitScriptRendered;
                                                
                                                var request = $.ajax({ 
                                                    url: urltoload,
                                                });
                                                
                                                request.success(function(data) {
                                                    var obj = $.parseJSON(data);
                                                    if(obj!=null){
                                                            $("#contentForm").empty();
                                                            $("#contentForm").append(obj.form);
                                                            $("#loadingAnimation").toggle(); 
                                                    }
                                                    else
                                                    {
                                                            alert("se encontraron errores");
                                                    }
                                                });
                                                
                                                return false;
                                                }',   
                                    )),
                        ),
                    ),
                ));
            ?> 
        </div>
    
    
</div>


<?php
        /*<div class="row">
        <br/>
        <?php 
        //$docs = $documento->search();
        
        /*
        //aqui iria para todos los formularios respectivos
            echo '<table class="table table-striped">
                    <thead>
                        <tr>
                        <th colspan="2">Registros Adjuntos</th>      
                        </tr>
                    </thead>
                    <tbody>';
            
            if($docs)
            { 
                echo '   <tr> 
                            <td><3 UIT</td>
                            <td><a class="update" title="Cargar Documento" rel="tooltip" id="docUIT">
                                <i class="icon-share-alt"></i></a>
                            </td>
                         </tr>'; }
            else
            {
                echo '   <tr> 
                            <td colspan="2" style="font-size: x-small">La atención no ha generado ningun registro adjunto</td> 
                         </tr>';
            }
            echo '</tbody>
                    </table>';</div>*/
  
?>