<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'vsolicitudModal')); ?>

<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h1 id="title" style="cursor: default">Nro. <?php echo $solicitud->customcod; ?></h1>
</div>

<div class="modal-body">           
    <?php
    $this->widget('bootstrap.widgets.TbDetailView', array(
        'type' => array('stripped'),
        'data' => $solicitud,
        'nullDisplay' => ' - ',
        'attributes' => array(
            array('name' => 'solicitante', 'label' => 'Solicitante'),
            array('name' => 'proceso.des_descripcion', 'label' => 'Tipo'),
            array('name' => 'proceso.des_proceso', 'label' => 'Asunto'),
            array('name' => 'des_descripcion', 'label' => 'Descripción'),
        ),
    ));
    ?>
</div>
<?php $this->endWidget(); ?>