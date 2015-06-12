<?php $this->renderPartial('..\resource\_script'); ?>

<h1>Actualizar Solicitud</h1>

<?php $this->renderPartial('_form', array('solicitud' => $solicitud,'tramite'=>$tramite, 'IsCreate'=> false)); ?>