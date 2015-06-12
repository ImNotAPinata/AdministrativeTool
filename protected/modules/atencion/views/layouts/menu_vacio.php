<?php
        $this->widget('bootstrap.widgets.TbNavbar', array(
            //'type' => 'inverse', // null or 'inverse' ; se altero el css por defecto
            'fluid'=>true,
            'brand' => 'Oficina de Administración y Almacén',
            'brandUrl' => Yii::app()->request->baseUrl,
            'collapse' => false, // requires bootstrap-responsive.css
        ));
?>