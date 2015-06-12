<?php
        $this->widget('bootstrap.widgets.TbNavbar', array(
            //'type' => 'inverse', // null or 'inverse' ; se altero el css por defecto
            'fluid'=>true,
            'brand' => 'Oficina de Soporte Administrativo',
            'brandUrl' => Yii::app()->user->isGuest? Yii::app()->request->baseUrl : Yii::app()->homeUrl.'site/welcome',
            'collapse' => false, // requires bootstrap-responsive.css
            'htmlOptions' => array('style'=>'font-size: 14px'),
            'items' => array(
                array(
                    'class' => 'bootstrap.widgets.TbMenu',
                    'htmlOptions' => array('class' => 'pull-right'),
                    'items' => array(
                        array('label' => 'Perfil', 'icon' => 'user white', 'url' => Yii::app()->request->baseUrl.'/perfil/index'),
                        array('label' => 'Ayuda', 'icon' => 'flag white', 'url' => Yii::app()->request->baseUrl.'/help/index'),
                        array('label' => 'Salir (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest),
                    )),
                array(
                    'class' => 'bootstrap.widgets.TbMenu',
                    'items' => array(
                         array('label' => 'Atención', 'url' => '#','icon' => 'cog white', 'items'=>array(
                            //array('label'=>'Principales'), 
                            array('label' => 'Solicitud', 'items'=>array(
                                    array('label'=>'Mis Solicitudes', 'url'=>Yii::app()->request->baseUrl.'/atencion/solicitud/personal/'),
                                    array('label'=>'Atender Solicitudes','url'=>Yii::app()->request->baseUrl.'/atencion/solicitud/atender/','visible'=>Yii::app()->user->esAtenderVisible()), 
                                    array('label'=>'Aprobar Solicitudes', 'url'=>Yii::app()->request->baseUrl.'/atencion/solicitud/aprobar/','visible'=>Yii::app()->user->esJefeAdministracion()),
                                )),
                            array('label' => 'Procesos','visible'=>Yii::app()->user->esAdministrador(),'items'=>array(
                                    array('label'=>'Req. menor a 3 UIT', 'url'=>Yii::app()->request->baseUrl.'/atencion/actividad/uit/'),
                                )), 
                            array('label' => 'Reportes','visible'=>Yii::app()->user->esJefeAdministracion(),'items'=>array(
                                    array('label'=>'De Atención'),
                                    array('label'=>'Efectividad de Atención', 'url'=>Yii::app()->request->baseUrl.'/atencion/reporte/atencion'),
                                    array('label'=>'Pendientes por Usuario', 'url'=>Yii::app()->request->baseUrl.'/atencion/reporte/pendiente'),
                                    '---',
                                    array('label'=>'De Solicitudes'),
                                    array('label'=>'Req. menor a 3 Uit', 'url'=>Yii::app()->request->baseUrl.'/atencion/reporte/uit'),
                                )), 
                            '---', 
                            //array('label'=>'Secundarias'), 
                            array('label' => 'Entidades','visible'=>Yii::app()->user->esAdministrador(),'items'=>array(
                                    array('label'=>'Proveedores', 'url'=>Yii::app()->request->baseUrl.'/atencion/gestionar/proveedor/'),
                                    //array('label'=>'Bienes','url'=> Yii::app()->request->baseUrl.'/atencion/gestionar/bienes/'),
                                    //array('label'=>'Solicitudes', 'url'=>Yii::app()->request->baseUrl.'/atencion/gestionar/solicitud/'),
                                    //'---',
                                    //array('label'=>'Economato', 'url'=> Yii::app()->request->baseUrl.'/atencion/gestionar/economato/'),
                                    //array('label'=>'Patrimonial', 'url'=>Yii::app()->request->baseUrl.'/atencion/gestionar/patrimonial/'),
                                    //array('label'=>'Temporal', 'url'=>Yii::app()->request->baseUrl.'/atencion/gestionar/temporal/'),
                                )),
                            '---',
                            array('label' => 'ECP','visible'=>Yii::app()->user->esAdministrador(),'items'=>array(
                                    array('label'=>'Documentos', 'url'=>Yii::app()->request->baseUrl.'/atencion/reader/'),
                            )),
                            /*array('label' => 'Configuración','items'=>array(
                                array('label'=>'MANTENEDORES'),
                                array('label'=>'Usuario', 'url'=>Yii::app()->request->baseUrl.'/atencion/configuracion/usuario/'),
                                array('label'=>'Persona', 'url'=>Yii::app()->request->baseUrl.'/atencion/configuracion/persona/'),
                                '---',
                                array('label'=>'WEB'),
                                array('label'=>'Correo', 'url'=>Yii::app()->request->baseUrl.'/atencion/configuracion/correo/'),
                                )),*/
                            )),
                        )),
                 array(
                    'class' => 'bootstrap.widgets.TbMenu',
                    'items' => array(
                        
                    )),
                      array(
                    'class' => 'bootstrap.widgets.TbMenu',
                    'items' => array(
                        
                    )),
              )
        ));
// .' () ' 
// Se puede agregar eso para que aparezca tipo outlook que se puede ver cuanto tienes que atender/aceptar
?>