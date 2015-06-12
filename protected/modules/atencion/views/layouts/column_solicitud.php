<?php $this->beginContent('/layouts/main'); ?>
<div id="content">
    <?php
    $this->widget('bootstrap.widgets.TbMenu', array(
        'type' => 'tabs', // '', 'tabs', 'pills' (or 'list')
        'items' => array(
            array('label' => 'Nueva Solicitud', 'icon' => 'plus-sign', 'url' => Yii::app()->createUrl("atencion/solicitud/formulario/empty")),
            array('label' => 'Mis Solicitudes', 'icon' => 'book', 'url' => Yii::app()->createUrl("atencion/solicitud/personal")),
            array('label' => 'Atender Solicitudes', 'icon' => 'book', 'url' => Yii::app()->createUrl("atencion/solicitud/atender"), 'visible' => Yii::app()->user->esAtenderVisible()),
            array('label' => 'Aprobar Solicitudes', 'icon' => 'book', 'url' => Yii::app()->createUrl("atencion/solicitud/aprobar"), 'visible' => Yii::app()->user->esAdministrador()),
        ),
    ));
    ?>
    <?php echo $content; ?>
</div><!-- content -->
<?php $this->endContent(); ?>