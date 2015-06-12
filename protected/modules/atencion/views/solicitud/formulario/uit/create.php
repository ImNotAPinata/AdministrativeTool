<?php $this->renderPartial('..\resource\_script'); ?>

<h1>Crear Solicitud</h1>

<?php $this->renderPartial('_formuit', array('solicitud' => $solicitud, 'uit' => $uit, 'persona' => $persona,'tramite'=>$tramite, 'IsCreate'=> true)); ?>