   <h3>Nro. <?php echo $solicitud->customcod; ?></h3>
    <div  id="solicitudInformation"> 
        <?php
        $this->widget('bootstrap.widgets.TbDetailView', array(
            'type' => array('stripped'),
            'data' => $solicitud,
            'nullDisplay'=>' - ',
            'attributes' => array(
                array('name' => 'solicitante', 'label' => 'Solicitante'),
                array('name' => 'categoria.des_descripcion', 'label' => 'Tipo'),
                array('name' => 'categoria.des_categoria', 'label' => 'Asunto'),
                array('name' => 'des_descripcion', 'label' => 'Descripción'),
            ),
        ));
        ?>

    </div>