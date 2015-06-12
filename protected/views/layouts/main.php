<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
        <meta http-equiv="x-ua-compatible" content="IE=EmulateIE8" >
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<meta name="language" content="es" />
        
	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div id="Page">
    <div style="padding-top: 40px">
        <?php if(!Yii::app()->user->isGuest) echo $this->renderPartial('//layouts/menu_lleno'); //exporto el menu a otro archivo porque puede llegar a ser muy grande 
              else echo $this->renderPartial('//layouts/menu_vacio');  
        ?>  
    </div>
   
     
    <div class="container">
        <?php echo $content; ?>
    </div><!-- content -->

    <div id="footer">
        Oficina de Administración y Almacén - SUNAT IR La Libertad. <?php echo date('Y'); ?> <br/>
        Versión 0.1
        All Rights Reserved.
        <?php echo Yii::powered(); ?>
    </div><!-- footer -->
</div><!-- page -->

</body>
</html>
