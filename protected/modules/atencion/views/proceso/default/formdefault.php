<?php $this->renderPartial('_get_script'); ?>
<div class="row">
    <div class="span9">
        <h3>Atender Solicitud Nro. <?php echo $solicitud->customcod; ?></h3>
        <label style="font-style: italic">Observación</label>
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
<?php $this->renderPartial('_form', array('tramite'=>$tramite)); ?>

<!-- DialogOptionWindow -->
<?php echo $this->renderPartial('../opcion/_devolver', array('tramite'=>$tramite)); ?>
<?php echo $this->renderPartial('../opcion/_rechazar', array('tramite'=>$tramite)); ?>
<?php echo $this->renderPartial('../opcion/_atencion', array('solicitud'=>$solicitud)); ?>