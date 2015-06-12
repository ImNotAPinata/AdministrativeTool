<?php $this->renderPartial('_get_script', array('uit' => $uit)); ?>

<div class="row">
    <div class="span9">
        <h3>Atender Solicitud Nro. <?php echo $solicitud->customcod; ?></h3>
        <label style="font-style: italic; font-size: smaller"> Seguimiento Req. <3 UIT</label>
    </div>
    <div class="span2">
        <br/>
        <h5>      
            Prioridad: <?php
            $this->widget('bootstrap.widgets.TbLabel', array(
                'type' => F_Css::getBootstrapColorNamebyCode($solicitud->cod_prioridad),
                'label' => $solicitud->prioridad,
            ));
            ?>
        </h5>
    </div>
</div>
<br/>
<?php $this->renderPartial('_form', array('tramite' => $tramite, 'uit' => $uit, 'facturauit' => $facturauit, 'persona' => $persona, 'proveedor' => $proveedor, 'proveedoruit' => $proveedoruit)); ?>
<div class="row">
    <div class="btn-toolbar span7">
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'label' => 'Atender',
            'type' => 'primary',
            'htmlOptions' => array(
                'data-toggle' => 'modal',
                'data-target' => '#FinalizarAtencionModal',
            ),
        ));
        ?>  
        <?php $this->renderPartial('../opcion/_menu'); ?>
    </div>
</div>  

<!-- DialogOptionWindow -->
<?php echo $this->renderPartial('../opcion/_devolver', array('tramite'=>$tramite)); ?>
<?php echo $this->renderPartial('../opcion/_rechazar', array('tramite'=>$tramite)); ?>
<?php echo $this->renderPartial('../opcion/_atencion', array('solicitud'=>$solicitud)); ?>
<?php /* echo $this->renderPartial('../opcion/_vmovimiento', array('tramite'=>$tramite)); ?>
<?php echo $this->renderPartial('../opcion/_vsolicitud', array('solicitud'=>$solicitud)); */?>