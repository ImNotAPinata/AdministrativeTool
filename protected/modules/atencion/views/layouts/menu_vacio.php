<?php
        $this->widget('bootstrap.widgets.TbNavbar', array(
            //'type' => 'inverse', // null or 'inverse' ; se altero el css por defecto
            'fluid'=>true,
            'brand' => 'Oficina de Administraci�n y Almac�n',
            'brandUrl' => Yii::app()->request->baseUrl,
            'collapse' => false, // requires bootstrap-responsive.css
        ));
?>