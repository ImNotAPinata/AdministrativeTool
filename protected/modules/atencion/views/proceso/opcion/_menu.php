<?php  $this->widget('bootstrap.widgets.TbButtonGroup', array(
                'buttonType' => 'submit',
                'type' => 'default', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                'buttons' => array(
                    array('label' => 'Opciones', 'items' => array(
                            array('label' => 'Atención',
                                'url' => '#',
                                'items' => array(
                                                array('label' => 'Cargar',
                                                    'url' => '#',
                                                    'linkOptions' => array('id' => 'modalidadOption',
                                                        'data-toggle' => 'modal',
                                                        'data-target' => '#ModalidadModal')),
                            )),
                            array('label' => 'Solicitud',
                                'url' => '#',
                                'items' => array(
                                               /* array('label' => 'Ver',
                                                    'url' => '#',
                                                    'linkOptions' => array('id' => 'vsolicitudOption',
                                                        'data-toggle' => 'modal',
                                                        'data-target' => '#vsolicitudModal')),
                                                array('label' => 'Movimientos',
                                                    'url' => '#',
                                                    'linkOptions' => array('id' => 'vmovimientoOption',
                                                        'data-toggle' => 'modal',
                                                        'data-target' => '#vmovimientoModal')),*/
                                                array('label' => 'Devolver',
                                                    'url' => '#',
                                                    'linkOptions' => array('id' => 'devolverOption',
                                                        'data-toggle' => 'modal',
                                                        'data-target' => '#DevolverModal')),
                                                array('label' => 'Rechazar',
                                                    'url' => '#',
                                                    'linkOptions' => array('id' => 'rechazarSolicitud',
                                                        'data-toggle' => 'modal',
                                                        'data-target' => '#RechazarModal')),
                            )),
                    )),
                ),
            ));
?>