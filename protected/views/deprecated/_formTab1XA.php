<div id="leftContent"  class="span-16" >
    <h3>Atender Solicitud Nro. <?php echo $solicitud->customcod; ?></h3>
    
    <h5>Prioridad: <?php $this->widget('bootstrap.widgets.TbLabel', array(
                    'type'=>F_Css::getBootstrapColorNamebyCode($solicitud->cod_prioridad),
                    'label'=>$solicitud->prioridad,
                )); ?>
    </h5><br/> 
    
    <div id="contentForm">
        <fieldset>
            <?php
            $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id' => 'uit-form',
                'type' => 'vertical',
                'action' => Yii::app()->createUrl("atencion/solicitud/atender/saveuit"),
                'enableAjaxValidation' => false,
                    ));
            ?>

            <legend style="font-size: small"><b>Nota:</b> Si usted quiere editar un registro ya adjunto hacer clic en la lista del lado derecho</legend>

            <?php echo $form->errorSummary($uit); ?>
            <?php echo $form->hiddenField($tramite, 'fk_solicitud'); ?>
            <?php echo $form->hiddenField($tramite, 'selectedDocumento'); ?>
            <?php echo $form->hiddenField($uit, 'cod_reg'); ?>
            <?php echo $form->hiddenField($uit, 'cod_area'); ?>

            <div class="row">
                <div class="span-3">
                    <?php echo $form->uneditableRow($uit, 'area'); ?>
                </div>
                <div class="span-7">
                    <?php echo $form->uneditableRow($uit, 'persona'); ?>
                </div>
            </div>

            <div class="row">
                <div class="span-10">
                    <?php echo $form->textFieldRow($uit, 'num_siged', array('class' => 'span5', 'maxlength' => 50)); ?>

                    <?php echo $form->textAreaRow($uit, 'des_descripcion', array('rows' => 6, 'cols' => 50, 'class' => 'span5')); ?>
                </div>    
                <div class="span-5">
                    <?php echo $form->labelEx($uit, 'fec_siged'); ?>
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'name' => 'uit_fsiged',
                        'model' => $uit,
                        'language' => 'es',
                        'options' => array('changeYear' => true, 'yearRange' => '1950:2050'),
                        'attribute' => 'fec_siged',
                        'htmlOptions' => array(
                            'class' => 'span3',
                        ),
                    ));
                    ?>

                    <?php echo $form->dropDownListRow($uit, 'cod_estado', Yii::app()->params->estadoUIT, array('class' => 'span3', 'maxlength' => 50, 'empty' => 'Elegir ..')); ?>
                    <?php echo $form->textFieldRow($uit, 'mto_importe', array('class' => 'span3', 'maxlength' => 50)); ?>
                </div>
            </div>

            <div class="row">
                <div class="span-16">
                    <table id="bienesuit-grid" class="table table-condensed">
                        <thead>
                            <tr>
                                <th colspan="5" style="background: white"><a title="Agregar Bien" data-target="#SUITModal" class="view" data-toggle="modal" href="#"><i class="icon-plus"></i></a></th>
                            </tr>
                            <tr>
                                <th><?php echo CHtml::encode(BienUit::model()->getAttributeLabel('pk_bien')); ?></th>
                                <th><?php echo CHtml::encode(BienUit::model()->getAttributeLabel('pk_proveedor')); ?></th>
                                <th><?php echo CHtml::encode(BienUit::model()->getAttributeLabel('num_cantidad')); ?></th>
                                <th><?php echo CHtml::encode(BienUit::model()->getAttributeLabel('num_precio')); ?></th>
                                <th><?php echo CHtml::encode(BienUit::model()->getAttributeLabel('des_umedida')); ?></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php if (is_array($uit->bienUits)) { ?>
                                    <?php foreach ($uit->bienUits as $id => $bienuit) { ?>
                                    <tr>
                                        <?php // los pongo ocultos para que se vea bonito ?>
                                        <?php echo chtml::activeHiddenField($bienuit, "[$id]pk_bien", array('class' => 'mycustomrow', 'maxlength' => 100)); ?>
                                        <?php echo chtml::activeHiddenField($bienuit, "[$id]pk_proveedor", array('class' => 'mycustomrow', 'maxlength' => 100)); ?>
                                        <?php echo chtml::activeHiddenField($bienuit, "[$id]num_cantidad", array('class' => 'mycustomrow', 'maxlength' => 100)); ?>
                                        <?php echo chtml::activeHiddenField($bienuit, "[$id]num_precio", array('class' => 'mycustomrow', 'maxlength' => 100)); ?>
                                        <?php echo chtml::activeHiddenField($bienuit, "[$id]des_umedida", array('class' => 'mycustomrow', 'maxlength' => 100)); ?>
                                        
                                        <td><?php echo $bienuit->Bien; ?></td>
                                        <td><?php echo $bienuit->Proveedor; ?></td>
                                        <td><?php echo $bienuit->num_cantidad; ?></td>
                                        <td><?php echo $bienuit->num_precio; ?></td>
                                        <td><?php echo $bienuit->des_umedida; ?></td>
                                        <td><a class=delete title=Borrar href="<?php echo Yii::app()->createUrl("atencion/solicitud/atender/formuit/id/$sid/", array('bienuitid' => "$id")); ?>" rel=tooltip><i class=icon-trash></i></a></td>
                                    </tr>
                               <?php }} else { ?>
                                <tr><td><tt>Solicitud sin bienes</tt></td></tr>
                               <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="form-actions">
            <?php echo $form->textAreaRow($tramite, 'des_observacion', array('class' => 'span-15', 'rows' => 6, 'title' => 'Ingrese sus observaciones')); ?>
            </div>
            <?php echo $this->renderPartial('_formOpcion', array('tramite' => $tramite, 'form' => $form)); //array('label'=>'Atender','path'=>'..\..\atender')  ?>  
        <?php $this->endWidget(); ?>
        </fieldset>
        <?php $this->renderPartial('_suit', array('bien' => $bien, 'proveedor' => $proveedor, 'bienuit' => $bienuit)); ?>
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