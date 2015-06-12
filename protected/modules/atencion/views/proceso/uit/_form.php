
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'uit-form',
        'type' => 'vertical',
        //'action' => Yii::app()->createUrl("atencion/proceso/uit/save"),
        'enableAjaxValidation' => false,
            ));
    ?>
    <?php echo $form->errorSummary(array($uit,$tramite)); ?>
    <?php echo chtml::hiddenField('op','',array('id'=>'operation')); ?>
    <?php echo chtml::hiddenField('item','',array('id'=>'item')); ?>
    
    <!--TABS!-->
    <?php
    $tabsarray = array();
    //<!--TABS - REQUERIMIENTO!-->
    if ($uit->cod_uit_estado >= EEstadoUit::Requerimiento) {
        $newtab = array('label' => 'Requerimiento',
            'content' => $this->renderPartial('_uit_requerimiento', array('form' => $form, 'uit' => $uit, 'tramite' => $tramite, 'persona' => $persona), true));
        /*if (EEstadoUit::Requerimiento === $uit->cod_uit_estado) {
            $newtab += array('active' => true);
        }*/
        array_push($tabsarray, $newtab);
    }
    //<!--TABS - ANEXO!-->
    if ($uit->cod_uit_estado >= EEstadoUit::Anexo) {
        $newtab = array('label' => 'Cotiz. y elaboración de anexo 2',
            'content' => $this->renderPartial('_uit_cotizacionanexo2', array('form' => $form, 'uit' => $uit, 'tramite' => $tramite), true));
        /*if (EEstadoUit::Anexo == $uit->cod_uit_estado) {
            $newtab += array('active' => true);
        }*/
        array_push($tabsarray, $newtab);
    }
    //<!--TABS - CCP!-->
    if ($uit->cod_uit_estado >= EEstadoUit::Ccp) {
        $newtab = array('label' => 'CCP',
            'content' => $this->renderPartial('_uit_ccp', array('form' => $form, 'uitproveedors' => $uit->uitproveedors), true));
        /*if (EEstadoUit::Ccp == $uit->cod_uit_estado) {
            $newtab += array('active' => true);
        }*/
        array_push($tabsarray, $newtab);
    }
    //<!--TABS - SERVICIO!-->
    if ($uit->cod_uit_estado >= EEstadoUit::Servicio && $uit->cod_uit_tipo == ETipoUIT::PorDefecto) {
        $newtab = array('label' => 'Compra/prestación del servicio',
            'content' => $this->renderPartial('_uit_compraservicio', array('form' => $form, 'uitproveedors' => $uit->uitproveedors), true));
        if (EEstadoUit::Servicio == $uit->cod_uit_estado) {
            $newtab += array('active' => true);
        }
        array_push($tabsarray, $newtab);
    } else if ($uit->cod_uit_estado >= EEstadoUit::Servicio && $uit->cod_uit_tipo == ETipoUIT::GastosParciales) {
        $newtab = array('label' => 'Compra/prestación del servicio',
            'content' => $this->renderPartial('_uit_gastoparcial', array('form' => $form, 'uitproveedors' =>  $uit->uitproveedors), true));
        /*$newtab += array('active' => true);*/

        array_push($tabsarray, $newtab);
    }
    //<!--TABS - BIENESPATRIMONIALES!-->
    if ($uit->cod_uit_estado >= EEstadoUit::BienesPatrimoniales && $uit->cod_uit_tipo != ETipoUIT::GastosParciales && $uit->UitHaveBienPatrimonial()) {
        $newtab = array('label' => 'Bienes patrimoniales',
            'content' => $this->renderPartial('_uit_bienespatrimoniales', array('form' => $form, 'uitproveedors' => $uit->uitproveedors), true));
        /*if (EEstadoUit::BienesPatrimoniales == $uit->cod_uit_estado) {
            $newtab += array('active' => true);
        }*/
        array_push($tabsarray, $newtab);
    }
 
    ?>
    <div class="row">
        <div class="span-22 well">
            <?php
            $this->widget('bootstrap.widgets.TbTabs', array(
                'type' => 'tabs', // 'tabs' or 'pills'
                'placement' => 'left',
                'tabs' => $tabsarray,
            ));
            ?>
        </div>
    </div>  
    
    <?php echo $this->renderPartial('_get_proveedoruit', array('proveedor'=>$proveedor, 'proveedoruit'=>$proveedoruit,'form'=>$form)); ?>
    <?php if ($uit->cod_uit_estado >= EEstadoUit::Servicio && $uit->cod_uit_tipo == ETipoUIT::GastosParciales) echo $this->renderPartial('_get_facturauit', array('facturauit'=>$facturauit,'form'=>$form,'uitproveedors' => $uit->uitproveedors)); ?>
    <?php echo $this->renderPartial('..\opcion\_formOpcion', array('tramite' => $tramite, 'esfinal'=>$uit->cod_uit_estado==EEstadoUit::BienesPatrimoniales ? true : false, 'form' => $form)); //array('label'=>'Atender','path'=>'..\..\atender')  ?>  
    
        
<?php $this->endWidget(); ?>
