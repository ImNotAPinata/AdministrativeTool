<?php $this->renderPartial('..\resource\_script'); ?>

<h1>Actualizar Solicitud</h1>

<?php $this->renderPartial('_formuit', array('solicitud' => $solicitud, 'uit' => $uit, 'persona' => $persona, 'IsCreate'=> false)); ?>