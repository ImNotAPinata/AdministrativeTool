<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

        
        <div class="row">
            <div class="span7">
                <?php echo $form->label($solicitud, 'des_descripcion',array('required'=>false)); ?>
                <?php echo $form->textField($solicitud, 'des_descripcion', array('class' => 'span7', 'maxlength' => 50)); ?>
            </div><div class="span2">
                <?php echo $form->label($solicitud, 'cod_estado'); ?>
                <?php echo $form->dropDownList($solicitud, 'cod_estado', EEstadoSolicitud::getEstadoSolicitudArray(), array('class' => 'span2', 'maxlength' => 50, 'empty' => 'Elegir...')); ?>
            </div><div class="span2">
                <?php echo $form->label($solicitud, 'fk_proceso',array('required'=>false)); ?>
                <?php echo $form->dropDownList($solicitud, 'fk_proceso', CHtml::listData(Proceso::Load(), 'pk_proceso', 'des_descripcion', 'des_proceso'), array('class' => 'span2', 'maxlength' => 50, 'empty' => 'Elegir...')); ?>
            </div>
        </div>
        <div class="row"><br/>
            <div class="span9"><br/>
            <?php
            $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType' => 'submit',
                'type' => 'primary',
                'label' => 'Buscar',
            ));
            ?>
            </div>
            <div class="span2">
                    <?php $pageSize = Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']); ?> 
                    <?php echo chtml::label('Resultados x p�gina','');?>
                    <?php
                    echo CHtml::dropDownList('pageSize', $pageSize, array(10 => 10, 50 => 50, 100 => 100, 1000 => 1000), array(
                        'onchange' => "$.fn.yiiGridView.update('solicitud-grid',{ data:{pageSize: $(this).val() }})",
                        'class' => 'span2'
                    ));
                    ?>
            </div>
        </div>

<?php $this->endWidget(); ?>
