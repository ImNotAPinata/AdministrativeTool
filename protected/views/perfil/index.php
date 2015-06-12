<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class="row">
    <div class="span9">
        <h1>Hola, <?php echo Yii::app()->user->name; ?></h1>
    </div>
    <div class="span2">
        <img src='<?php echo Yii::app()->user->getUserPicPath(); ?>' ALIGN=LEFT  id='imagen' name='imagen' width='90' height='100' />
    </div>
</div>




<br/><br/>
<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>Yii::app()->user->getUserModel(),
	'attributes'=>array(
            'UsuarioFullname',
            'registro',
            'area',
	),
)); ?>
